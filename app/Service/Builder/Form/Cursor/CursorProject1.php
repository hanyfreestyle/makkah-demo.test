<?php

namespace App\Service\Builder\Form\Cursor;


use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class CursorProject1 {
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
          ->setDataRequired($this->setDataRequired)
          ->getColumns(),

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des')
          ->setDataRequired($this->setDataRequired)
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

      ])->columns(1)->visible($this->setAddBlockPhoto),

      Forms\Components\Section::make()->schema([
        Forms\Components\TextInput::make('config.take')
          ->label(__('builder/_default.take'))
          ->numeric()
          ->required()
          ->extraAttributes(fn () => rtlIfArabic("en"))

      ])->columns(1),


    ])->columnSpan(2)->columns(2);


    return $columns;
  }
}