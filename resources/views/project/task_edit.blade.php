@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" >Create New Team</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Team</a>
                        <li class="breadcrumb-item"><a href="/team/create">Edit Team</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content" id="task">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body" id="team">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Project</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/task/$task->task_id",'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Project</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $project_array = [];
                                                @endphp

                                                @foreach($project as $key => $project_data)
                                                    @php $project_array[$project_data->project_id] = $project_data->project_name; @endphp
                                                @endforeach

                                                {{Form::select('project_id',$project_array,$task->project_id,['class'=>'form-control','v-model'=>'project_id','v-on:change'=>'GetTeam'])}}
                                                <font class="text-danger">{{$errors->first('project_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Team Name</label>
                                            <div class="col-sm-8">
                                                <select name="team_id" class="form-control">
                                                    <option selected="selected" :value="team.team_id" v-text="team.team_name"></option>
                                                </select>
                                                <font class="text-danger">{{$errors->first('team_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Task Name</label>
                                            <div class="col-sm-8">
                                                {{Form::text('task_name',$task->task_name,['class'=>'form-control','placeholder'=>'Task Name'])}}
                                                <font class="text-danger">{{$errors->first('task_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                {{Form::textarea('description',$task->description,['class'=>'form-control','placeholder'=>'Description','rows'=>3])}}
                                                <font class="text-danger">{{$errors->first('description')}}</font>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Start From</label>
                                            <div class="col-sm-8">
                                                {{Form::input('dateTime-local','start_from',date('Y-m-d\Th:m:s',  strtotime($task->start_from)),['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('start_from')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">End Time</label>
                                            <div class="col-sm-8">
                                                
                                                {{Form::input('dateTime-local','end_time',date('Y-m-d\Th:m:s',  strtotime($task->end_time)),['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('end_time')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Task Assign to Team Member</label>
                                            <div class="col-sm-8">
                                                <select id="chkveg" name="team_member[]" multiple="multiple" class="form-control">
                                                    <option v-for="data in team_member" :value="data.id" v-text="data.employe_name" :selected="ExistMemberSelect(data.id)"></option>
                                                </select>
                                                <font class="text-danger">{{$errors->first('team_member')}}</font>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        
                                    </div>
                                </div>
                                <div class="card-block row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <button class="btn btn-info btn-sm">Sumbit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
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
                project_id : '{{ $task->project_id }}',
                team : [],
                MemberID : [],
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
                            _this.MemberID = response.team_member_id;
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
                ExistMemberSelect : function(id){
                    const _this = this;
                    if (_this.MemberID.includes(id)) {
                        return "selected";
                    }
                },
            },
            mounted(){
                this.GetTeam();
            }
        })
    </script>
@stop   
