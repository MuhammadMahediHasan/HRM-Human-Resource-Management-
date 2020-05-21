@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">          
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" >Create New Team</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Team</a>
                        <li class="breadcrumb-item"><a href="/team/create">Edit Team</a>
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
                <div class="page-body" id="team">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Project</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/project/$project->project_id",'method'=>'PUT'])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Project Name</label>
                                            <div class="col-sm-8">
                                                {{Form::text('project_name',$project->project_name,['class'=>'form-control','placeholder'=>'Project Name'])}}
                                                <font class="text-danger">{{$errors->first('project_name')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Description</label>
                                            <div class="col-sm-8">
                                                {{Form::textarea('description',$project->description,['class'=>'form-control','placeholder'=>'Description','rows'=>3])}}
                                                
                                                <font class="text-danger">{{$errors->first('description')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $team_array = [];
                                                    $team_array[$project->team_id] = $project->team_name;
                                                @endphp

                                                @foreach($team as $key => $team_data)
                                                    @php $team_array[$team_data->team_id] = $team_data->team_name; @endphp
                                                @endforeach

                                                {{Form::select('project_lead_team_id',$team_array,'null',['class'=>'form-control'])}}
                                                <font class="text-danger">{{$errors->first('project_lead_team_id')}}</font>
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
