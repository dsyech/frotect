<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\PlanController;
use App\Http\Controllers\api\LocationController;
use App\Http\Controllers\api\CutController;
use App\Http\Controllers\api\SlhController;

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

Route::get('/report', [ReportController::class, 'index']);

Route::get('/plan', [PlanController::class, 'index']);
Route::get('/plan/delete', [PlanController::class, 'delete']);
Route::post('/plan/file', [PlanController::class, 'file']);

Route::get('/location', [LocationController::class, 'index']);

Route::get('/cut', [CutController::class, 'index']);
Route::post('/cut/report', [CutController::class, 'report']);
Route::post('/cut/location', [CutController::class, 'location']);

Route::get('/slh', [SlhController::class, 'index']);
Route::post('/slh/file', [SlhController::class, 'file']);
