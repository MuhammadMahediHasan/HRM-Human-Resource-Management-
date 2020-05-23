@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card" id="task">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create New Task</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" id="team">
                          <div class="modal-header">
                            <h4 class="modal-title">Create Task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>"/task"])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Project</label>
                                <div class="col-sm-8">
                                    @php
                                        $project_array = [];
                                        $project_array[''] = "--select--";
                                    @endphp

                                    @foreach($project as $key => $project_data)
                                        @php $project_array[$project_data->project_id] = $project_data->project_name; @endphp
                                    @endforeach

                                    {{Form::select('project_id',$project_array,'null',['class'=>'form-control','v-model'=>'project_id','v-on:change'=>'GetTeam'])}}
                                    <font class="text-danger">{{$errors->first('project_id')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Team Name</label>
                                <div class="col-sm-8">
                                    <select name="team_id" class="form-control">
                                        <option selected="selected" :value="team.team_id" v-text="team.team_name"></option>
                                    </select>
                                    <font class="text-danger">{{$errors->first('team_id')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Task Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('task_name','',['class'=>'form-control','placeholder'=>'Task Name'])}}
                                    <font class="text-danger">{{$errors->first('task_name')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('description','',['class'=>'form-control','placeholder'=>'Description','rows'=>3])}}
                                    <font class="text-danger">{{$errors->first('description')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Start From</label>
                                <div class="col-sm-8">
                                    {{Form::input('dateTime-local','start_from','',['class'=>'form-control'])}}
                                    <font class="text-danger">{{$errors->first('start_from')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">End Time</label>
                                <div class="col-sm-8">
                                    {{Form::input('dateTime-local','end_time','',['class'=>'form-control'])}}
                                    <font class="text-danger">{{$errors->first('end_time')}}</font>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Task Assign to Team Member</label>
                                <div class="col-sm-8">
                                    <select id="chkveg" name="team_member[]" multiple="multiple" class="form-control">
                                        <option v-for="data in team_member" :value="data.id" v-text="data.employe_name"></option>
                                    </select>
                                    <font class="text-danger">{{$errors->first('team_member')}}</font>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            
                            <button class="btn btn-success btn-sm">Sumbit</button>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                          </div>
                          {{Form::close()}}
                        </div>

                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Task</a>
                        <li class="breadcrumb-item"><a href="/team/create">Create Task</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Team</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Task Name</th>
                                                    <th>Description</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Assigned Member</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($task as $key=> $task_data)
                                                <tr class="action_table_row">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$task_data['project_name']}}</td>
                                                    <td>{{$task_data['task_name']}}</td>
                                                    <td>{{$task_data['description']}}</td>
                                                    <td>
                                                        {{ date('d-F-Y h:i A', strtotime($task_data['start_from'])) }} 

                                                    </td>
                                                    <td>
                                                         {{ date('d-F-Y h:i A', strtotime($task_data['end_time'])) }} 
                                                    </td>
                                                    <td>
                                                        @foreach($task_data['team_member'] as $team_member_data)
                                                        @php
                                                            $team_member_name = collect($employee)->where('id',$team_member_data['task_assign_member_id']);
                                                        @endphp

                                                            @foreach($team_member_name as $name)
                                                                {{ $name['employe_name'] }}
                                                            @endforeach
                                                        <br>
                                                        @endforeach
                                                    </td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"/task/".$task_data['task_id'],'method'=>'DELETE'])}}
                                                        <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"/task/".$task_data['task_id']."/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-link"><i class="fas fa-edit text-primary"></i></button>
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Task Name</th>
                                                    <th>Description</th>
                                                    <th>Assigned Member</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>
</div>

@stop  
@section('script')
    <script type="text/javascript">
        new Vue({
            el: "#task",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                team_member : [],
                Employee : [],
                project_id : '',
                team : [],
            },
            methods : {
                GetTeam : function(){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/task/' + _this.project_id,
                        type : 'get',
                        success : function (response){
                            _this.team = response.team;
                            _this.team_member = response.team_member;
                        }
                    })
                },
                GetEmployee : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/team_leader',
                        type : 'post',
                        data :{
                            _token : _this.csrf_token,
                            department_id : _this.department_name,
                            branch_id : _this.branch_name,
                        },
                        success : function (response){
                            _this.Employee = response;
                        }
                    })
                },
                GetTeamMember : function (id){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/team_member',
                        type : 'post',
                        data :{
                            _token : _this.csrf_token,
                            department_id : _this.department_name,
                            branch_id : _this.branch_name,
                            team_leader_id : id,
                        },
                        success : function (response){
                            _this.TeamMember = response;
                        }
                    })
                },
            },
            mounted(){
                // this.GetRequiredData();
            }
        })
    </script>
@stop               