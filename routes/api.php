<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ApicrudController;


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
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('/email/send', [UserController::class, 'emailSend']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::put('profile/update/{id}', [ProfileController::class, 'update']);
    Route::put('profile/change/password/{id}', [ProfileController::class, 'update']);
    Route::delete('profile/account/delete/{id}', [ProfileController::class, 'destroy']);

    Route::get('crud/read', [ApicrudController::class, 'index']);
    Route::post('crud/create', [ApicrudController::class, 'store']);
    Route::post('crud/update', [ApicrudController::class, 'update']);
    Route::delete('crud/delete/{id}', [ApicrudController::class, 'destroy']);

});

// Route::get('crud/read', [ApicrudController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});