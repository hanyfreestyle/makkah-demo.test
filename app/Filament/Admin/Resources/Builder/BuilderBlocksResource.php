<?php

namespace App\Filament\Admin\Resources\Builder;

use App\FilamentCustom\Form\Inputs\SlugInput;
use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderBlock;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Forms;

class BuilderBlocksResource extends Resource {
  use Translatable;
  use SmartResourceTrait;

  protected static ?string $model = BuilderBlock::class;
  protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';
  protected static ?string $uploadDirectory = 'BuilderBlocksResource';

//  public static bool $showCategoryActions = true;
//  public static string $relatedResourceClass = BlogCategoryResource::class;
//  public static string $modelPolicy = BuilderPage::class;
//
//  public static function canViewAny(): bool {
//    return Gate::forUser(auth()->user())->allows('viewAnyCategory', BuilderPage::class) ;
//  }
//
//  public static function shouldRegisterNavigation(): bool {
//    return false;
//  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListBuilderBlocks::route('/'),
      'create' => Pages\CreateBuilderBlocks::route('/create'),
      'edit' => Pages\EditBuilderBlocks::route('/{record}/edit'),
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

    return $form->schema([
      Forms\Components\Section::make()->schema([
//        Forms\Components\TextInput::make('slug')->required(),
        SlugInput::make('slug')->required(),
        ...SoftTranslatableInput::make()->setUniqueTable("builder_block")->getColumns(),
        Forms\Components\Repeater::make('schema.items')
          ->label('Items')
          ->schema([
            Forms\Components\TextInput::make('number')->numeric()->required(),
            Forms\Components\Grid::make(2)->schema([
              Forms\Components\TextInput::make('icon')->label('icon')->required(),
              Forms\Components\TextInput::make('label.ar')->label('Label (AR)')->required(),
              Forms\Components\TextInput::make('label.en')->label('Label (EN)')->required(),
            ]),
          ])
          ->minItems(1)
          ->defaultItems(1)

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
    return [];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public static function getNavigationGroup(): ?string {
//        return __('builder/builder-blocks.navigation_group');
//    }
//    public static function getNavigationLabel(): string {
//        return __('builder/builder-blocks.navigation_label');
//    }
//    public static function getModelLabel(): string {
//        return __('builder/builder-blocks.model_label');
//    }
//    public static function getPluralModelLabel(): string {
//        return __('builder/builder-blocks.plural_model_label');
//    }

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
