<?php

namespace App\Service\Builder\Form\Embedded;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;

class Map1 {
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

        Forms\Components\TextInput::make('schema.map_url')
          ->label(__('builder/_default.map_url'))
          ->columnSpanFull()
          ->required()
          ->extraAttributes(fn () => rtlIfArabic("en")),

        ...BuilderTranslatableInput::make()
          ->setInputName('schema.h1')
          ->setLabel(__('builder/_default.title'))
          ->setDataRequired(false)
          ->getColumns(),

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des')
          ->setLabel(__('builder/_default.description'))
          ->setDataRequired(false)
          ->getColumns(),


      ])->columns(2),
    ])->columnSpan(6)->columns(2);


//    $columns[] = Forms\Components\Group::make()->schema([
//      Forms\Components\Section::make()->schema([
//      ])->columns(1),
//    ])->columnSpan(2)->columns(2);


    return $columns;
  }
}