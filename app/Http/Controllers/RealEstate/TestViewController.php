<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\ForSale;
use App\Models\RealEstate\Projects;
use App\Models\RealEstate\ProjectUnits;

class TestViewController extends DefaultWebController {
  use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function __construct() {
    parent::__construct();
    self::LoadMainVar();
  }

  public function TestListingSlider() {

  }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function TestProjectList() {
    $projects = Projects::query()
      ->with(['project_type', 'project_units', 'unit_types'])
//      ->whereNull('photo')
      ->orderBy('id', 'asc')
      ->paginate(12, ['*'], 'compound_page');

    return view('real-estate.test.projects')->with([
      'projects' => $projects,
    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function ForSaleList() {
    $units = ForSale::query()
//      ->whereNull('photo')
//      ->translatedIn()
//        ->where('unit_type_id',9)
        ->where("area",'<',120)

        ->where("rooms",'>',2)
      ->orderBy('id', 'asc')
      ->paginate(12, ['*'], 'compound_page');

    return view('real-estate.test.for-sale')->with([
      'units' => $units,
    ]);
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function ListingList() {
    $units = ProjectUnits::query()
//      ->whereNull('photo')
//      ->translatedIn()
//      ->where("area",'<',120)
//      ->where("rooms",'>',2)
      ->where('unit_type_id',7)
      ->where("area",'<',120)
      ->orderBy('id', 'asc')
      ->paginate(12, ['*'], 'compound_page');

    return view('real-estate.test.units')->with([
      'units' => $units,
    ]);
  }

}
