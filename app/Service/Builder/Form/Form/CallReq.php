<?php

namespace App\Service\Builder\Form\Form;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\ConfigInputDefault;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class CallReq {
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
      Forms\Components\Section::make()->schema([

        ...BuilderTranslatableInput::make()
          ->setInputName('schema.h1')
          ->setLabel(__('builder/_default.title'))

          ->getColumns(),

        ...BuilderTranslatableInput::make()
          ->setInputName('schema.btn')

          ->setLabel(__('builder/_default.btn'))
          ->getColumns(),

      ])->columns(2),
    ])->columnSpan(6)->columns(2);


    $columns[] = Forms\Components\Group::make()->schema([
//      Forms\Components\Section::make()->schema([

//      ])->columns(1),
    ])->columnSpan(2)->columns(2);




    return $columns;
  }
}