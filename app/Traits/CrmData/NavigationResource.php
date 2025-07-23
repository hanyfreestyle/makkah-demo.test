<?php

namespace App\Traits\CrmData;

use App\Filament\Admin\Resources\CrmData\DataCustomerEvaluationResource;
use App\Filament\Admin\Resources\CrmData\DataCustomerTypeResource;
use App\Filament\Admin\Resources\CrmData\DataLeadSourceResource;
use Filament\Resources\Resource;
use Filament\Facades\Filament;
use Illuminate\Support\Str;


trait NavigationResource {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function navigationBuilder(array $resources = null): array {
        $resources ??= Filament::getCurrentPanel()?->getResources() ?? [];

        return array_values(array_filter(
            array_map(
                static function (string $resource): ?array {
                    // ✅ Check: class exists and extends Filament Resource
                    if (!class_exists($resource) || !is_subclass_of($resource, Resource::class)) {
                        return null;
                    }

                    // ✅ Must explicitly define canViewAny
                    if (!method_exists($resource, 'canViewData')) {
                        return null;
                    }

                    // ✅ Must return true
                    if ($resource::canViewData() !== true) {
                        return null;
                    }

                    // ✅ Build navigation item
                    return [
                        'name' => Str::before(class_basename($resource), 'Resource'),
                        'resource' => $resource,
                        'label' => $resource::getNavigationLabel() ?? Str::headline(Str::before(class_basename($resource), 'Resource')),
                        'icon' => $resource::getNavigationIcon() ?? 'heroicon-o-question-mark-circle',
                        'url' => $resource::getUrl('index'),
                    ];
                },
                $resources
            ),
            fn($item) => !is_null($item) // ⬅️ استبعد العناصر اللي رجعت null
        ));
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function LoadNavigationBuilder(): array {

        return self::NavigationBuilder([
            \App\Filament\Admin\Resources\CrmData\DataCustomerTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataCustomerEvaluationResource::class,
            \App\Filament\Admin\Resources\CrmData\DataLeadSourceResource::class,
            \App\Filament\Admin\Resources\CrmData\DataLeadSourceSubResource::class,
            \App\Filament\Admin\Resources\CrmData\DataCampaignResource::class,
            \App\Filament\Admin\Resources\CrmData\DataUnitTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataDeveloperResource::class,
            \App\Filament\Admin\Resources\CrmData\DataProjectResource::class,
            \App\Filament\Admin\Resources\CrmData\DataDistrictResource::class,
            \App\Filament\Admin\Resources\CrmData\DataContactTimeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataContactTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataDeliveryDateResource::class,
            \App\Filament\Admin\Resources\CrmData\DataFinishingTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataFollowingTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataFurnishedTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataPaymentTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataServiceTypeResource::class,
            \App\Filament\Admin\Resources\CrmData\DataUnitAreaResource::class,
            \App\Filament\Admin\Resources\CrmData\DataFloorTypeResource::class,
        ]);
    }

}
