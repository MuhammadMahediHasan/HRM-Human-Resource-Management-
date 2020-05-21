<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\EmployeModel;
use App\TeamMemberModel;
use App\TeamModel;
use App\BranchModel;
use Validator;
use Redirect;
use Toastr;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['branch'] = BranchModel::all();
        $data['department'] = DepartmentModel::all();
        $data['employee'] = EmployeModel::get()->toArray();
        $data['team'] = TeamModel::with('team_member')
                            ->join('users','users.id','=','team.team_leader_id')
                            ->get()->toArray();

        return view('team.team',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $team = new TeamModel;
        $validate = Validator::make($request->all(), $team->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        
        $team->fill($request->all())->save();

        if ($request->team_member) {
            $team_member = array();
            foreach ($request->team_member as $key => $value) {
                $team_member[$key]['team_id'] = $team->team_id;
                $team_member[$key]['team_member_id'] = $value;
            }
            TeamMemberModel::insert($team_member);
        }

        Toastr::success('Team Created Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $data = TeamMemberModel::where('team_id',$id)->get();
        return response()->json($data->pluck('team_member_id'));
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
        $data['employee'] = EmployeModel::get()->toArray();
        $data['team'] = TeamModel::with('team_member')
                            ->join('users','users.id','=','team.team_leader_id')
                            ->join('branch','branch.branch_id','=','users.branch_name')
                            ->join('department','department.department_id','=','users.department_name')
                            ->where('team.team_id',$id)
                            ->first()->toArray();

        return view('team.team_edit',$data);
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
        // dd($request->all());
        $team = TeamModel::findOrFail($id);
        $validate = Validator::make($request->all(), $team->validation());
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        
        $team->fill($request->all())->save();

        if ($request->team_member) {
            $team_member = array();
            foreach ($request->team_member as $key => $value) {
                $team_member[$key]['team_id'] = $team->team_id;
                $team_member[$key]['team_member_id'] = $value;
            }
            TeamMemberModel::where('team_id',$team->team_id)->delete();
            TeamMemberModel::insert($team_member);
        }

        Toastr::success('Team Updated Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/team/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TeamMemberModel::where('team_id',$id)->delete();
        TeamModel::where('team_id',$id)->delete();

        Toastr::success('Team Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
        return Redirect::to('/team/create');
    }


    public function GetTeamLeader(Request $request){
        $team = TeamModel::get();
        $team_leader_id = $team->pluck('team_leader_id')->toArray();

        $data = EmployeModel::where(function($query) use($request) {
            if ($request->branch_id) {
                $query->where('branch_name',$request->branch_id);
            }
            if ($request->designation_id) {
                $query->where('designation_name',$request->designation_id);
            }
            if ($request->department_id) {
                $query->where('department_name',$request->department_id);
            }
        })->get();

        return response()->json($data);
    }


    public function GetTeamMember(Request $request){
        $team = TeamModel::get();
        $team_leader_id = $team->pluck('team_leader_id')->toArray();

        $data = EmployeModel::where(function($query) use($request) {
            if ($request->branch_id) {
                $query->where('branch_name',$request->branch_id);
            }
            if ($request->designation_id) {
                $query->where('designation_name',$request->designation_id);
            }
            if ($request->department_id) {
                $query->where('department_name',$request->department_id);
            }
        })->whereNotIn('id',[$request->team_leader_id])->get();

        return response()->json($data);
    }
}
