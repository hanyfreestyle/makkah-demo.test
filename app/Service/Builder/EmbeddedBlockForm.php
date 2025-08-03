<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Embedded\Video1;

class EmbeddedBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'video-1' => Video1::make()->getColumns(),

      default => [],
    };
  }
}