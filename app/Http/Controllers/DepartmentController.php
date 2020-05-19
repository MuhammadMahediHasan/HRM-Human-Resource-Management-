<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use Toastr;
use Redirect;
use Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department=DepartmentModel::all();
        return view('department.department',['department'=>$department]);
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
        $input_data=new DepartmentModel;
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Department Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $status_data=DepartmentModel::findOrFail($id);
        if ($status_data->department_status=='Active') 
        {
            $status_data->update(['department_status'=>'Inactive']);
        }
        else
        {
            $status_data->update(['department_status'=>'Active']);
        }
        Toastr::success('Department Status Changed', '', ["positionClass" => "toast-top-right"]);
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
        $department=DepartmentModel::findOrFail($id);
        return view('department.department_edit',['department'=>$department]);
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
        $input_data=DepartmentModel::findOrFail($id);
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Department Added Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/department');
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
        DepartmentModel::findOrFail($id)->delete();
        Toastr::success('Department Added Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
