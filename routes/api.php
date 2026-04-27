<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Learning;

Route::post('/test-swishtag', [App\Http\Controllers\TestSwishtag::class, 'store']);