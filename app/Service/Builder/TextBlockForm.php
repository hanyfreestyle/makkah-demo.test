<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Text\TextBlock1;
use App\Service\Builder\Form\Text\TextBlock2;
use App\Service\Builder\Form\Text\TextBlock3;

class TextBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//dd($slug);
    return match ($slug) {
      'text-block-1' => TextBlock1::make()->getColumns(),
      'text-block-2' => TextBlock2::make()->getColumns(),
      'text-block-3' => TextBlock3::make()->getColumns(),
      default => [],
    };
  }
}