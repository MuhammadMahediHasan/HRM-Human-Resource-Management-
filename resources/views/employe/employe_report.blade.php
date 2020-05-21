@extends('backend')
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">       
                    <!-- Trigger the modal with a button -->
                    <a href="/add_employe/create" class="btn btn-primary btn-sm">Add New Employee</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/backend"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/branch">Branch</a>
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
                            <div class="card">
                                <div class="card-header">
                                    <h5>Employee List</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="custom_table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Company Info</th>
                                                    <th>Contact Info</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Joining Date</th>
                                                    <th>Gender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($employee as $key=> $employee_data)
                                                <tr class="action_table_row">
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        {{$employee_data->employe_name}}
                                                        <br>
                                                        ID : {{$employee_data->employe_code}}
                                                    </td>
                                                    <td>
                                                        Branch : {{$employee_data->branch_name}}
                                                        <br>
                                                        Department : {{$employee_data->department_name}}
                                                        <br>
                                                        Designation : {{$employee_data->designation_name}}
                                                    </td>
                                                    <td>
                                                        Phone : {{$employee_data->phone}}
                                                        <br>
                                                        Email : {{$employee_data->email}}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($employee_data->date_of_birth)->format('d/F/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($employee_data->joining_date)->format('d/F/Y') }}</td>
                                                    <td>
                                                        @if($employee_data->gender== 1)
                                                            Male
                                                        @else
                                                            Female
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="action">
                                                        {{Form::open(['url'=>"add_employe/$employee_data->branch_id",'method'=>'DELETE'])}}
                                                        <button class="btn btn-link"><i class="fas fa-trash text-danger" onclick="return confirm('Are You Sure?')"></i></button>
                                                        {{Form::close()}}

                                                        {{Form::open(['url'=>"add_employe/$employee_data->branch_id/edit",'method'=>'GET'])}}
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
                                                    <th>Company Info</th>
                                                    <th>Contact Info</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Joining Date</th>
                                                    <th>Gender</th>
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