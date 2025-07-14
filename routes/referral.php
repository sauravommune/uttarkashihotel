<?php

use App\Http\Controllers\ReferralController;
use Illuminate\Support\Facades\Route;

Route::prefix('affiliate')->controller(ReferralController::class)->group(function () {
    Route::get('index', 'index')->name('referral.index');
    Route::post('register', 'store')->name('referral.store');
    // Route::get('register/{id}', 'register')->name('referral.register');
    Route::get('reports', 'reports')->name('referral.reports');
    Route::get('payouts', 'payouts')->name('referral.payouts');
    Route::get('payouts-form/{user_id}', 'payoutForm')->name('payout.form');
    Route::get('payouts-transactions/{user_id}', 'payoutTransaction')->name('payout.transactions');
    Route::post('payouts-save', 'savePayout')->name('payout.save');
    Route::get('register/{id?}', 'register')->name('referral.register');
    Route::post('check/domain', 'checkDomain')->name('check.domain');
});