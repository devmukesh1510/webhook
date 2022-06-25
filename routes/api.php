<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\AuthenticationController;

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





// Route::post('login', [PassportAuthController::class, 'login']);
// Route::get('message', [TransactionController::class, 'index']);

// Route::middleware('auth:api')->group(function () {
  

// });

// Route::middleware('auth:api')->get('/user1', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->any('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/login', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::get('message', [TransactionController::class, 'index']);
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
});