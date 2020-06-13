<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('customer/', 'CustomerController@customer');
Route::post('transaction/', 'TransactionController@transaction');
Route::get('transaction/{customer_id}/{transaction_id}', 'TransactionController@getTransaction');
Route::put('transaction/{transaction_id}/{amount}', 'TransactionController@updateTransaction');
Route::delete('transaction/{transaction_id}', 'TransactionController@deleteTransaction');
Route::get('transaction/{customer_id}/{amount}/{date}/{offset}/{limit}', 'TransactionController@filterTransaction');
