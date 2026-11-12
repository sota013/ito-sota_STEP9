<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PurchaseController;

Route::middleware('auth:sanctum')->post(
    '/products/{id}/purchase',
    [PurchaseController::class, 'store']
)->whereNumber('id');
