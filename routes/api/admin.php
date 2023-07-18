<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OfferStatusController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin', 'middleware' => ['auth:api', 'checkRole'],
    'roles' => ['admin'], ], function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('sub_categories', SubCategoryController::class);
        Route::apiResource('payment_methods', PaymentMethodController::class);
        Route::apiResource('offer_statuses', OfferStatusController::class);
        Route::apiResource('plans', PlanController::class);
    });
