<?php

namespace App\Service\Builder\Form\Text;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;

class TextBlock2 {
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
          ->getColumns(),


        ...BuilderTranslatableInput::make()
          ->setInputName('schema.h12')
          ->setLabel(__('builder/_default.title'))
          ->getColumns(),

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des2')
          ->setLabel(__('builder/_default.description'))
          ->getColumns(),



      ])->columns(2),
    ])->columnSpan(6)->columns(2);


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


    return $columns;
  }
}