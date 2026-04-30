<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Exercise1TierPricing;
use App\Http\Controllers\Exercise2TierPricing;
use App\Http\Controllers\Eexercise3CartValidator;
use App\Http\Controllers\Exercise4VendorAllocation;



 Route::post('/exercise-4-vendor-allocation', [Exercise4VendorAllocation::class, 'allocate']);
Route::post('/exercise-3-cart-validator', [Eexercise3CartValidator::class, 'CartIntegrityValidator']);

Route::post('/exercise-1-artwork-version', [App\Http\Controllers\Exercise1ArtworkVersion::class, 'store']);
Route::post('/exercise-2-tier-pricing', [App\Http\Controllers\Exercise2TierPricing::class, 'getPrice']);