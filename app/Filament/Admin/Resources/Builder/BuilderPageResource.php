<?php

namespace App\Filament\Admin\Resources\Builder;


use App\Filament\Admin\Resources\Builder\BuilderPageResource\RelationManagers\BlocksRelationManager;
use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderPageResource\Pages;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderPage;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Forms;

class BuilderPageResource extends Resource {
  use Translatable;
  use SmartResourceTrait;

  protected static ?string $model = BuilderPage::class;
  protected static ?string $navigationIcon = 'fas-file-lines';
  protected static ?string $uploadDirectory = 'BuilderPageResource';

//    public static bool $showCategoryActions = true;
//    public static string $relatedResourceClass = BlogCategoryResource::class;
//    public static string $modelPolicy = BuilderPage::class;
//
//    public static function canViewAny(): bool {
//        return Gate::forUser(auth()->user())->allows('viewAnyCategory', BuilderPage::class) ;
//    }
//
//    public static function shouldRegisterNavigation(): bool {
//        return false;
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListBuilderPages::route('/'),
      'create' => Pages\CreateBuilderPage::route('/create'),
      'edit' => Pages\EditBuilderPage::route('/{record}/edit'),
    ];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function table(Table $table): Table {
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

        Tables\Columns\TextColumn::make('blocks')
          ->label('البلوكات')
          ->getStateUsing(fn ($record) => $record->blocks->map(fn ($block) => $block->display_name)->toArray()
          )->badge(),

        Tables\Columns\IconColumn::make('is_active')
          ->label(__('default/lang.columns.is_active'))
          ->boolean()
          ->sortable(),

      ])->filters([
//        ...FilterWithArchive::make()->getColumns(),
      ])
      ->persistFiltersInSession()
      ->persistSearchInSession()
      ->persistSortInSession()
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([

      ])
      ->recordUrl(fn ($record) => static::getTableRecordUrl($record))
      ->defaultSort('id', 'desc');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    $filterId = getModuleConfigKey("builder_page_filter_photo", 0);
    $locale = app()->getLocale();

    return $form->schema([
      Forms\Components\Section::make()->schema([
        ...SoftTranslatableInput::make()->setUniqueTable("builder_page")->getColumns(),

        Forms\Components\Select::make('blocks')
          ->label( __('builder/builder-page.columns.blocks'))
          ->relationship('blocks', 'id') // ← نرجّع الترتيب للـ id
          ->getOptionLabelFromRecordUsing(fn ($record) => $record->display_name)
          ->multiple()
          ->preload()
          ->columnSpanFull()
          ->searchable(),

      ])->columnSpan(2)->columns(2),
      Forms\Components\Section::make()->schema([
        Forms\Components\Toggle::make('is_active')
          ->label(__('default/lang.columns.is_active'))
          ->inline(false)
          ->default(true)
          ->required(),

      ])->columnSpan(1)->columns(2),
    ])->columns(3);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRelations(): array {
    return [
      BlocksRelationManager::class,
    ];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getNavigationGroup(): ?string {
    return __('builder/builder-block-template.navigation_group');
  }

  public static function getNavigationLabel(): string {
    return __('builder/builder-page.navigation_label');
  }

  public static function getModelLabel(): string {
    return __('builder/builder-page.model_label');
  }

  public static function getPluralModelLabel(): string {
    return __('builder/builder-page.plural_model_label');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPermissionPrefixes(): array {
    return static::filterPermissions(
      skipKeys: ['view'],
      keepKeys: ['cat', 'sort', 'publish'],
    );
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRecordTitle(?Model $record): Htmlable|string|null {
    return getTranslatedValue($record->name) ?? null;
  }
}
