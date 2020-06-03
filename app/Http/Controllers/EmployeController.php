<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\BranchModel;
use App\DepartmentModel;
use App\DesignationModel;
use App\EmployeModel;
use App\EmployeContactInfoModel;
use App\EmployeBankInfoModel;
use App\EmployeJoiningDetailsModel;
use App\EmployePersonalBioModel;
use Validator;
use Toastr;
use Redirect;
use Hash;
use File;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employee=EmployeModel::leftJoin('branch','branch.branch_id','=','users.branch_name')
                                ->leftJoin('designation','designation.designation_id','=','users.id')
                                ->leftJoin('department','department.department_id','=','users.id')
                                ->get();

        return view('employe.employe_report',['employee'=>$employee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch=BranchModel::all();
        $department=DepartmentModel::all();

        $employee = EmployeModel::latest()->first()->toArray();
        $year = date('y');
        $month = date('m');
        if (strlen($employee['id']) == 1) {
            $date = date('d').'0';
        }else {
            $date = date('d');
        }

        if (!empty($employee)) {
            $id = (int) $employee['id'] + 1;
            $employee_code = $year . $month . $date . $id;
        } else {
            $id = 1;
            $employee_code = $year . $month . $date . $id;
        }

        return view('employe.add_employe',['branch'=>$branch,'department'=>$department,'employee_code'=>$employee_code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $employe_basic_data=new EmployeModel;
        $requested_data=$request->all();
        $validate=Validator::make($request->all(),$employe_basic_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        
        $employe_basic_data->fill($requested_data);
        $employe_basic_data->password = Hash::make($request->password);
        $employe_basic_data->save();

        Toastr::success('Employee Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $branch=BranchModel::all();
        $department=DepartmentModel::all();

        $employee=EmployeModel::join('branch','branch.branch_id','=','users.branch_name')
                                ->join('designation','designation.designation_id','=','users.id')
                                ->join('department','department.department_id','=','users.id')
                                ->first();

        return view('employe.employe_edit',['employee'=>$employee, 'branch'=>$branch, 'department'=>$department]);            
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
        $employe_basic_data = EmployeModel::findOrFail($id);
        $requested_data=$request->all();
        $validate=Validator::make($request->all(),$employe_basic_data->validation($id));
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        
        $employe_basic_data->fill($requested_data);
        $employe_basic_data->save();

        Toastr::success('Employee Edited Successfully', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeModel::findOrFail($id)->delete();

        Toastr::success('Employee Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

}
