<?php

use App\Livewire\MarketAnalysis;
use App\Livewire\Overview;
use App\Livewire\ProductPerformance;
use App\Livewire\SalesTrendOverTime;
use App\Livewire\TopSellingProduct;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('market-basket-analysis');
// });

Route::get('/', Overview::class);
Route::get('/market-analysis', MarketAnalysis::class);
Route::get('/top-selling-product', TopSellingProduct::class);
Route::get('/top-selling-product', TopSellingProduct::class);
Route::get('/sales-trend-over-time', SalesTrendOverTime::class);
Route::get('/product-performance', ProductPerformance::class);
