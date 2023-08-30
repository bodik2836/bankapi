<?php

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

Route::apiResource('customers', 'CustomerController')->only(['store']);

Route::apiResource('transactions', 'TransactionController')->only(['store']);
Route::get('transactions/{customer_id}/{amount}/{date}/{offset}/{limit}', 'TransactionController@filterTransaction');

//Route::post('transaction/', 'TransactionController@transaction');
//Route::get('transaction/{customer_id}/{transaction_id}', 'TransactionController@getTransaction');
//Route::put('transaction/{transaction_id}/{amount}', 'TransactionController@updateTransaction');
//Route::delete('transaction/{transaction_id}', 'TransactionController@deleteTransaction');
