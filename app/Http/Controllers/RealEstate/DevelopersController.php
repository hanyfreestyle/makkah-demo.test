<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\BlogPost;
use App\Models\RealEstate\Developer;
use App\Models\RealEstate\Projects;
use App\Models\RealEstate\ProjectUnits;

class DevelopersController extends DefaultWebController {
    use __LoadConstructData;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct() {
        parent::__construct();
        self::LoadMainVar();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DevelopersList() {

        $developers = Developer::query()->where('id', '!=', 365)
            ->where('is_active', true)
            ->withCount(['projects', 'units'])
            ->withMin(['projects as min_price' => function ($q) {
                $q->whereNotNull('price'); // أو starting_price حسب عمود السعر
            }], 'price') // أو 'starting_price'
            ->with(['projects' => function ($query) {
                $query->select('id', 'developer_id', 'project_type_id', 'location_id')
                    ->with([
                        'location.translations',
                        'project_type.translations'
                    ]);
            }])
            ->with('translation')
            ->orderBy('projects_count', 'desc')
            ->paginate(12);

        if ($developers->isEmpty()) {
            self::abortError404('Empty');
        }

        $meta = self::getMeatByCatId('developer');
        self::printSeoMeta($meta, 'page_developers');

        return view('real-estate.developer.index')->with([
            'developers' => $developers,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DeveloperView($slug) {
        try {
            $developer = Developer::query()
                ->where('is_active', true)
                ->where('slug', $slug)
                ->withCount(['active_projects', 'active_units', 'active_posts'])
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('Developer');
        }



        self::printSeoMeta($developer, 'page_developer_view');

        $projects = Projects::query()
            ->where('developer_id', $developer->id)
            ->where('id','!=',5061432)
            ->with(['project_type','project_units','unit_types'])
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'compound_page');

        if ($projects->isEmpty()) {
            self::abortError404('Empty');
        }
//       dd($projects->first()->developer->photo_thumbnail);

        $units = ProjectUnits::query()
            ->where('developer_id', $developer->id)
            ->orderBy('id', 'desc')
            ->paginate(12, ['*'], 'property_page');
        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }


        $posts = BlogPost::query()
            ->where('developer_id', $developer->id)
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->paginate(12, ['*'], 'post_page');


        return view('real-estate.developer.view')->with([
            'developer' => $developer,
            'projects' => $projects,
            'units' => $units,
            'posts' => $posts,
        ]);
    }


}
