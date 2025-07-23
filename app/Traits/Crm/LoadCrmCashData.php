<?php

namespace App\Traits\Crm;

use App\Models\CrmData\DataCampaign;
use App\Models\CrmData\DataContactTime;
use App\Models\CrmData\DataContactType;
use App\Models\CrmData\DataDeliveryDate;
use App\Models\CrmData\DataDeveloper;
use App\Models\CrmData\DataDistrict;
use App\Models\CrmData\DataFinishingType;
use App\Models\CrmData\DataFloorType;
use App\Models\CrmData\DataFollowingType;
use App\Models\CrmData\DataFurnishedType;
use App\Models\CrmData\DataLeadSource;
use App\Models\CrmData\DataLeadSourceSub;
use App\Models\CrmData\DataPaymentType;
use App\Models\CrmData\DataProject;
use App\Models\CrmData\DataServiceType;
use App\Models\CrmData\DataUnitArea;
use App\Models\CrmData\DataUnitType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\CrmData\DataCustomerEvaluation;
use App\Models\CrmData\DataCustomerType;


trait LoadCrmCashData {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function loadCrmData(
        string $modelClass,
        string $cacheKey,
        bool   $useCache = true,
        bool   $onlyActive = true
    ): Collection {
        $queryBuilder = fn() => $modelClass::query()
            ->when($onlyActive, fn($q) => $q->where('is_active', true)->where('is_archive', false))
            ->get();

        if ($useCache) {
            $fullCacheKey = $cacheKey . '_' . ($onlyActive ? 'only_active' : 'all') . '_' . app()->getLocale();
            return Cache::remember(
                $fullCacheKey,
                cashDay(1),
                $queryBuilder
            );
        }
        return $queryBuilder();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getLocalizedName(Collection $data, int|string|null $id, string $field = 'name'): string {
        if (is_null($id)) return '-';

        $record = $data->get($id) ?? $data->where('id', $id)->first();

        if (!$record) return '-';

        $locale = app()->getLocale();
        $raw = $record->{$field} ?? null;

        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
        } elseif (is_array($raw)) {
            $decoded = $raw;
        } elseif (is_object($raw)) {
            $decoded = (array)$raw;
        } else {
            return '-';
        }
        return $decoded[$locale] ?? $decoded['ar'] ?? '-';
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function cashDataCampaign(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataCampaign::class, 'DataCampaign_CashList', $useCache, $onlyActive);
    }

    public static function cashCustomerType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataCustomerType::class, 'DataCustomerType_CashList', $useCache, $onlyActive);
    }

    public static function cashCustomerEvaluation(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataCustomerEvaluation::class, 'DataCustomerEvaluation_CashList', $useCache, $onlyActive);
    }

    public static function cashDataLeadSource(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataLeadSource::class, 'DataLeadSource_CashList', $useCache, $onlyActive);
    }

    public static function cashDataLeadSourceSub(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataLeadSourceSub::class, 'DataLeadSourceSub_CashList', $useCache, $onlyActive);
    }

    public static function cashDataContactTime(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataContactTime::class, 'DataContactTime_CashList', $useCache, $onlyActive);
    }

    public static function cashDataContactType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataContactType::class, 'DataContactType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataDeliveryDate(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataDeliveryDate::class, 'DataDeliveryDate_CashList', $useCache, $onlyActive);
    }

    public static function cashDataDeveloper(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataDeveloper::class, 'DataDeveloper_CashList', $useCache, $onlyActive);
    }

    public static function cashDataDistrict(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataDistrict::class, 'DataDistrict_CashList', $useCache, $onlyActive);
    }

    public static function cashDataFinishingType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataFinishingType::class, 'DataFinishingType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataFloorType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataFloorType::class, 'DataFloorType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataFollowingType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataFollowingType::class, 'DataFollowingType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataFurnishedType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataFurnishedType::class, 'DataFurnishedType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataPaymentType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataPaymentType::class, 'DataPaymentType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataProject(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataProject::class, 'DataProject_CashList', $useCache, $onlyActive);
    }

    public static function cashDataServiceType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataServiceType::class, 'DataServiceType_CashList', $useCache, $onlyActive);
    }

    public static function cashDataUnitArea(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataUnitArea::class, 'DataUnitArea_CashList', $useCache, $onlyActive);
    }

    public static function cashDataUnitType(bool $onlyActive = true, bool $useCache = true): Collection {
        return self::loadCrmData(DataUnitType::class, 'DataUnitType_CashList', $useCache, $onlyActive);
    }
}
