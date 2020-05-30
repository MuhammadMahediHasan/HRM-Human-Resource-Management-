@extends('backend')
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

    <style type="text/css">
        * {
              box-sizing: border-box;
              font-family: 'Roboto', sans-serif;
              list-style: none;
              margin: 0;
              outline: none;
              padding: 0;
            }

            a {
              text-decoration: none;
            }

            body, html {
              height: 100%;
            }

            body {
                background: #dfebed;
                font-family: 'Roboto', sans-serif;
            }

            .container {
                align-items: center;
                display: flex;
                height: 100%;
                justify-content: center;
                margin: 0 auto;
                max-width: 600px;
                width: 100%;
            }

            .calendar {
                background: #2b4450;
                border-radius: 4px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, .3);
                height: 501px;
                perspective: 1000;
                transition: .9s;
                transform-style: preserve-3d;
                width: 100%;
            }

            /* Front - Calendar */
            .front {
                transform: rotateY(0deg);
            }

            .current-date {
                border-bottom: 1px solid rgba(73, 114, 133, .6);
                display: flex;
                justify-content: space-between;
                padding: 30px 40px;
            }

            .current-date h1 {
                color: #dfebed;
                font-size: 1.4em;
                font-weight: 300;
            }

            .week-days {
                color: #dfebed;
                display: flex;
                justify-content: space-between;
                font-weight: 600;
                padding: 30px 40px;
            }

            .days {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .weeks {
                color: #fff;
                display: flex;
                flex-direction: column;
                padding: 0 40px;
            }

            .weeks div {
                display: flex;
                font-size: 1.2em;
                font-weight: 300;
                justify-content: space-between;
                margin-bottom: 20px;
                width: 100%;
            }

            .last-month {
                opacity: .3;
            }

            .weeks span {
                padding: 10px;
            }

            .weeks span.active {
                background: #ed6321;
                /*border-radius: 50%;*/
            }

            .weeks span:not(.last-month):hover {
                cursor: pointer;
                font-weight: 600;
            }

            .event {
                position: relative;
            }

            .event:after {
                content: '•';
                color: #f78536;
                font-size: 1.4em;
                position: absolute;
                right: -4px;
                top: -4px;
            }

            /* Back - Event form */

            .back {
                height: 100%;
                transform: rotateY(180deg);
            }

            .back input {
                background: none;
                border: none;
                border-bottom: 1px solid rgba(73, 114, 133, .6);
                color: #dfebed;
                font-size: 1.4em;
                font-weight: 300;
                padding: 30px 40px;
                width: 100%;
            }

            .info {
                color: #dfebed;
                display: flex;
                flex-direction: column;
                font-weight: 600;
                font-size: 1.2em;
                padding: 30px 40px;
            }

            .info div:not(.observations) {
                margin-bottom: 40px;
            }

            .info span {
                font-weight: 300;
            }

            .info .date {
                display: flex;
                justify-content: space-between;
            }

            .info .date p {
                width: 50%;
            }

            .info .address p {
                width: 100%;
            }

            .actions {
                bottom: 0;
                border-top: 1px solid rgba(73, 114, 133, .6);
                display: flex;
                justify-content: space-between;
                position: absolute;
                width: 100%;
            }

            .actions button {
                background: none;
                border: 0;
                color: #fff;
                font-weight: 600;
                letter-spacing: 3px;
                margin: 0;
                padding: 30px 0;
                text-transform: uppercase;
                width: 50%;
            }

            .actions button:first-of-type {
                border-right: 1px solid rgba(73, 114, 133, .6);
            }

            .actions button:hover {
                background: #497285;
                cursor: pointer;
            }

            .actions button:active {
                background: #5889a0;
                outline: none;
            }

            /* Flip animation */

            .flip {
                transform: rotateY(180deg);
            }

            .front, .back {
                backface-visibility: hidden;
            }


    </style>

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
                                    <h5>Branch List</h5>
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
                                                    <span v-for="day_date in day.days" v-text="day_date['_d'].getDate()" :class="changeClass(day_date['_d'])"></span>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="back">
                                          <input placeholder="What's the event?">
                                          <div class="info">
                                            <div class="date">
                                              <p class="info-date">
                                              Date: <span>Jan 15th, 2016</span>
                                              </p>
                                              <p class="info-time">
                                                Time: <span>6:35 PM</span>
                                              </p>
                                            </div>
                                            <div class="address">
                                              <p>
                                                Address: <span>129 W 81st St, New York, NY</span>
                                              </p>
                                            </div>
                                            <div class="observations">
                                              <p>
                                                Observations: <span>Be there 15 minutes earlier</span>
                                              </p>
                                            </div>
                                          </div>

                                          <div class="actions">
                                            <button class="save">
                                              Save <i class="ion-checkmark"></i>
                                            </button>
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
        var app = {
            settings: {
                container: $('.calendar'),
                calendar: $('.front'),
                days: $('.weeks span'),
                form: $('.back'),
                input: $('.back input'),
                buttons: $('.back button')
            },

            init: function() {
                instance = this;
                settings = this.settings;
                this.bindUIActions();
            },

            swap: function(currentSide, desiredSide) {
                settings.container.toggleClass('flip');

                currentSide.fadeOut(900);
                currentSide.hide();

                desiredSide.show();
            },

            bindUIActions: function() {
                $(document).on('click', '.active', function () {
                    alert('oo');
                    instance.swap(settings.calendar, settings.form);
                    settings.input.focus();
                });

                settings.buttons.on('click', function(){
                    instance.swap(settings.form, settings.calendar);
                });
            }
        }

        app.init();
    </script>

    <script type="text/javascript">
        new Vue({
            el: "#vue-calendar",
            data : {
                current_month : '',
                current_day : '',
                calendar_days : [],
                number_of_current_month : '',
                number_of_current_day : '',
            },
            methods : {
                dateFunction : function(){
                    const _this = this;
                    const weekDay = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    const d = new Date();

                    _this.current_month = monthNames[d.getMonth()]+','+d.getFullYear();
                    _this.current_day = weekDay[d.getDay()];
                    _this.number_of_current_month = d.getMonth();
                    _this.number_of_current_day = d.getDate();

                    const startWeek = moment().startOf('month').week();
                    const endWeek = moment().endOf('month').week();
                    let cal = []
                    for(var week = startWeek; week<endWeek;week++){
                      cal.push({
                        week:week,
                        days:Array(7).fill(0).map((n, i) => moment().week(week).startOf('week').clone().add(n + i, 'day'))
                      })
                    }
                    _this.calendar_days = cal;
                },

                changeClass : function(date) {
                    const _this = this;
                    if (_this.number_of_current_month == date.getMonth() && _this.number_of_current_day == date.getDate()) {
                        return 'active';
                    }
                    else if (_this.number_of_current_month != date.getMonth()) {
                        return 'last-month';
                    }
                },
            },
            mounted(){
                this.dateFunction();
            }
        });
    </script>
@stop         