<?php

namespace App\Service\Builder\Form\Gallery;

use App\FilamentCustom\UploadFile\WebpUploadFixedSize;
use App\FilamentCustom\UploadFile\WebpUploadWithFilter;
use App\Service\Builder\Function\BuilderTranslatableInput;
use App\Service\Builder\Function\BuilderTranslatableTextArea;
use App\Service\Builder\Function\SetProtectedValTrait;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Illuminate\Support\HtmlString;

class Gallery1 {
  use SetProtectedValTrait;

  public static function make(): static {
    return new static();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns(): array {
    $model = 'blockPhotos';
    $columns = [];

    $columns[] = Forms\Components\Group::make()->schema([
      Forms\Components\Section::make()->schema([
        Group::make()->schema([
          Placeholder::make("")
            ->content(function ($record) use ($model) {
              return new HtmlString(view('components.admin.media.media-manager-list', [
                'record' => $record,
                'modelName' => $model,
              ])->render());
            }),
        ])->columnSpan(2),
      ])->columnSpan(2)->columns(2),

      Forms\Components\Section::make(__('default/lang.construct.gallery_file'))->schema([
//        ...WebpUploadWithFilter::make()
//          ->setFileName('gallery')
//          ->setMultipleFiles(true)
//          ->setFilterId(4)
//          ->setUploadDirectory($this->uploadDirectory)
//          ->setRequiredUpload(true)
//          ->getColumns(),


        ...WebpUploadFixedSize::make()
          ->setFileName('gallery')
          ->setMultipleFiles(true)
          ->setThumbnail(true)
          ->setUploadDirectory($this->uploadDirectory)
          ->setRequiredUpload(false)
          ->setResize(800, 400, 90)
          ->setFilter(1)
          ->setThumbnailSize(200, 200, 90)
          ->setCanvas('#fff')
          ->setAspectRatio(null)
          ->setRequiredUpload(true)
          ->getColumns(),


      ])->columnSpan(1),

    ])->columnSpan(8)->columns(3);

    return $columns;
  }
}