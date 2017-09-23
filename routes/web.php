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

//Authentication routes
Auth::routes();
Route::post('/SecurityQuestions', 'Auth\ForgotPasswordController@getSecurityQuestions');
Route::post('/ResetPassword', 'Auth\ResetPasswordController@resetUserPassword');
Route::post('/ChangePassword', 'Auth\ResetPasswordController@changePassword');

//Admin Routes

//Landing page for Admin
Route::get('/home', 'AdminController@index')->name('home');

//Add Student emails
Route::get('/AddStudentEmails', 'AdminController@getStudentEmails');
Route::post('AddStudentEmails', 'AdminController@postStudentEmails');
Route::get('AddMoreStudentEmails', 'AdminController@addStudentEmails');
Route::get('RemoveStudentEmails', 'AdminController@removeStudentEmails');

//Add Instructor emails
Route::get('/AddInstructorEmails', 'AdminController@getInstructorEmails');
Route::post('AddInstructorEmails', 'AdminController@postInstructorEmails');
Route::get('AddMoreInstructorEmails', 'AdminController@addInstructorEmails');
Route::get('RemoveInstructorEmails', 'AdminController@removeInstructorEmails');

//Admin can manage emails
Route::get('/ManageEmails', 'AdminController@getManageEmails');

//Student routes

//Landing page for Student
Route::get('/StudentHome', 'StudentController@index');

//Landing page for Instructor
Route::get('/InstructorHome', 'InstructorController@index');




