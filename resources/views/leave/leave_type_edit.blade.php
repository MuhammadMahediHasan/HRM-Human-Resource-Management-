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

                {{Form::open(['url'=>"leave_type/$leave_type->leave_type_id",'method'=>'PUT'])}}
                
                    <center>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Leave Type Name</label>
                            <div class="col-sm-8">
                                {{Form::text('leave_type_name',$leave_type->leave_type_name,['class'=>'form-control required'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Leave Type Description</label>
                            <div class="col-sm-8">
                                {{Form::textarea('leave_type_description',$leave_type->leave_type_description,['class'=>'form-control required'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Leave Type Status</label>
                            <div class="col-sm-8">
                                {{Form::select('leave_type_status',[$leave_type->leave_type_status=>'Active',$leave_type->leave_type_status=>'Inactive','Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control'])}}
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