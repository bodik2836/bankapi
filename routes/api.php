<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('customers', TransactionController::class);

Route::apiResource('transactions', TransactionController::class)->only(['store', 'update', 'destroy']);
Route::get('transactions/{customerId}/{transactionId}', [TransactionController::class, 'show']);
Route::get('transactions/{customerId}/{amount}/{date}/{offset}/{limit}', [TransactionController::class, 'filterTransaction']);
