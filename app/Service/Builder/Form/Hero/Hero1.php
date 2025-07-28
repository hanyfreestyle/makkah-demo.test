<?php

namespace App\Service\Builder\Form\Hero;


use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class Hero1 {
  use SetProtectedValTrait;

  public static function make(): static {
    return new static();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns(): array {

    $names = [];

    foreach ($this->setLang as $lang) {
      $printName = "schema.name" . "." . $lang;
      $printLang = "(" . ucfirst($lang) . ")";

      $input = TextInput::make($printName)
        ->label(__('builder/_default.label') . " " . $printLang)
        ->required()
        ->extraAttributes(fn () => rtlIfArabic($lang));
      $names[] = $input;
    }

    $columns = [];

    $columns[] = Forms\Components\Group::make()->schema([
      ...$names,
    ])->columnSpan(4);

    return $columns;
  }
}