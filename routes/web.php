<?php

use App\Http\Livewire\Features\Home\Pages\Categories;
use App\Http\Livewire\Features\Home\Pages\Home;
use App\Http\Livewire\Features\Products\Pages\Products;
use App\Http\Livewire\Features\Products\Pages\ProductsDetails;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize' ])
    ->group(function () {
        Route::get(LaravelLocalization::transRoute('routes.home'), Home::class);
        Route::get(LaravelLocalization::transRoute('routes.categories'), Categories::class);
        Route::prefix(LaravelLocalization::transRoute('routes.products'))
            ->middleware('localize')
            ->group(function () {
                Route::get('/', Products::class);
                Route::get(LaravelLocalization::transRoute('routes.products-details'), ProductsDetails::class)
                    ->name('products.details');
            });
    });

