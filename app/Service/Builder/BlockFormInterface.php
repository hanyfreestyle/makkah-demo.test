<?php

namespace App\Service\Builder;

interface BlockFormInterface {
  public static function make(string $type, string $slug): array;
}