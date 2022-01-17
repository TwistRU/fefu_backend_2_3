<?php

use App\Http\Controllers\AppealController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\SuggestAppeal;
use Illuminate\Support\Facades\Route;

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
Route::get('/news', [NewsController::class, 'getList'])->name('news_list');
Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_item');
Route::match(['POST', 'GET'], '/appeal', AppealController::class)->name('appeal')->withoutMiddleware([SuggestAppeal::class]);
Route::match(['get', 'post'], '/registration', RegistrationController::class)->name('registration');
Route::match(['get', 'post'], '/login', LoginController::class)->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::get('/logout', LogoutController::class)->name('logout');
});
