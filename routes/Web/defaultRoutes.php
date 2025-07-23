<?php

use App\Http\Controllers\DefaultWebController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/check-proxy', function () {
    return [
        'url'          => url()->current(),
        'request_uri'  => request()->getRequestUri(),
        'scheme'       => request()->getScheme(),
        'host'         => request()->getHost(),
        'forwarded'    => [
            'proto' => request()->header('x-forwarded-proto'),
            'host'  => request()->header('x-forwarded-host'),
            'port'  => request()->header('x-forwarded-port'),
        ],
    ];
});


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/under-construction', [DefaultWebController::class, 'UnderConstruction'])->name('UnderConstruction');
});
