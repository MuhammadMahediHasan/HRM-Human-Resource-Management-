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
                <!-- Attendence -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Employee Attendence</h2>
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
                                    <h5>Add Employee Attendence</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="text-center">Make Your Attendence</h4>
                                        </div>
                                    </div>
                                </div>
                                {{Form::open(['url'=>"/attendence"])}}
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                          <table class="table table-bordered">
                                            <thead>
                                              <tr style="background: #263544; color: white">
                                                <th>Department</th>
                                                <th>Date</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>
                                                    <select name="department" class="form-control department">
                                                        <option>Select</option>
                                                        @foreach($department as $department_data)
                                                        <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    <div class="col-lg-2"></div>
                                </div>
                                <div class="row employe_data">
                                    
                                </div>
                                {{Form::close()}}
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
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change",".department", function(){
            var department=$(".department").val();
            $.ajax({
                url:'/get_department_wise_data',
                method:'get',
                dataType:"html",
                data:{
                    "_token":"{{ csrf_token() }}",
                    'department':department,
                },
                success:function(data)
                {
                    console.log(data);
                    $(".employe_data").html(data);
                }
            });
        });
    });
</script>


@stop