<?php

namespace App\Http\Controllers\Makkah;

use App\Models\Makkah\MakkahProject;
use Illuminate\Support\Facades\Cache;
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

}
