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
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add Leave Type</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Leave type</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>'/leave_type'])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Type Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('leave_type_name','',['class'=>'form-control required','placeholder'=>'Name'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Type Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('leave_type_description','',['class'=>'form-control required','rows'=>3,'placeholder'=>'Description'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Leave Type Status</label>
                                <div class="col-sm-8">
                                    {{Form::select('leave_type_status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control'])}}
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
                            <a href="index-2.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Leave</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/leave_type">Leave Type</a>
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
                                    <h5>Leave Type</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Leave Type</th>
                                                    <th>Leave Type Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($leave_type as $key=> $leave_type_data)
                                                <tr class="action_table_row">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$leave_type_data->leave_type_name}}</td>
                                                    <td>{{$leave_type_data->leave_type_description}}</td>
                                                    <td>
                                                        @if($leave_type_data->leave_type_status=='Active')
                                                            <span style="color: green;"><i class="fas fa-check-circle"></i>{{$leave_type_data->leave_type_status}}</span>
                                                        @else
                                                            <span style="color: red;"><i class="fas fa-times-circle"></i>{{$leave_type_data->leave_type_status}}</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"leave_type/$leave_type_data->leave_type_id",'method'=>'DELETE'])}}
                                                            <button class="btn btn-danger"><i class="fas fa-trash" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"leave_type/$leave_type_data->leave_type_id/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"leave_type/$leave_type_data->leave_type_id",'method'=>'GET'])}}
                                                            @if($leave_type_data->branch_status=='Inactive')
                                                            <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                            @else
                                                            <button class="btn btn-warning"><i class="fas fa-times"></i></button>
                                                            @endif
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Leave Type</th>
                                                    <th>Leave Type Description</th>
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