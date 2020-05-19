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
                {{Form::open(['url'=>"/designation/$designation->designation_id",'method'=>'PUT'])}}
                
                    <center>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Department Name</label>
                            <div class="col-sm-8">
                                <select name="department_name" class="form-control">
                                    <option value="{{$designation->department_id}}">{{$designation->department_name}}</option>
                                    @foreach($department as $department_data)
                                        <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Designation Name</label>
                            <div class="col-sm-8">
                                {{Form::text('designation_name',$designation->designation_name,['class'=>'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Designation Status</label>
                            <div class="col-sm-8">
                                {{Form::select('designation_status',[$designation->designation_status=>'Active',$designation->designation_status=>'Inactive','Active'=>'Active','Inactive'=>'Inactive'],'null',['class'=>'form-control'])}}
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
