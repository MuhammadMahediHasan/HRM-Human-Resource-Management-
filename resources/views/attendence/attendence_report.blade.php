@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="/attendence/create" class="btn-sm btn btn-primary">Attendence</a>
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
                        <li class="breadcrumb-item"><a href="#">Attendence</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/attendence">Attendence Sheet</a>
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
                                    <h5>Attendence Sheet</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="text-center">Attendence Sheet</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                          <table class="custom_table table-bordered">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Branch</th>
                                                <th>Department</th>
                                                <th>Generate Sheet</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td><input type="date" name="date" class="form-control date" value="<?php echo date('Y-m-d'); ?>"></td>
                                                <td>
                                                    <select name="branch" class="form-control branch">
                                                        <option value="">Select</option>
                                                        @foreach($branch as $branch_data)
                                                        <option value="{{$branch_data->branch_id}}">{{$branch_data->branch_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="department" class="form-control department">
                                                        <option value="">Select</option>
                                                        @foreach($department as $department_data)
                                                        <option value="{{$department_data->department_id}}">{{$department_data->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><button class="btn btn-success btn-sm generate_report">Submit</button></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    <div class="col-lg-2"></div>
                                </div>
                                <br>
                                <div class="row employe_data">
                                    
                                </div>
                                <br>
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
        $(document).ready(function(){
            $(document).on("click",".generate_report", function(){
                var branch=$(".branch").val();
                var department=$(".department").val();
                var date=$(".date").val();

                $.ajax({
                    url:'/attendence_report_data',
                    method:'get',
                    dataType:"html",
                    data:{
                        "_token":"{{ csrf_token() }}",
                        'branch':branch,
                        'department':department,
                        'date':date,
                    },
                    success:function(data)
                    {
                        $(".employe_data").html(data);
                    }
                });
            });
        });
    </script>
@stop