<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CutController;
use App\Http\Controllers\SlhController;
use App\Http\Controllers\TechnicalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);
Route::get('/plan', [PlanController::class, 'index']);
Route::get('/location', [LocationController::class, 'index']);
Route::get('/cut', [CutController::class, 'index']);
Route::get('/slh', [SlhController::class, 'index']);
Route::get('/technical', [TechnicalController::class, 'index']);
