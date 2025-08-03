<?php

namespace App\Filament\Admin\Resources\Builder;

use App\Enums\Builder\EnumsBlockTemplate;
use App\Enums\Builder\EnumsBlockType;
use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use App\Models\Builder\BuilderBlockTemplate;
use App\Models\Builder\BuilderPage;
use App\Models\SnapCode;
use App\Service\Builder\BlockFormFactory;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Get;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderBlock;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;


class BuilderBlocksResource extends Resource implements HasShieldPermissions {
  use Translatable;
  use SmartResourceTrait;

  protected static ?string $model = BuilderBlock::class;
  protected static ?string $navigationIcon = 'fas-puzzle-piece';
  protected static ?string $uploadDirectory = 'BuilderBlocksResource';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListBuilderBlocks::route('/'),
      'create' => Pages\CreateBuilderBlocks::route('/create'),
      'edit' => Pages\EditBuilderBlocks::route('/{record}/edit'),
    ];
  }

  public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder {
    return parent::getEloquentQuery()->with('template');
  }


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
          ->visible(fn () => Auth::user()?->can('update_builder::builder::blocks'))
          ->sortable(),


      ])->filters([

//        SelectFilter::make('template.type')
//          ->label(__('builder/builder-block-template.columns.type'))
//          ->options(
//            collect(EnumsBlockType::cases())
//              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
//              ->sort()
//              ->toArray()
//          )
//          ->multiple()
//          ->searchable()
//          ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
//            if (!$data['value']) {
//              return $query;
//            }
//
//            return $query->whereHas('template', function ($q) use ($data) {
//              $q->where('type', $data['value']);
//            });
//          })
//          ->preload(),


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
              ->pluck("name." . app()->getLocale(), 'id') // لو name مترجم: ->pluck("name->" . app()->getLocale(), 'id')
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


        Action::make('copy')
          ->label(__('Copy'))
          ->action(function (BuilderBlock $record) {
//            dd($record->name['ar']);
            $newRecord = new BuilderBlock();
            $newRecord->template_id = $record->template_id;
            $newRecord->name = ['ar' => $record->name['ar'] . '  ---Copy', 'en' => $record->name['en'] . '  ---Copy'];
            $newRecord->schema = $record->schema;
            $newRecord->save();

            // نسخ العلاقة "pages" (علاقة many-to-many)
//            foreach ($record->pages as $relation) {
//              $newRecord->pages()->attach($relation->id, [
//                'position' => $relation->pivot->position
//              ]);
//            }
            session()->flash('success', __('The record has been copied successfully!'));
//            return redirect()->route('filament.resources.codes.update', [
//              'resource' => 'snap-codes',
//              'record' => $newRecord->id,
//            ]);
          })
          ->icon('heroicon-o-rectangle-stack')
          ->color('success'),

        Tables\Actions\EditAction::make()->iconButton(),
        Tables\Actions\DeleteAction::make()->iconButton(),

      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ])
      ->recordUrl(fn ($record) => static::getTableRecordUrl($record))
      ->defaultSort('id', 'desc');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    return $form->schema([

      Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([
          ...SoftTranslatableInput::make()->setUniqueTable("builder_block")->getColumns(),
        ])->columns(2),

      ])->columnSpan(6)->columns(2),


      Forms\Components\Group::make()->schema([
        Forms\Components\View::make('builder/admin/template-photo')
          ->label(false)
          ->visible(fn ($get, $livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
      ])->columnSpan(2)->columns(1),


      Forms\Components\Section::make()->schema([
        Forms\Components\Select::make('type')
          ->label(__('builder/builder-blocks.columns.block_type'))
          ->searchable()
          ->preload()
          ->options(
            collect(EnumsBlockType::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->sort()
              ->toArray()
          )
          ->reactive()
          ->required(),

        RadioButtonImage::make('template_id')
          ->label(__('builder/builder-blocks.columns.block_template'))
          ->options(function (callable $get) {
            if (!$get('type')) {
              return [];
            }

            return BuilderBlockTemplate::query()
              ->when($get('type'), fn ($q, $type) => $q->where('type', $type))
              ->get()
              ->mapWithKeys(fn ($template) => [
                $template->id => ['name' => $template->name['ar'], 'photo' => $template->photo ?? 'builder-template/noPhoto.webp'],
              ])
              ->toArray();
          })->required()

      ])
        ->columnSpanFull()
        ->visible(fn (Get $get, $livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),


      Forms\Components\Group::make()
        ->schema(function (Get $get) {
          $slug = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->slug;
          $type = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->type;
          return BlockFormFactory::make($type, $slug);
        })
        ->columns(8)
        ->columnSpanFull()
        ->visible(fn ($get, $livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
    ])->columns(8);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRelations(): array {
    return [];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getNavigationGroup(): ?string {
    return __('builder/builder-block-template.navigation_group');
  }

  public static function getNavigationLabel(): string {
    return __('builder/builder-blocks.navigation_label');
  }


  public static function getModelLabel(): string {
    return __('builder/builder-blocks.model_label');
  }


  public static function getPluralModelLabel(): string {
    return __('builder/builder-blocks.plural_model_label');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPermissionPrefixes(): array {
    return static::filterPermissions(
      skipKeys: ['view'],
      keepKeys: ['sort', 'replicate'],
    );
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRecordTitle(?Model $record): Htmlable|string|null {
    return getTranslatedValue($record->name) ?? null;
  }


}
