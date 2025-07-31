<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Counter\Counter1;
use App\Service\Builder\Form\Hero\Hero1;
use App\Service\Builder\Form\Hero\TextBlock3;
use Filament\Forms\Components\TextInput;

class TextBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//dd($slug);
    return match ($slug) {
      'text-block-3' => TextBlock3::make()->getColumns(),
      default => [],
    };
  }
}