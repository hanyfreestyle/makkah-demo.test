<?php

namespace App\Service\Builder\Function;


use App\Enums\Builder\EnumsConfigPaddingTop;
use App\Enums\Styles\EnumsColumnsSize;
use App\Enums\Styles\EnumsMarginSize;
use App\Enums\Styles\EnumsPaddingSize;
use Filament\Forms;
use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;


class ConfigInputs {
  use SetProtectedValTrait;

   public static function make(): static {
    return new static();
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns() {
    $fields = self::getFinalConfigKeys();
//     dd($keys);

    foreach ($fields as $key) {
      $component = match ($key) {
        'bg_color', 'font_color', 'icon_color' => ColorPicker::make('config.'.$key),

        'pt', 'pb', 'pl', 'pr' => Forms\Components\Select::make('config.'.$key)
          ->label($key)
          ->options(
            collect(EnumsPaddingSize::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->toArray()
          )
          ->searchable(),

        'mt', 'mb', 'ml', 'mr' => Forms\Components\Select::make('config.'.$key)
          ->label(__('builder/_default.title'))
          ->options(
            collect(EnumsMarginSize::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->toArray()
          )
          ->searchable(),



        'col', 'col-m' => Forms\Components\Select::make('config.'.$key)
          ->label(__('builder/_default.title'))
          ->options(
            collect(EnumsColumnsSize::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->toArray()
          )
          ->searchable(),

//        'col' => TextInput::make('config.'.$key)->numeric()->minValue(1)->maxValue(12),

        default => TextInput::make('config.'.$key),

      };

      // لو فيه قيمة ممررة، نحطها كـ default
      if (array_key_exists($key, $fields)) {
        $component->default($fields[$key]);
      }

//      $components[] = $component->label(__('config.' . $key)); // أو Str::headline($key)
      $components[] = $component->label(__('builder/_default.config.'. $key)); // أو Str::headline($key)
    }

    return $components;
  }

}

