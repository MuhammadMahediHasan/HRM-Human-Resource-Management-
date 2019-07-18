@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
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

                {{Form::open(['url'=>"leave/$leave->leave_id",'method'=>'PUT'])}}
                
                    <center>
                        <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Employe Code</label>
                                <div class="col-sm-8">
                                    {{Form::text('employe_code',$leave->employe_code,['class'=>'form-control required','readonly'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Type</label>
                                <div class="col-sm-8">
                                    <select name="leave_type_name" class="form-control">
                                        @php
                                            $leave_type_name=DB::table('leave_type')->where('leave_type_id',$leave->leave_type_name)->first();
                                        @endphp
                                        <option value="{{$leave->leave_type_name}}">{{$leave_type_name->leave_type_name}}</option>
                                        @foreach($leave_type as $leave_type_data)
                                        <option value="{{$leave_type_data->leave_type_id}}">{{$leave_type_data->leave_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">From</label>
                                <div class="col-sm-8">
                                    {{Form::date('leave_from',$leave->leave_from,['class'=>'form-control required'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">To</label>
                                <div class="col-sm-8">
                                    {{Form::date('leave_to',$leave->leave_to,['class'=>'form-control required'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Reason</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('leave_reason',$leave->leave_reason,['class'=>'form-control required'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Status</label>
                                <div class="col-sm-8">
                                    {{Form::select('leave_status',[$leave->leave_status=>'Active',$leave->leave_status=>'Inative','Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control'])}}
                                </div>
                            </div>
                        
                            <button class="btn btn-success">Sumbit</button>
                    </center>
                <div class="col-sm-2"></div>

                {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
</div>
@stop