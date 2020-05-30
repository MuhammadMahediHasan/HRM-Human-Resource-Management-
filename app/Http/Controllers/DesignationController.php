<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\DesignationModel;
use Validator;
use Toastr;
use Redirect;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department=DepartmentModel::where('department_status','Active')->get();
        $designation=DesignationModel::join('department','designation.department_name','=','department.department_id')->get();
        
        return view('designation.designation',['department'=>$department,'designation'=>$designation]);
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
        $input_data=new DesignationModel;
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Designation Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $status_data=DesignationModel::findOrFail($id);
        if ($status_data->designation_status=='Active') 
        {
            $status_data->update(['designation_status'=>'Inactive']);
        }
        else
        {
            $status_data->update(['designation_status'=>'Active']);
        }
        Toastr::success('Designation Status Changed ', '', ["positionClass" => "toast-top-right"]);
            return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation=DesignationModel::join('department','designation.department_name','=','department.department_id')->findOrFail($id);
        $department=DepartmentModel::all();

        return view('designation.designation_edit',['designation'=>$designation,'department'=>$department]);
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
        $input_data=DesignationModel::findOrFail($id);
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Designation Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/designation');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DesignationModel::findOrFail($id)->delete();
        Toastr::success('Designation Data Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
