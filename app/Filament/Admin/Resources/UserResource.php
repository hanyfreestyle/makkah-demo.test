<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\TableUsersResource;
use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Models\User;
use App\Traits\Admin\Helper\SmartResourceTrait;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use FreestyleRepo\FilamentPhoneInput\Forms\PhoneInput;
use FreestyleRepo\FilamentPhoneInput\PhoneInputNumberType;
use Illuminate\Support\Facades\Hash;
use Filament\Forms;

use libphonenumber\PhoneNumberType;


class UserResource extends Resource implements HasShieldPermissions {
    use SmartResourceTrait;
    use TableUsersResource;

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPermissionPrefixes(): array {
        return static::filterPermissions(
            skipKeys: ['slug'],
            keepKeys: [],
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {

        return $form->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\TextInput::make('name')
                        ->label(__('default/users.columns.name'))
                        ->maxLength(255)
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->label(__('default/users.columns.email'))
                        ->email()
                        ->unique(User::class, 'email', ignoreRecord: true)
                        ->maxLength(255)
                        ->autocomplete('off')
                        ->required(),

                    PhoneInput::make('phone')
                        ->onlyCountries(['EG'])
                        ->validateFor(
                            country: 'AUTO',
                            type: PhoneNumberType::MOBILE,
                            lenient: false
                        )
                        ->countryStatePath('phone_country')
                        ->formatAsYouType(true)
                        ->inputNumberFormat(PhoneInputNumberType::E164) // يتم حفظه كـ +201221563252
                        ->displayNumberFormat(PhoneInputNumberType::NATIONAL) // يعرض للمستخدم بصيغة محلية
                        ->dehydrateStateUsing(fn($state) => $state) // للتأكد من حفظ التنسيق الدولي
                        ->unique('users', 'phone', ignoreRecord: true)
                        ->nullable(),

                    Forms\Components\TextInput::make('password')
                        ->label(__('default/users.columns.password'))
                        ->password()
                        ->default(fn(string $context) => $context === 'edit' ? '' : null)
                        ->required(fn($record) => !$record) // مطلوب فقط عند الإنشاء
                        ->dehydrateStateUsing(fn($state) => !empty($state) ? Hash::make($state) : null) // تشفير كلمة المرور قبل الحفظ
                        ->dehydrated(fn($state) => !empty($state)) // يمنع إعادة تعيين كلمة المرور إذا لم يتم إدخالها
                        ->autocomplete('new-password')
                        ->maxLength(255),

                ])->columns(2),

                Forms\Components\Section::make(__('default/users.card.team'))->schema([
                    Forms\Components\CheckboxList::make('user_team')
                        ->label('فريق العمل')
                        ->options(function () {
                            return User::query()
                                ->where('team_leader', false)
                                ->where('sales', true)
                                ->where('is_active', true)
                                ->where('is_archived', false)
                                ->pluck('name', 'id')
                                ->toArray();
                        })
                        ->columns(4) // You can adjust number of columns
                        ->bulkToggleable(), // Optional: for "select all" feature
                ]) ->hidden(fn(callable $get) =>
                    ! $get('team_leader') || ! config('appConfig.users_team_leader')
                )
                    ->columnSpanFull(),

            ])->columnSpan(2),

            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Group::make()->schema([
                        ...WebpUploadFixedSize::make()
                            ->setFileName('avatar_url')
                            ->setUploadDirectory('avatar_url')
                            ->setRequiredUpload(false)
                            ->setResize(150, 150, 90)
                            ->getColumns(),
                    ])->columnSpanFull(),


                    Forms\Components\Toggle::make('is_active')
                        ->label(__('default/lang.columns.is_active'))
                        ->default(true)
                        ->inline(false)
                        ->required(),

                    Forms\Components\Toggle::make('is_archived ')
                        ->label(__('default/lang.columns.is_archive'))
                        ->default(false)
                        ->inline(false)
                        ->required(),

                    Forms\Components\Toggle::make('sales')
                        ->label(__('default/users.columns.sales'))
                        ->default(false)
                        ->inline(false)
                        ->hidden(fn () => ! config('appConfig.users_sales'))
                        ->required(),

                    Forms\Components\Toggle::make('team_leader')
                        ->label(__('default/users.columns.team_leader'))
                        ->default(false)
                        ->inline(false)
                        ->reactive()
                        ->hidden(fn () => ! config('appConfig.users_team_leader'))
                        ->afterStateUpdated(fn($state, callable $set) => $set('user_team', $state ? [] : null))
                        ->required(),

                ])->columns(2),
                Forms\Components\Section::make(__('default/users.card.roles'))->schema([
                    Forms\Components\Select::make('role')
                        ->hiddenLabel()
                        ->relationship('roles', 'name')
                        ->preload()
                        ->multiple()
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2),
            ])->columnSpan(1),

        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getRelations(): array {
        return [
            //
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('default/users.navigation_group');
    }

    public static function getModelLabel(): string {
        return __('default/users.model_label');
    }

    public static function getPluralModelLabel(): string {
        return __('default/users.plural_model_label');
    }

    public static function getNavigationLabel(): string {
        return __('default/users.navigation_label');
    }

}
