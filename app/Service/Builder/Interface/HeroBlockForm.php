<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Hero\Hero1;
use App\Service\Builder\Form\Hero\Hero2;

class HeroBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {

    return match ($slug) {
      'hero-1', => Hero1::make()->getColumns(),
      'hero-2' => Hero2::make()->getColumns(),
      default => [],
    };
  }
}