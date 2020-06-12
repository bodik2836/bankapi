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

Route::get('customer/{name}/{cnp}', 'CustomerController@customer');
Route::get('transaction/{customer_id}/{amount}', 'TransactionController@transaction');
Route::get('transaction/get/{customer_id}/{transaction_id}', 'TransactionController@getTransaction');
Route::get('transaction/update/{transaction_id}/{amount}', 'TransactionController@updateTransaction');
Route::get('transaction/{transaction_id}', 'TransactionController@deleteTransaction');
Route::get('transaction/filter/{customer_id}/{amount}/{date}/{offset}/{limit}', 'TransactionController@filterTransaction');
