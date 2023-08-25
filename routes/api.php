<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\WasmanController;

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

Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/wasman', [WasmanController::class, 'index']);
// Route::get('/api-key', function () {
//     return response()->json(['api_key' => env('API_KEY')]);
// });
