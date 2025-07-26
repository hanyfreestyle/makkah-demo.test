<?php

namespace App\Filament\Admin\Pages\WebSetting;


use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use App\FilamentCustom\Form\Inputs\SoftTranslatableTextArea;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use App\Models\WebSetting\WebSettings;
use App\Models\WebSetting\WebSiteSettings;
use App\Traits\Admin\Helper\SmartResourceTrait;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;
use Filament\Forms;
use Illuminate\Support\Facades\Gate;

class SiteSettings extends Page implements HasForms, HasActions {
  use SmartResourceTrait;

  protected static ?string $navigationIcon = 'heroicon-o-cog';
  protected static string $view = 'filament.admin.pages.web-setting.site-settings';
  public ?array $data = [];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function canAccess(): bool {
    return Gate::allows('viewWebSiteSettings', WebSiteSettings::class); // ✅ استخدام Gate للتحقق من إذن الوصول
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getNavigationGroup(): ?string {
    return __('filament/settings/webSetting.navigation_group');
  }

  public function getTitle(): string|Htmlable {
    return __('filament/settings/webSetting.web.NavigationLabel');
  }

  public static function getNavigationLabel(): string {
    return __('filament/settings/webSetting.web.NavigationLabel');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function mount(): void {
    $record = WebSettings::with('translations')->first();
    if (!$record) {
      return;
    }
    $state = $record->toArray(); // هنا بنجيب كل الحقول العادية
    // دمج الترجمة مع الحقول العادية
    foreach (config('app.web_add_lang') as $locale) {
      $translation = $record->translations->firstWhere('locale', $locale);
      $state[$locale] = [
        'name' => $translation?->name,
        'closed_mass' => $translation?->closed_mass,
        'footer_text' => $translation?->footer_text,
        'meta_des' => $translation?->meta_des,
        'whatsapp_des' => $translation?->whatsapp_des,
        'schema_address' => $translation?->schema_address,
        'schema_city' => $translation?->schema_city,

      ];
    }
    $this->form->fill($state);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function form(Form $form): Form {
    return $form
      ->schema([
        Forms\Components\Group::make()->schema([
          Forms\Components\Group::make()->schema([
            TranslatableTabs::make()
              ->availableLocales(config('app.web_add_lang'))
              ->localeTabSchema(fn (TranslatableTab $tab) => [
                Forms\Components\TextInput::make($tab->makeName('name'))
                  ->label(__('filament/settings/webSetting.web.columns.name'))
                  ->extraAttributes(fn () => rtlIfArabic($tab->getLocale()))
                  ->required(),
                Forms\Components\Textarea::make($tab->makeName('closed_mass'))
                  ->label(__('filament/settings/webSetting.web.columns.closed_mass'))
                  ->rows(3)
                  ->extraAttributes(fn () => rtlIfArabic($tab->getLocale()))
                  ->required(),

                Forms\Components\Textarea::make($tab->makeName('footer_text'))
                  ->label(__('filament/settings/webSetting.web.columns.footer_text'))
                  ->rows(3)
                  ->extraAttributes(fn () => rtlIfArabic($tab->getLocale()))
                  ->required(),

                Forms\Components\TextInput::make($tab->makeName('meta_des'))
                  ->label(__('filament/settings/webSetting.web.columns.meta_des'))
                  ->extraAttributes(fn () => rtlIfArabic($tab->getLocale()))
                  ->required(),
                Forms\Components\TextInput::make($tab->makeName('whatsapp_des'))
                  ->label(__('filament/settings/webSetting.web.columns.whatsapp_des'))
                  ->extraAttributes(fn () => rtlIfArabic($tab->getLocale()))
                  ->required(),

              ])->columns(1),
          ])->columnSpan(2),
          Forms\Components\Group::make()->schema([
            Forms\Components\Section::make(__('filament/settings/webSetting.web.section.setting'))->schema([

              Forms\Components\Toggle::make('web_status')
                ->label(__('filament/settings/webSetting.web.columns.web_status'))
                ->inline(false)
                ->required()
                ->afterStateUpdated(function ($state, callable $set) {
                  if ($state === true) {
                    $set('web_status_date', null);
                  }
                }),

              Forms\Components\DatePicker::make('web_status_date')
                ->label(__('filament/settings/webSetting.web.columns.web_status_date'))
                ->nullable()
                ->requiredIf('web_status', false) // ⬅️ مطلوب فقط لو الموقع مغلق
                ->afterOrEqual(Carbon::tomorrow()->toDateString()) // ⬅️ لازم يكون >= بكره
                ->validationMessages([
                  'required_if' => __('filament/settings/webSetting.web.req.required_if'),
                  'after_or_equal' => __('filament/settings/webSetting.web.req.after_or_equal'),
                ]),

              Forms\Components\Toggle::make('switch_lang')
                ->label(__('filament/settings/webSetting.web.columns.switch_lang'))
                ->inline(false)
                ->required(),

//              Forms\Components\Select::make('lang')
//                ->label(__('filament/settings/webSetting.web.columns.lang'))
//                ->options(config('app.web_lang'))
//                ->searchable()
//                ->preload()
//                ->required(),


//              Forms\Components\Toggle::make('users_login')
//                ->label(__('filament/settings/webSetting.web.columns.users_login'))
//                ->inline(false)
//                ->required(),
//
//
//              Forms\Components\Toggle::make('users_register')
//                ->label(__('filament/settings/webSetting.web.columns.users_register'))
//                ->inline(false)
//                ->required(),
//
//              Forms\Components\Toggle::make('users_forget_password')
//                ->label(__('filament/settings/webSetting.web.columns.users_forget_password'))
//                ->inline(false)
//                ->required(),


            ])->columnSpan(1)->columns(2),
            Forms\Components\Section::make(__('filament/settings/webSetting.web.section.phones'))->schema([
              Forms\Components\Group::make()->schema([
                Forms\Components\TextInput::make('phone_num')
                  ->label(__('filament/settings/webSetting.web.columns.phone_num'))
                  ->maxLength(255)
                  ->extraAttributes(fn () => rtlIfArabic('en'))
                  ->columnSpan(1)
                  ->required(),

                Forms\Components\TextInput::make('phone_call')
                  ->label(__('filament/settings/webSetting.web.columns.phone_call'))
                  ->maxLength(255)
                  ->extraAttributes(fn () => rtlIfArabic('en'))
                  ->columnSpan(1)
                  ->required(),

                Forms\Components\TextInput::make('whatsapp_num')
                  ->label(__('filament/settings/webSetting.web.columns.whatsapp_num'))
                  ->maxLength(255)
                  ->extraAttributes(fn () => rtlIfArabic('en'))
                  ->columnSpan(1)
                  ->required(),

                Forms\Components\TextInput::make('whatsapp_send')
                  ->label(__('filament/settings/webSetting.web.columns.whatsapp_send'))
                  ->maxLength(255)
                  ->extraAttributes(fn () => rtlIfArabic('en'))
                  ->columnSpan(1)
                  ->required(),


              ])->columnSpan(2)->columns(2),

              Forms\Components\TextInput::make('web_url')
                ->label(__('filament/settings/webSetting.web.columns.web_url'))
                ->url()
                ->maxLength(255)
                ->columnSpan(2)
                ->extraAttributes(fn () => rtlIfArabic('en'))
                ->required(),


              Forms\Components\TextInput::make('email')
                ->label(__('filament/settings/webSetting.web.columns.email'))
                ->email()
                ->extraAttributes(fn () => rtlIfArabic('en'))
                ->maxLength(255)
                ->columnSpan(2)
                ->required(),


              Forms\Components\TextInput::make('google_map_url')
                ->extraAttributes(fn () => rtlIfArabic('en'))
                ->label(__('filament/settings/webSetting.web.columns.google_map_url'))
                ->columnSpan(2)
                ->url()
                ->nullable(),

              Forms\Components\TextInput::make('google_map_embed')
                ->extraAttributes(fn () => rtlIfArabic('en'))
                ->label(__('filament/settings/webSetting.web.columns.google_map_embed'))
                ->columnSpan(2)
                ->url()
                ->nullable(),


            ])->columnSpan(1)->columns(2),

          ])->columnSpan(1)->columns(1),

        ])->columnSpanFull()->columns(3),
        Forms\Components\Group::make()->schema([
          Forms\Components\Section::make(__('filament/settings/webSetting.web.section.social'))->schema([

            Forms\Components\TextInput::make('social.facebook')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.facebook'))
              ->url()
              ->nullable(),

            Forms\Components\TextInput::make('social.twitter')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.twitter'))
              ->url()
              ->nullable(),

            Forms\Components\TextInput::make('social.youtube')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.youtube'))
              ->url()
              ->nullable(),

            Forms\Components\TextInput::make('social.instagram')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.instagram'))
              ->url()
              ->nullable(),

            Forms\Components\TextInput::make('social.linkedin')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.linkedin'))
              ->url()
              ->nullable(),


          ])->columnSpan(1)->columns('2'),
          Forms\Components\Section::make("Schema")->schema([

            Forms\Components\Group::make()->schema([
              ...SoftTranslatableTextArea::make()
                ->setInputName('schema_address')
                ->setTransMode(true)
                ->setLabel(__('filament/settings/webSetting.web.columns.schema_address'))
                ->setTextAreaRow(3)
                ->getColumns(),

              ...SoftTranslatableInput::make()
                ->setInputName('schema_city')
                ->setTransMode(true)
                ->setLabel(__('filament/settings/webSetting.web.columns.schema_city'))
                ->getColumns(),

            ])->columnSpan(6)->columns(2),

            Forms\Components\TextInput::make('schema.type')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.schema_type'))
              ->columnSpan(3)
              ->nullable(),

            Forms\Components\TextInput::make('schema.country')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.schema_country'))
              ->columnSpan(3)
              ->nullable(),

            Forms\Components\TextInput::make('schema.lat')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.schema_lat'))
              ->columnSpan(2)
              ->nullable(),

            Forms\Components\TextInput::make('schema.long')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.schema_long'))
              ->columnSpan(2)
              ->nullable(),

            Forms\Components\TextInput::make('schema.postal_code')
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->label(__('filament/settings/webSetting.web.columns.schema_postal_code'))
              ->columnSpan(2)
              ->nullable(),


          ])->columnSpan(1)->columns('6'),
        ])->columnSpanFull()->columns(2),

        Forms\Components\Group::make()->schema([

        ])->columnSpan(1)->columns(2),
      ])->columns(2)
      ->statePath('data')
      ->model(WebSettings::class);

  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function submit(): void {
    $data = $this->form->getState();
    // لو الموقع مفتوح → نخلي التاريخ null
    if ($data['web_status'] === true) {
      $data['web_status_date'] = null;
    }
    $record = WebSettings::first();
    if (!$record) {
      WebSettings::create($data);
    } else {
      $record->update($data);
    }

    Notification::make()
      ->title(__('default/lang.notification.update'))
      ->success()
      ->send();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected function getFormActions(): array {
    return [
      Action::make('submit')
        ->label(__('default/lang.but.update'))
        ->action('submit')
        ->color('primary'),
    ];
  }
}
