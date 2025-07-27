<?php

namespace App\Service\Builder;

use Filament\Forms\Components\TextInput;

class HeroBlockForm implements BlockFormInterface {
  public static function make(string $type, string $slug): array {

    return match ($slug) {
      'hero-1' => [
        TextInput::make('schema.title')->label('العنوان الرئيسي')->required(),
        TextInput::make('schema.subtitle')->label('الوصف الفرعي'),
      ],
      'hero-2' => [
        TextInput::make('settings.title')->label('عنوان اليسار'),
        TextInput::make('settings.image')->label('رابط الصورة'),
      ],
      default => [],
    };
  }
}