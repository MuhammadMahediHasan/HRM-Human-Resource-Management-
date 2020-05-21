@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create New Branch</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" id="team">
                          <div class="modal-header">
                            <h4 class="modal-title">Create Team</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>"/team"])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('team_name','',['class'=>'form-control','placeholder'=>'Team Name'])}}
                                    <font class="text-danger">{{$errors->first('team_name')}}</font>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('description','',['class'=>'form-control','placeholder'=>'Description','rows'=>3])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Branch</label>
                                <div class="col-sm-8">
                                    @php
                                        $branch_array = [];
                                        $branch_array[''] = "--select--";
                                    @endphp

                                    @foreach($branch as $key => $branch_data)
                                        @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                    @endforeach

                                    {{Form::select('branch_id',$branch_array,'null',['class'=>'form-control','v-model'=>'branch_name'])}}
                                    <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Department</label>
                                <div class="col-sm-8">
                                    @php
                                        $department_array = [];
                                        $department_array[''] = "--select--";
                                    @endphp

                                    @foreach($department as $key => $department_data)
                                        @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                    @endforeach

                                    {{Form::select('department_id',$department_array,'null',['class'=>'form-control','v-model'=>'department_name','v-on:change'=>'GetEmployee'])}}
                                    <font class="text-danger">{{$errors->first('department_id')}}</font>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Team Leader</label>
                                <div class="col-sm-8">
                                    <select id="emloyee_name" name="team_leader_id" class="form-control" @change="GetTeamMember($event.target.value)">
                                        <option value="">--select--</option>
                                        <option v-for="data in Employee" :value="data.id" v-text="data.employe_name"></option>
                                    </select>
                                    <font class="text-danger">{{$errors->first('team_leader_id')}}</font>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Team Member</label>
                                <div class="col-sm-8">
                                    <select id="chkveg" name="team_member[]" multiple="multiple" class="form-control">
                                        <option v-for="data in TeamMember" :value="data.id" v-text="data.employe_name"></option>
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
                        <li class="breadcrumb-item"><a href="#">Team</a>
                        <li class="breadcrumb-item"><a href="/team/create">Create Team</a>
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
                                                    <th>Name</th>
                                                    <th>Team Leader</th>
                                                    <th>Team Member</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($team as $key=> $team_data)
                                                <tr class="action_table_row">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$team_data['team_name']}}</td>
                                                    <td>{{$team_data['employe_name']}}</td>
                                                    <td>
                                                        @foreach($team_data['team_member'] as $team_member_data)
                                                        @php
                                                            $team_member_name = collect($employee)->where('id',$team_member_data['team_member_id']);
                                                        @endphp

                                                            @foreach($team_member_name as $name)
                                                                {{ $name['employe_name'] }}
                                                            @endforeach
                                                        <br>
                                                        @endforeach
                                                    </td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"team/".$team_data['team_id'],'method'=>'DELETE'])}}
                                                        <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                            
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"team/".$team_data['team_id']."/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-link"><i class="fas fa-edit text-primary"></i></button>
                                                        
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Team Leader</th>
                                                    <th>Team Member</th>
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
            el: "#team",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                TeamMember : [],
                Employee : [],
                department_name : '',
                branch_name : '',
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
                console.log("ok");
            }
        })
    </script>
@stop               