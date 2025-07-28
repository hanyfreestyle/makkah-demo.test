<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Cursor\CursorNews1;

class CursorBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//    dd($slug);
    return match ($slug) {
      'cursor-news-1' => CursorNews1::make()->getColumns(),
      default => [],
    };

  }
}