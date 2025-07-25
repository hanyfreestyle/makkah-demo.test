<?php
namespace App\Filament\Admin\Resources\Makkah;

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
use Illuminate\Support\Facades\Gate;

class MakkahProjectResource extends Resource implements HasShieldPermissions {
    use Translatable;
    use SmartResourceTrait;
    use TableMakkahProject;

    protected static ?string $model = MakkahProject::class;
    protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';
    protected static ?string $translationTable = 'makkah_project_lang';
    protected static ?string $uploadDirectory = 'MakkahProjectResource';

//    public static bool $showCategoryActions = true;
//    public static string $relatedResourceClass = BlogCategoryResource::class;
//    public static string $modelPolicy = MakkahProject::class;

//    public static function canViewAny(): bool {
//        return Gate::forUser(auth()->user())->allows('viewAnyCategory', MakkahProject::class) ;
//    }
//
//    public static function shouldRegisterNavigation(): bool {
//        return false;
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array {
        return [
            'index' => Pages\ListMakkahProjects::route('/'),
            'create' => Pages\CreateMakkahProject::route('/create'),
            'view' => Pages\ViewMakkahProject::route('/{record}'),
            'edit' => Pages\EditMakkahProject::route('/{record}/edit'),
        ];
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {
        $filterId = getModuleConfigKey("makkah_project_filter_photo", 0);

        return $form->schema([
            Group::make()->schema([
                SlugInput::make('slug'),
                TranslatableTabs::make('translations')
                    ->availableLocales(config('app.web_add_lang'))
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
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
//        return __('makkah/makkah-project.navigation_group');
//    }
//    public static function getNavigationLabel(): string {
//        return __('makkah/makkah-project.navigation_label');
//    }
//    public static function getModelLabel(): string {
//        return __('makkah/makkah-project.model_label');
//    }
//    public static function getPluralModelLabel(): string {
//        return __('makkah/makkah-project.plural_model_label');
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
