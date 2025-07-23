<?php

namespace App\Traits\Crm;

use App\FilamentCustom\View\TextEntryWithView;
use Illuminate\Support\Carbon;

trait DefaultSetFunction {
    protected bool $setSearchable = false;
    protected bool $setIcon = true;
    protected bool $setInfoList = false;
    protected bool $setSpanLabel = false;
    protected bool $setFontawesome = false;
    protected bool $setRemoveIfEmpty = false;


    public function setSearchable(bool $value): static {
        $this->setSearchable = $value;
        return $this;
    }

    public function setIcon(bool $value): static {
        $this->setIcon = $value;
        return $this;
    }

    public function setInfoList(bool $value): static {
        $this->setInfoList = $value;
        return $this;
    }

    public function setSpanLabel(bool $value): static {
        $this->setSpanLabel = $value;
        return $this;
    }

    public function setFontawesome(bool $condition = true): static {
        $this->setFontawesome = $condition;
        return $this;
    }

    public function setRemoveIfEmpty(bool $condition = true): static {
        $this->setRemoveIfEmpty = $condition;
        return $this;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function baseInfoList(string $name, string $label, string $icon = null): mixed {
        $column = TextEntryWithView::make($name)
            ->label($label)
            ->removeIfEmpty(true)
            ->setFontawesome($this->setFontawesome);

        if ($this->setIcon) {
            $column->icon($icon);
        }
        return $column;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function defaultDate($name, $label, $icon, $format = 'Y-m-d'): mixed {
        if ($this->setInfoList) {
            $column = TextEntryWithView::make($name)
                ->state(function ($record) use ($format, $name) {
                    return optional($record->{$name} ? Carbon::parse($record->{$name}) : null)?->format($format);
                })
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
//            $column = TextColumn::make('created_at')
//                ->label($label)
//                ->searchable()
//                ->sortable()
//                ->limit(25)
//                ->wrap()
//                ->weight('medium');
//            if ($this->setIcon) {
//                $column->icon($icon);
//            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function defaultPrice($name, $label, $icon, $format = 'Y-m-d'): mixed {
        if ($this->setInfoList) {
            $column = TextEntryWithView::make($name)
                ->state(function ($record) use ($name) {
                    $price = $record->{$name};
                    if (! is_numeric($price)) {
                        return null;
                    }
                    return number_format((float) $price, 0, '.', ',');
                })
                ->removeIfEmpty($this->setRemoveIfEmpty)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
//            $column = TextColumn::make('created_at')
//                ->label($label)
//                ->searchable()
//                ->sortable()
//                ->limit(25)
//                ->wrap()
//                ->weight('medium');
//            if ($this->setIcon) {
//                $column->icon($icon);
//            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function defaultNotes($name = 'notes', $label = null, $icon = null): mixed {
        if (!$label) {
            $label = __('default/lang.columns.notes');
        }
        if (!$icon) {
            $icon = 'fas-comment';
        }
        if ($this->setInfoList) {
            $column = TextEntryWithView::make($name)
                ->state(function ($record) use ($name) {
                    return nl2br($record->{$name});
                })
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
//            $column = TextColumn::make('user.name')
//                ->label($label)
//                ->searchable()
//                ->sortable()
//                ->limit(25)
//                ->wrap()
//                ->weight('medium');
//            if ($this->setIcon) {
//                $column->icon($icon);
//            }
        }
        return $column;
    }


}
