@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" >Create New meeting</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">meeting</a>
                        <li class="breadcrumb-item"><a href="/meeting/create">Edit meeting</a>
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
                <div class="page-body" id="vue-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit meeting</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/meeting/$meeting->meeting_id",'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Branch</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $branch_array = [];
                                                    $branch_array[''] = "All";
                                                @endphp

                                                @foreach($branch as $key => $branch_data)
                                                    @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                                @endforeach

                                                {{Form::select('branch_id',$branch_array,$meeting->branch_id,['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $department_array = [];
                                                    $department_array[''] = "All";
                                                @endphp

                                                @foreach($department as $key => $department_data)
                                                    @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                                @endforeach

                                                {{Form::select('department_id',$department_array,$meeting->department_id,['class'=>'form-control','v-model'=>'department_name','v-on:change'=>'GetDesignation'])}}
                                                <font class="text-danger">{{$errors->first('department_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Designation</label>
                                            <div class="col-sm-8">
                                                <select id="designation_id" name="designation_id" class="form-control" v-model="designation_name">
                                                    <option value="">All</option>
                                                    <option v-for="data in Designation"  :value="data.designation_id" v-text="data.designation_name" ></option>
                                                </select>
                                                <font class="text-danger">{{$errors->first('designation_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Title</label>
                                            <div class="col-sm-8">
                                                {{Form::text('title',$meeting->title,['class'=>'form-control','placeholder'=>'Title'])}}
                                                <font class="text-danger">{{$errors->first('title')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Time</label>
                                            <div class="col-sm-8">
                                                {{Form::input('dateTime-local','time',date('Y-m-d\Th:m:s',  strtotime($meeting->time)),['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('time')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Meeting Description</label>
                                            <div class="col-sm-8">
                                                {{Form::textarea('description',$meeting->description,['class'=>'form-control','placeholder'=>'Meeting Description','rows'=>3])}}
                                                <font class="text-danger">{{$errors->first('description')}}</font>
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
            el: "#vue-area",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                department_name : '{{ $meeting->department_id }}',
                designation_name : '{{ $meeting->designation_id }}',
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
                this.GetDesignation();
            }
        })
    </script>
@stop               