<?php

use Illuminate\Http\Request;
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


Route::post('/signup', [App\Http\Controllers\AuthController::class, 'signUp']);

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::post('employees/edit',[App\Http\Controllers\EmployeeController::class, 'update']);
Route::get('states',[App\Http\Controllers\EmployeeController::class, 'getStates']);
Route::post('cities',[App\Http\Controllers\EmployeeController::class, 'getCities']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    

    //CSV file
   /*  Route::get('clients_export',[App\Http\Controllers\ClientController::class, 'export']);
    Route::post('clients_import',[App\Http\Controllers\ClientController::class, 'import']);

    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('bills', App\Http\Controllers\BillController::class);
    Route::resource('bills_products', App\Http\Controllers\BillProductController::class); */

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});