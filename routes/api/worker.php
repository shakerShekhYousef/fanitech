<?php

use App\Http\Controllers\api\OfferApplicationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'worker',
    'middleware' => ['auth:api', 'checkRole'],
    'roles' => ['worker'],
], function () {
    //Offer applications routes
    Route::post('offer_applications', [OfferApplicationController::class, 'store']);
    Route::delete('offer_applications/{id}', [OfferApplicationController::class, 'destroy']);
    Route::get('get_my_applications', [OfferApplicationController::class, 'getMyApplications']);
    Route::put('update_application_price/{offerApplication}', [OfferApplicationController::class, 'update']);
});
