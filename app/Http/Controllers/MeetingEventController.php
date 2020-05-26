<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MeetingEventModel;
use App\BranchModel;
use App\DepartmentModel;

class MeetingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['meeting_event'] = MeetingEventModel::all();
        $data['branch'] = BranchModel::all();
        $data['department'] = DepartmentModel::all();
        return view('meeting_event',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_data=new BranchModel;
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Branch Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $status_data=BranchModel::findOrFail($id);
        if ($status_data->branch_status=='Active') 
        {
            $status_data->update(['branch_status'=>'Inactive']);
        }
        else
        {
            $status_data->update(['branch_status'=>'Active']);
        }
        Toastr::success('Branch Status Changed', '', ["positionClass" => "toast-top-right"]);
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
        $branch=BranchModel::findOrFail($id);
        return view('branch.branch_edit',['branch'=>$branch]);
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
        $input_data=BranchModel::findOrFail($id);
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $input_data->fill($request->all())->save();
            Toastr::success('Branch Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/branch');
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
        BranchModel::findOrFail($id)->delete();
        Toastr::error('Branch Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
