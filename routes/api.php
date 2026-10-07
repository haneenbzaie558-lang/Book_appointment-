<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('specialties', \App\Http\Controllers\SpecialtyController::class);
Route::apiResource('doctors', \App\Http\Controllers\DoctorController::class);
Route::apiResource('patients', \App\Http\Controllers\PatientController::class);
Route::apiResource('appointments', \App\Http\Controllers\AppointmentController::class); 
