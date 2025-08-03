<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Cta\Cta1;
use App\Service\Builder\Form\Cta\Cta2;

class CtaBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'cta-1' => Cta1::make()->getColumns(),
      'cta-2' => Cta2::make()->getColumns(),
      default => [],
    };
  }
}