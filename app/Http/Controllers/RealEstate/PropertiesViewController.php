<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\Listing;
use App\Models\RealEstate\Location;
use App\Models\RealEstate\ProjectUnits;
use Illuminate\Support\Facades\File;


class PropertiesViewController extends DefaultWebController {
  use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function __construct() {
    parent::__construct();
    self::LoadMainVar();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function ListView($listingId) {
    $locationTree = [];
    $mediaData = [];


    try {
      $listing_unit = Listing::query()
        ->where('slug', $listingId)
        ->with([
          'developer',
          'slider_gallery',
          'faqs',
          'project',
          'children.unit_type', // الوحدات الفرعية + النوع
        ])
        ->withCount(['slider_gallery', 'faqs', 'units'])
        ->translatedIn()
        ->firstOrFail();
    } catch (\Exception $e) {
      self::abortError404('Listing');
    }

//       dd($listing_unit);

    if ($listing_unit->location_id) {
      $locationTree = Location::find($listing_unit->location_id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
    }

    if (count($listing_unit->translations) == 1) {
      $pageView['go_home'] = route('web.index');
    }
    parent::printSeoMeta($listing_unit, 'page_ListView');


    if ($listing_unit->listing_type == 'Project') {

      $groupedUnits = collect();

      $children = $listing_unit->children;

      $groupedUnits = $children->groupBy('unit_type_id')->map(function ($items, $typeId) {
        return [
          'unit_type_id' => $typeId,
          'type_name' => optional($items->first()->unit_type)->name ?? 'Unknown',
          'type_icon' => optional($items->first()->unit_type)->icon ?? 'fas fa-building',
          'count' => $items->count(),
          'units' => $items,
        ];
      })
        ->sortByDesc('count') // ترتيب تنازلي حسب عدد الوحدات
        ->values(); // إعادة ترتيب الفهارس الرقمية

      $groupedUnits->prepend([
        'unit_type_id' => null,
        'type_name' => 'All Units',
        'type_icon' => 'fas fa-home',
        'count' => $children->count(),
        'units' => $children,
      ]);

      $mediaData = [
        'youtube' => $listing_unit->youtube_url ?? null,
        'latitude' => $listing_unit->latitude ?? null,
        'longitude' => $listing_unit->longitude ?? null,

      ];

    } elseif ($listing_unit->listing_type == 'ForSale') {


    } elseif ($listing_unit->listing_type == 'Unit') {

      $mediaData = [
        'youtube' => $listing_unit->youtube_url ?? $listing_unit->project->youtube_url ?? null,
        'latitude' => $listing_unit->latitude ?? $listing_unit->project->latitude ?? null,
        'longitude' => $listing_unit->longitude ?? $listing_unit->project->longitude ?? null,

      ];
    }

//        $pageGoBack = route('web.index');
//
//        if ($unit->listing_type == 'Project') {
//            if ($unit->locationName->slug ?? null) {
//                $pageGoBack = route('page_locationView', $unit->locationName->slug);
//            }
//        } elseif ($unit->listing_type == 'ForSale') {
//            if ($unit->developerName->slug ?? null) {
//                $pageGoBack = route('page_developer_view', $unit->developerName->slug);
//            }
//        } elseif ($unit->listing_type == 'Unit') {
//            if ($unit->projectName->slug ?? null) {
//                $pageGoBack = route('page_ListView', $unit->projectName->slug);
//            }
//        }


    if ($listing_unit->listing_type == 'Project') {

      $similarProjects = Listing::query()
        ->where('is_published', true)
        ->where('listing_type', 'Project')
        ->where('location_id', $listing_unit->location_id)
        ->where('developer_id', '!=', 365)
        ->translatedIn()
        ->with('translation')
        ->inRandomOrder()
        ->limit('10')
        ->get();

      return view('real-estate.project_view')->with([
        'listing_unit' => $listing_unit,
        'locationTree' => $locationTree,
        'groupedUnits' => $groupedUnits,
        'mediaData' => $mediaData,
        'similarProjects' => $similarProjects,
      ]);


    } elseif ($listing_unit->listing_type == 'Unit') {

      $similarUnits = Listing::query()
        ->where('is_published', true)
        ->where('listing_type', 'Unit')
        ->where('parent_id', $listing_unit->project->id)
        ->where('unit_type_id', $listing_unit->unit_type_id)
        ->where('id', "!=", $listing_unit->id)
        ->translatedIn()
        ->with('translation')
        ->get();

//            dd($listing_unit->project->id);
//            dd($similarUnits);


      return view('real-estate.project_unit_view')->with([
        'listing_unit' => $listing_unit,
        'locationTree' => $locationTree,
        'mediaData' => $mediaData,
        'similarUnits' => $similarUnits,
      ]);
    }

  }

}
