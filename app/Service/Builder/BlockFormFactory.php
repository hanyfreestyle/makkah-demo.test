<?php

namespace App\Service\Builder;

class BlockFormFactory {
  public static function make(?string $type, ?string $slug): array {


    $map = [
      'hero' => HeroBlockForm::class,
//      'slider' => SliderBlockForm::class,
      'counter' => CounterBlockForm::class,
    ];

    $class = $map[$type] ?? null;

    if (!$class || !is_subclass_of($class, BlockFormInterface::class)) {
      return [];
    }

    return $class::make($type, $slug);
  }
}