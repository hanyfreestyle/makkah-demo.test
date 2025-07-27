<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Counter\Counter1;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class CounterBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'counter-1' => Counter1::make()->getColumns(),

      default => [],
    };

  }
}