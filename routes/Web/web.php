<?php


use App\Http\Controllers\Makkah\HomePageController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['UnderConstruction']], function () {
  Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomePageController::class, 'index'])->name('web.index');
    Route::get('/about-us', [HomePageController::class, 'aboutUs'])->name('web.about_us');
    Route::get('/contact-us', [HomePageController::class, 'contactUs'])->name('web.contact_us');
    Route::get('/latest-news', [HomePageController::class, 'latestNews'])->name('web.latest_news');
    Route::get('/latest-news/{slug}', [HomePageController::class, 'latestNewsView'])->name('web.latest_news_view');
    Route::get('/our-projects', [HomePageController::class, 'ourProjects'])->name('web.our_projects');
    Route::get('/project/{slug}', [HomePageController::class, 'projectView'])->name('web.project_view');
//    Route::get(LaravelLocalization::transRoute('routes.LatestNews_View'),
//      [WebPageController::class, 'LatestNews_View'])->name('LatestNews_View');

  });
});
