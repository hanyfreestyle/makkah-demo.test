<?php

namespace App\Service\Builder;

use App\Service\Builder\Interface\AmenitiesBlockForm;
use App\Service\Builder\Interface\CounterBlockForm;
use App\Service\Builder\Interface\CtaBlockForm;
use App\Service\Builder\Interface\CursorBlockForm;
use App\Service\Builder\Interface\EmbeddedBlockForm;
use App\Service\Builder\Interface\FormsBlockForm;
use App\Service\Builder\Interface\GalleryBlockForm;
use App\Service\Builder\Interface\HeroBlockForm;
use App\Service\Builder\Interface\TabsBlockForm;
use App\Service\Builder\Interface\TextBlockForm;

class BlockFormFactory {

  public static function make(?string $type, ?string $slug): array {
//      dd($type);
    $map = [
      'cta' => CtaBlockForm::class,
      'amenities' => AmenitiesBlockForm::class,
      'counter' => CounterBlockForm::class,
      'hero' => HeroBlockForm::class,
      'embedded' => EmbeddedBlockForm::class,
      'cursor' => CursorBlockForm::class,
      'gallery' => GalleryBlockForm::class,
      'text' => TextBlockForm::class,
      'tabs' => TabsBlockForm::class,
      'form' => FormsBlockForm::class,

    ];

    $class = $map[$type] ?? null;

    if (!$class || !is_subclass_of($class, BlockFormInterface::class)) {
      return [];
    }

    return $class::make($type, $slug);
  }
}