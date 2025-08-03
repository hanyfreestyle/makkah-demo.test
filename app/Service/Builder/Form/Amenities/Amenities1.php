<?php

namespace App\Service\Builder\Form\Amenities;


use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class Amenities1 {
  use SetProtectedValTrait;

  public static function make(): static {
    return new static();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns(): array {

    $columns = [];

    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Section::make()->schema([


        ...BuilderTranslatableInput::make()
          ->setInputName('schema.h1')
          ->setLabel(__('builder/_default.title'))
          ->setDataRequired(false)
          ->getColumns(),


        ...BuilderTranslatableInput::make()
          ->setInputName('schema.des')
          ->setDataRequired(false)
          ->setLabel(__('builder/_default.description'))
          ->getColumns(),



//        ...BuilderTranslatableTextArea::make()
//          ->setInputName('schema.des')
//          ->setLabel(__('builder/_default.description'))
//          ->getColumns(),

      ])->columns(2),
    ])->columnSpan(6)->columns(2);


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

            ...BuilderTranslatableInput::make()
              ->setInputName('name')
              ->getColumns(),

          ])
            ->columns(2),
        ])
        ->minItems(1)
        ->defaultItems(1)


    ])->columnSpan(8)->columns(2);

    return $columns;
  }
}