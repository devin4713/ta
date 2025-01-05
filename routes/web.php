<?php

use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SensorDataController::class, 'show']);
Route::get('/latest', [SensorDataController::class, 'update_chart']);

require __DIR__.'/auth.php';
