<?php

namespace App\Http\Controllers\RealEstate;

use App\Models\Makkah\MakkahProject;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

trait __LoadConstructData {

  protected mixed $printSchema;
  protected mixed $amenities;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function LoadMainVar() {
    $pageView = [
      'selMenu' => null,
      'show_fix' => true,
      'slug' => null,
      'go_home' => null,
      'cta_footer' => true,
      'cta_footer_slug' => route('web.our_projects'),
    ];

    $this->pageView = $pageView;
    View::share('pageView', $pageView);

    $projectMenu = self::cashProjectMenu($this->is_cash);
    View::share('projectMenu', $projectMenu);


//    $locationsList = self::CashLocationList($this->is_cash);
//    View::share('locationsList', $locationsList);
//
//    $projectTypeList = self::CashProjectTypeList($this->is_cash);
//    View::share('projectTypeList', $projectTypeList);
//
//    $projectStatusList = self::CashProjectStatusList($this->is_cash);
//    View::share('projectStatusList', $projectStatusList);
//
//    $propertyTypeList = self::CashPropertyTypeList($this->is_cash);
//    View::share('propertyTypeList', $propertyTypeList);
//
//    $projectNameList = self::CashProjectNameList($this->is_cash);
//    View::share('projectNameList', $projectNameList);
//
//    $blogCategoryList = self::CashBlogCategoryList($this->is_cash);
//    View::share('blogCategoryList', $blogCategoryList);
//

//
//    $developersMenu = self::cashDeveloperMenu($this->is_cash);
//    View::share('developersMenu', $developersMenu);
//
//    $listingPageMenu = self::cashListingPageMenu($this->is_cash);
//    View::share('listingPageMenu', $listingPageMenu);
//
//
//    $amenitiesList = self::cashAmenitiesList($this->is_cash);
//    View::share('amenitiesList', $amenitiesList);

//    $printSchema = new SchemaTools();
//    View::share('printSchema', $printSchema);

//        $pagesLinkMenu = DefaultMainController::CashPagesLinkMenu(1);
//        View::share('pagesLinkMenu', $pagesLinkMenu);
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  static function cashProjectMenu($cash = true) {
    if ($cash) {
      $cashProjectMenu = Cache::remember("ProjectMenu_CashList_" . app()->getLocale(), cashDay(1), function () {
        return MakkahProject::query()
          ->where('is_active', true)
          ->orderBy('id', 'asc')
          ->take(8)
          ->get();
      });
    } else {
      $cashProjectMenu = MakkahProject::query()
        ->where('is_active', true)
        ->orderBy('id', 'asc')
        ->take(8)
        ->get();
    }
    return $cashProjectMenu;
  }


//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashLocationList($cash = true) {
//    if ($cash) {
//      $location = Cache::remember("Location_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return Location::query()->with('translation')->get();
//      });
//    } else {
//      $location = Location::query()->with('translation')->get();
//    }
//    return $location;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashProjectTypeList($cash = true) {
//    if ($cash) {
//      $projectTypeList = Cache::remember("DataProjectType_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return DataProjectType::query()->with('translation')->get();
//      });
//    } else {
//      $projectTypeList = DataProjectType::query()->with('translation')->get();
//    }
//    return $projectTypeList;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashProjectStatusList($cash = true) {
//    if ($cash) {
//      $projectTypeList = Cache::remember("DataProjectStatus_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return DataProjectStatus::query()->with('translation')->get();
//      });
//    } else {
//      $projectTypeList = DataProjectStatus::query()->with('translation')->get();
//    }
//    return $projectTypeList;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashPropertyTypeList($cash = true) {
//    if ($cash) {
//      $projectTypeList = Cache::remember("DataUnitType_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return DataUnitType::query()->with('translation')->get();
//      });
//    } else {
//      $projectTypeList = DataUnitType::query()->with('translation')->get();
//    }
//    return $projectTypeList;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashBlogCategoryList($cash = true) {
//    if ($cash) {
//      $blogCategoryList = Cache::remember("DataBlogCategory_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return BlogCategory::query()->where('is_active', true)->with('translation')->get();
//      });
//    } else {
//      $blogCategoryList = BlogCategory::query()->where('is_active', true)->with('translation')->get();
//    }
//    return $blogCategoryList;
//  }
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function CashProjectNameList($cash = true) {
//    if ($cash) {
//      $projectNameList = Cache::remember("DataProjectName_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return self::getTranslatedProjectNameQuery("listings", "listing_translations", "listing_id");
//      });
//    } else {
//      $projectNameList = self::getTranslatedProjectNameQuery("listings", "listing_translations", "listing_id");
//    }
//    return $projectNameList;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  public static function getTranslatedProjectNameQuery($TableName, $TableTranslations, $ForeignKey) {
//    return DB::table("$TableName")
//      ->select("$TableName.id", "$TableTranslations.name as name")
//      ->where('listing_type', "Project")
//      ->where('is_published', true)
//      ->join("$TableTranslations", function ($join) use ($TableName, $TableTranslations, $ForeignKey) {
//        $join->on("$TableTranslations.$ForeignKey", '=', "$TableName.id")
//          ->where("$TableTranslations.locale", '=', app()->getLocale());
//      })
//      ->orderBy("$TableName.id")
//      ->pluck('name', 'id');
//  }
//
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function cashDeveloperMenu($cash = true) {
//    if ($cash) {
//      $developer = Cache::remember("Developer_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return Developer::query()
//          ->where('id', '!=', 365)
//          ->where('is_active', true)
//          ->with('translation')
//          ->withCount('units')
//          ->orderBy('units_count', 'desc')
//          ->get()
//          ->map(function ($developer) {
//            return [
//              'id' => $developer->id,
//              'name' => $developer->name,
//              'slug' => $developer->slug,
//              'projects_count' => $developer->units_count,
//            ];
//          });
//      });
//    } else {
//      $developer = Developer::query()
//        ->where('id', '!=', 365)
//        ->where('is_active', true)
//        ->with('translation')
//        ->withCount('units')
//        ->orderBy('units_count', 'desc')
//        ->get()
//        ->map(function ($developer) {
//          return [
//            'id' => $developer->id,
//            'name' => $developer->name,
//            'slug' => $developer->slug,
//            'projects_count' => $developer->units_count,
//          ];
//        });
//    }
//    return $developer;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function cashAmenitiesList($cash = true) {
//    if ($cash) {
//      $location = Cache::remember("Amenity_CashList_" . app()->getLocale(), cashDay(1), function () {
//        return Amenity::query()->with('translation')->get();
//      });
//    } else {
//      $location = Amenity::query()->with('translation')->get();
//    }
//    return $location;
//  }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  static function cashListingPageMenu($cash = true) {
//    $ids = [23, 24, 25, 35, 36, 250, 251, 252];
//    if ($cash) {
//      $listingPageMenuMenu = Cache::remember("ListingPage_CashList_" . app()->getLocale(), cashDay(1), function () use ($ids) {
//        return ListingsPage::query()
//          ->where('is_active', true)
//          ->where('location_id', '!=', null)
//          ->whereIn('id', $ids)
//          ->translatedIn()
//          ->with('location')
//          ->with('project')
//          ->get();
//      });
//    } else {
//      $listingPageMenuMenu = ListingsPage::query()
//        ->where('is_active', true)
//        ->where('location_id', '!=', null)
//        ->whereIn('id', $ids)
//        ->translatedIn()
//        ->with('location')
//        ->with('project')
//        ->get();
//    }
//    return $listingPageMenuMenu;
//  }


}
