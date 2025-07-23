<?php


use App\Http\Controllers\RealEstate\HomePageController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['UnderConstruction']], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/', [HomePageController::class, 'index'])->name('web.index');

        Route::get('/search', [SearchController::class, 'Search'])->name('Search');
        Route::get('/about-us', [WebPagesController::class, 'AboutUs'])->name('page_AboutUs');
        Route::get('/contact-us', [WebPagesController::class, 'ContactUs'])->name('page_ContactUs');




    });
});
