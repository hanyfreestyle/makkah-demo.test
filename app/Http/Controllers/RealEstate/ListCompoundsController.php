<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;



class  ListCompoundsController extends DefaultWebController {
    use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct() {
        parent::__construct();
        self::LoadMainVar();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CompoundsList() {

        $projects = Listing::def()
            ->where('listing_type', 'Project')
            ->with('developerName')
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'compound_page');

        if ($projects->isEmpty()) {
            self::abortError404('Empty');
        }

        $units = Listing::def()
            ->where('listing_type', '!=', 'Project')
            ->with('developerName')
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'property_page');


        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }

        $Meta = parent::getMeatByCatId('compounds');
        parent::printSeoMeta($Meta, 'page_compounds', 'blog', ['sendRows' => $projects, 'sendRows2' => $units]);
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Compounds';

        return view('web.compounds_list')->with([
            'pageView' => $pageView,
            'projects' => $projects,
            'units' => $units,
        ]);
    }

}
