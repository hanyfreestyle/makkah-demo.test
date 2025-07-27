<?php

namespace App\Enums\Builder;

use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumsBlockTemplate: string {
  use EnumHasLabelOptionsTrait;

  case makkah = "makkah";


  public function label(): string {
    return match ($this) {
      self::makkah => "Makkah",

    };
  }
}

