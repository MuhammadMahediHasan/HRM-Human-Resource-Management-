@extends('backend')
@section('main_content') 

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card" id="vue-area">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif         
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add Meeting</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Meeting</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>"/meeting"])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Mail Sent</label>
                                <div class="col-sm-8">
                                    <label> <input type="radio" name="mail_sent" value="1"> Sent Mail to Employees</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Branch</label>
                                <div class="col-sm-8">
                                    @php
                                        $branch_array = [];
                                        $branch_array[''] = "All";
                                    @endphp

                                    @foreach($branch as $key => $branch_data)
                                        @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                    @endforeach

                                    {{Form::select('branch_id',$branch_array,'null',['class'=>'form-control'])}}
                                    <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Department</label>
                                <div class="col-sm-8">
                                    @php
                                        $department_array = [];
                                        $department_array[''] = "All";
                                    @endphp

                                    @foreach($department as $key => $department_data)
                                        @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                    @endforeach

                                    {{Form::select('department_id',$department_array,'null',['class'=>'form-control','v-model'=>'department_name','v-on:change'=>'GetDesignation'])}}
                                    <font class="text-danger">{{$errors->first('department_id')}}</font>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Designation</label>
                                <div class="col-sm-8">
                                    <select id="designation_id" name="designation_id" class="form-control">
                                        <option value="">All</option>
                                        <option v-for="data in Designation"  :value="data.designation_id" v-text="data.designation_name"></option>
                                    </select>
                                    <font class="text-danger">{{$errors->first('designation_id')}}</font>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
                                    <font class="text-danger">{{$errors->first('title')}}</font>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Date & Time</label>
                                <div class="col-sm-8">
                                    {{Form::input('dateTime-local','time','',['class'=>'form-control'])}}
                                    <font class="text-danger">{{$errors->first('time')}}</font>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Meeting Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('description','',['class'=>'form-control','placeholder'=>'Meeting Description','rows'=>3])}}
                                    <font class="text-danger">{{$errors->first('description')}}</font>
                                </div>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-success btn-sm">Submit</button>
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
                        <li class="breadcrumb-item"><a href="/department">Meeting</a>
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
                            <!-- Zero config.table start -->
                            
                            <!-- Zero config.table end -->
                            <!-- Default ordering table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Meeting List</h5>
                                    <span></span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($meeting as $key=> $meeting_data)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        @if($meeting_data->branch_id == null) 
                                                            All
                                                        @else
                                                            {{ $meeting_data->branch_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($meeting_data->department_id == null) 
                                                            All
                                                        @else
                                                            {{ $meeting_data->department_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($meeting_data->designation_id == null) 
                                                            All
                                                        @else
                                                            {{ $meeting_data->designation_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{$meeting_data->title}}</td>
                                                    <td>{{$meeting_data->description}}</td>
                                                    <td>{{ date('d-F-Y h:i A', strtotime($meeting_data['time'])) }}</td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"meeting/$meeting_data->meeting_id",'method'=>'DELETE'])}}
                                                            <button class="btn btn-link text-danger"><i class="fas fa-trash" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"meeting/$meeting_data->meeting_id/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-link text-primary"><i class="fas fa-edit"></i></button>
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Time</th>
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
            el: "#vue-area",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                department_name : '',
            },
            methods : {
                GetDesignation : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/'+ _this.department_name,
                        type : 'get',
                        success : function (response){
                            _this.Designation = response;
                        }
                    })
                },
            },
            mounted(){
                console.log("ok");
            }
        })
    </script>
@stop               