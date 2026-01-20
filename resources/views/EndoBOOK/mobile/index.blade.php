@extends('layouts.layout_booking_mobile')
@section('title', 'EndoBook')
@section('style')
    <link href="{{url('')}}/public/css/book/home_mobile.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">

@endsection

@section('modal')
@endsection

@section('content')


{{--  --}}

<div class="row m-0 mt-5 mb-5">
    <div class="col-lg-12">
        <h4 class="mb-0">
            CALENDAR
        </h4>
    </div>
    <div class="col-lg-12 p-3 mt-4">
        <div class="main-wrapper">

        <div class="sidebar-wrapper z-depth-2 side-nav fixed" id="sidebar">

            <div class="sidebar-title">
            <h4>Events</h4>
            <h5 id="eventDayName">Date</h5>
            </div>
            <div class="sidebar-events" id="sidebarEvents">
            <div class="empty-message">Sorry, no events to selected date</div>
            </div>

        </div>

        <div class="content-wrapper lighten-3">
            <div class="container">

            <div class="calendar-wrapper z-depth-2">

                <div class="header-background">
                <div class="calendar-header">

                    <a class="prev-button" id="prev">
                    <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                    <a class="next-button" id="next">
                    <i class="material-icons">keyboard_arrow_right</i>
                    </a>

                    <div class="row header-title">

                    <div class="header-text">
                        <h3 id="month-name">February</h3>
                        <h5 id="todayDayName">Today is Friday 7 Feb</h5>
                    </div>

                    </div>
                </div>
                </div>

                <div class="calendar-content">
                <div id="calendar-table" class="calendar-cells">

                    <div id="table-header">
                    <div class="row">
                        <div class="col">Mon</div>
                        <div class="col">Tue</div>
                        <div class="col">Wed</div>
                        <div class="col">Thu</div>
                        <div class="col">Fri</div>
                        <div class="col">Sat</div>
                        <div class="col">Sun</div>
                    </div>
                    </div>

                    <div id="table-body" class="">

                    </div>

                </div>
                </div>

            </div>

            </div>
        </div>

        </div>
    </div>
    <div class="col-lg-12">
        <h4 class="mb-0">
            TODAY LIST
        </h4>
    </div>
    <div class="col-lg-12">
        <div class="card card-calendar-detail">
            <div class="card-body pl-0 pr-0 text-light">
                <div class="row">
                    <div class="col-12 text-right">
                        <i class="fas fa-angle-double-down text-light" data-type='up' onclick="show_hide('onday')" id="onday"></i>
                    </div>
                    <div class="col-12 text-center h3 p-0 bg-success pt-2 pb-2 mt-2">กิจกรรมวันนี้ของคุณ (0 Event)</div>
                </div>
                <div class="row onday">
                    <div class="col-12 h3"><b>Topic</b></div>
                    <div class="col-12 h4 text-center">ไม่มีกิจกรรมใดๆในวันนี้</div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-5">
        <div class="card card-calendar-detail">
            <div class="card-body pl-0 pr-0 text-light">
                <div class="row">
                    <div class="col-12 text-right">
                        <i class="fas fa-angle-double-down text-light" data-type='up' onclick="show_hide('onall')" id="onall"></i>
                    </div>
                    <div class="col-12 text-center h3 p-0 bg-primary pt-2 pb-2 mt-2">กิจกรรมจาก Appointment System (3 Event)</div>
                </div>
                <div class="row onall">
                    <div class="col-12 h3"><b>Topic</b></div>
                    <div class="col-12 h4"><b>Gastroscopy</b></div>
                    <div class="col-12">
                        <div class="table-responsive">
                            @for ($i=0;$i<3;$i++)
                            <table class="table table-borderless text-light h5 table-detail">
                                <tr>
                                    <th>Name</th>
                                    <td>นำโชค เงินขาว</td>
                                    <th>Room</th>
                                    <td>ห้อง 1</td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td>09.00 AM</td>
                                    <th>Department</th>
                                    <td>ห้องเก็บเงิน</td>
                                </tr>
                            </table>
                            @endfor
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<br>
<br>




{{--  --}}
@endsection

@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/js/book/calendar_mobile.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script>
$(".button-collapse").sideNav();
</script>
<script>
    $(".onday").hide();
    $(".onall").hide();
    function show_hide(event){
        // if(event=='onday'){
            $("."+event).toggle();
            var this_type = $("#"+event).attr("data-type");
            if(this_type=='down'){
                $("#"+event).removeClass("fa-angle-double-up");
                $("#"+event).addClass("fa-angle-double-down");
                $("#"+event).attr("data-type","up");
                $("."+event).hide();
            }else{
                $("#"+event).removeClass("fa-angle-double-down");
                $("#"+event).addClass("fa-angle-double-up");
                $("#"+event).attr("data-type","down");
                $("."+event).show();
            }
        // }
    }
</script>
@endsection
