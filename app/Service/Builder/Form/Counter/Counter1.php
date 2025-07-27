<?php

namespace App\Service\Builder\Form\Counter;

use App\Service\Builder\Form\SetProtectedValTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class Counter1 {
  use SetProtectedValTrait;

  public static function make(): static {
    return new static();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns(): array {

    $names = [];

    foreach ($this->setLang as $lang) {
      $printName = "name" . "." . $lang;
      $printLang = "(" . ucfirst($lang) . ")";

      $input = TextInput::make($printName)
        ->label(__('builder/_default.label') . " " . $printLang)
        ->required()
        ->extraAttributes(fn () => rtlIfArabic($lang));
      $names[] = $input;
    }

    $columns = [];
    $columns[] = Forms\Components\Group::make()->schema([


      Forms\Components\Repeater::make('schema.items')
        ->label('Items')
        ->schema([

          Forms\Components\Group::make()->schema([
            IconPicker::make('icon')
              ->label(__('builder/_default.icon'))
              ->hiddenLabel()
              ->searchLabels()
              ->columnSpanFull()
              ->preload()
              ->columns([
                'default' => 1,
                'lg' => 12,
                '2xl' => 5,
              ])
              ->sets(['fas', 'fab', "fontawesome-solid", "fontawesome-brands"])
              ->required(),
            Forms\Components\TextInput::make('number')->label(__('builder/_default.number'))->required(),
            ...$names,
          ])
            ->columns(4),
        ])
        ->minItems(1)
        ->defaultItems(1)


    ])->columnSpan(4);

    return $columns;
  }
}