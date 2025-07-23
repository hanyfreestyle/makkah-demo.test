<?php

namespace App\FilamentCustom\Default;


use App\FilamentCustom\View\TextEntryWithView;
use App\Traits\Crm\DefaultSetFunction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

class DefaultTableColumn {
    use DefaultSetFunction;

    public static function make(): static {
        return new static();
    }

    public function getColumns(string $type): mixed {
        return match ($type) {
            'defaultId' => $this->defaultId(),
            'userName' => $this->userName(),
            'createdAt' => $this->defaultDate('created_at', __('default/lang.columns.created_at'), 'fas-calendar-days'),
            'updatedAt' => $this->defaultDate('updated_at', __('default/lang.columns.updated_at'), 'fas-spinner'),
            'sinceTime' => $this->sinceTime(),
            'tableNotes' => $this->defaultNotes(),


            default => TextColumn::make('invalid_type'),
        };
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function defaultId(): mixed {
        return TextColumn::make('id')
            ->label("ID")
            ->alignCenter()
            ->searchable()
            ->sortable();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function userName(): mixed {
        $label = __('crm-data/data.select.user_id');
        $icon = 'heroicon-s-user';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('user.name')
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make('user.name')
                ->label($label)
                ->searchable()
                ->limit(25)
                ->wrap()
                ->weight('medium');
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function sinceTime(): mixed {
        $label = __('default/lang.columns.updated_diff');
        $icon = 'fas-clock';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('updated_diff')
                ->state(function ($record) {
                    return optional($record->updated_at)?->diffForHumans();
                })
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = [];
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





//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    protected function customerName(): mixed {
//        return TextColumn::make('name')
//            ->label(__('crm-customer/customer.columns.name'))
//            ->searchable()
//            ->sortable()
//            ->wrap()
//            ->weight('medium');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    protected function customerEmail(): mixed {
//        return TextColumn::make('email')
//            ->label(__('crm-customer/customer.columns.email'))
//            ->searchable()
//            ->color('gray')
//            ->toggleable(isToggledHiddenByDefault: true)
//            ->alignLeft();
//    }


}

