@extends('backend')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend_asset/hr_calendar.css') }}">
@stop  
@section('main_content')  

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">           
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create New Branch</button>
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
                                    <h5>HR Calendar</h5>
                                    <span>Table</span>
                                </div>
                                <div class="card-block">
                                    <div class="calendar" id="vue-calendar">
                                        <div class="front">
                                            <div class="current-date">
                                                <h1 v-text="current_day"></h1>
                                                <h1 v-text="current_month"></h1>   
                                            </div>

                                            <div class="current-month">
                                                <ul class="week-days">
                                                  <li>SUN</li>
                                                  <li>MON</li>
                                                  <li>TUE</li>
                                                  <li>WED</li>
                                                  <li>THU</li>
                                                  <li>FRI</li>
                                                  <li>SAT</li>
                                                </ul>

                                                <div class="weeks">
                                                  <div v-for="(day, index) in calendar_days">
                                                        <span v-for="day_date in day.days" 
                                                              v-text="day_date['_d'].getDate()" 
                                                              :class="changeClass(day_date['_d'])"
                                                              @click="getDayWiseMeeting(day_date['_d'])">    
                                                        </span>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="back">
                                            <div class="current-date">
                                                <h1 v-text="current_day"></h1>
                                                <h1 v-text="current_month"></h1>   
                                            </div>
                                          <div class="info">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Description</th>  
                                                        <th>Date</th>  
                                                        <th>Time</th>  
                                                    </tr>
                                                    <tr v-for="day_meeting in DayWiseMeetings">
                                                        <td v-text="day_meeting.title"></td>
                                                        <td v-text="day_meeting.description"></td>
                                                        <td v-text="day_meeting.date"></td>
                                                        <td v-text="day_meeting.time"></td>
                                                    </tr>
                                                </table>
                                          </div>

                                          <div class="actions">
                                            <button class="dismiss">
                                              Dismiss <i class="ion-android-close"></i>
                                            </button>
                                          </div>
                                        </div>

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
@section('script')
    <script type="text/javascript">
        $(document).on('click', '.event', function () {
            $('.calendar').toggleClass('flip');
            $('.front').fadeOut(900);
            $('.front').hide();
            $('.back').show();
        });
        $(document).on('click', '.dismiss', function () {
            $('.calendar').toggleClass('flip');
            $('.back').fadeOut(900);
            $('.back').hide();
            $('.front').show();
        });
    </script>

    <script type="text/javascript">
        new Vue({
            el: "#vue-calendar",
            data : {
                csrf_token : token,
                baseUrl : baseUrl,

                current_month : '',
                current_day : '',
                calendar_days : [],
                number_of_current_month : '',
                number_of_current_day : '',

                Meetings : [],
                DayWiseMeetings : [],
            },
            methods : {
                dateFunction : function(){
                    const _this = this;
                    const weekDay = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    const d = new Date();

                    _this.current_month = d.getDate() +'-'+ monthNames[d.getMonth()]+'-'+d.getFullYear();
                    _this.current_day = weekDay[d.getDay()];

                    _this.number_of_current_month = d.getMonth();
                    _this.number_of_current_day = d.getDate();

                    const startWeek = moment().startOf('month').week();
                    const endWeek = moment().endOf('month').week();
                    let cal = []
                    for(var week = startWeek; week<endWeek+1;week++){
                      cal.push({
                        week:week,
                        days:Array(7).fill(0).map((n, i) => moment().week(week).startOf('week').clone().add(n + i, 'day'))
                      })
                    }
                    _this.calendar_days = cal;
                    console.log(_this.calendar_days);
                },

                changeClass : function(date) {
                    const _this = this;
                    if (_this.number_of_current_month == date.getMonth() && _this.number_of_current_day == date.getDate()) {
                        return 'active';
                    }
                    else if (_this.number_of_current_month != date.getMonth()) {
                        return 'last-month';
                    }

                    if (_this.Meetings.includes(date.getDate())) {
                        return 'event';
                    }
                },

                getMeeting : function() {
                    const _this = this;
                    $.ajax({
                        url : _this.baseUrl + '/meeting/create',
                        type : 'get',
                        success : function( response ) {
                            _this.Meetings = response;
                        }
                    });
                },

                getDayWiseMeeting : function(date){
                    const _this = this;
                    _this.DayWiseMeetings = [],
                    $.ajax({
                        url : _this.baseUrl + '/meeting/' + date.getDate(),
                        type : 'get',
                        success : function( response ) {
                            _this.DayWiseMeetings = response;
                        }
                    });
                }
            },
            mounted(){
                this.dateFunction();
                this.getMeeting();
            }
        });
    </script>
@stop         