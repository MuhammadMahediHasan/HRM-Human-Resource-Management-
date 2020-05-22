<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMemberModel;
use App\TaskAssignModel;
use App\ProjectModel;
use App\TaskModel;
use App\TeamModel;
use Validator;
use Toastr;
use DateTime;

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
        $start_from = new DateTime($request->start_from);
        $end_time = new DateTime($request->end_time);

        $task = new TaskModel;
        $requested_data = $request->all();
        $validate = Validator::make($request->all(), $task->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $requested_data['start_from'] = $start_from->format("Y-m-d H:i:s");
        $requested_data['end_time'] = $end_time->format("Y-m-d H:i:s");
        
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
}
