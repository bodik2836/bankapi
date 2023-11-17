<?php

use App\Http\Controllers\CustomerController;
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

Route::apiResource('customers', CustomerController::class);

Route::get('transactions/{customerId}/{transactionId}', [TransactionController::class, 'show']);
Route::post('transactions/{customerId}/{amount}', [TransactionController::class, 'store']);
Route::match(['put', 'patch'], 'transactions/{transactionId}/{amount}', [TransactionController::class, 'update']);
Route::delete('transactions/{transactionId}', [TransactionController::class, 'destroy']);
Route::get('transactions/{customerId}/{amount}/{date}/{offset}/{limit}', [TransactionController::class, 'filterTransaction']);
