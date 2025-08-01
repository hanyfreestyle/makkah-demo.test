<?php

namespace App\Service\Builder\Form\Text;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\FilamentCustom\UploadFile\WebpUploadFixedSizeBuilder;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;

class TextBlock1 {
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
          ->setInputName('schema.h6')
          ->setLabel(__('builder/_default.title'))
          ->getColumns(),

        ...BuilderTranslatableInput::make()
          ->setInputName('schema.h1')
          ->setLabel(__('builder/_default.title'))
          ->getColumns(),

        ...BuilderTranslatableTextArea::make()
          ->setInputName('schema.des')
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




//        Forms\Components\Repeater::make('schema.photo')
//          ->label(__('builder/_default.items'))
//          ->schema([
//            Forms\Components\Group::make()->schema([
//              ...WebpUploadFixedSize::make()
//                ->setFileName('photo')
//                ->setThumbnail(false)
//                ->setUploadDirectory($this->uploadDirectory)
//                ->setRequiredUpload(false)
//                ->setResize(800, 400, 90)
//                ->setFilter(1)
//                ->setThumbnailSize(200, 200, 90)
//                ->setCanvas('#fff')
//                ->setAspectRatio(null)
//                ->getColumns(),
//            ])
//              ->columns(1),
//          ])
//          ->minItems(1)
//          ->defaultItems(1)



      ])->columns(1),
    ])->columnSpan(2)->columns(2);


    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Repeater::make('schema.items')
        ->label(__('builder/_default.items'))
        ->schema([

          Forms\Components\Group::make()->schema([

//            IconPicker::make('icon')
//              ->label(__('builder/_default.icon'))
//              ->hiddenLabel()
//              ->searchLabels()
//              ->columnSpanFull()
//              ->columns([
//                'default' => 1,
//                'lg' => 12,
//                '2xl' => 5,
//              ])
//              ->sets(['fas', 'fab', "fontawesome-solid", "fontawesome-brands"])
//              ->nullable(),


            ...BuilderTranslatableInput::make()
              ->setInputName('h1')
              ->setLabel(__('builder/_default.title'))
              ->getColumns(),

            ...BuilderTranslatableTextArea::make()
              ->setInputName('des')
              ->setLabel(__('builder/_default.description'))
              ->getColumns(),


          ])
            ->columns(2),
        ])
        ->minItems(1)
        ->defaultItems(1)


    ])->columnSpan(8);


    return $columns;
  }
}