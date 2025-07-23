<?php

namespace App\Traits\CrmData;


use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use App\FilamentCustom\Table\FilterWithArchive;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Filament\Actions;

trait SmartCrmDataResourceTrait {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function defaultTable(Table $table): Table {
        $thisLang = app()->getLocale();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label("#")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name.' . $thisLang)
                    ->label(__('default/lang.columns.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('default/lang.columns.is_active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_archive')
                    ->label(__('default/lang.columns.is_archive'))
                    ->boolean()
                    ->sortable(),

            ])->filters([
                ...FilterWithArchive::make()->getColumns(),
            ])
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->persistSortInSession()
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

            ])
            ->recordUrl(fn($record) => static::getTableRecordUrl($record))
            ->defaultSort('id', 'desc');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function defaultForm(Form $form, $tableName): Form {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                ...SoftTranslatableInput::make()->setUniqueTable($tableName)->getColumns(),
            ])->columnSpan(2)->columns(2),
            Forms\Components\Section::make()->schema([
                Forms\Components\Toggle::make('is_active')
                    ->label(__('default/lang.columns.is_active'))
                    ->inline(false)
                    ->default(true)
                    ->required(),
                Forms\Components\Toggle::make('is_archive')
                    ->label(__('default/lang.columns.is_archive'))
                    ->inline(false)
                    ->default(false)
                    ->required(),
            ])->columnSpan(1)->columns(2),
        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getResourceNavigationActionGroup(): ActionGroup {
        return Actions\ActionGroup::make(
            collect(NavigationResource::LoadNavigationBuilder())
                ->filter(fn($item) => $item['resource'] !== static::getResource())
                ->map(fn(array $resource) => Actions\Action::make($resource['name'])
                    ->label($resource['label'])
                    ->url($resource['url'])
                    ->icon($resource['icon'] ?? null)
                )
                ->toArray()
        )
            ->label('انتقل إلى مورد آخر')
            ->button()
            ->icon('heroicon-o-arrow-right-circle')
//            ->tooltip('اختر مورداً للانتقال إليه')
            ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getResourceNavigationFormSelect(): Action {
        return Action::make('navigate_to')
            ->label('الانتقال إلى مورد')      // نص الزر
            ->icon('heroicon-o-chevron-down')  // أى أيقونة مناسبة
            ->modalHeading('اختر مورداً')
            ->modalSubmitActionLabel('انتقل')  // اسم زر التنفيذ
            // ❶ النموذج يحوى Select واحد
            ->form([
                Select::make('url')
                    ->label('الموارد المتاحة')
                    ->options($this->getResourceOptions())  // key = الرابط، value = التسمية
                    ->searchable()
                    ->required(),
            ])
            // ❷ الكول-باك يتسلّم $data['url']
            ->action(function (array $data): void {
                $url = $data['url'] ?? null;
                if ($url) {
                    redirect()->to($url);
                }
            });
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getResourceOptions(): array {
        return collect(NavigationResource::LoadNavigationBuilder())
            ->filter(fn($item) => $item['resource'] !== static::getResource())
            ->mapWithKeys(fn($item) => [
                $item['resource']::getUrl('index') => $item['label'],
            ])->toArray();
    }

}
