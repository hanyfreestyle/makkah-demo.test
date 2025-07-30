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
      'gallery-1' => Gallery1::make()->getColumns(),
      default => [],
    };
  }
}