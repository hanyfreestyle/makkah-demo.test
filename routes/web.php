<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () { return redirect('/admin/login'); })->name('login');

LoadRoutesFolder('routes/Admin');
LoadRoutesFolder('routes/Web');
