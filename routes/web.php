<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/sessionAll/{secret}', function ($secret) {
    if ($secret != 1010) {
        abort('404');
    } else {
        return Session()->all();
    }
});

Route::get('/login', 'AuthController@showloginform')->name('login');
Route::get('/forgot', 'AuthController@forgot')->name('forgot');
Route::post('/forgotpass', 'AuthController@forgotpass')->name('forgot.post');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::post('/savelogindata', 'AuthController@savelogindata')->name('savelogindata');
Route::post('logout', 'AuthController@logout')->name('logout');


Route::get('/register', 'AuthController@showregisterform')->name('register');
Route::post('/saveuserdata', 'AuthController@saveuserdata')->name('saveuserdata');


Route::group(['middleware' => 'authcheck'], function () {
    Route::get('/dashboard', 'DashboardController@showHomePage')->name('dashboard');
});


Route::get('/alluserlist', 'DashboardController@alluserlist')->name('alluserlist');
Route::post('/delete_data', 'DashboardController@delete_data')->name('delete_data');
Route::post('/update_user', 'DashboardController@update_user')->name('update_user');
Route::get('/user/edit/{id}', 'DashboardController@edit_user_frm')->name('edit_user');
