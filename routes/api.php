<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\relationcontroller;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResturantController;
use App\Http\Controllers\usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('places',PlaceController::class);
Route::resource('resturants',ResturantController::class);
Route::resource('user',usercontroller::class); 
Route::resource('reservations',ReservationController::class); 
Route::get('places/{id}/resturants',[relationcontroller::class,'PlaceResturants']);
Route::get('resturants/{id}/place',[relationcontroller::class,'ResturantsPlace']);
Route::post('login',[LoginController::class,'login'])->name('login');
Route::post('logout',[logoutController::class,'logout']);
Route::post('register',[RegisterController::class,'Register']);
Route::get('index1',[ResturantController::class,'index1']);