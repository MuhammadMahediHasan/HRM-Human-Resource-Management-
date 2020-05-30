@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <a href="/department" class="btn btn-primary btn-sm">Department List</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/department">Department</a>
                        <li class="breadcrumb-item"><a href="#">Department Edit</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


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
                                    <h5>{{ $department->department_name }} Department Edit</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/department/$department->department_id",'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                {{Form::text('department_name',$department->department_name,['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('department_name')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                {{Form::select('department_status',[$department->department_status=>'Active',$department->department_status=>'Inactive','Active'=>'Active','Inactive'=>'Inactive'],'null',['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('department_status')}}</font>
                                            </div>
                                        </div>
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
                                {{Form::close()}}
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
