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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Transfer Employee</button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="width: 150%;margin-left: -25%;">
                          <div class="modal-header">
                            <h4 class="modal-title">Transfer Employee</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            {{Form::open(['url'=>"/employe_transfer"])}}
                            <div class="form-group row">
                                <div class="col-md-4 col-lg-2">
                                    <label for="userName-2" class="block">Employee Code *</label>
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    {{Form::text('employe_code','',['class'=>'form-control required employe_code'])}}

                                    {{Form::hidden('id','',['class'=>'id'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 col-lg-2">
                                    <label for="userName-2" class="block">Employee Name *</label>
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    {{Form::text('employe_name','',['class'=>'form-control required employe_name','readonly'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 col-lg-2">
                                    <label for="userName-2" class="block">Issue Date *</label>
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    {{Form::date('issue_date','',['class'=>'form-control required'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 col-lg-3">
                                    <label for="userName-2" class="block">Previous Branch *</label>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    {{Form::text('previous_branch_name','',['class'=>'form-control required previous_branch_name','readonly'])}}

                                    {{Form::hidden('previous_branch','',['class'=>'previous_branch'])}}
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label for="userName-2" class="block">Previous Department *</label>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    {{Form::text('previous_department_name','',['class'=>'form-control required previous_department_name','readonly'])}}

                                    {{Form::hidden('previous_department','',['class'=>'previous_department'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 col-lg-3">
                                    <label for="userName-2" class="block">Present Branch *</label>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <select name="present_branch" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($branch as $branch_data)
                                        <option value="{{$branch_data->branch_id}}">{{$branch_data->branch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label for="userName-2" class="block">Present Branch *</label>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <select name="present_department" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($department as $department_data)
                                        <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <center>
                                <button class="btn btn-success" style="margin-top: 50px;">Submit</button>
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
                        <li class="breadcrumb-item"><a href="/add_employe">Employee</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/employe_transfer">Transfer Employee</a>
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
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee Code</th>
                                                    <th>Issue Date</th>
                                                    <th>Previous Branch</th>
                                                    <th>Previous Department</th>
                                                    <th>Present branch</th>
                                                    <th>Present Department</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($employe_transfer as $key=> $employe_transfer_data)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$employe_transfer_data->employe_code}}</td>
                                                    <td>{{ Carbon\Carbon::parse($employe_transfer_data->issue_date)->format('d-M-Y') }}</td>
                                                    <td>
                                                        @php
                                                            $previous_branch_name=DB::table('branch')->where('branch_id',$employe_transfer_data->present_branch)->first();
                                                        @endphp
                                                        {{$previous_branch_name->branch_name}}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $previous_department_name=DB::table('department')->where('department_id',$employe_transfer_data->previous_department)->first();
                                                        @endphp
                                                        {{$previous_department_name->department_name}}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $present_branch_name=DB::table('branch')->where('branch_id',$employe_transfer_data->present_branch)->first();
                                                        @endphp
                                                        {{$present_branch_name->branch_name}}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $present_department_name=DB::table('department')->where('department_id',$employe_transfer_data->present_department)->first();
                                                        @endphp
                                                        {{$present_department_name->department_name}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee Code</th>
                                                    <th>Issue Date</th>
                                                    <th>Previous Branch</th>
                                                    <th>Previous Department</th>
                                                    <th>Present branch</th>
                                                    <th>Present Department</th>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("keyup",".employe_code", function(){
            var employe_code = $(".employe_code").val();
            $.ajax({
                url:'/get_employe_transfer_data',
                type:'post',
                data:{
                    "_token":"{{ csrf_token() }}",
                    'employe_code':employe_code,
                },
                success:function(data)
                {
                    $(".employe_name").val(data.employe_name);
                    $(".previous_branch_name").val(data.branch_name);
                    $(".previous_branch").val(data.branch_id);
                    $(".previous_department_name").val(data.department_name);
                    $(".previous_department").val(data.department_id);
                    $(".id").val(data.id);
                }
            });
        });
    });
</script>


@stop              