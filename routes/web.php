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
Route::group(['middleware'=>'auth'],function(){



Route::get('/', 'HomeController@index');
Route::get('/test', 'HomeController@helper');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/backend','BackendController@index');
//Branch
Route::resource('/branch','BranchController');
//Department
Route::resource('/department','DepartmentController');
//Designation 
Route::resource('/designation','DesignationController');
//Employee
Route::resource('/add_employe','EmployeController');
Route::get('/employe_report','EmployeController@employe_report');
Route::get('/get_employe_report','EmployeController@get_employe_report');
Route::get('/delete','EmployeController@delete');
Route::post('/get_bio','EmployeController@view_bio');
Route::post('/download_cv','EmployeController@download_cv');
//Employee Transfer
Route::resource('/employe_transfer','EmployeTransferController');
Route::post('/get_employe_transfer_data','EmployeTransferController@get_employe_transfer_data');

//Attendence
Route::resource('/attendence','AttendenceController');
Route::get('/get_department_wise_data','AttendenceController@get_department_wise_data');

Route::get('/attendence_report','AttendenceReportController@index');
Route::get('/attendence_report_data','AttendenceReportController@attendence_report_data');
//Leave
Route::resource('/leave','LeaveController');
//Leave Type
Route::resource('/leave_type','LeaveTypeController');



});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
