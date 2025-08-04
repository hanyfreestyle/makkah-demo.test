<?php

namespace App\Enums\Builder;

use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumsBlockType: string {
  use EnumHasLabelOptionsTrait;

  case hero = 'hero';
  case counter = 'counter';
  case tabs = 'tabs';
  case cursor = 'cursor';
  case cta = 'cta';
  case gallery = 'gallery';
  case text = 'text';
  case amenities = 'amenities';
  case embedded = 'embedded';


  public function label(): string {
    return match ($this) {
      self::hero => 'Hero',
      self::counter => 'Counter',
      self::tabs => 'Tabs',
      self::cursor => 'Cursor',
      self::cta => 'Cta',
      self::gallery => 'Gallery',
      self::text => 'Text',
      self::amenities => 'Amenities',
      self::embedded => 'Embedded',

    };
  }
}

