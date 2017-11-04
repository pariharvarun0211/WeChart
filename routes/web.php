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
Route::get('/User/EditProfile/{id}', 'UserController@getEditProfile')->name('EditProfile');
Route::post('EditProfile', 'UserController@postEditProfile');

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

//Admin can delete a email from remove email page.
Route::any('deleteuser/{id}', 'AdminController@delete_email')->name('deleteuser');
Route::any('archive/{id}', 'AdminController@archive_user')->name('archiveuser');

//Admin module management
Route::get('/ConfigureModules','AdminController@getConfigureModules');
Route::post('submitmodule', 'AdminController@submitmodule')->name('submitmodule');
Route::post('deletemodule/{modid}', 'AdminController@deletemodule')->name('deletemodule');

//Student routes
//Landing page for Student
Route::get('/StudentHome', 'StudentController@index')->name('student.home');
Route::get('/PatientView/{patient_id}', 'StudentController@view_patient')->name('patient.view');
Route::get('/PatientDelete/{id}', 'StudentController@destroy')->name('patient.destroy');

//Patient routes
//Add new patient
Route::get('/add_patient', 'StudentController@get_add_patient');
Route::post('add_patient', 'StudentController@post_add_patient');

//Active record routes
Route::get('/Demographics/{id}', 'NavigationController@get_demographics_panel')->name('Demographics');
Route::post('Demographics', 'DocumentationController@post_Demographics');

Route::get('/HPI/{id}', 'NavigationController@get_HPI')->name('History of Present Illness (HPI)');
Route::post('HPI', 'DocumentationController@post_HPI')->name('post_HPI');

Route::get('/Medical_History/{id}', 'NavigationController@get_medical_history')->name('Medical History');
Route::post('social_history}', 'DocumentationController@post_social_history')->name('social_history');
Route::post('family_history}', 'DocumentationController@post_family_history')->name('family_history');
Route::post('personal_history}', 'DocumentationController@post_personal_history')->name('personal_history');
Route::post('surgical_history}', 'DocumentationController@post_surgical_history')->name('surgical_history');

Route::get('/Medications/{id}', 'NavigationController@get_medications')->name('Medications');
Route::post('post_medications}', 'DocumentationController@post_medications')->name('post_medications');

Route::get('/Vital_Signs/{id}', 'NavigationController@get_vital_signs')->name('Vital Signs');
Route::post('post_vital_signs', 'DocumentationController@post_vital_signs');
Route::post('delete_vital_signs/{ts}', 'DocumentationController@delete_vital_signs')->name('delete_vital_signs');

Route::get('/Review_of_System (ROS)/{id}', 'NavigationController@get_ROS')->name('Review of System (ROS)');
Route::get('/Physical_Exam/{id}', 'NavigationController@get_physical_exams')->name('Physical Exam');

Route::get('/Orders/{id}', 'NavigationController@get_orders')->name('Orders');
Route::post('post_orders}', 'DocumentationController@post_orders')->name('post_orders');
Route::any('orders_delete/{id}', 'DocumentationController@delete_image_order')->name('delete_image_order');
Route::any('orders_lab_delete/{id}', 'DocumentationController@delete_lab_order')->name('delete_lab_order');

Route::get('/Results/{id}', 'NavigationController@get_results')->name('Results');
Route::post('post_results}', 'DocumentationController@post_results')->name('post_results');

Route::get('/MDM/{id}', 'NavigationController@get_MDM')->name('MDM/Plan');
Route::get('/Disposition/{id}', 'NavigationController@get_disposition')->name('Disposition');

//Landing page for Instructor
Route::get('/InstructorHome', 'InstructorController@index');
Route::get('/family_history', 'DocumentationController@post_new_family_member')->name('post_new_family_member');

//Routes for autocomplete
Route::get('/diagnosis/find', 'DocumentationController@find_diagnosis')->name('diagnosis_find');
Route::get('/medications/find', 'DocumentationController@find_medications')->name('medications_find');
Route::get('/orders_labs/find', 'DocumentationController@find_lab_orders')->name('orders_labs_find');
Route::get('/orders_imaging/find', 'DocumentationController@find_imaging_orders')->name('orders_imaging_find');



