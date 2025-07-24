<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;

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

//     dd($this->webConfig);



    return view('makkah.index')->with([
//      'latestBlog' => $latestBlog,
//      'featuredProperties' => $featuredProperties,
//      'popularTerritories' => $popularTerritories,
//      'topDevelopers' => $topDevelopers,
    ]);
  }


}
