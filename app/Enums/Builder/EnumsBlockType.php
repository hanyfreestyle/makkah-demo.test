<?php

namespace App\Enums\Builder;

use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumsBlockType: string {
  use EnumHasLabelOptionsTrait;

  case hero = 'hero';
  case counter = 'counter';
  case slider = 'slider';
  case cursor = 'cursor';
  case cta = 'cta';
  case gallery = 'gallery';
  case text = 'text';
  case amenities = 'amenities';


  public function label(): string {
    return match ($this) {
      self::hero => 'Hero',
      self::counter => 'Counter',
      self::slider => 'Slider',
      self::cursor => 'Cursor',
      self::cta => 'Cta',
      self::gallery => 'Gallery',
      self::text => 'Text',
      self::amenities => 'Amenities',

    };
  }
}

