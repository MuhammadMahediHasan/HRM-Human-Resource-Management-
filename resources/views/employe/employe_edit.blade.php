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

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>  
        {!! Toastr::message() !!} 

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
                                                    {{Form::open(['url'=>"/add_employe/$employe_data->employe_basic_info_id",'files'=>true,'method'=>'put','class'=>'wizard-form','id'=>'example-advanced-form'])}}    
                                                        <h3> Besis Info </h3>
                                                        <fieldset style="position: inherit;">
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Employee Code *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('employe_code',$employe_data->employe_code,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Employee Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('employe_name',$employe_data->employe_name,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Branch *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    <select name="branch_name" class="form-control">
                                                                        <option value="{{$employe_data->branch_id}}">{{$employe_data->branch_name}}</option>
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
                                                                    <select name="department_name" class="form-control">
                                                                        <option value="{{$employe_data->department_name}}">Select</option>
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
                                                                        <option value="{{$employe_data->designation_id}}">{{$employe_data->designation_name}}</option>
                                                                        @foreach($designation as $designation_data)
                                                                        <option value="{{$designation_data->designation_id}}">{{$designation_data->designation_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Father Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('father_name',$employe_data->father_name,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Mother Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('mother_name',$employe_data->mother_name,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Date Of Birth *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('date_of_birth',$employe_data->date_of_birth,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">National ID *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('national_id',$employe_data->national_id,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Nationality *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::select('nationality',[$employe_data->nationality=>$employe_data->nationality,'Bangladeshi'=>'Bangladeshi'],null,['class'=>'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Gender *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::select('employe_gender',[$employe_data->employe_gender=>$employe_data->employe_gender,'Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Blood Group *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::select('blood_group',[$employe_data->blood_group=>$employe_data->blood_group,'A+'=>'A+','A-'=>'A-','B+'=>'B+','O+'=>'O+','O-'=>'O-'],null,['class'=>'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Religion *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::select('religion',[$employe_data->religion=>$employe_data->religion,'Islam'=>'Islam'],null,['class'=>'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Marital status *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::select('merital_statas',[$employe_data->merital_statas=>$employe_data->merital_statas,'Married'=>'Married','Single'=>'Single'],null,['class'=>'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Photo *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::file('employe_photo',['class'=>'form-control ','id'=>'profile-img'])}}

                                                                    {{Form::hidden('employe_photo',asset($employe_data->employe_photo))}}
                                                                     <img src="{{asset($employe_data->employe_photo)}}" id="profile-img-tag" style="width: 200px;margin-top: 20px;" />
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
                                                                    {{Form::text('phone_number',$employe_data->phone_number,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Email *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::email('email',$employe_data->email,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Present Address *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::textarea('present_address',$employe_data->present_address,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Parmanent Address *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::textarea('parmanent_address',$employe_data->parmanent_address,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <span style="margin: 15px;" class="text-center"><h3>Banking Info</h3></span>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Account Number *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_account_number',$employe_data->bank_account_number,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Bank Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_name',$employe_data->bank_name,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                           <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Branch Name *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::text('bank_Branch_name',$employe_data->bank_Branch_name,['class'=>'form-control required'])}}
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
                                                                    {{Form::date('offer_date',$employe_data->offer_date,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Confirmation Date *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('confirmation_date',$employe_data->confirmation_date,['class'=>'form-control required'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 col-lg-2">
                                                                    <label for="userName-2" class="block">Date Of Joining *</label>
                                                                </div>
                                                                <div class="col-md-8 col-lg-10">
                                                                    {{Form::date('joining_date',$employe_data->joining_date,['class'=>'form-control required'])}}
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
                                                                    {{Form::file('cv',['class'=>'form-control '])}}
                                                                    {{Form::hidden('cv',asset($employe_data->cv))}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <button class="btn btn-success" style="margin: 50px 0px 0px 500px;">Submit</button>
                                                            </div>
                                                        </fieldset>
                                                        {{Form::hidden('employe_contact_info_id',$employe_data->employe_contact_info_id)}}
                                                        {{Form::hidden('employe_bank_info_id',$employe_data->employe_bank_info_id)}}
                                                        {{Form::hidden('employe_joining_info_id',$employe_data->employe_joining_info_id)}}
                                                        {{Form::hidden('employe_personal_bio_id',$employe_data->employe_personal_bio_id)}}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
</script>



@stop              