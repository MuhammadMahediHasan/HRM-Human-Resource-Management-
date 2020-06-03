@extends('backend')
@section('style')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@stop
@section('main_content')                   
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Dashboard</h5>
                            <span>{{ date('D').'day'}} | {{ date('d - M - Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index-2.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="pcoded-inner-content" id="vue-dashboard">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card card-red">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Total Branch</h6>
                                                <h3 class="m-b-0 f-w-700 text-white" v-text="DashboardData.total_branch"></h3>
                                            </div>
                                            <div class="col-auto">
                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                            </div>
                                        </div>
                                        <!-- <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From Previous Month</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card card-blue">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Total Department</h6>
                                                <h3 class="m-b-0 f-w-700 text-white" v-text="DashboardData.total_department"></h3>
                                            </div>
                                            <div class="col-auto">
                            <i class="fas fa-database text-c-blue f-18"></i>
                                            </div>
                                        </div>
                                        <!-- <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card card-green">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Total Team</h6>
                                                <h3 class="m-b-0 f-w-700 text-white" v-text="DashboardData.total_team"></h3>
                                            </div>
                                            <div class="col-auto">
                            <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                            </div>
                                        </div>
                                        <!-- <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From Previous Month</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card card-yellow">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Total Employee</h6>
                                                <h3 class="m-b-0 f-w-700 text-white" v-text="DashboardData.total_employees"></h3>
                                            </div>
                                            <div class="col-auto">
                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                            </div>
                                        </div>
                                        <!-- <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ page content ] start -->
                        <div class="row">

                            <!-- Project statustic start -->
                            <div class="col-xl-12">
                                <div class="card proj-progress-card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Completed Project</h6>
                                                <h5 class="m-b-30 f-w-700"><span v-text="DashboardData.total_complete_project"></span><span class="text-c-green m-l-10" v-text="DashboardData.total_complete_project_percent+'%'"></span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-red" :style="'width:'+DashboardData.total_complete_project_percent+'%'"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Completed Task</h6>
                                                <h5 class="m-b-30 f-w-700"><span v-text="DashboardData.total_complete_task"></span><span class="text-c-green m-l-10" v-text="DashboardData.total_complete_task_percent+'%'"></span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-blue" :style="'width:'+DashboardData.total_complete_task_percent+'%'"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Ongoing Task</h6>
                                                <h5 class="m-b-30 f-w-700"><span v-text="DashboardData.total_ongoing_task"></span><span class="text-c-green m-l-10" v-text="DashboardData.total_ongoing_task_percent+'%'"></span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-green" :style="'width:'+DashboardData.total_ongoing_task_percent+'%'"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Ongoing Project</h6>
                                                <h5 class="m-b-30 f-w-700"><span v-text="DashboardData.total_ongoing_project"></span><span class="text-c-green m-l-10" v-text="DashboardData.total_ongoing_project_percent+'%'"></span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-yellow" :style="'width:'+DashboardData.total_ongoing_project_percent+'%'"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Project statustic end -->

                            <!-- sale 2 card start -->
                            <div class="col-xl-6 col-md-12">
                                <div class="card latest-update-card">
                                    <div class="card-header">
                                        <h5>Attendence Today</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="scroll-widget">
                                            <div class="latest-update-box">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div id="attendencePieChart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="card latest-update-card">
                                    <div class="card-header">
                                        <h5>Salary This Month</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="scroll-widget">
                                            <div class="latest-update-box">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div id="salaryPieChart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sale 2 card end -->
                        </div>
                        <!-- [ page content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var attendence_data = google.visualization.arrayToDataTable([
                ['Attendence', 'Daily'],
                ['Present',     '{{ $present }}'],
                ['Absent',      '{{ $absent }}'],
            ]);

            var salary_data = google.visualization.arrayToDataTable([
                ['Salary', 'This Month'],
                ['Paid',     '{{ $paid }}'],
                ['Unpaid',      '{{ $unpaid }}'],
            ]);

            var attendencePieChart = new google.visualization.PieChart(document.getElementById('attendencePieChart'));
            attendencePieChart.draw(attendence_data);

            var salaryPieChart = new google.visualization.PieChart(document.getElementById('salaryPieChart'));
            salaryPieChart.draw(salary_data);
        }
    </script>

    <script type="text/javascript">
        new Vue({
            el: "#vue-dashboard",
            data : {
                DashboardData : [],
            },

            methods : {
                getData :function() {
                    const _this = this;
                    $.ajax({
                        url : 'get_dashboard_data',
                        type : 'get',
                        success : function ( response ){
                            _this.DashboardData = response;
                        }
                    });

                },
            },

            mounted(){
                this.getData();
            }
            
        })
    </script>
@stop    