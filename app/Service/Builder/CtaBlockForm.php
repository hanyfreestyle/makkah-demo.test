<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Cta\Cta1;

class CtaBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'cta-1' => Cta1::make()->getColumns(),
      default => [],
    };
  }
}