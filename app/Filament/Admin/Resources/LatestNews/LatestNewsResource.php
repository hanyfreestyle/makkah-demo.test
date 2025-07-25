<?php

namespace App\Filament\Admin\Resources\LatestNews;

use App\FilamentCustom\Form\Translation\MainInputWithSlug;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\LatestNews\LatestNewsResource\TableLatestNews;
use App\Filament\Admin\Resources\LatestNews\LatestNewsResource\Pages;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\FilamentCustom\UploadFile\WebpUploadWithFilter;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\LatestNews\LatestNews;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;

class LatestNewsResource extends Resource implements HasShieldPermissions {
  use Translatable;
  use SmartResourceTrait;
  use TableLatestNews;

  protected static ?string $model = LatestNews::class;
  protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';
  protected static ?string $translationTable = 'latest_news_lang';
  protected static ?string $uploadDirectory = 'latest-news';

//    public static bool $showCategoryActions = true;
//    public static string $relatedResourceClass = BlogCategoryResource::class;
//    public static string $modelPolicy = LatestNews::class;

//    public static function canViewAny(): bool {
//        return Gate::forUser(auth()->user())->allows('viewAnyCategory', LatestNews::class) ;
//    }
//
//    public static function shouldRegisterNavigation(): bool {
//        return false;
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListLatestNews::route('/'),
      'create' => Pages\CreateLatestNews::route('/create'),
      'edit' => Pages\EditLatestNews::route('/{record}/edit'),
    ];
  }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    $filterId = getModuleConfigKey("LatestNews_filter_photo", 0);

    return $form->schema([
      Group::make()->schema([
        TranslatableTabs::make('translations')
          ->availableLocales(config('app.web_add_lang'))
          ->localeTabSchema(fn (TranslatableTab $tab) => [
            ...MainInputWithSlug::make()
              ->setDes(true)
              ->setEditor(true)
              ->setSeoRequired(false)
              ->getColumns($tab, 'latest_news_lang'),
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
//        return __('latest-news/latest-news.navigation_group');
//    }
//    public static function getNavigationLabel(): string {
//        return __('latest-news/latest-news.navigation_label');
//    }
//    public static function getModelLabel(): string {
//        return __('latest-news/latest-news.model_label');
//    }
//    public static function getPluralModelLabel(): string {
//        return __('latest-news/latest-news.plural_model_label');
//    }

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
