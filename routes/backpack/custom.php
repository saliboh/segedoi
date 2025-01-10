<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('financer', 'FinancerCrudController');
    Route::crud('payment', 'PaymentCrudController');
    Route::crud('loan', 'LoanCrudController');

    Route::get('user/financer/search', [UserController::class, 'search'])->name('user.financer.search');
    Route::get('images/payments/{filename}', [UserController::class, 'showImage'])->name('admin.images.payments.show');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
