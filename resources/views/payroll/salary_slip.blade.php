@extends('backend')
@section('main_content')  
<div class="pcoded-content" id="salary_slip">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">                   
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

                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Generate Salary Slip</h5>
                                    <span>table</span>
                                </div>
                                <div class="card-block row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="branch">Branch</label>
                                            <select id="branch" name="branch_id" class="form-control" v-model="formData.branch_id">
                                                <option value="">--select--</option>
                                                <option v-for="data in RequiredData.branch"  :value="data.branch_id" v-text="data.branch_name"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="department_id">Department</label>
                                            <select id="department_id" name="department_id" class="form-control" @change="GetDesignation($event.target.value)"  v-model="formData.department_id">
                                                <option value="">--select--</option>
                                                <option v-for="data in RequiredData.department"  :value="data.department_id" v-text="data.department_name"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="designation_id">Designation</label>
                                            <select id="designation_id" name="designation_id" class="form-control" v-model="formData.designation_id">
                                                <option value="">--select--</option>
                                                <option v-for="data in Designation"  :value="data.designation_id" v-text="data.designation_name"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="month">Month</label>
                                            <input type="month" id="month" name="month" class="form-control"  v-model="formData.month">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="payment">Payment</label>
                                            <button  @click="BulkPay()" id="payment" class="btn btn-sm btn-primary"><i class="ti-check"></i>Bulk Payment</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="search">Search</label><br>
                                            <button id="search" class="btn btn-sm btn-primary" @click="GetSalarySlipData()"><i class="ti-search"></i>Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!--  <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Salary Structure</h5>
                                    <span>table</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Salary Slip</h5>
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
                                                    <th>Month</th>
                                                    <th>Payroll Frequency</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr v-for="(data, index) in SalarySlipData">
                                                    <td v-text="index+1"></td>
                                                    <td v-text="data.employe_name"></td>
                                                    <td v-text="data.branchname"></td>
                                                    <td v-text="data.departmentname"></td>
                                                    <td v-text="data.designationname"></td>
                                                    <td v-text="data.amount"></td>
                                                    <td v-text="data.month_name"></td>
                                                    <td v-text="data.payroll_frequency"></td>
                                                    <td>
                                                        <label v-if="data.payment_status == 'Paid'" class="label label-success">Paid</label>
                                                        <label v-if="data.payment_status == 'Unpaid'" class="label label-danger">Unpaid</label>
                                                    </td>
                                                    <td class="action">
                                                        <button class="btn btn-link" @click="Pay(data,index)"><i class="far fa-money-bill-alt"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Amount Of Salary</th>
                                                    <th>Month</th>
                                                    <th>Payroll Frequency</th>
                                                    <th>Status</th>
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
            el: "#salary_slip",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,
                RequiredData : [],
                Designation : [],
                formData : {
                    branch_id : '',
                    designation_id : '',
                    department_id : '',
                    month : '',
                },
                SalarySlipData : {}, 
            },
            methods : {
                GetRequiredData : function (){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/create',
                        type : 'get',
                        success : function (response){
                            _this.RequiredData = response;
                        }
                    })
                },
                GetDesignation : function (id){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip/'+ id,
                        type : 'get',
                        success : function (response){
                            _this.Designation = response;
                        }
                    })
                },
                GetSalarySlipData : function (){
                    $(".dataTables_empty").text("Loading...");
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip_data',
                        type : 'post',
                        data : {
                            _token : _this.csrf_token,
                            data : _this.formData
                        },
                        success : function (response){
                            _this.SalarySlipData = response;
                            if (_this.SalarySlipData.length > 0) {
                                $(".dataTables_empty").text(" ");
                            }
                            else{
                                $(".dataTables_empty").text("No data found.");
                            }
                        },
                    })
                },
                Pay : function (data, index){
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_slip',
                        type : 'post',
                        data : {
                            _token : _this.csrf_token,
                            data : data,
                            month : _this.formData.month,
                        },
                        success : function(response){
                            if (response.success == 200) {
                                _this.SalarySlipData[index]['payment_status'] = 'Paid'; 
                                Toster('success', response.message);
                            }else{
                                Toster('warning', response.message);
                            }
                        }
                    })
                },
                BulkPay : function(){
                    $(".dataTables_empty").text("Loading...");
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/salary_bulk_payment',
                        type : 'post',
                        data : {
                            _token : _this.csrf_token,
                            data : _this.formData,
                        },
                        success : function(response){
                            if (response.count == 0) {
                                Toster('error', 'Already Paid For this month');
                            }else{
                                _this.GetSalarySlipData();
                                Toster('success', response.count +' Of Employees Payment Successfully Completed');
                            }
                        }
                    })                
                },
                getMonth(){
                    const _this = this;
                    var now = new Date();
                    var month = (now.getMonth() + 1);               
                    var day = now.getDate();
                    if (month < 10) 
                      month = "0" + month;
                    var today = now.getFullYear() + '-' + month;
                    _this.formData.month = today;
                },
            },
            mounted(){
                this.GetRequiredData();
                this.getMonth();
            }
            
        })
    </script>
@stop         