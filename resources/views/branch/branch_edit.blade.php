@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <a href="/branch" class="btn btn-primary btn-sm">Branch List</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/branch">Branch</a>
                        <li class="breadcrumb-item"><a href="#">Branch Edit</a>
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
                                    <h5>{{ $branch->branch_name }} Branch Edit</h5>
                                    <span>Table</span>
                                </div>

                                {{Form::open(['url'=>"branch/$branch->branch_id",'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                {{Form::text('branch_name',$branch->branch_name,['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('branch_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                {{Form::select('branch_status',[$branch->branch_status=>'Active',$branch->branch_status=>'Inactive','Active'=>'Active','Inactive'=>'Inactive'],'null',['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('branch_status')}}</font>
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
