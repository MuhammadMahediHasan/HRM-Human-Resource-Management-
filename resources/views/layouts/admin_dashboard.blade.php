@extends('backend')
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
                                                <h6>Published Project</h6>
                                                <h5 class="m-b-30 f-w-700">532<span class="text-c-green m-l-10">+1.69%</span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-red" style="width:25%"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Completed Task</h6>
                                                <h5 class="m-b-30 f-w-700">4,569<span class="text-c-red m-l-10">-0.5%</span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-blue" style="width:65%"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Successfull Task</h6>
                                                <h5 class="m-b-30 f-w-700">89%<span class="text-c-green m-l-10">+0.99%</span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-green" style="width:85%"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <h6>Ongoing Project</h6>
                                                <h5 class="m-b-30 f-w-700">365<span class="text-c-green m-l-10">+0.35%</span></h5>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-yellow" style="width:45%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Project statustic end -->

                            <!-- sale 2 card start -->
                            <div class="col-xl-4 col-md-12">
                                <div class="card latest-update-card">
                                    <div class="card-header">
                                        <h5>What’s New</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-trash close-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="scroll-widget">
                                            <div class="latest-update-box">
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <img src="https://colorlib.com//polygon/admindek/files/assets/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15 update-icon">
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Your Manager Posted.</h6></a>
                                                        <p class="text-muted m-b-0">Jonny michel</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>You have 3 pending Task.</h6></a>
                                                        <p class="text-muted m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>New Order Received.</h6></a>
                                                        <p class="text-muted m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <img src="https://colorlib.com//polygon/admindek/files/assets/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15 update-icon">
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Your Manager Posted.</h6></a>
                                                        <p class="text-muted m-b-0">Jonny michel</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>You have 3 pending Task.</h6></a>
                                                        <p class="text-muted m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>New Order Received.</h6></a>
                                                        <p class="text-muted m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card latest-update-card">
                                    <div class="card-header">
                                        <h5>Latest Activity</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-trash close-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="scroll-widget">
                                            <div class="latest-update-box">
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-primary update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Devlopment & Update</h6></a>
                                                        <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-primary update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Showcases</h6></a>
                                                        <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-success update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Miscellaneous</h6></a>
                                                        <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-danger update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Your Manager Posted.</h6></a>
                                                        <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-primary update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Showcases</h6></a>
                                                        <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-success update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Miscellaneous</h6></a>
                                                        <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sale 2 card end -->

                            <!-- testimonial and top selling start -->
                            <div class="col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>New Products</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-trash close-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block p-b-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Product Code</th>
                                                        <th>Customer</th>
                                                        <th>Status</th>
                                                        <th>Rating</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Sofa</td>
                                                        <td>#PHD001</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5130333211363c30383d7f323e3c">[email&#160;protected]</a></td>
                                                        <td><label class="label label-danger">Out Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Computer</td>
                                                        <td>#PHD002</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="64070007240309050d084a070b09">[email&#160;protected]</a></td>
                                                        <td><label class="label label-success">In Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile</td>
                                                        <td>#PHD003</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3040414270575d51595c1e535f5d">[email&#160;protected]</a></td>
                                                        <td><label class="label label-danger">Out Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Coat</td>
                                                        <td>#PHD004</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fc9e9f8fbc9b919d9590d29f9391">[email&#160;protected]</a></td>
                                                        <td><label class="label label-success">In Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Watch</td>
                                                        <td>#PHD005</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0261666142656f636b6e2c616d6f">[email&#160;protected]</a></td>
                                                        <td><label class="label label-success">In Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shoes</td>
                                                        <td>#PHD006</td>
                                                        <td><a href="https://colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7606070436111b171f1a5815191b">[email&#160;protected]</a></td>
                                                        <td><label class="label label-danger">Out Stock</label></td>
                                                        <td>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>
                                                            <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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