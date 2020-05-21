<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
use App\TeamModel;
use Validator;
use Toastr;
use Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['project'] = ProjectModel::join('team','team.team_id','=','project.project_lead_team_id')->select('team.team_name','project.*')->get();
        $data['team'] = TeamModel::all();

        return view('project.project',$data);
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
        $data = new ProjectModel;
        $validate = Validator::make($request->all(), $data->validation());
        if($validate->fails()){
            return back()->withInput()->withErrors($validate);
        }

        $data->fill($request->all())->save();
        Toastr::success('Project Created Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $data['project'] = ProjectModel::join('team','team.team_id','=','project.project_lead_team_id')->select('team.team_name','team.team_id','project.*')->where('project.project_id',$id)->first();
        $data['team'] = TeamModel::all();

        return view('project.project_edit',$data);
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
        $data = ProjectModel::findOrFail($id);
        $validate = Validator::make($request->all(), $data->validation());
        if($validate->fails()){
            return back()->withInput()->withErrors($validate);
        }

        $data->fill($request->all())->save();
        Toastr::success('Project Updated Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/project');
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
