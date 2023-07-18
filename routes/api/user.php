<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\DeviceController;
use App\Http\Controllers\api\NotificationController;
use App\Http\Controllers\api\OfferApplicationController;
use App\Http\Controllers\api\OfferController;
use App\Http\Controllers\api\PaymentMethodController;
use App\Http\Controllers\api\PlanController;
use App\Http\Controllers\api\SubCategoryController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    //Device routes
    Route::post('save_device_token', [DeviceController::class, 'saveDeviceToken']);
    Route::post('delete_device_token', [DeviceController::class, 'deleteDeviceToken']);
    //profile route
    Route::get('my_profile', [UserController::class, 'profile']);
    Route::post('update_profile', [UserController::class, 'updateProfile']);
    Route::post('update_password', [UserController::class, 'updatePassword']);
    //Rate application route
    Route::post('rate_application',[UserController::class,'rateApplication']);
    //Notifications routes
    Route::get('my_notifications', [NotificationController::class, 'getMyNotifications']);
    Route::post('read_notification', [NotificationController::class, 'readNotifications']);
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
    //Offer routes
    Route::apiResource('offers', OfferController::class)->except('update');
    Route::post('offers/{offer}', [OfferController::class, 'update']);
    Route::get('get_offers_by_status', [OfferController::class, 'getOffersByStatus']);
    Route::get('get_my_offers', [OfferController::class, 'getMyOffers']);
    //Change offer status route
    Route::post('offer/change_status/{offer}',[OfferController::class,'changeStatus']);
    //Rate order route
    Route::post('rate_order/{order}',[OrderController::class,'rateOrder']);
    //Offer application routes
    Route::get('offer_applications', [OfferApplicationController::class, 'index']);
    Route::get('get_offer_applications', [OfferApplicationController::class, 'getOfferApplications']);
    Route::get('offer_applications/{id}', [OfferApplicationController::class, 'show']);
    Route::post('accept_application/{offerApplication}', [OfferApplicationController::class, 'acceptApplication']);
    //Get payment methods
    Route::get('payment_methods', [PaymentMethodController::class, 'index']);
    //Get categories
    Route::get('categories', [CategoryController::class, 'index']);
    //Get sub categories
    Route::get('sub_categories', [SubCategoryController::class, 'index']);
    //Get plans
    Route::get('plans', [PlanController::class, 'index']);
});
