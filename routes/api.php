<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Exercise1TierPricing;
use App\Http\Controllers\Exercise2TierPricing;
use App\Http\Controllers\Eexercise3CartValidator;
use App\Http\Controllers\Exercise4VendorAllocation;
use App\Http\Controllers\Exercise5Discount;
use App\Http\Controllers\ApprovalFlowValidator;
use App\Http\Controllers\Exercise7Inventory;
use App\Http\Controllers\Exercise8Shipment;
use App\Http\Controllers\Exercise9Webhook; 
use App\Http\Controllers\Exercise10QuoteEexpiry;

Route::post('/exercise-1-artwork-version', [App\Http\Controllers\Exercise1ArtworkVersion::class, 'store']);
Route::post('/exercise-2-tier-pricing', [App\Http\Controllers\Exercise2TierPricing::class, 'getPrice']);
Route::post('/exercise-3-cart-validator', [Eexercise3CartValidator::class, 'CartIntegrityValidator']);
Route::post('/exercise-4-vendor-allocation', [Exercise4VendorAllocation::class, 'allocate']);
Route::post('/exercise-5-discount', [Exercise5Discount::class, 'resolveDiscount']);
Route::post('/exercise-6-approval-flow', [ApprovalFlowValidator::class, 'validateFlow']); 
Route::post('/exercise-7-inventory', [Exercise7Inventory::class, 'reserve']);
Route::post('/exercise-8-shipment', [Exercise8Shipment::class, 'trackShipment']);
Route::post('/exercise-9-webhook', [Exercise9Webhook::class, 'handleWebhook']); 
Route::post('/exercise-10-quote-expiry', [Exercise10QuoteEexpiry::class, 'checkQuoteExpiry']);   

 