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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add Department</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Department</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            {{Form::open(['url'=>"/department"])}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('department_name','',['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Roll</label>
                                <div class="col-sm-8">
                                    {{form::select('department_status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control'])}}
                                </div>
                            </div>

                            <center>
                                <button class="btn btn-success">Submit</button>
                            </center>
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
                        <li class="breadcrumb-item"><a href="/department">Department</a>
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
                                    <h5>Default Ordering</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($department as $key=> $department_data)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$department_data->department_name}}</td>
                                                    <td>
                                                        @if($department_data->department_status=='Active')
                                                            <span style="color: green;"><i class="fas fa-check-circle"></i>{{$department_data->department_status}}</span>
                                                        @else
                                                            <span style="color: red;"><i class="fas fa-times-circle"></i>{{$department_data->department_status}}</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"department/$department_data->department_id",'method'=>'DELETE'])}}
                                                            <button class="btn btn-link text-danger"><i class="fas fa-trash" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"department/$department_data->department_id/edit",'method'=>'GET'])}}
                                                        <button class="btn btn-link text-primary"><i class="fas fa-edit"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"department/$department_data->department_id",'method'=>'GET'])}}
                                                            @if($department_data->department_status=='Inactive')
                                                            <button class="btn btn-link text-success"><i class="fas fa-check"></i></button>
                                                            @else
                                                            <button class="btn btn-link text-warning"><i class="fas fa-times"></i></button>
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