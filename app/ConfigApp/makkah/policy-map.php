<?php



return [
  \App\Models\LatestNews\LatestNews::class => \App\Policies\LatestNews\LatestNewsPolicy::class,
  \App\Models\Makkah\MakkahProject::class => \App\Policies\Makkah\MakkahProjectPolicy::class,
  \App\Models\Builder\BuilderBlock::class => \App\Policies\Builder\BuilderBlockPolicy::class,
  \App\Models\Builder\BuilderPage::class => \App\Policies\Builder\BuilderPagePolicy::class,


//  \App\Models\Data\ManageData::class => \App\Policies\RealEstate\ClientManageDataPolicy::class,
//  \App\Models\Data\DataCountry::class => \App\Policies\RealEstate\ClientManageDataPolicy::class,
//  \App\Models\RealEstate\Location::class => \App\Policies\RealEstate\ClientManageDataPolicy::class,
//  \App\Models\RealEstate\Amenity::class => \App\Policies\RealEstate\ClientManageDataPolicy::class,
//  \App\Models\RealEstate\DataProjectType::class => \App\Policies\RealEstate\ClientManageDataPolicy::class,
//
//  \App\Models\RealEstate\Projects::class => \App\Policies\RealEstate\ProjectsPolicy::class,
//  \App\Models\RealEstate\ProjectUnits::class => \App\Policies\RealEstate\ProjectUnitsPolicy::class,
//  \App\Models\RealEstate\ForSale::class => \App\Policies\RealEstate\ForSalePolicy::class,
//  \App\Models\RealEstate\UnitPages::class => \App\Policies\RealEstate\UnitPagesPolicy::class,

];
