<?php

use App\Http\Controllers\UserTransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group([
    'prefix' => 'transactions/'
], function () {
    Route::get('/{user}/', [UserTransactionsController::class, 'index']);
    Route::get('/{user}/balance', [UserTransactionsController::class, 'getBalance']);
    Route::post('/{user}/add', [UserTransactionsController::class, 'storeAdd']);
    Route::post('/{user}/subtract', [UserTransactionsController::class, 'storeSubtract']);
    Route::post('/{sender_user}/transfer/{receiver_user}', [UserTransactionsController::class, 'storeTransfer']);
});
