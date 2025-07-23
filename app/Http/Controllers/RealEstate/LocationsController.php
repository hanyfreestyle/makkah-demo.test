<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\BlogPost;
use App\Models\RealEstate\Location;
use App\Models\RealEstate\Projects;
use App\Models\RealEstate\ProjectUnits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class LocationsController extends DefaultWebController {
    use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct() {
        parent::__construct();
        self::LoadMainVar();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LocationView($slug) {
        try {
            $location = Location::query()
                ->where('is_active', true)
                ->where('slug', $slug)
                ->firstOrFail();

        } catch (\Exception $e) {
            self::abortError404('root');
        }

        self::printSeoMeta($location, 'page_locationView');
        $pageView = $this->pageView;

        $trees = Location::find($location->id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
        $listId = Location::find($location->id)->descendantsAndSelf()->orderBy('depth', 'asc')->pluck('id');


        $projects = Projects::query()
            ->whereIn('location_id', $listId)
            ->with('developer')
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'compound_page');

        if ($projects->isEmpty()) {
//            self::abortError404('Empty');
        }


        $units = ProjectUnits::query()
            ->whereIn('location_id', $listId)
            ->with('developer')
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'property_page');


        if ($units->isEmpty()) {
//            self::abortError404('Empty');
        }




        if ($units->isEmpty()) {
//            self::abortError404('Empty');
        }


        return view('real-estate.location_view')->with([
            'pageView' => $pageView,
            'location' => $location,
            'trees' => $trees,
            'projects' => $projects,
            'units' => $units,
        ]);

    }
}
