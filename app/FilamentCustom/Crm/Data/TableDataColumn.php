<?php

namespace App\FilamentCustom\Crm\Data;

use App\FilamentCustom\View\TextEntryWithView;
use App\Traits\Crm\DefaultSetFunction;
use App\Traits\Crm\LoadCrmCashData;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class TableDataColumn {
    use LoadCrmCashData;
    use DefaultSetFunction;

    public static function make(): static {
        return new static();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getColumns(string $type): mixed {
        return match ($type) {
            'customerType' => $this->baseRelationColumn('customerType', __('crm-data/data.select.customer_type'), 'heroicon-s-user-group'),
            'customerEvaluation' => $this->baseRelationColumn('customerEvaluation', __('crm-data/data.select.customer_evaluation'), 'heroicon-s-star'),
            'leadSource' => $this->baseRelationColumn('leadSource', __('crm-data/data.select.lead_source'), 'heroicon-o-sparkles'),
            'leadSourceSub' => $this->baseRelationColumn('leadSourceSub', __('crm-data/data.select.lead_source_sub'), 'heroicon-o-bars-3-bottom-left'),
            'campaign' => $this->baseRelationColumn('campaign', __('crm-data/data.select.campaign'), 'heroicon-o-megaphone'),
            'contactNumbers' => $this->contactColumn(),
            'customerId' => $this->customerId(),
            'customerName' => $this->customerName(),
            'customerEmail' => $this->customerEmail(),
            'developerName' => $this->baseRelationColumn('developerName', __('crm-data/data.select.developer'), 'heroicon-s-wrench-screwdriver'),
            'districtName' => $this->baseRelationColumn('districtName', __('crm-data/data.select.district'), 'heroicon-s-map'),
            'projectName' => $this->baseRelationColumn('projectName', __('crm-data/data.select.project'), 'heroicon-s-building-office-2'),
            'unitType' => $this->baseRelationColumn('unitType', __('crm-data/data.select.unit_type'), 'heroicon-s-home-modern'),
            'finishingType' => $this->baseRelationColumn('finishingType', __('crm-data/data.select.finishing_type'), 'heroicon-s-paint-brush'),
            'furnishingType' => $this->baseRelationColumn('furnishingType', __('crm-data/data.select.furnished_type'), 'fas-chair'),
            'serviceType' => $this->baseRelationColumn('serviceType', __('crm-data/data.select.service_type'), 'heroicon-s-briefcase'),
            'paymentType' => $this->baseRelationColumn('paymentType', __('crm-data/data.select.payment_type'), 'heroicon-s-credit-card'),
            'floorType' => $this->baseRelationColumn('floorType', __('crm-data/data.select.floor_type'), 'heroicon-s-square-3-stack-3d'),

            default => TextColumn::make('invalid_type'),
        };
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerId(): mixed {
        return TextColumn::make('id')
            ->label("ID")
            ->alignCenter()
            ->searchable()
            ->sortable();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerName(): mixed {
        return TextColumn::make('name')
            ->label(__('crm-customer/customer.columns.name'))
            ->searchable()
            ->sortable()
            ->wrap()
            ->weight('medium');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerEmail(): mixed {
        return TextColumn::make('email')
            ->label(__('crm-customer/customer.columns.email'))
            ->searchable()
            ->color('gray')
            ->toggleable(isToggledHiddenByDefault: true)
            ->alignLeft();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function contactColumn($type = "contacts"): mixed {
        if ($type == 'line') {
            $column = TextColumn::make('contacts')
                ->label(__('crm-customer/customer.columns.phone'))
                ->searchable()
                ->color('warning')
                ->formatStateUsing(function ($record) {
                    return $record->contacts
                        ->map(function ($contact) {
                            return $contact->number;
                        })
                        ->implode(' | ');
                })
                ->searchable(query: function (Builder $query, string $search) {
                    $query->whereHas('contacts', function (Builder $subQuery) use ($search) {
                        $subQuery->where('number', 'LIKE', "%{$search}%");
                    });
                })
                ->extraCellAttributes([
                    'style' => 'direction: ltr!important; text-align: left;',
                ])
                ->wrap();

        } else {
            $column = TextColumn::make('contacts')
                ->label(__('crm-customer/customer.columns.phone'))
                ->formatStateUsing(function ($record) {
                    $badges = $record->contacts
                        ->pluck('number')
                        ->unique()
                        ->map(function ($number) {
                            return '<span style="direction: ltr!important;" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium badgeYellow mr-1">'
                                . $number
                                . '</span>';
                        })
                        ->implode('');

                    return new HtmlString($badges);
                })
                ->searchable(query: function (Builder $query, string $search) {
                    $query->whereHas('contacts', function (Builder $subQuery) use ($search) {
                        $subQuery->where('number', 'LIKE', "%{$search}%");
                    });
                });
        }


        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function baseRelationColumn(string $relation, string $label, string $icon = null): mixed {
        $locale = app()->getLocale();

        if ($this->setInfoList) {
            $column = TextEntryWithView::make("{$relation}.name.{$locale}")
                ->label($label);
            if ($icon and $this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make("{$relation}.name.{$locale}")
                ->label($label);
            if ($this->setSearchable) {
                $column->searchable(query: function (Builder $query, string $search, string $locale, $relation) {
                    $query->whereHas($relation, function (Builder $subQuery) use ($search, $locale) {
                        $subQuery->where("name->{$locale}", 'LIKE', "%{$search}%");
                    });
                });
            }

            if ($icon and $this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

}

