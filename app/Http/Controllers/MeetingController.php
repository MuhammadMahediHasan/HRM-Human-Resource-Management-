<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\EmployeModel;
use App\MeetingModel;
use App\BranchModel;
use Validator;
use Redirect;
use Toastr;
use Mail;
use DB;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['meeting'] = MeetingModel::leftJoin('branch','branch.branch_id','meeting.branch_id')
                                        ->leftJoin('department','department.department_id','=','meeting.department_id')
                                        ->leftJoin('designation','designation.designation_id','=','meeting.designation_id')
                                        ->select('branch.branch_name','department.department_name','designation.designation_name','meeting.*')
                                        ->get();

        $data['branch'] = BranchModel::all();
        $data['department'] = DepartmentModel::all();
        return view('meeting.meeting',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = MeetingModel::whereMonth('time',date('m'))
                            ->select(DB::raw('DAY(time) as day'))
                            ->get()
                            ->pluck('day')
                            ->toArray();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_data=new MeetingModel;
        $validate=Validator::make($request->all(), $input_data->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $input_data->fill($request->all())->save();

            if ($request->mail_sent == 1) {
                $emails = EmployeModel::where(function($query) use($request) {
                    if ($request->branch_id) {
                        $query->where('branch_name',$request->branch_id);
                    }
                    if ($request->designation_id) {
                        $query->where('designation_name',$request->designation_id);
                    }
                    if ($request->department_id) {
                        $query->where('department_name',$request->department_id);
                    }
                })->get()->pluck('email')->toArray();

                Mail::send('meeting.mail', array('data'=>$request->all()), function($message) use ($emails) {
                    $message->to($emails)->subject('Attend Your Office Meeting!!');    
                });
            }

            Toastr::success('Meeting Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $data = MeetingModel::whereDay('time', $id)->whereMonth('time', date('m'))->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['branch'] = BranchModel::all();
        $data['department'] = DepartmentModel::all();
        $data['meeting']=MeetingModel::findOrFail($id);

        return view('meeting.meeting_edit',$data);
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
        $input_data=MeetingModel::findOrFail($id);
        $validate=Validator::make($request->all(),$input_data->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $input_data->fill($request->all())->save();
            Toastr::success('Meeting Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return Redirect::to('/meeting');
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
        MeetingModel::findOrFail($id)->delete();
        Toastr::error('Meeting Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }
}
