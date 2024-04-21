<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

// Login And Register Logout end points
//Route::post('/login', 'App\Http\Controllers\Auth\AuthController@login');
//Route::post('/register', 'App\Http\Controllers\Auth\AuthController@register');
//Route::post('/logout', 'App\Http\Controllers\Auth\AuthController@logout');

// get Available Seats end point
Route::get('/available-seats', [\App\Http\Controllers\Booking\GetAvailableSeatsController::class, '__invoke']);

// book seat end point
Route::post('/book-seat', [\App\Http\Controllers\Booking\BookSeatController::class, '__invoke']);

