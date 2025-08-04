<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Tabs\TabsPlans;

class TabsBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//dd($slug);
    return match ($slug) {
      'tabs-plans' => TabsPlans::make()
        ->setConfig()
//        ->setAddToConfig(['col', 'col-m'])
        ->getColumns(),
      default => [],
    };
  }
}