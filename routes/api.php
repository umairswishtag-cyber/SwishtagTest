<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Exercise1TierPricing;
use App\Http\Controllers\Exercise2TierPricing;

Route::post('/exercise-1-artwork-version', [App\Http\Controllers\Exercise1ArtworkVersion::class, 'store']);
Route::post('/exercise-2-tier-pricing', [App\Http\Controllers\Exercise2TierPricing::class, 'getPrice']);