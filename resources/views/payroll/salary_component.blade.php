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

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>  
        {!! Toastr::message() !!}       
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create New Salary Component</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Salary Component</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>"/salary_component"])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('name','',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('description','',['class'=>'form-control','rows'=>4])}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    {{Form::select('status',['1'=>'Active','0'=>'Inactive'],'null',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <button class="btn btn-success btn-sm">Sumbit</button>

                            {{Form::close()}}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
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
                        <li class="breadcrumb-item"><a href="/salary_component">salary_component</a>
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
                                    <h5>Salary Component</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($salary_component as $key=> $salary_component_data)
                                                <tr class="action_table_row">
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $salary_component_data->name }}</td>
                                                    <td>{{ $salary_component_data->description }}</td>
                                                    <td>
                                                        @if( $salary_component_data->status == 1 )
                                                            <span style="color: green;"><i class="fas fa-check-circle"></i>Active</span>
                                                        @else
                                                            <span style="color: red;"><i class="fas fa-times-circle"></i>Inactive</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td style="display: inline-flex;">
                                                        {{Form::open(['url'=>"salary_component/$salary_component_data->id",'method'=>'DELETE'])}}
                                                        <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                            
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"salary_component/$salary_component_data->id/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-link"><i class="fas fa-edit text-primary"></i></button>
                                                        
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"salary_component/$salary_component_data->id",'method'=>'GET'])}}
                                                            @if($salary_component_data->status=='Inactive')
                                                        <button class="btn btn-link"><i class="fas fa-check text-success"></i></button>
                                                            
                                                            @else
                                                        <button class="btn btn-link"><i class="fas fa-times-circle"></i></button>
                                                            
                                                            @endif
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
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