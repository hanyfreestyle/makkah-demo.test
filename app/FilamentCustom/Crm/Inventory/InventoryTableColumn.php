<?php

namespace App\FilamentCustom\Crm\Inventory;

use App\FilamentCustom\View\TextEntryWithView;
use App\Traits\Crm\DefaultSetFunction;
use App\Traits\Crm\LoadCrmCashData;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class InventoryTableColumn {
    use LoadCrmCashData;
    use DefaultSetFunction;

    public static function make(): static {
        return (new static())
            ->setSearchable(false);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function getColumns(string $type): mixed {
        return match ($type) {
            'customerName' => $this->customerName(),
            'contactNumbers' => $this->contactColumn(),
            'customerEmail' => $this->customerEmail(),
            'unitZone' => $this->unitZone(),
            'UnitArea' => $this->UnitArea(),
            'UnitLand' => $this->UnitLand(),
            'UnitGarden' => $this->UnitGarden(),
            'UnitRoof' => $this->UnitRoof(),
            'unitPrice' => $this->unitPrice(),
            'unitNumber' => $this->baseInfoList('unit_number', __('crm-inventory/inventory.columns.unit_number'), 'heroicon-s-hashtag'),
            'unitBedRooms' => $this->baseInfoList('unit_bed_rooms', __('crm-inventory/inventory.columns.unit_bed_rooms'), 'fas-bed'),
            'unitBathRooms' => $this->baseInfoList('unit_bath_rooms', __('crm-inventory/inventory.columns.unit_bath_rooms'), 'fas-bath'),
            'unitParking' => $this->baseInfoList('unit_parking', __('crm-inventory/inventory.columns.unit_parking'), 'heroicon-s-truck'),
            'deliveryDate' => $this->defaultDate('delivery_date', __('crm-inventory/inventory.columns.delivery_date'), 'fas-clock'),
            'downPayment' => $this->defaultPrice('down_payment', __('crm-inventory/inventory.columns.down_payment'), 'fas-money-bill-wave'),
            'transferFees' => $this->defaultPrice('transfer_fees', __('crm-inventory/inventory.columns.transfer_fees'), 'fas-money-check-dollar'),
            'maintenance' => $this->defaultPrice('maintenance', __('crm-inventory/inventory.columns.maintenance'), 'fas-tools'),
            'remainingInstallments' => $this->defaultPrice('remaining_installments', __('crm-inventory/inventory.columns.remaining_installments'), 'fas-calendar-check'),
            default => [],
        };
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerName(): mixed {
        $label = __('crm-inventory/inventory.columns.customer');
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('customer.name')
                ->icon('heroicon-s-user')
                ->label($label);
        } else {
            $column = TextColumn::make('customer.name')
                ->label($label)
                ->searchable()
                ->sortable()
                ->limit(25)
                ->wrap()
                ->visible(fn($record) => auth()->user()?->can('viewClientInfo', $record))
                ->weight('medium');
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function contactColumn($type = "contacts"): mixed {
        $label = __('crm-inventory/inventory.columns.customer_number');
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('customers')
                ->state(function ($record) {
                    $badges = $record->customer->contacts
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
                ->icon('heroicon-s-phone-arrow-down-left')
                ->label($label);
        } else {
            if ($type == 'line') {
                $column = self::contactBade($label);
            } else {
                $column = self::contactLine($label);
            }
        }
        return $column;

    }

    protected static function contactBade($label): mixed {
        return TextColumn::make('customer.contacts')
            ->label($label)
            ->searchable()
            ->color('warning')
            ->formatStateUsing(function ($record) {
                return $record->customer->contacts
                    ->map(function ($contact) {
                        return $contact->number;
                    })
                    ->implode(' | ');
            })
            ->searchable(query: function (Builder $query, string $search) {
                $query->whereHas('customer.contacts', function (Builder $subQuery) use ($search) {
                    $subQuery->where('number', 'LIKE', "%{$search}%");
                });
            })
            ->extraCellAttributes([
                'style' => 'direction: ltr!important; text-align: left;',
            ])
            ->visible(fn($record) => auth()->user()?->can('viewClientInfo', $record))
            ->wrap();
    }

    protected static function contactLine($label): mixed {
        return TextColumn::make('customer.contacts')
            ->label($label)
            ->formatStateUsing(function ($record) {
                $badges = $record->customer->contacts
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
                $query->whereHas('customer.contacts', function (Builder $subQuery) use ($search) {
                    $subQuery->where('number', 'LIKE', "%{$search}%");
                });
            })
            ->visible(fn($record) => auth()->user()?->can('viewClientInfo', $record))
            ->wrap();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerEmail(): mixed {
        $label = __('crm-inventory/inventory.columns.customer_email');

        if ($this->setInfoList) {
            $column = TextEntryWithView::make('customer.email')
                ->icon('heroicon-s-envelope-open')
                ->removeIfEmpty(true)
                ->label($label);
        } else {
            $column = TextColumn::make('customer.email')
                ->label(__('crm-customer/customer.columns.email'))
                ->searchable()
                ->color('gray')
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignLeft()->wrap();
        }
        return $column;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function unitZone(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_zone');
        $icon = 'heroicon-s-map-pin';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_zone')
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }

        } else {
            $column = TextColumn::make('unit_zone')
                ->label($label)
                ->weight('Bold')
                ->size('Large')
                ->searchable();
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function UnitArea(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_area');
        $icon = 'heroicon-s-arrows-pointing-out';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_area')
//                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }

        } else {
            $column = TextColumn::make('unit_area')
                ->label($label);
            if ($this->setSpanLabel) {
                $column->formatStateUsing(function ($record) use ($label) {
                    return '<span class="inventoryTableSpan">' . $label . ' : </span> ' . number_format($record->unit_area);
                })->html();
            }
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function UnitLand(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_land');
        $icon = 'heroicon-s-cube';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_land')
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make('unit_land')
                ->label($label);
            if ($this->setSpanLabel) {
                $column->formatStateUsing(function ($record) use ($label) {
                    return '<span class="inventoryTableSpan">' . $label . ' : </span> ' . number_format($record->unit_land);
                })->html();
            }
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function UnitGarden(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_garden');
        $icon = 'fas-tree';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_garden')
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make('unit_garden')
                ->label($label);
            if ($this->setSpanLabel) {
                $column->formatStateUsing(function ($record) use ($label) {
                    return '<span class="inventoryTableSpan">' . $label . ' : </span> ' . number_format($record->unit_garden);
                })->html();
            }
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function UnitRoof(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_roof');
        $icon = 'heroicon-s-view-columns';
        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_roof')
                ->removeIfEmpty(true)
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make('unit_roof')
                ->label($label);
            if ($this->setSpanLabel) {
                $column->formatStateUsing(function ($record) use ($label) {
                    return '<span class="inventoryTableSpan">' . $label . ' : </span> ' . number_format($record->unit_roof);
                })->html();
            }
            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function unitPrice(): mixed {
        $label = __('crm-inventory/inventory.columns.unit_price');
        $icon = 'heroicon-s-currency-dollar';

        if ($this->setInfoList) {
            $column = TextEntryWithView::make('unit_price')
                ->state(function ($record) {
                    return number_format($record->unit_price);
                })
                ->label($label);
            if ($this->setIcon) {
                $column->icon($icon);
            }
        } else {
            $column = TextColumn::make('unit_price')
                ->label($label)
                ->formatStateUsing(function ($record) {
                    return number_format($record->unit_price);
                })
                ->weight('Bold')
                ->size('Large')
                ->searchable()
                ->sortable();

            if ($this->setIcon) {
                $column->icon($icon);
            }
        }
        return $column;
    }


}


