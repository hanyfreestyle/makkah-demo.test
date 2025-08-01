<?php

namespace App\Service\Builder\Form\Hero;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;

class Hero2 {
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
          ->getColumns(),

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des')
          ->setLabel(__('builder/_default.description'))
          ->setDataRequired(false)
          ->getColumns(),

//        ...BuilderTranslatableInput::make()
//          ->setInputName('schema.btn')
//          ->setLabel(__('builder/_default.btn'))
//          ->getColumns(),
//
//        ...BuilderTranslatableInput::make()
//          ->setInputName('schema.btn_url')
//          ->setLabel(__('builder/_default.btn_url'))
//          ->getColumns(),


      ])->columns(2),
    ])->columnSpan(6)->columns(2);


    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Section::make()->schema([

        ...WebpUploadFixedSize::make()
          ->setFileName('photo')
          ->setThumbnail(false)
          ->setUploadDirectory($this->uploadDirectory)
          ->setRequiredUpload(false)
          ->setFilter(2)
          ->setResize(1600, 400, 90)

          ->setThumbnailSize(200, 200, 90)
          ->setCanvas('#fff')
          ->setAspectRatio(null)
          ->getColumns(),


      ])->columns(1),
    ])->columnSpan(2)->columns(2);


    return $columns;
  }
}