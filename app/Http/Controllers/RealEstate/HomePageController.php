<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use Illuminate\Support\Facades\View;

class HomePageController extends DefaultWebController {
  use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function __construct() {
    parent::__construct();
    self::LoadMainVar();
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function index() {
    $meta = parent::getMeatByCatId('home');
    self::printSeoMeta($meta, 'web.index');
    View::share('headerHomeMenu', true);

    return view('makkah.index')->with([
//      'latestBlog' => $latestBlog,
//      'featuredProperties' => $featuredProperties,
//      'popularTerritories' => $popularTerritories,
//      'topDevelopers' => $topDevelopers,
    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function aboutUs() {
    $meta = parent::getMeatByCatId('home');
    self::printSeoMeta($meta, 'web.index');
    return view('makkah.about_us')->with([

    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function contactUs() {
    $meta = parent::getMeatByCatId('home');
    self::printSeoMeta($meta, 'web.index');
    return view('makkah.contact_us')->with([

    ]);
  }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function latestNews() {
    $meta = parent::getMeatByCatId('home');
    self::printSeoMeta($meta, 'web.index');
    return view('makkah.latest_news')->with([

    ]);
  }





}
