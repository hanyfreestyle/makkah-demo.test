<?php

namespace App\FilamentCustom\Crm\Data;

use App\Enums\Crm\EnumsDeliveryDate;
use App\FilamentCustom\View\TextEntryWithView;
use App\Traits\Crm\DefaultSetFunction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class TableDataEnumsColumn {
    use DefaultSetFunction;

    public static function make(): static {
        return new static();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getColumns(string $type): mixed {
        return match ($type) {
            'deliveryType' => $this->baseEnumsColumn('delivery_type', __('default/crm.enum.delivery_date.label'), EnumsDeliveryDate::class, 'fas-calendar-days'),

            default => TextColumn::make('invalid_type'),
        };
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function baseEnumsColumn(string $name, string $label, $enums, string $icon = null): mixed {
        if ($this->setInfoList) {
            $column = TextEntryWithView::make($name)
                ->label($label)
                ->state(function ($record) use ($enums) {
                    $value = $record->delivery_type;
                    if (!$value) {
                        return null;
                    }
                    return $enums::tryFrom($value)?->label();
                });
            if ($icon and $this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make($name)
                ->label($label);
            if ($icon and $this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

}

