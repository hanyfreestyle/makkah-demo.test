<?php

namespace App\Service\Builder\Interface;

use App\Service\Builder\BlockFormInterface;
use App\Service\Builder\Form\Form\CallReq;

class FormsBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//dd($slug);
    return match ($slug) {
      'call-req' => CallReq::make()
        ->setConfig()
//        ->setAddToConfig(['col', 'col-m'])
        ->getColumns(),
      default => [],
    };
  }
}