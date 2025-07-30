<?php

namespace App\Service\Builder\Form\Gallery;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\FilamentCustom\UploadFile\WebpUploadWithFilter;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Filament\Forms\Components\Section;

class Gallery1 {
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

//        ...BuilderTranslatableInput::make()
//          ->setInputName('schema.number')
//          ->setLabel(__('builder/_default.number'))
//          ->getColumns(),
//
//        ...BuilderTranslatableInput::make()
//          ->setInputName('schema.years')
//          ->setLabel(__('builder/_default.years'))
//          ->getColumns(),
//
//        ...BuilderTranslatableInput::make()
//          ->setInputName('schema.h1')
//          ->setLabel(__('builder/_default.title'))
//          ->getColumns(),
//
//        ...BuilderTranslatableTextArea::make()
//          ->setInputName('schema.des')
//          ->setLabel(__('builder/_default.description'))
//          ->getColumns(),
//
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
          ->setFileName('gallery')
          ->setThumbnail(false)
          ->setUploadDirectory('hany-darwish')
          ->setRequiredUpload(true)
          ->setResize(800, 400, 90)
          ->setFilter(1)
          ->setThumbnailSize(200, 200, 90)
          ->setCanvas('#fff')
          ->setMultipleFiles(true)
          ->setAspectRatio(null)
          ->getColumns(),

      ])->columns(1),

    ])->columnSpan(2)->columns(2);


    return $columns;
  }
}