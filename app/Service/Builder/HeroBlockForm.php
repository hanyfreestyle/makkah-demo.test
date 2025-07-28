<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Counter\Counter1;
use App\Service\Builder\Form\Hero\Hero1;
use Filament\Forms\Components\TextInput;

class HeroBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {

    return match ($slug) {
      'hero-1' => Hero1::make()->getColumns(),
      default => [],
    };
  }
}