<?php

namespace App\Service\Builder;

class BlockFormFactory {

  public static function make(?string $type, ?string $slug): array {
//     dd($type);
    $map = [
      'hero' => HeroBlockForm::class,
      'counter' => CounterBlockForm::class,
      'cursor' => CursorBlockForm::class,
      'cta' => CtaBlockForm::class,
      'gallery' => GalleryBlockForm::class,
      'text' => TextBlockForm::class,
      'embedded' => EmbeddedBlockForm::class,

    ];

    $class = $map[$type] ?? null;

    if (!$class || !is_subclass_of($class, BlockFormInterface::class)) {
      return [];
    }

    return $class::make($type, $slug);
  }
}