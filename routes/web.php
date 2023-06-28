<?php

use App\Http\Controllers\{
    CampaignController,
    CategoryController,
    DashboardController,
    SettingController,
    UserProfileInformationController
};
use App\Http\Controllers\Front\{
    AboutController,
    ContactController as FrontContactController,
    CampaignController as FrontCampaignController,
    DonationController as FrontDonationController,
    FrontController,
    PaymentController,
    SubscriberController as FrontSubscriberController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index']);
Route::get('/contact', [FrontContactController::class, 'index']);
Route::post('/contact', [FrontContactController::class, 'store']);
Route::get('/about', [AboutController::class, 'index']);
Route::post('/subscriber', [FrontSubscriberController::class, 'store']);
Route::resource('/campaign', FrontCampaignController::class)->only('index', 'create', 'edit');

Route::get('/donation', [FrontDonationController::class, 'index']);
Route::group([
    'middleware' => ['auth', 'role:admin,donatur'],
    'prefix' => '/donation/{id}' 
], function () {
    Route::get('/', [FrontDonationController::class, 'show']); //pakai camel case atau tanpa _
    Route::get('/create', [FrontDonationController::class, 'create']);
    Route::post('/', [FrontDonationController::class, 'store']);
    Route::get('/payment/{order_number}', [PaymentController::class, 'index']);
    Route::get('/payment-confirmation/{order_number}', [PaymentController::class, 'paymentConfirmation']);
    Route::post('/payment-confirmation/{order_number}', [PaymentController::class, 'store']);
});

Route::group([
    'middleware' => ['auth', 'role:admin,donatur'],
    'prefix' => 'admin'
], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])
        ->name('profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bankDestroy'])
        ->name('profile.bank.destroy');

    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        Route::resource('/category', CategoryController::class);

        Route::get('/setting', [SettingController::class, 'index'])
            ->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])
            ->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bankDestroy'])
            ->name('setting.bank.destroy');
    });

    Route::get('/campaign/data', [CampaignController::class, 'data'])
        ->name('campaign.data');
    Route::resource('/campaign', CampaignController::class);
    Route::put('/campaign/{id}/update_status', [CampaignController::class, 'updateStatus'])
        ->name('campaign.update_status');
});


