<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Counter\Counter1;

class CounterBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'counter-1' => Counter1::make()->getColumns(),

      default => [],
    };

  }
}