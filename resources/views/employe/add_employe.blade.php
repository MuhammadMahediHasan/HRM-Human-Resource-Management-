@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper" id="vue-employee">   
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Form wizard with validation card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add New Employee</h5>
                                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                </div>
                                {{Form::open(['url'=>'/add_employe', 'files'=>true])}} 
                                <div class="card-block row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Employee Name</label>
                                            <div class="col-sm-12">
                                                {{Form::text('employe_name','',['class'=>'form-control required','placeholder'=>'Employee Name'])}}
                                                
                                                <font class="text-danger">{{$errors->first('employe_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Branch Name</label>
                                            <div class="col-sm-12">
                                                @php
                                                    $branch_array = [];
                                                    $branch_array[''] = "--select--";
                                                @endphp

                                                @foreach($branch as $key => $branch_data)
                                                    @php $branch_array[$branch_data->branch_id] = $branch_data->branch_name; @endphp
                                                @endforeach

                                                {{Form::select('branch_name',$branch_array,'null',['class'=>'form-control'])}}
                                                
                                                <font class="text-danger">{{$errors->first('branch_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Department Name</label>
                                            <div class="col-sm-12">
                                                @php
                                                    $department_array = [];
                                                    $department_array[''] = "--select--";
                                                @endphp

                                                @foreach($department as $key => $department_data)
                                                    @php $department_array[$department_data->department_id] = $department_data->department_name; @endphp
                                                @endforeach

                                                {{Form::select('department_name',$department_array,'null',['class'=>'form-control','v-model'=>'department_name','v-on:change'=>'GetDesignation'])}}
                                                
                                                <font class="text-danger">{{$errors->first('department_name')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Designation Name</label>
                                            <div class="col-sm-12">
                                                <select id="designation_name" name="designation_name" class="form-control">
                                                    <option value="">--select--</option>
                                                    <option v-for="data in Designation"  :value="data.designation_id" v-text="data.designation_name"></option>
                                                </select>
                                                
                                                <font class="text-danger">{{$errors->first('designation_name')}}</font>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">


                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Employee ID</label>
                                            <div class="col-sm-12">

                                                {{Form::text('employe_code',$employee_code,['class'=>'form-control required','placeholder'=>'Employee ID','readonly'])}}

                                                
                                                <font class="text-danger">{{$errors->first('employe_code')}}</font>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Date of Birth</label>
                                            <div class="col-sm-12">
                                                {{Form::date('date_of_birth','',['class'=>'form-control required'])}}
                                                
                                                <font class="text-danger">{{$errors->first('date_of_birth')}}</font>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Joining Date</label>
                                            <div class="col-sm-12">
                                                {{Form::date('joining_date','',['class'=>'form-control required'])}}
                                                
                                                <font class="text-danger">{{$errors->first('joining_date')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Gender</label>
                                            <div class="col-sm-12">
                                                {{Form::select('gender',['1'=>'Male','2'=>'Female'],'null',['class'=>'form-control'])}}
                                                
                                                <font class="text-danger">{{$errors->first('gender')}}</font>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Phone</label>
                                            <div class="col-sm-12">
                                                {{Form::text('phone','',['class'=>'form-control required','placeholder'=>'Phone'])}}
                                                
                                                <font class="text-danger">{{$errors->first('phone')}}</font>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Email</label>
                                            <div class="col-sm-12">
                                                {{Form::email('email','',['class'=>'form-control required','placeholder'=>'Email'])}}
                                                
                                                <font class="text-danger">{{$errors->first('email')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Password</label>
                                            <div class="col-sm-12">
                                                {{Form::password('password',['class'=>'form-control required','placeholder'=>'Password'])}}
                                                
                                                <font class="text-danger">{{$errors->first('password')}}</font>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label">Confirm Password</label>
                                            <div class="col-sm-12">
                                                {{Form::password('password_confirmation',['class'=>'form-control required','placeholder'=>'Confirm Password'])}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-block row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-info btn-sm">Sumbit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                            <!-- Form wizard with validation card end -->
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  $('#profile-img-tag').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
  }
  }
  $("#profile-img").change(function(){
  readURL(this);
  });
</script> -->
@stop              
@section('script')
    <script type="text/javascript">
        new Vue({
            el: "#vue-employee",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                Designation : [],
                department_name : '',
            },
            methods : {
                GetDesignation : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/'+ _this.department_name,
                        type : 'get',
                        success : function (response){
                            _this.Designation = response;
                        }
                    })
                },
            },
            mounted(){
                // this.GetRequiredData();
                console.log("ok");
            }
        })
    </script>
@stop     