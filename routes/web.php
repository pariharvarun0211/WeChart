<?php

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
    return view('auth/login');
});

Auth::routes();
Route::post('/SecurityQuestions', 'Auth\ForgotPasswordController@getSecurityQuestions');
Route::post('/ResetPassword', 'Auth\ResetPasswordController@resetUserPassword');
Route::post('/ChangePassword', 'Auth\ResetPasswordController@changePassword');
Route::get('/EditProfile', 'Auth\ResetPasswordController@changePassword');

Route::get('/home', 'HomeController@index')->name('home');
