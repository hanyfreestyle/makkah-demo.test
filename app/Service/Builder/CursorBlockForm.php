<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Cursor\CursorNews1;
use App\Service\Builder\Form\Cursor\CursorProject1;
use App\Service\Builder\Function\SetProtectedValTrait;

class CursorBlockForm implements BlockFormInterface {

  public static function make(string $type, string $slug): array {
//    dd($slug);
    return match ($slug) {
      'cursor-news-1' => CursorNews1::make()->getColumns(),
      'cursor-project-1' => CursorProject1::make()->getColumns(),
      'cursor-project-2' => CursorProject1::make()->setDataRequired(false)->getColumns(),
      'cursor-project-3' => CursorProject1::make()->setDataRequired(false)->setAddBlockPhoto(true)->getColumns(),
      default => [],
    };

  }
}