<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttendenceModel;
use App\DepartmentModel;
use App\EmployeModel;
use App\BranchModel;
use Toastr;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch=BranchModel::where('branch_status','Active')->get();
        $department=DepartmentModel::where('department_status','Active')->get();
        return view('attendence/attendence_report',['department'=>$department,'branch'=>$branch]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=DepartmentModel::where('department_status','Active')->get();
        return view('attendence/attendence',['department'=>$department]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendence = AttendenceModel::where('date',$request->date)
                                    ->get()
                                    ->toArray();

        $attendence_array = array();
        if (count($request->id) > 0) {
            $i = 0;
            foreach ($request->id as $key => $value) {
                $has_attendence = collect($attendence)->where('user_id',$value);
                if (count($has_attendence) == 0) {
                    $attendence_array[$key]['date'] = $request->date;
                    $attendence_array[$key]['user_id'] = $value;
                    $i++;
                }
            }
            AttendenceModel::insert($attendence_array);
            if ($i > 0) {
                Toastr::success('Attendence Submited Successfully', '', ["positionClass" => "toast-top-right"]);
            }
            else {
                Toastr::error('All Employee Attendence Maked For This Date!', '', ["positionClass" => "toast-top-right"]);
            }
        }
        else {
            Toastr::error('Something Went Wrong!', '', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function get_department_wise_data(Request $request)
    {
        $data["department_data"]=EmployeModel::where('department_name',$request->department)->get();
        return view('attendence.attendence_sheet',$data);

    }

    public function AttendenceReportSheet(Request $request){
        $employee = EmployeModel::where(function($query) use($request) {
            if ($request->department) {
                $query->where('users.department_name',$request->department);
            }
            
            if ($request->branch) {
                $query->where('users.branch_name',$request->branch);
            }
        })->join('branch','branch.branch_id','users.branch_name')
            ->join('department','department.department_id','users.department_name')
            ->get();

        $employee_id = $employee->pluck('id')->toArray();
        $attendence = AttendenceModel::whereIn('user_id',$employee_id)
                        ->where('date',$request->date)
                        ->get()->toArray();

        return view('attendence/attendence_report_sheet',['employee'=>$employee,'attendence'=>$attendence]);
    }
}
