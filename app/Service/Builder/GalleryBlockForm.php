<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Counter\Counter1;
use App\Service\Builder\Form\Gallery\Gallery1;
use App\Service\Builder\Form\Hero\Hero1;
use Filament\Forms\Components\TextInput;

class GalleryBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//    dd($slug);
    return match ($slug) {
      'gallery-1' => Gallery1::make()
        ->setPhotoFilter(3)
        ->setPhotoSize(1200,600)
        ->setPhotoFilterThumbnail(2)
        ->setPhotoThumbnailSize(450,400)
        ->setPhotoCanvas('#fff')
        ->getColumns(),

      'gallery-2' => Gallery1::make()
        ->setPhotoFilter(2)
        ->setPhotoSize(1200,450)
        ->setPhotoFilterThumbnail(4)
        ->setPhotoThumbnailSize(415,310)
        ->setPhotoCanvas('#000')
        ->getColumns(),

      default => [],
    };
  }
}