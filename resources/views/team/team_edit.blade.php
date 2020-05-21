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
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body" id="team">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Team</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/team/".$team['team_id'],'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Team Name</label>
                                            <div class="col-sm-8">
                                                {{Form::text('team_name',$team['team_name'],['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Branch</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $branch_array = [];
                                                @endphp

                                                @foreach($branch as $key => $branch_data)
                                                    @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                                @endforeach

                                                {{Form::select('branch_id',$branch_array,'null',['class'=>'form-control','v-model'=>'branch_name'])}}
                                                
                                                <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $department_array = [];
                                                @endphp

                                                @foreach($department as $key => $department_data)
                                                    @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                                @endforeach

                                                {{Form::select('department_id',$department_array,'null',['class'=>'form-control','v-model'=>'department_name','v-on:change'=>'GetEmployee'])}}
                                                
                                                <font class="text-danger">{{$errors->first('department_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Team Leader</label>
                                            <div class="col-sm-8">
                                                <select id="emloyee_name" name="team_leader_id" class="form-control" v-model="team_leader_id" @change="GetTeamMember()">
                                                    <option v-for="data in Employee" :value="data.id" v-text="data.employe_name"></option>
                                                </select>
                                                <font class="text-danger">{{$errors->first('team_leader_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Employee</label>
                                            <div class="col-sm-8">
                                                <select id="chkveg" name="team_member[]" multiple="multiple" class="form-control">
                                                    <option v-for="data in TeamMember" :value="data.id" v-text="data.employe_name" :selected="ExistMemberSelect(data.id)"></option>
                                                </select>
                                                <font class="text-danger">{{$errors->first('employee_basic_info_id')}}</font>
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
            el: "#team",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                TeamMember : [],
                Employee : [],
                department_name : '{{ $team['department_id'] }}',
                branch_name : '{{ $team['branch_id'] }}',
                team_leader_id : '{{ $team['team_leader_id'] }}',
                team_id : '{{ $team['team_id'] }}',
                MemberID : [],
            },
            methods : {
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
                GetTeamMember : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/team_member',
                        type : 'post',
                        data :{
                            _token : _this.csrf_token,
                            department_id : _this.department_name,
                            branch_id : _this.branch_name,
                            team_leader_id : _this.team_leader_id,
                        },
                        success : function (response){
                            _this.TeamMember = response;
                        }
                    })
                },
                GetTeamMemberID : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/team/' + _this.team_id,
                        type : 'get',
                        success : function (response){
                            _this.MemberID = response;
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
                this.GetEmployee();
                this.GetTeamMember();
                this.GetTeamMemberID();
            }
        })
    </script>
@stop               