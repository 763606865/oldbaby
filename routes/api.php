<?php

use App\Http\Controllers\HomeController;
    use App\Http\Controllers\StoreController;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/', [HomeController::class, 'index']);
Route::post('/stores', [StoreController::class, 'index']);
Route::post('/stores/{store_id}', [StoreController::class, 'detail']);
