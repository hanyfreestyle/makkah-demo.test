<?php

namespace App\FilamentCustom\Table;

use App\Enums\Status\EnumsActive;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class FilterWithArchive {

    public static function make(): static {
        return new static();
    }


    public function getColumns(): array {
        return [

            SelectFilter::make('is_active')
                ->label(__('default/lang.enum.active.label'))
                ->options(EnumsActive::options())
                ->searchable()
                ->preload(),


             TernaryFilter::make('is_archive')
                ->label(__('default/lang.enum.archived.label'))
                ->trueLabel(__('default/lang.ternary.archived_true'))
                ->falseLabel(__('default/lang.ternary.archived_false'))
                ->placeholder(__('default/lang.ternary.archived_all'))
                ->searchable()
                ->default(false) // القيمة الافتراضية: غير مؤرشف
                ->queries(
                    true: fn(Builder $query) => $query->where('is_archive', true),
                    false: fn(Builder $query) => $query->where('is_archive', false),
                    blank: fn(Builder $query) => $query, // للكل
                )
        ];
    }

}
