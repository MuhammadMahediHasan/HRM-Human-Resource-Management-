@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">       

        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>  
        {!! Toastr::message() !!}       
                    <!-- Trigger the modal with a button -->
                    <a href="/salary_structure" class="btn btn-primary btn-sm">Salary Structure List</a>

                  
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
            <div class="page-wrapper" id="vue-element">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Salary Structure</h5>
                                    <span>Table</span>
                                </div>
                                {{Form::open(['url'=>"/salary_structure/$salary_structure_data->id", 'method'=>"PUT"])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">branch</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $branch_array = [];
                                                    $branch_array[$salary_structure_data->branch_id] = $salary_structure_data->branch_name;
                                                @endphp

                                                {{Form::select('branch_id',$branch_array,'null',['class'=>'form-control'])}}
                                                <br>
                                                <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $department_array = [];
                                                    $department_array[$salary_structure_data->department_id] = $salary_structure_data->department_name;
                                                @endphp

                                                {{Form::select('department_id',$department_array,'null',['class'=>'form-control'])}}
                                                <br>
                                                <font class="text-danger">{{$errors->first('department_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Designation</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $designation_array = [];
                                                    $designation_array[$salary_structure_data->designation_id] = $salary_structure_data->designation_name;
                                                @endphp

                                                {{Form::select('designation_id',$designation_array,'null',['class'=>'form-control','v-on:change'=>'GetEmployee'])}}
                                                <br>
                                                <font class="text-danger">{{$errors->first('designation_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Employee</label>
                                            <div class="col-sm-8">
                                                <select name="employee_basic_info_id" class="form-control" selected="selected">
                                                    <option value="{{$salary_structure_data->employee_basic_info_id}}" >{{$salary_structure_data->employe_name}}</option>
                                                </select>
                                                <br>
                                                <font class="text-danger">{{$errors->first('employee_basic_info_id')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Payroll Frequency</label>
                                            <div class="col-sm-8">
                                                {{Form::select('payroll_frequency',['Monthly'=>'Monthly','Weekly'=>'Weekly','Daily'=>'Daily'],'null',['class'=>'form-control'])}}
                                                <br>
                                                <font class="text-danger">{{$errors->first('payroll_frequency')}}</font>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($salary_component->count() == 0)
                                            <font class="text-success">Add Selery Component First!!</font>
                                        @else    
                                            @foreach($salary_component as $key=> $component_value)
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">{{ $component_value->name }}</label>
                                                <div class="col-sm-8">
                                                    {{Form::number('component['.$component_value->component_id.']',$component_value->amount,['class'=>'form-control'])}}
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
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
    </div>
</div>

@stop            