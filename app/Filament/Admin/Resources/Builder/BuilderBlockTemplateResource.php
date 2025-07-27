<?php

namespace App\Filament\Admin\Resources\Builder;

use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderBlockTemplateResource\Pages;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\FilamentCustom\Form\Inputs\SlugInput;
use App\FilamentCustom\Form\Translation\MainInput;
use App\FilamentCustom\UploadFile\WebpUploadWithFilter;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderBlockTemplate;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Gate;
use Filament\Tables;
use Filament\Forms;

class BuilderBlockTemplateResource extends Resource implements HasShieldPermissions {
  use Translatable;
  use SmartResourceTrait;


  protected static ?string $model = BuilderBlockTemplate::class;
  protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';
  protected static ?string $uploadDirectory = 'builder-template';

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
      'index' => Pages\ListBuilderBlockTemplates::route('/'),
      'create' => Pages\CreateBuilderBlockTemplate::route('/create'),
      'edit' => Pages\EditBuilderBlockTemplate::route('/{record}/edit'),
    ];
  }

  public static function table(Table $table): Table {
    $thisLang = app()->getLocale();

    return $table->columns([
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
    $filterId = getModuleConfigKey("builder_block_template_filter_photo", 0);

    return $form->schema([
      Group::make()->schema([
        SlugInput::make('slug'),
        TranslatableTabs::make('translations')
          ->availableLocales(config('app.web_add_lang'))
          ->localeTabSchema(fn (TranslatableTab $tab) => [
            ...MainInput::make()
              ->setDes(false)
              ->setSeoRequired(false)
              ->getColumns($tab),
          ]),
      ])->columnSpan(2),

      Group::make()->schema([
        Section::make()->schema([
          ...WebpUploadWithFilter::make()
            ->setFilterId($filterId)
            ->setUploadDirectory(static::$uploadDirectory)
            ->setRequiredUpload(false)
            ->setCanChangeFilter(true)
            ->getColumns(),

          Toggle::make('is_active')
            ->label(__('default/lang.columns.is_active'))
            ->default(true)
            ->required(),
        ]),
      ])->columnSpan(1),
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
//        return __('builder/builder-block-template.navigation_group');
//    }
//    public static function getNavigationLabel(): string {
//        return __('builder/builder-block-template.navigation_label');
//    }
//    public static function getModelLabel(): string {
//        return __('builder/builder-block-template.model_label');
//    }
//    public static function getPluralModelLabel(): string {
//        return __('builder/builder-block-template.plural_model_label');
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
    return $record->translation->name ?? null;
  }
}
