<?php

namespace App\Service\Builder;

use App\Service\Builder\Form\Amenities\Amenities1;


class AmenitiesBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {
//    dd($slug);
    return match ($slug) {
      'amenities-1' => Amenities1::make()->getColumns(),
      'amenities-2' => Amenities1::make()->getColumns(),

      default => [],
    };

  }
}