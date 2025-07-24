<?php


use App\Http\Controllers\RealEstate\HomePageController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['UnderConstruction']], function () {
  Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomePageController::class, 'index'])->name('web.index');
    Route::get('/about-us', [HomePageController::class, 'aboutUs'])->name('web.about_us');
    Route::get('/contact-us', [HomePageController::class, 'index'])->name('web.contact_us');
    Route::get('/latest-news', [HomePageController::class, 'index'])->name('web.latest_news');


  });
});
