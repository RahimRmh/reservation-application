<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\relationcontroller;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResturantController;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\VerifyController;
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


Route::middleware('auth:api')->group(function(){
Route::resource('places',PlaceController::class)->except('index');
Route::resource('resturants',ResturantController::class);
Route::resource('user',usercontroller::class); 
Route::resource('reservations',ReservationController::class); 
Route::post('logout',[logoutController::class,'logout']);
Route::get('places/{placeId}/resturants',[ResturantController::class,'ResturantsAccordingToPlace']);
});
Route::post('login',[LoginController::class,'login'])->name('login');
Route::post('register',[RegisterController::class,'Register']);
Route::post('verification',[VerifyController::class,'verify']);