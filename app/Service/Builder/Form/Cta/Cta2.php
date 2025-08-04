<?php

namespace App\Service\Builder\Form\Cta;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\ConfigInputDefault;
use App\Service\Builder\Function\ConfigInputs;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;

class Cta2 {
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
          ->setInputName('schema.number')
          ->setLabel(__('builder/_default.number'))
          ->getColumns(),


        ...BuilderTranslatableInput::make()
          ->setInputName('schema.btn')
          ->setLabel(__('builder/_default.btn'))
          ->getColumns(),

        ...BuilderTranslatableInput::make()
          ->setInputName('schema.btn2')
          ->setLabel(__('builder/_default.btn'))
          ->getColumns(),


      ])->columns(2),
    ])->columnSpan(6)->columns(2);


    if ($this->setAddBlockPhoto) {
      $columns[] = Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([

          ...WebpUploadFixedSize::make()
            ->setFileName('photo')
            ->setThumbnail(false)
            ->setUploadDirectory($this->uploadDirectory)
            ->setRequiredUpload(false)
            ->setResize(800, 400, 90)
            ->setFilter(1)
            ->setThumbnailSize(200, 200, 90)
            ->setCanvas('#fff')
            ->setAspectRatio(null)
            ->getColumns(),
        ])->columns(1),

      ])->columnSpan(2)->columns(2);
    }



    return $columns;
  }
}