<?php
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

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/docs', function () {
	return view('swagger.index');
});

Route::get('/', function () {
	return redirect('sign-in');
})->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth', 'admin')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');

Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('/crud', CrudController::class);
	Route::resource('/user', UserController::class);
});

// Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');


// Routes accessible only to users with the "admin" role
Route::group(['middleware' => ['role:admin']], function () {

})->middleware(RoleMiddleware::class);