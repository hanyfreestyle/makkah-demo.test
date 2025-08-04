<?php

namespace App\Service\Builder\Form\Counter;


use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\ConfigInputDefault;
use App\Service\Builder\Function\SetProtectedValTrait;
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

    $columns = [];

    if ($this->setConfig) {
      $columns = ConfigInputDefault::make()
        ->setConfigArr($this->setConfigArr)
        ->setAddToConfig($this->addToConfig)
        ->setRemoveFromConfig($this->removeFromConfig)
        ->getColumns();
    }


    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Repeater::make('schema.items')
        ->label(__('builder/_default.items'))
        ->schema([
          Forms\Components\Group::make()->schema([
            IconPicker::make('icon')
              ->label(__('builder/_default.icon'))
              ->hiddenLabel()
              ->searchLabels()
              ->columnSpanFull()
              ->columns([
                'default' => 1,
                'lg' => 12,
                '2xl' => 5,
              ])
              ->sets(['fas', 'fab', "fontawesome-solid", "fontawesome-brands"])
              ->required(),
            Forms\Components\TextInput::make('number')
              ->label(__('builder/_default.number'))
              ->extraAttributes(fn () => rtlIfArabic('en'))
              ->required(),

            ...BuilderTranslatableInput::make()
              ->setInputName('name')
              ->getColumns(),

          ])
            ->columns(4),
        ])
        ->itemLabel(function (array $state): ?string {
          $locale = app()->getLocale();

          if (isset($state['name'][$locale]) && filled($state['name'][$locale])) {
            return $state['name'][$locale];
          }

          return __('builder/_default.item'); // fallback label
        })
        ->collapsible()
        ->collapsed()
        ->minItems(1)
        ->defaultItems(1)


    ])->columnSpan(8);

    return $columns;
  }
}