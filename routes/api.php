<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\TripsController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


//////////////////////////////////////////////////////////////////////////
/// Mock Endpoints To Be Replaced With RESTful API.
/// - API implementation needs to return data in the format seen below.
/// - Post data will be in the format seen below.
/// - /resource/assets/traxAPI.js will have to be updated to align with
///   the API implementation
//////////////////////////////////////////////////////////////////////////

//endpoint to get all cars for the logged in user

Route::get('/get-cars', [CarsController::class, 'getCars'])->middleware('auth:api');
Route ::post('/add-car', [CarsController::class, 'addCar'])->middleware('auth:api');
Route::get('/get-car/{id}', [CarsController::class, 'getCar'])->middleware('auth:api');
Route::delete('/delete-car/{id}', [CarsController::class, 'deleteCar'])->middleware('auth:api');
Route::get('/get-trips', [TripsController::class, 'getTrips'])->middleware('auth:api');
Route ::post('/add-trip', [TripsController::class, 'addTrip'])->middleware('auth:api');
