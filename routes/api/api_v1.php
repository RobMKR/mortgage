<?php

use App\Http\Controllers\Api\V1\LoanApproveController;
use App\Http\Controllers\Api\V1\LoanPrepareController;
use App\Http\Controllers\Api\V1\LoanSingleExtraPaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
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

/** Just for testing */
Route::get('test', function () {
    return response()->json([
        'version' => 'v1'
    ]);
});

Route::group(['prefix' => 'loan'], function (Router $router) {
    $router->post('prepare', LoanPrepareController::class);
    $router->post('approve', LoanApproveController::class);
    $router->post('extra-payment/{id}', LoanSingleExtraPaymentController::class);
});
