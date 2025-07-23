<?php

namespace App\FilamentCustom\Crm\Data;

use App\Traits\Crm\LoadCrmCashData;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class FormDataSelectFilter {
    use LoadCrmCashData;

    protected bool $setHiddenLabel = true;
    protected bool $setMultiple = true;

    public static function make(): static {
        return new static();
    }

    public function setHiddenLabel(bool $value): static {
        $this->setHiddenLabel = $value;
        return $this;
    }

    public function setMultiple(bool $value): static {
        $this->setMultiple = $value;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getColumns(string $type): mixed {
        $locale = app()->getLocale();

        return match ($type) {
            'customer_dynamic_filter' => $this->customerDynamicFilter('customer_type_id'),

            'customerParent_id' => $this->baseSelect('parent_id', __('crm-data/data.select.customer_type'))
                ->options(fn() => self::cashCustomerType()->pluck("name.{$locale}", 'id')),

            'customerType' => $this->baseSelect('customer_type_id', __('crm-data/data.select.customer_type'))
                ->options(fn() => self::cashCustomerType()->pluck("name.{$locale}", 'id')),

            'customerEvaluation' => $this->baseSelect('customer_evaluation_id', __('crm-data/data.select.customer_evaluation'))
                ->options(fn() => self::cashCustomerEvaluation()->pluck("name.{$locale}", 'id')),

            'leadSource' => $this->baseSelect('lead_source_id', __('crm-data/data.select.lead_source'))
                ->options(fn() => self::cashDataLeadSource()->pluck("name.{$locale}", 'id')),

            'leadSourceSub' => $this->baseSelect('lead_source_sub_id', __('crm-data/data.select.lead_source_sub'))
                ->options(fn() => self::cashDataLeadSourceSub()->pluck("name.{$locale}", 'id')),

            'campaign' => $this->baseSelect('campaign_id', __('crm-data/data.select.campaign'))
                ->options(fn() => self::cashDataCampaign()->pluck("name.{$locale}", 'id')),

            'project' => $this->baseSelect('project_id', __('crm-data/data.select.project'))
                ->options(fn() => self::cashDataProject()->pluck("name.{$locale}", 'id')),

            'developer' => $this->baseSelect('developer_id', __('crm-data/data.select.developer'))
                ->options(fn() => self::cashDataDeveloper()->pluck("name.{$locale}", 'id')),

            'district' => $this->baseSelect('district_id', __('crm-data/data.select.district'))
                ->options(fn() => self::cashDataDistrict()->pluck("name.{$locale}", 'id')),

            'unitType' => $this->baseSelect('unit_type_id', __('crm-data/data.select.unit_type'))
                ->options(fn() => self::cashDataUnitType()->pluck("name.{$locale}", 'id')),

            'serviceType' => $this->baseSelect('service_type_id', __('crm-data/data.select.service_type'))
                ->options(fn() => self::cashDataServiceType()->pluck("name.{$locale}", 'id')),

            'floorType' => $this->baseSelect('floor_type_id', __('crm-data/data.select.floor_type'))
                ->options(fn() => self::cashDataFloorType()->pluck("name.{$locale}", 'id')),

            'paymentType' => $this->baseSelect('payment_type_id', __('crm-data/data.select.payment_type'))
                ->options(fn() => self::cashDataPaymentType()->pluck("name.{$locale}", 'id')),

            'contactTime' => $this->baseSelect('contact_time_id', __('crm-data/data.select.contact_time'))
                ->options(fn() => self::cashDataContactTime()->pluck("name.{$locale}", 'id')),

            'contactType' => $this->baseSelect('contact_type_id', __('crm-data/data.select.contact_type'))
                ->options(fn() => self::cashDataContactType()->pluck("name.{$locale}", 'id')),

            'finishingType' => $this->baseSelect('finishing_type_id', __('crm-data/data.select.finishing_type'))
                ->options(fn() => self::cashDataFinishingType()->pluck("name.{$locale}", 'id')),

            'furnishedType' => $this->baseSelect('furnishing_type_id', __('crm-data/data.select.furnished_type'))
                ->options(fn() => self::cashDataFurnishedType()->pluck("name.{$locale}", 'id')),

            default => SelectFilter::make('invalid_type'),
        };
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function baseSelect(string $name, string $label): SelectFilter {
        $select = SelectFilter::make($name)
            ->preload()
            ->indicator($label)
            ->multiple($this->setMultiple)
            ->searchable();

        if ($this->setHiddenLabel) {
            $select->label('');
            $select->placeholder($label);
        } else {
            $select->label($label);
        }
        return $select;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function customerDynamicFilter(string $name): mixed {
        $select = Filter::make($name)
            ->form([
                FormDataSelectInput::make()->getColumns("customerType"),
                FormDataSelectInput::make()->getColumns("customerEvaluation"),
            ])
            ->query(function (Builder $query, array $data) {
                return $query
                    ->when($data['customer_type_id'] ?? null, fn($q, $id) => $q->where('customer_type_id', $id))
                    ->when($data['customer_evaluation_id'] ?? null, fn($q, $id) => $q->where('customer_evaluation_id', $id));
            });
        return $select;
    }

}

