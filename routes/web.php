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
Route::get('/EditProfile', 'EditProfileController@getEditProfile');
Route::post('/EditProfile', 'EditProfileController@postEditProfile');

//Add Student emails
Route::get('/AddStudentEmails', 'HomeController@getStudentEmails');
Route::post('AddStudentEmails', 'HomeController@postStudentEmails');
Route::get('AddMoreStudentEmails', 'HomeController@addStudentEmails');
Route::get('RemoveStudentEmails', 'HomeController@removeStudentEmails');

//Add Instructor emails
Route::get('/AddInstructorEmails', 'HomeController@getInstructorEmails');
Route::post('AddInstructorEmails', 'HomeController@postInstructorEmails');
Route::get('AddMoreInstructorEmails', 'HomeController@addInstructorEmails');
Route::get('RemoveInstructorEmails', 'HomeController@removeInstructorEmails');

//Landing page for Admin
Route::get('/home', 'HomeController@index')->name('home');

//Landing page for Student
Route::get('/StudentHome', 'StudentController@index');

//Landing page for Instructor
Route::get('/InstructorHome', 'InstructorController@index');


