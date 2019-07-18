<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveModel;
use App\LeaveTypeModel;
use Validator;
use Toastr;
use Redirect;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave=LeaveModel::all();
        $leave_type=LeaveTypeModel::where('leave_type_status','Active')->get();
        return view('leave.leave',['leave'=>$leave,'leave_type'=>$leave_type]);
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
        $leave_data=new LeaveModel;
        $validate=Validator::make($request->all(),$leave_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $leave_data->fill($request->all())->save();
            Toastr::success('Leave Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $leave_status=LeaveModel::findOrFail($id);
        if ($leave_status->leave_status=='Active') 
        {
            $leave_status->update(['leave_status'=>'Inactive']);
        }
        else
        {
            $leave_status->update(['leave_status'=>'Active']);
        }
        Toastr::success('Leave Status Changed Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $leave=LeaveModel::findOrFail($id);
        $leave_type=LeaveTypeModel::where('leave_type_status','Active')->get();
        return view('leave.leave_edit',['leave'=>$leave,'leave_type'=>$leave_type]);
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
        $leave_data=LeaveModel::findOrFail($id);
        $validate=Validator::make($request->all(),$leave_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $leave_data->fill($request->all())->save();
            Toastr::success('Leave Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/leave');
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
        LeaveModel::findOrFail($id)->delete();
        Toastr::success('Leave Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
