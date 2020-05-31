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
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/hr_calendar', function() { return view('hr_calendar'); });

	Route::get('/backend','BackendController@index');
	Route::get('/get_dashboard_data','BackendController@DashboardData');
	Route::resource('/setup','SetupController');
	Route::resource('/branch','BranchController');
	Route::resource('/department','DepartmentController');
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
	Route::get('/attendence_report_data','AttendenceController@AttendenceReportSheet');

	//Leave
	Route::resource('/leave','LeaveController');
	Route::resource('/leave_type','LeaveTypeController');

	//Salary
	Route::resource('/salary_component','SalaryComponentController');
	Route::resource('/salary_structure','SalaryStructureController');
	Route::resource('/salary_slip','SalarySlipController');
	Route::post('/selery_structure_employee','SalaryStructureController@GetEmployee');
	Route::post('/salary_slip_data','SalarySlipController@GetSalarySlipData');
	Route::post('/salary_bulk_payment','SalarySlipController@SalaryBulkPayment');

	//Team
	Route::resource('/team','TeamController');
	Route::post('/team_leader','TeamController@GetTeamLeader');
	Route::post('/team_member','TeamController@GetTeamMember');

	//Project & Task
	Route::resource('/project','ProjectController');
	Route::resource('/task','TaskController');

	//Meeting & Event
	Route::resource('/meeting','MeetingController');

});
Auth::routes();
