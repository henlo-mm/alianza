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
Route::delete('employees/delete/{id}',[App\Http\Controllers\EmployeeController::class, 'destroy']);

Route::get('states',[App\Http\Controllers\EmployeeController::class, 'getStates']);
Route::post('cities',[App\Http\Controllers\EmployeeController::class, 'getCities']);

Route::resource('positions_employee', App\Http\Controllers\PositionController::class);
Route::post('positions_employee/edit',[App\Http\Controllers\PositionController::class, 'update']);
Route::delete('positions_employee/delete/{id}',[App\Http\Controllers\PositionController::class, 'destroy']);

Route::get('positions',[App\Http\Controllers\PositionController::class, 'getPositions']);
Route::get('roles',[App\Http\Controllers\PositionController::class, 'getRoles']);
Route::get('employees_position',[App\Http\Controllers\PositionController::class, 'getEmployees']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    

    //CSV file
   /*  Route::get('clients_export',[App\Http\Controllers\ClientController::class, 'export']);
    Route::post('clients_import',[App\Http\Controllers\ClientController::class, 'import']);
; */

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});