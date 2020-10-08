<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\UserController;



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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', [PruebaController::class, 'prueba']);
Route::post('/api/prueba', [UserController::class, 'prueba']);
Route::post('/api/user/register', [UserController::class, 'register']);
Route::post('/api/user/login', [UserController::class, 'login']);

