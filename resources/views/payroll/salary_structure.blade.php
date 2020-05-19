@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">   
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
                                {{Form::open(['url'=>"/salary_structure"])}}
                                <div class="card-block row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">branch</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $branch_array = [];
                                                    $branch_array[''] = "--select--";
                                                @endphp

                                                @foreach($branch as $key => $branch_data)
                                                    @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                                @endforeach

                                                {{Form::select('branch_id',$branch_array,'null',['class'=>'form-control','v-model'=>'formData.branch_id'])}}
                                                
                                                <font class="text-danger">{{$errors->first('branch_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $department_array = [];
                                                    $department_array[''] = "--select--";
                                                @endphp

                                                @foreach($department as $key => $department_data)
                                                    @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                                @endforeach

                                                {{Form::select('department_id',$department_array,'null',['class'=>'form-control','v-model'=>'formData.department_id','v-on:change'=>'GetDesignation'])}}
                                                
                                                <font class="text-danger">{{$errors->first('department_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Designation</label>
                                            <div class="col-sm-8">

                                                <select class="form-control" name="designation_id" v-model="formData.designation_id" @change="GetEmployee">
                                                    <option value="">--select--</option>
                                                    <option v-for="data in Designation" :value="data.designation_id" v-text="data.designation_name"></option>
                                                </select>

                                                
                                                <font class="text-danger">{{$errors->first('designation_id')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Employee</label>
                                            <div class="col-sm-8">
                                                <select id="chkveg" name="employee_basic_info_id[]" multiple="multiple" class="form-control">
                                                    <!-- <option value="">--select above fields--</option> -->
                                                    <option v-for="data in Employees" :value="data.id" v-text="data.employe_name"></option>
                                                </select>
                                                
                                                <font class="text-danger">{{$errors->first('employee_basic_info_id')}}</font>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Payroll Frequency</label>
                                            <div class="col-sm-8">
                                                {{Form::select('payroll_frequency',['Monthly'=>'Monthly','Weekly'=>'Weekly','Daily'=>'Daily'],'null',['class'=>'form-control'])}}
                                                
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
                                                    {{Form::number('component['.$component_value->id.']','',['class'=>'form-control'])}}
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
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>
</div>

@stop  
@section('script')
    <script type="text/javascript">
        new Vue({
            el: "#vue-element",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                formData : {
                    branch_id : '',
                    designation_id : '',
                    department_id : '',
                },
                Designation : [],
                Employees : [],
            },
            methods:{
                GetEmployee : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/selery_structure_employee',
                        type : 'post',
                        data : {
                            _token : _this.csrf_token,
                            data : _this.formData,
                        },
                        success : function (response){
                            _this.Employees = response;
                        }
                    })
                    
                },
                GetDesignation : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/'+ _this.formData.department_id,
                        type : 'get',
                        success : function (response){
                            _this.Designation = response;
                        }
                    })
                }
            },
            mounted(){
                // console.log(this.baseUrl);
            }
        })
    </script>
@stop            