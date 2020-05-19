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
                    <!-- Trigger the modal with a button -->
                    <a href="/salary_structure/create" class="btn btn-primary btn-sm">Add Salary Structure</a>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/designation">Designation</a>
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
                                    <h5>Salary Structure</h5>
                                    <span>table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Amount Of Salary</th>
                                                    <th>Payroll Frequency</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($salary_structure as $key => $salary_structure_data)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$salary_structure_data->employe_name}}</td>
                                                    <td>{{$salary_structure_data->branch_name}}</td>
                                                    <td>{{$salary_structure_data->department_name}}</td>
                                                    <td>{{$salary_structure_data->designation_name}}</td>
                                                    <td>{{$salary_structure_data->amount}}</td>
                                                    <td>{{$salary_structure_data->payroll_frequency}}</td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"salary_structure/$salary_structure_data->id",'method'=>'DELETE'])}}
                                                            <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"salary_structure/$salary_structure_data->id/edit",'method'=>'GET'])}}
                                                            <button class="btn btn-link"><i class="fas fa-edit text-primary"></i></button>
                                                        {{Form::close()}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Amount Of Salary</th>
                                                    <th>Payroll Frequency</th>
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

@stop              