<?php

use App\Http\Controllers\Web\LoansController;
use App\Http\Controllers\Web\LoansViewController;
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

Route::get('/', LoansController::class);
Route::get('/loans/{id}', LoansViewController::class);
