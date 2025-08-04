<?php

namespace App\Enums\Builder;

use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumsConfigPaddingTop: string {
  use EnumHasLabelOptionsTrait;

  case pt10 = 'pt-10';
  case pt20 = 'pt-20';
  case pt30 = 'pt-30';
  case pt40 = 'pt-40';
  case pt50 = 'pt-50';
  case pt60 = 'pt-60';
  case pt70 = 'pt-70';
  case pt80 = 'pt-80';
  case pt90 = 'pt-90';
  case pt100 = 'pt-100';
  case pt110 = 'pt-110';
  case pt120 = 'pt-120';



  public function label(): string {
    return match ($this) {
      self::pt10 => 'Padding Top 10',
      self::pt20 => 'Padding Top 20',
      self::pt30 => 'Padding Top 30',
      self::pt40 => 'Padding Top 40',
      self::pt50 => 'Padding Top 50',
      self::pt60 => 'Padding Top 60',
      self::pt70 => 'Padding Top 70',
      self::pt80 => 'Padding Top 80',
      self::pt90 => 'Padding Top 90',
      self::pt100 => 'Padding Top 100',
      self::pt110 => 'Padding Top 110',
      self::pt120 => 'Padding Top 120',


    };
  }
}

