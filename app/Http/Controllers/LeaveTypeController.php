<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveTypeModel;
use Validator;
use Toastr;
use Redirect;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_type=LeaveTypeModel::all();
        return view('leave.leave_type',['leave_type'=>$leave_type]);
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
        $leave_type_data=new LeaveTypeModel;
        $validate=Validator::make($request->all(),$leave_type_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $leave_type_data->fill($request->all())->save();
            Toastr::success('Leave Type Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $leave_type_status=LeaveTypeModel::findOrFail($id);
        if ($leave_type_status->leave_type_status=='Active') 
        {
            $leave_type_status->update(['leave_type_status'=>'Inactive']);
        }
        else
        {
            $leave_type_status->update(['leave_type_status'=>'Active']);
        }
        Toastr::success('Leave Type Status Changed Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $leave_type=LeaveTypeModel::findOrFail($id);
        return view('leave.leave_type_edit',['leave_type'=>$leave_type]);
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
        $leave_type_data=LeaveTypeModel::findOrFail($id);
        $validate=Validator::make($request->all(),$leave_type_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $leave_type_data->fill($request->all())->save();
            Toastr::success('Leave Type Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/leave_type');
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
        LeaveTypeModel::findOrFail($id)->delete();
        Toastr::success('Leave Type Added Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
