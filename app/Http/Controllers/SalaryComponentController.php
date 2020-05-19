<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryComponentModel;
use Toastr;
use Validator;
use Redirect;


class SalaryComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary_component = SalaryComponentModel::all();
        return view('payroll.salary_component',['salary_component'=>$salary_component]);
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
        $input_data=new SalaryComponentModel;
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }

        $input_data->fill($request->all())->save();
        Toastr::success('Salary Component Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $status_data=SalaryComponentModel::findOrFail($id);
        if ($status_data->status==1) 
        {
            $status_data->update(['status'=>0]);
        }
        else
        {
            $status_data->update(['status'=>1]);
        }
        Toastr::success('Salary Component Status Changed', '', ["positionClass" => "toast-top-right"]);
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
        $salary_component=SalaryComponentModel::findOrFail($id);
        return view('payroll.salary_component_edit',['salary_component'=>$salary_component]);
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
        $input_data=SalaryComponentModel::findOrFail($id);
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        
        $input_data->fill($request->all())->save();
        Toastr::success('Salary Component Updated Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/salary_component');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalaryComponentModel::findOrFail($id)->delete();
        Toastr::error('Salary Component Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
