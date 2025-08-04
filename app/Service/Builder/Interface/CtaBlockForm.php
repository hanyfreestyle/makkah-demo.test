<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Cta\Cta1;
use App\Service\Builder\Form\Cta\Cta2;

class CtaBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
    return match ($slug) {
      'cta-1' => Cta1::make()
        ->setConfig(true)
        ->getColumns(),

      'cta-2' => Cta2::make()
        ->setConfig(true)
//        ->setConfigArr(['pt', 'pb', 'mt', 'mb', 'columns', 'bg_color', 'font_color', 'icon_color'])
//        ->setAddToConfig(['Hany'])
//        ->setRemoveFromConfig(['columns'])
        ->getColumns(),

      default => [],
    };
  }
}