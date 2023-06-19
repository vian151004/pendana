<?php

use App\Http\Controllers\{
    CampaignController,
    CategoryController,
    DashboardController,
    FrontController,
    SettingController,
    UserProfileInformationController
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
Route::get('/contact', [FrontController::class, 'contact']);
Route::post('/contact', [FrontController::class, 'storeContact']);
Route::get('/about', [FrontController::class, 'about']);
Route::get('/donation', [FrontController::class, 'donation']);
Route::get('/donation/{id}', [FrontController::class, 'donationDetail']); //pakai camel case atau tanpa _
Route::get('/donation/{id}/create', [FrontController::class, 'donationCreate']);
Route::get('/donation/{id}/payment', [FrontController::class, 'donationPayment']);
Route::get('/donation/{id}/payment-confirmation', [FrontController::class, 'donationPaymentConfirmation']);
Route::post('/subscriber', [FrontController::class, 'subscriberStore']);

Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
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

        Route::get('/campaign/data', [CampaignController::class, 'data'])
            ->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])
            ->name('campaign.detail');
        Route::resource('/campaign', CampaignController::class)->except('create', 'edit');

        Route::get('/setting', [SettingController::class, 'index'])
            ->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])
            ->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bankDestroy'])
            ->name('setting.bank.destroy');
    });

    Route::group([
        'middleware' => 'role:donatur'
    ], function () {
        // 
    });
});

Route::get('/campaign', function () {
    return view('front.campaign.index');
});
