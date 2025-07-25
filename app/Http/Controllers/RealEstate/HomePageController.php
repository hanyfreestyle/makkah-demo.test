<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\LatestNews\LatestNews;
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

    $meta = parent::getMeatByCatId('latest_news');
    self::printSeoMeta($meta, 'web.latest_news');

    $latestNews = LatestNews::query()
      ->where('is_active', true)
//      ->translatedIn()
      ->orderBy('id', 'desc')
      ->paginate(9);


    if ($latestNews->isEmpty()) {
      self::abortError404('Empty');
    }

    return view('makkah.latest_news')->with([
      'latestNews' => $latestNews,
      'meta' => $meta,
    ]);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function latestNewsView($slug) {
    $meta = parent::getMeatByCatId('home');
    $slug = Url_Slug($slug);
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


}
