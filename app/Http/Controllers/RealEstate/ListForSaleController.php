<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use Illuminate\Http\Request;


class  ListForSaleController extends DefaultWebController {
    use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct() {
        parent::__construct();
        self::LoadMainVar();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForSaleList(Request $request) {

        $search = new SearchController();

        $units = $search->SearchQuery($request, Listing::WebUnits(), 'units')
            ->orderBy('id', 'desc')
            ->paginate(12)->appends(request()->query());


        if ($units->isEmpty() and isset($request->page)) {
            self::abortError404('Empty');
        }

        $PagesLinks = Page::where('is_active', true)
            ->with('translation')
            ->with('loaction_slug')
            ->with('project_slug')
            ->get();

        $Meta = parent::getMeatByCatId('for-sale');
        parent::printSeoMeta($Meta, 'page_for_sale', 'blog', ['sendRows' => $units]);
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'ForSale';


        return view('web.for_sale_list')->with([
            'pageView' => $pageView,
            'units' => $units,
            'PagesLinks' => $PagesLinks,
        ]);
    }
}
