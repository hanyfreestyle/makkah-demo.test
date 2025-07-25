<?php

namespace App\Filament\Admin\Resources\Makkah;

use App\FilamentCustom\Form\Translation\MainInputWithSlug;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Makkah\MakkahProjectResource\TableMakkahProject;
use App\Filament\Admin\Resources\Makkah\MakkahProjectResource\Pages;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\FilamentCustom\Form\Inputs\SlugInput;
use App\FilamentCustom\Form\Translation\MainInput;
use App\FilamentCustom\UploadFile\WebpUploadWithFilter;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Makkah\MakkahProject;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms;

class MakkahProjectResource extends Resource implements HasShieldPermissions {
  use Translatable;
  use SmartResourceTrait;
  use TableMakkahProject;

  protected static ?string $model = MakkahProject::class;
  protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';
  protected static ?string $translationTable = 'makkah_project_lang';
  protected static ?string $uploadDirectory = 'project';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListMakkahProjects::route('/'),
      'create' => Pages\CreateMakkahProject::route('/create'),
      'edit' => Pages\EditMakkahProject::route('/{record}/edit'),
    ];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    $filterId = getModuleConfigKey("LatestNews_filter_photo", 0);
    $filterId = getModuleConfigKey("LatestNews_filter_photosssssss", 5);

    return $form->schema([
      Forms\Components\Group::make()->schema([
        TranslatableTabs::make('translations')
          ->availableLocales(config('app.web_add_lang'))
          ->localeTabSchema(fn (TranslatableTab $tab) => [
            ...MainInputWithSlug::make()
              ->setDes(true)
              ->setEditor(true)
              ->setSeoRequired(false)
              ->getColumns($tab, static::$translationTable),
          ]),
      ])->columnSpan(2),

      Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([
          ...WebpUploadWithFilter::make()
            ->setFilterId($filterId)
            ->setUploadDirectory(static::$uploadDirectory)
            ->setRequiredUpload(false)
            ->setCanChangeFilter(false)
            ->getColumns(),

          Forms\Components\Toggle::make('is_active')
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
//  public static function getNavigationGroup(): ?string {
//    return __('makkah/makkah-project.navigation_group');
//  }

  public static function getNavigationLabel(): string {
    return __('makkah/makkah-project.navigation_label');
  }

  public static function getModelLabel(): string {
    return __('makkah/makkah-project.model_label');
  }

  public static function getPluralModelLabel(): string {
    return __('makkah/makkah-project.plural_model_label');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPermissionPrefixes(): array {
    return static::filterPermissions(
      skipKeys: ['view'],
      keepKeys: [],
    );
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRecordTitle(?Model $record): Htmlable|string|null {
    return $record->translation->name ?? null;
  }
}
