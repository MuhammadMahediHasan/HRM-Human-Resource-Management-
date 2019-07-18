<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\EmployeModel;
use App\AttendenceParentModel;
use App\AttendenceChildModel;
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
        $department=DepartmentModel::where('department_status','Active')->get();
        return view('attendence/attendence',['department'=>$department]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendence_parent=new AttendenceParentModel;
        $attendence_parent->attendence_parent_date=$request->date;
        $attendence_parent->attendence_parent_department=$request->department;
        $attendence_parent->save();

        $attendence_parent_id=$attendence_parent->attendence_parent_id;

        if (!$request->employe_basic_info_id=[]) 
        {
            foreach ($request->employe_basic_info_id as $key => $attendence_value) 
            {
                $attendence_child=new AttendenceChildModel;
                $attendence_child->attendence_parent_id=$attendence_parent_id;
                $attendence_child->employe_basic_info_id=$attendence_value;
                $attendence_child->attendence_child_status="Present";
                $attendence_child->save();
            }

            $absent=EmployeModel::where('department_name',$request->department)->whereNotIn('employe_basic_info_id',$request->employe_basic_info_id)->get();
            foreach ($absent as $key => $absent_value) 
            {
                $attendence_child=new AttendenceChildModel;
                $attendence_child->attendence_parent_id=$attendence_parent_id;
                $attendence_child->employe_basic_info_id=$absent_value->employe_basic_info_id;
                $attendence_child->attendence_child_status="Absent";
                $attendence_child->save();
            }
            Toastr::success('Attendence Submited Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
        }

        

        
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
}
