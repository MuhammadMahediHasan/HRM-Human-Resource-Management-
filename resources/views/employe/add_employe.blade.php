@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif         
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Form wizard with validation card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add New Employee</h5>
                                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="wizard">
                                                <section>
                                                    {{Form::open(['url'=>'/add_employe', 'files'=>true,'class'=>'wizard-form','id'=>'example-advanced-form'])}}    
                                                        <h3> Besis Info </h3>
                                                        <fieldset style="position: inherit;">
                                                            <div class="row" id="vue-employee">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Employee Code *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::text('employe_code','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Employee Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::text('employe_name','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Branch *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <select name="branch_name" class="form-control" @change="GetDesignation($event.target.value)">
                                                                                <option value="">Select</option>
                                                                                @foreach($branch as $branch_data)
                                                                                <option value="{{$branch_data->branch_id}}">{{$branch_data->branch_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Department *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <select name="department_name" class="form-control" @change="GetDesignation($event.target.value)">
                                                                                <option value="">Select</option>
                                                                                @foreach($department as $department_data)
                                                                                <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Designation *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <select name="designation_name" class="form-control">
                                                                                <option value="">--select--</option>
                                                                                <option v-for="data in Designation"  :value="data.designation_id" v-text="data.designation_name"></option>
                                                                            </select>
                                                                          <!--   <select name="designation_name" class="form-control">
                                                                                <option value="">Select</option>
                                                                                @foreach($designation as $designation_data)
                                                                                <option value="{{$designation_data->designation_id}}">{{$designation_data->designation_name}}</option>
                                                                                @endforeach
                                                                            </select> -->
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Photo *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::file('employe_photo',['class'=>'form-control  required','id'=>'profile-img'])}}

                                                                             <img src=""  onerror="this.src='{{asset('backend_asset/images/avatar_image.png')}}';" id="profile-img-tag" style="width: 200px;margin-top: 20px;" />      
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Father Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::text('father_name','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Mother Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::text('mother_name','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Date Of Birth *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::date('date_of_birth','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">National ID *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::text('national_id','',['class'=>'form-control required'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Nationality *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::select('nationality',[''=>'Select','Bangladeshi'=>'Bangladeshi'],null,['class'=>'form-control'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Gender *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::select('employe_gender',[''=>'Select','Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Blood Group *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::select('blood_group',[''=>'Select','A+'=>'A+','A-'=>'A-','B+'=>'B+','O+'=>'O+','O-'=>'O-'],null,['class'=>'form-control'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Religion *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::select('religion',[''=>'Select','Islam'=>'Islam'],null,['class'=>'form-control'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName-2" class="block">Marital status *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            {{Form::select('merital_statas',[''=>'Select','Married'=>'Married','Single'=>'Single'],null,['class'=>'form-control'])}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <h3> Contact Info </h3>
                                                        <fieldset style="position: inherit;">
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Phone Number *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('phone_number','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Email *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::email('email','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Present Address *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::textarea('present_address','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Parmanent Address *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::textarea('parmanent_address','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <span style="margin: 15px;" class="text-center"><h3>Banking Info</h3></span>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Account Number *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_account_number','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Bank Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_name','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Branch Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_Branch_name','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <h3> Joining Info </h3>
                                                        <fieldset style="position: inherit;">
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Offer Date *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('offer_date','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Confirmation Date *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('confirmation_date','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Date Of Joining *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('joining_date','',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <h3> Personal Bio </h3>
                                                        <fieldset style="position: inherit;">
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">CV *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::file('cv',['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <button class="btn btn-success" style="margin: 50px 0px 0px 500px;">Submit</button>
                                                            </div>
                                                        </fieldset>
                                                    {{Form::close()}}
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            },
            methods : {
                GetDesignation : function (id){
                    alert(id);
                    console.log("ok");
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/'+ id,
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