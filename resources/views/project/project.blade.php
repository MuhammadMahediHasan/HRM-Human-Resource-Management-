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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create New Project</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Project</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          {{Form::open(['url'=>"/project"])}}
                          <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Project Name</label>
                                <div class="col-sm-8">
                                    {{Form::text('project_name','',['class'=>'form-control','placeholder'=>'Project Name'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    {{Form::textarea('description','',['class'=>'form-control','placeholder'=>'Description','rows'=>3])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Assign to Team</label>
                                <div class="col-sm-8">
                                    @php
                                        $team_array = [];
                                        $team_array[''] = "--select--";
                                    @endphp

                                    @foreach($team as $key => $team_data)
                                        @php $team_array[$team_data->team_id] = $team_data->team_name; @endphp
                                    @endforeach

                                    {{Form::select('project_lead_team_id',$team_array,'null',['class'=>'form-control'])}}
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                                <button class="btn btn-success btn-sm">Sumbit</button>
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
                        <li class="breadcrumb-item"><a href="/branch">Project</a>
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
                                    <h5>Project List</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Working Team</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project as $key=> $project_data)
                                                <tr class="action_table_row">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$project_data->project_name}}</td>
                                                    <td>{{$project_data->team_name}}</td>
                                                    <td>{{$project_data->description}}</td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"project/$project_data->project_id",'method'=>'DELETE'])}}
                                                            <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"project/$project_data->project_id/edit",'method'=>'GET'])}}
                                                            <button class="btn btn-link"><i class="fas fa-edit text-primary"></i></button>
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Working Team</th>
                                                    <th>Description</th>
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