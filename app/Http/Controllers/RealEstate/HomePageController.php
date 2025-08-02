<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\Builder\BuilderBlock;
use App\Models\Builder\BuilderPage;
use App\Models\LatestNews\LatestNews;
use App\Models\Makkah\MakkahProject;
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
    $blocks = self::getBuilderPageBlocks($meta->builder_page_id);
    return view('makkah.index')->with([
      'blocks' => $blocks,
    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function aboutUs() {
    $meta = parent::getMeatByCatId('about_us');
    self::printSeoMeta($meta, 'web.about_us');
    $pageView = $this->pageView;
    $pageView['selMenu'] = "about_us";

    $blocks = self::getBuilderPageBlocks($meta->builder_page_id);

    return view('makkah.about_us')->with([
      'meta' => $meta,
      'pageView' => $pageView,
      'blocks' => $blocks,
    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function contactUs() {
    $meta = parent::getMeatByCatId('contact_us');
    self::printSeoMeta($meta, 'web.contact_us');
    $pageView = $this->pageView;
    $pageView['selMenu'] = "contact_us";
    $pageView['cta_footer'] = false;

    return view('makkah.contact_us')->with([
      'meta' => $meta,
      'pageView' => $pageView,
    ]);
  }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function latestNews() {

    $meta = parent::getMeatByCatId('latest_news');
    self::printSeoMeta($meta, 'web.latest_news');
    $pageView = $this->pageView;
    $pageView['selMenu'] = "latest_news";


    $latestNews = LatestNews::query()
      ->where('is_active', true)
      ->whereNotNull('published_at')
      ->where('published_at', '<=', now())
//      ->translatedIn()
      ->orderBy('published_at', 'desc')
      ->paginate(9);


    if ($latestNews->isEmpty()) {
      self::abortError404('Empty');
    }

    return view('makkah.latest_news')->with([
      'latestNews' => $latestNews,
      'meta' => $meta,
      'pageView' => $pageView,
    ]);
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function latestNewsView($slug) {
    $meta = parent::getMeatByCatId('home');
    $slug = Url_Slug($slug);
    $pageView = $this->pageView;
    $pageView['selMenu'] = "latest_news";

    $news = LatestNews::query()
      ->whereTranslation('slug', $slug)
      ->firstOrFail();
    $pageView['slug'] = route('web.latest_news_view', $news->translate(webChangeLocale())->slug);

    self::printSeoMeta($meta, 'web.index');
    return view('makkah.latest_news_view')->with([
      'news' => $news,
      'pageView' => $pageView,
    ]);
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function ourProjects() {

    $meta = parent::getMeatByCatId('our_project');
    self::printSeoMeta($meta, 'web.our_projects');
    $pageView = $this->pageView;
    $pageView['selMenu'] = "our_project";
    $pageView['cta_footer'] = false;

    $ourProjects = MakkahProject::query()
      ->where('is_active', true)
      ->orderBy('id', 'asc')
      ->get();

    return view('makkah.our_projects')->with([
      'ourProjects' => $ourProjects,
      'meta' => $meta,
      'pageView' => $pageView,
    ]);
  }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function projectView($slug) {
    $slug = Url_Slug($slug);
    $pageView = $this->pageView;
    $pageView['selMenu'] = "our_project";

    $project = MakkahProject::query()
      ->whereTranslation('slug', $slug)
      ->firstOrFail();
    $pageView['slug'] = route('web.project_view', $project->translate(webChangeLocale())->slug);

    $blocks = self::getBuilderPageBlocks($project->builder_page_id);

    self::printSeoMeta($project, 'web.project_view');

    return view('makkah.projects_view')->with([
      'project' => $project,
      'pageView' => $pageView,
      'blocks' => $blocks,
    ]);
  }


}
