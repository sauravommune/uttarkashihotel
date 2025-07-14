<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\ProfileController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\FrontController;
use App\Http\Controllers\FrontControllers\PaymentController;
use App\Http\Controllers\Auth\PasswordResetLinkController;


// Route::get('/hotels', function (Request $request) {
//     return Hotel::get();
// })->middleware('auth:api');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('socialLogin',[AuthController::class,'socialLogin']);


Route::get('allCity',[SearchController::class,'allCity']);
Route::post('searchCity',[SearchController::class,'searchCity']);
Route::post('searchHotel',[SearchController::class,'searchHotel']);
Route::get('popularHotel',[SearchController::class,'popularHotel']);
Route::get('hotelDetails',[SearchController::class,'hotelDetails']);
Route::get('allRoom',[SearchController::class,'allRoom']);
Route::get('addBooking',[SearchController::class,'addDetails']);
Route::post('addBookingMultiple',[SearchController::class,'addBookingMultiple']);
Route::get('amenityList',[SearchController::class,'amenityList']);
Route::post('forgotPassword', [PasswordResetLinkController::class, 'store']);
Route::post('saveMultipleBooking',[SearchController::class,'addMultipleBooking']);

Route::middleware('auth:api')->group(function(){

    Route::post('update/profile', [ProfileController::class, 'updateProfile']);
    Route::post('user', [UserController::class, 'getUser']);
    Route::post('user/deactivate', [UserController::class, 'deactivateUser']);
    Route::get('makePayment',[BookingController::class,'makePayment']);
    Route::post('applyCoupon',[BookingController::class,'applyCoupon']);
    Route::post('createPayment',[PaymentController::class,'orderCreate']);
    
    Route::get('allMyBooking',[SearchController::class,'myBooking']);
    Route::post('resetPassword',[SearchController::class,'resetPassword']);

    Route::post('savedHotel',[FrontController::class,'SavedHotel']);
    Route::get('getSavedHotel',[FrontController::class,'getSavedHotel']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('sendRequest',[SearchController::class,'sendRequestModifyBooking']);
    Route::get('downloadInvoice',[SearchController::class,'downloadInvoice']);
    
});
