<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Embedded\Map1;
use App\Service\Builder\Form\Embedded\Video1;

class EmbeddedBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//    dd($slug);
    return match ($slug) {
      'video-1' => Video1::make()->getColumns(),
       'map-1' => Map1::make()->getColumns(),

      default => [],
    };
  }
}