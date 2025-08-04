<?php

namespace App\Filament\Admin\Resources\Builder\BuilderBlocksResource;

use App\Enums\Builder\EnumsBlockTemplate;
use App\Enums\Builder\EnumsBlockType;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource;
use App\Models\Builder\BuilderBlock;
use App\Models\Builder\BuilderPage;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

trait BuilderBlockTable {
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function table(Table $table): Table {
    $thisLang = app()->getLocale();

    return $table
      ->modifyQueryUsing(fn ($query) => $query->with('template'))
      ->columns([

        Tables\Columns\TextColumn::make('id')
          ->label("#")
          ->sortable()
          ->searchable(),

        ImageColumn::make('template.photo')
          ->label('')
          ->disk('root_folder'),

        Tables\Columns\TextColumn::make('name.' . $thisLang)
          ->label(__('default/lang.columns.name'))
          ->sortable()
          ->searchable(),

        Tables\Columns\TextColumn::make('pages')
          ->label('الصفحات')
          ->getStateUsing(fn ($record) => $record->pages->map(fn ($pages) => $pages->display_name)->toArray())
          ->badge(),


        Tables\Columns\TextColumn::make('template.template')
          ->label(__('builder/builder-block-template.columns.template'))
          ->formatStateUsing(fn ($state) => EnumsBlockTemplate::tryFrom($state)?->label())
          ->sortable()
          ->searchable(),


        Tables\Columns\TextColumn::make('template.type')
          ->label(__('builder/builder-block-template.columns.type'))
          ->formatStateUsing(fn ($state) => EnumsBlockType::tryFrom($state)?->label())
          ->sortable()
          ->searchable(),

        Tables\Columns\ToggleColumn::make('is_active')
          ->label(__('default/lang.columns.is_active'))
          ->visible(fn () => Auth::user()?->can('update_builder::builder::blocks')),


        Tables\Columns\IconColumn::make('is_update')
          ->label(__('builder/builder-block-template.columns.is_update'))
          ->boolean(),


      ])->filters([

        SelectFilter::make('template.type')
          ->label(__('builder/builder-block-template.columns.type'))
          ->options(
            collect(EnumsBlockType::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->sort()
              ->toArray()
          )
          ->multiple()
          ->searchable()
          ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
            if (empty($data['values'])) {
              return $query;
            }
            return $query->whereHas('template', function ($q) use ($data) {
              // استخدم whereIn بدلاً من where للتعامل مع المصفوفة
              $q->whereIn('type', $data['values']);
            });
          })
          ->preload(),


        SelectFilter::make('template.template')
          ->label(__('builder/builder-block-template.columns.template'))
          ->options(
            collect(EnumsBlockTemplate::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->sort()
              ->toArray()
          )
          ->searchable()
          ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
            if (!$data['value']) {
              return $query;
            }

            return $query->whereHas('template', function ($q) use ($data) {
              $q->where('template', $data['value']);
            });
          })
          ->preload(),


        SelectFilter::make('page_id')
          ->label('الصفحة')
          ->options(
            BuilderPage::all()
              ->pluck("name." . app()->getLocale(), 'id')
              ->toArray()
          )
          ->searchable()
          ->preload()
          ->query(function ($query, $data) {
            if (!$data['value']) return $query;

            return $query->whereHas('pages', function ($q) use ($data) {
              $q->where('builder_page.id', $data['value']); // ← هنا التعديل
            });
          }),


      ], layout: FiltersLayout::Modal)->filtersFormColumns(4)
      ->persistFiltersInSession()
      ->persistSearchInSession()
      ->persistSortInSession()
      ->actions([
        Tables\Actions\EditAction::make()->iconButton(),
        Tables\Actions\DeleteAction::make()->iconButton(),


        Action::make('copy')
          ->label(__('default/lang.but.copy'))
          ->icon('heroicon-o-rectangle-stack')
          ->color('success')
          ->requiresConfirmation() // ✅ 1. تأكيد قبل النسخ
          ->action(function (BuilderBlock $record, array $arguments) {
            // ✅ 2. إنشاء نسخة من السجل
            $newRecord = new BuilderBlock();
            $newRecord->template_id = $record->template_id;
            $newRecord->name = [
              'ar' => $record->name['ar'] . ' ---Copy',
              'en' => $record->name['en'] . ' ---Copy',
            ];
            $newRecord->schema = $record->schema;
            $newRecord->save();

            // ✅ 3. إشعار نجاح (باستخدام Filament Notification)
            Notification::make()
              ->title(__('default/lang.notification.copy'))
              ->success()
              ->send();

            // ✅ 4. إعادة التوجيه إلى صفحة تعديل السجل الجديد
            return redirect(
              BuilderBlocksResource::getUrl('edit', ['record' => $newRecord])
            );
          })
          ->size(ActionSize::Small)

      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ])
      ->recordUrl(fn ($record) => static::getTableRecordUrl($record))
      ->defaultSort('id', 'desc');
  }
}

