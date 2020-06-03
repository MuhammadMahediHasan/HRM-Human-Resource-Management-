<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMemberModel;
use App\TaskAssignModel;
use App\EmployeModel;
use App\ProjectModel;
use App\TaskModel;
use App\TeamModel;
use Validator;
use Redirect;
use DateTime;
use Toastr;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['team'] = TeamModel::all();
        $data['project'] = ProjectModel::all();
        $data['employee'] = EmployeModel::get()->toArray();
        $data['task'] = TaskModel::join('project','project.project_id','=','task.project_id')->with('team_member')->select('project.project_name','task.*')->get()->toArray();

        return view('project.task',$data);
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
        $task = new TaskModel;
        $requested_data = $request->all();
        $validate = Validator::make($request->all(), $task->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        
        $task->fill($requested_data)->save();

        if ($request->team_member) {
            $team_member = array();
            foreach ($request->team_member as $key => $value) {
                $team_member[$key]['task_id'] = $task->task_id;
                $team_member[$key]['task_assign_member_id'] = $value;
            }
            TaskAssignModel::insert($team_member);
        }

        Toastr::success('Task Created Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $project = ProjectModel::findOrFail($id);
        $data['team'] = TeamModel::where('team_id',$project->project_lead_team_id)->first();
        $data['team_member'] = TeamMemberModel::where('team_id', $data['team']['team_id'])
                                                ->join('users','users.id','=','team_member.team_member_id')->get();

         $data['team_member_id'] = TaskAssignModel::where('task_id',$id)->get()->pluck('task_assign_member_id')->toArray();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function taskStatus($id)
    {
        $status_data=TaskModel::findOrFail($id);
        if ($status_data->status == 1) 
        {
            $status_data->update(['status' => 0]);
        }
        else
        {
            $status_data->update(['status'=> 1]);
        }
        Toastr::success('Task Status Changed', '', ["positionClass" => "toast-top-right"]);
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
        $data['team'] = TeamModel::all();
        $data['project'] = ProjectModel::all();
        $data['task'] = TaskModel::findOrFail($id);

        return view('project.task_edit',$data);
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
        $task = TaskModel::findOrFail($id);
        $requested_data = $request->all();
        $validate = Validator::make($request->all(), $task->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $task->fill($requested_data)->save();

        if ($request->team_member) {
            $team_member = array();
            foreach ($request->team_member as $key => $value) {
                $team_member[$key]['task_id'] = $task->task_id;
                $team_member[$key]['task_assign_member_id'] = $value;
            }
            TaskAssignModel::where('task_id',$id)->delete();
            TaskAssignModel::insert($team_member);
        }

        Toastr::success('Task Upadted Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TaskAssignModel::where('task_id',$id)->delete();
        TaskModel::findOrFail($id)->delete();
        Toastr::success('Task Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/task');
    }
}
