<?php

namespace App\Service\Builder\Form\Text;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class TextBlock4 {
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

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des')
          ->setDataRequired(false)
          ->setLabel(__('builder/_default.description'))
          ->getColumns(),

      ])->columns(2),
    ])->columnSpan(6)->columns(2);


    $columns[] = Forms\Components\Group::make()->schema([
//      Forms\Components\Section::make()->schema([
//
//        ...WebpUploadFixedSize::make()
//          ->setFileName('photo')
//          ->setThumbnail(false)
//          ->setUploadDirectory($this->uploadDirectory)
//          ->setRequiredUpload(false)
//          ->setResize(800, 400, 90)
//          ->setFilter(1)
//          ->setThumbnailSize(200, 200, 90)
//          ->setCanvas('#fff')
//          ->setAspectRatio(null)
//          ->getColumns(),
//
//
//      ])->columns(1),
    ])->columnSpan(2)->columns(2);


    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Repeater::make('schema.items')
        ->label(__('builder/_default.items'))
        ->schema([

          Forms\Components\Group::make()->schema([
            ...WebpUploadFixedSize::make()
              ->setFileName('photo')
              ->setThumbnail(false)
              ->setUploadDirectory($this->uploadDirectory)
              ->setRequiredUpload(false)
              ->setResize(800, 400, 90)
              ->setFilter(4)


              ->setAspectRatio(null)
              ->getColumns(),

            ...BuilderTranslatableInput::make()
              ->setInputName('name')
              ->getColumns(),

            ...BuilderTranslatableInput::make()
              ->setInputName('des')
              ->getColumns(),


          ])->columns(2),
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


    ])->columnSpan(8)->columns(1);

    return $columns;
  }
}