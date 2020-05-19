<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\AttendenceParentModel;
use App\AttendenceChildModel;
use App\EmployeModel;

class AttendenceReportController extends Controller
{
    public function index()
    {
    	$department=DepartmentModel::where('department_status','Active')->get();
    	return view('attendence.attendence_report',['department'=>$department]);
    }



    public function attendence_report_data(Request $request)
    {
    	if($request->date=='' || $request->department=='')
    	{
    		echo "<span>No Data Found<span>";
    	}
    	else
    	{
    		$attendence_report=AttendenceParentModel::join('attendence_child','attendence_parent.attendence_parent_id','=','attendence_child.attendence_parent_id')
    							->join('employe_basic_info','attendence_child.id','=','employe_basic_info.id')
    							->where('attendence_parent.attendence_parent_department','=',$request->department)
    							->where('attendence_parent.attendence_parent_date','=',$request->date)
    							->get();

    							// echo "<pre>";
    							// print_r($attendence_report);
    	    return view('attendence.attendence_report_sheet',['attendence_report'=>$attendence_report]);
    	}
    	
    }
}
