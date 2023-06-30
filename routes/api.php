<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ParishController;
use App\Http\Controllers\ReportController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/zones',[ParishController::class,'get_zones']);
Route::get('/areas',[ParishController::class,'get_areas']);
Route::get('/parishes',[ParishController::class,'get_parishes']);
//Reports
Route::post('/reports',[ReportController::class,'submit_report']);
Route::get('/reports',[ReportController::class,'get_reports']);

//Email
Route::post('/email',[FormController::class,'send_email']);