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
                        <h2>Employee Attendence Report</h2>
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
                                    <h5>Search Attendence with Department..</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="text-center">Attendence Report</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                          <table class="table table-bordered">
                                            <thead>
                                              <tr style="background: #263544; color: white">
                                                <th>Date</th>
                                                <th>Department</th>
                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td><input type="date" name="date" class="form-control date"></td>
                                                <td>
                                                    <select name="department" class="form-control department">
                                                        <option value="">Select</option>
                                                        @foreach($department as $department_data)
                                                        <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><button class="btn btn-success btn-sm generate_report">Generate Report</button></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    <div class="col-lg-2"></div>
                                </div>
                                <div class="row employe_data">
                                    
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
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".generate_report", function(){
            var department=$(".department").val();
            var date=$(".date").val();
            $.ajax({
                url:'/attendence_report_data',
                method:'get',
                dataType:"html",
                data:{
                    "_token":"{{ csrf_token() }}",
                    'department':department,
                    'date':date,
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