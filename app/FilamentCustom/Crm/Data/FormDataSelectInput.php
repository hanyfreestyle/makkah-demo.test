<?php

namespace App\FilamentCustom\Crm\Data;

use App\Traits\Crm\LoadCrmCashData;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;


class FormDataSelectInput {
    use LoadCrmCashData;

    protected bool $setHiddenLabel = false;
    protected bool $setRequired = true;

    public static function make(): static {
        return new static();
    }

    public function setHiddenLabel(bool $value): static {
        $this->setHiddenLabel = $value;
        return $this;
    }

    public function setRequired(bool $value): static {
        $this->setRequired = $value;
        return $this;
    }

    /**
     * Get a configured Select input based on type.
     *
     * @param string $type
     * @return Select
     */
    public function getColumns(string $type): Select {
        $locale = app()->getLocale();

        return match ($type) {
            'customerParent_id' => $this->baseSelect('parent_id', __('crm-data/data.select.customer_type'))
                ->options(fn() => self::cashCustomerType()->pluck("name.{$locale}", 'id')),

            'customerType' => $this->baseSelect('customer_type_id', __('crm-data/data.select.customer_type'))
                ->options(fn() => self::cashCustomerType()->pluck("name.{$locale}", 'id'))
                ->live()
                ->afterStateUpdated(fn(Set $set) => $set('customer_evaluation_id', null)),

            'customerEvaluation' => $this->baseSelect('customer_evaluation_id', __('crm-data/data.select.customer_evaluation'))
                ->options(fn(Get $get) => self::cashCustomerEvaluation()
                    ->where('parent_id', $get('customer_type_id'))
                    ->pluck("name.{$locale}", 'id'))
                ->default(null),

            'leadSource' => $this->baseSelect('lead_source_id', __('crm-data/data.select.lead_source'))
                ->options(fn() => self::cashDataLeadSource()->pluck("name.{$locale}", 'id')),

            'leadSourceSub' => $this->baseSelect('lead_source_sub_id', __('crm-data/data.select.lead_source_sub'))
                ->options(fn() => self::cashDataLeadSourceSub()->pluck("name.{$locale}", 'id')),

            'campaign' => $this->baseSelect('campaign_id', __('crm-data/data.select.campaign'))
                ->options(fn() => self::cashDataCampaign()->pluck("name.{$locale}", 'id')),

            default => Select::make('invalid_type'),
        };
    }

    /**
     * Create base Select with shared configuration.
     *
     * @param string $name
     * @param string $label
     * @return Select
     */
    protected function baseSelect(string $name, string $label): Select {
        $select = Select::make($name)
            ->label($label)
            ->hiddenLabel($this->setHiddenLabel)
            ->preload()
            ->searchable()
            ->required($this->setRequired);

        if ($this->setHiddenLabel) {
            $select->placeholder($label);
        }

        return $select;
    }
}

