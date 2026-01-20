{{-- @extends('layouts.app') --}}
@extends('capture.layoutv6')
@section('title', 'EndoBook')
@section('style')
    <style>
        #menu_home_logo{
            display: none !important;
        }
        body{
            background: #fff;
        }
        /* #kt_header{
            background: #6D7DB1;
        } */
        #kt_quick_user_toggle{
            display: none !important;
        }
        .dropdown-item.notify-item{
            border-radius: 15px;
            background: #fff !important;
        }
        .cn{
            align-items: center;
        }
        .table-bordered td{
            text-align: center;
            padding: 0.6em;
        }
        .content-book *{
            /* font-size: large; */
        }
        h1,.h1{
            font-size: 1em !important;
        }
        .content-book .head_label{
            text-decoration: underline;
            font-weight: 700 !important;
        }
        .content-book{
            padding: 1.5em;
        }
        .menu_count{
            display: none;
        }
        .menu_count.active{
            display: block;
        }
        .form-control{
            border-radius: 0;
        }
        .cn{
            align-items: center;
        }
        .fa{
            opacity: 0.6;
            font-size: 14px;
        }
        body{
            background: #F7F7F7;
        }
        .bg-fff{
            background: #fff;
            padding-bottom: 5px;
        }
        #btn_modal{
            position: absolute;
            right: 0.5em;
            top: 0.5em;
        }
        #rs{
            position: relative;
        }
        /* body{
            zoom: 0.8;
        } */
        .modal-backdrop.fade.show{
            width: 100%;
            height: 100%;
        }
        .menu-left-zone th{
            text-align: center;
            font-size: 0.7em;
        }
        .pl-5.pr-2 input,.pr-5.pl-2 input{
            width: 4.5em;
        }

        .pl-1 input,.pr-1 input{
            width: 3.5em;
        }
        .bg-pink{
            background: rgb(247, 216, 221);
        }
        .bg-skyblue{
            background: rgb(183, 221, 236);
        }
        .right-set{
            overflow-y: auto;
            height: 88vh;
        }
    </style>

@endsection
@section('header_b')

    <a href="{{url('')}}"><i class="fas fa-chevron-left icon-3x text-light"></i></a>
@endsection
@section('modal')
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="content-book pt-0">

    <div class="row m-0">
        @php
            $users = DB::table('users')->get();
            $room   = DB::table('tb_room')->get();
            function set_bg($data){
                if(isset($data)){
                    if($data>=1){
                        echo "bg-skyblue";
                    }else{
                        echo "bg-pink";
                    }
                }
            }
        @endphp
            <div class="col-lg-4">
                <div class="card mt-2">
                    <div class="card-body px-0">
                        <div class="row m-0 border-bottom">
                            <div class="col-12 mb-5"><b class="h4">Available Time</b></div>
                        </div>

                        <div class="row m-0 cn mt-2">
                            <div class="col-6">A.M. (Hour)</div>
                            <div class="col"><input type="text" value="{{@$dep->time_am}}" id="time_am" class="condition form-control form-control-sm text-center"></div>
                            <div class="col-auto">=</div>
                            <div class="col"><input type="text" value="{{@$dep->time_am_min}}" id="time_am_min" class="condition form-control form-control-sm text-center"></div>
                        </div>
                        <div class="row m-0 cn mt-2">
                            <div class="col-6">P.M. (Hour)</div>
                            <div class="col"><input type="text" value="{{@$dep->time_pm}}" id="time_pm" class="condition form-control form-control-sm text-center"></div>
                            <div class="col-auto">=</div>
                            <div class="col"><input type="text" value="{{@$dep->time_pm_min}}" id="time_pm_min" class="condition form-control form-control-sm text-center"></div>
                        </div>
                        <div class="row m-0 cn mt-2">
                            <div class="col-6">Overtime (Hour)</div>
                            <div class="col"><input type="text" value="{{@$dep->time_ot}}" id="time_ot" class="condition form-control form-control-sm text-center"></div>
                            <div class="col-auto">=</div>
                            <div class="col"><input type="text" value="{{@$dep->time_ot_min}}" id="time_ot_min" class="condition form-control form-control-sm text-center"></div>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body px-0">
                        <div class="row m-0 border-bottom">
                            <div class="col-12 mb-5"><b class="h4">Clinic Available</b></div>
                        </div>
                        <div class="row m-0 cn mt-2">
                            <div class="col-6">Service</div>
                            <div class="col"><input type="number" value="{{@$dep->service_am_room}}" id="service_am_room" class="condition form-control form-control-sm text-center"></div>
                            <div class="col">
                                <label class="checkbox  text-dark-50">
                                    <input type="checkbox" name="Checkboxes1"/>
                                    <span></span>
                                    &emsp;Default
                                </label>
                            </div>
                        </div>
                        <div class="row m-0 cn mt-2">
                            <div class="col-6">Special</div>
                            <div class="col"><input type="number" value="{{@$dep->special_am_room}}" id="special_am_room" class="condition form-control form-control-sm text-center"></div>
                            <div class="col">
                                <label class="checkbox text-dark-50">
                                    <input type="checkbox" name="Checkboxes1"/>
                                    <span></span>
                                    &emsp;Default
                                </label>
                            </div>
                        </div>
                        <div class="row m-0 cn mt-2">
                            <div class="col-6">Premium</div>
                            <div class="col"><input type="number" value="{{@$dep->premium_am_room}}" id="premium_am_room" class="condition form-control form-control-sm text-center"></div>
                            <div class="col">
                                <label class="checkbox  text-dark-50">
                                    <input type="checkbox" name="Checkboxes1"/>
                                    <span></span>
                                    &emsp;Default
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body px-0">
                        <div class="row m-0 border-bottom">
                            <div class="col-12 mb-5"><b class="h4">Anesthesia</b></div>
                        </div>
                        @php
                            unset($procedure);

                            $procedure[] = array("anes01","GA");
                            $procedure[] = array("anes02","Sedation");
                            $procedure[] = array("anes03","LA");

                            $view['dep']        = $dep;
                            $view['procedure']  = $procedure;
                        @endphp
                        @component("Endobook.settingdepartment.component.procedure",$view)@endcomponent
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body px-0">
                        <div class="row m-0 border-bottom"><div class="col-12 mb-5"><b class="h4">Special Equipment</b></div></div>
                        @php
                            unset($procedure);
                            $procedure[] = array("equ01","Flu");
                            $procedure[] = array("equ02","Spyglass");
                            $procedure[] = array("equ03","Laser");
                            $view['procedure'] = $procedure;
                        @endphp
                        @component("Endobook.settingdepartment.component.procedure",$view)@endcomponent
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body px-0">
                        <div class="row m-0 border-bottom"><div class="col-12 mb-5"><b class="h4">Procedure Setting</b></div></div>
                        @php
                            unset($procedure);
                            $procedure[] = array("gi001","EGD");
                            $procedure[] = array("gi002","Colonoscopy");
                            $procedure[] = array("gi003","EUS");
                            $procedure[] = array("gi004","ERCP");
                            $procedure[] = array("gi005","EUS FNA");
                            $procedure[] = array("gi006","ESD");
                            $procedure[] = array("gi007","POEM");
                            $view['procedure'] = $procedure;
                        @endphp
                        @component("Endobook.settingdepartment.component.procedure",$view)@endcomponent
                    </div>
                </div>
            </div>
            <div class="col-lg-4 right-set">
                @php


                $date = array();
                foreach($tb_bookset_calendar_department as $data){
                    $data = (object) $data;
                    $date[$data->calendar_date]['in']   = @$data->calendar_roomin;
                    $date[$data->calendar_date]['out']  = @$data->calendar_roomout;
                }

                $pr_id      = sprintf("%02d", 0);
                $year       = date('Y');
                $dates      = getDates($year);
                $weekdays   = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                @endphp
                @foreach($dates as $month => $weeks)
                <div class="bg-fff">
                    <div class="bg-dark text-white row m-0 py-5">
                        {{-- <div class="col-2 h2"><</div> --}}
                        @php
                            $month_name = DateTime::createFromFormat('!m', $month);
                            if($month<date('m')){
                                $year = date('Y')+1;
                            }
                        @endphp
                        <div class="col text-center h2">{{$month_name->format('F')}} &emsp; {{$year}}</div>
                        {{-- <div class="col-2 text-right h2">></div> --}}
                    </div>
                    <table class="table table-bordered">
                        <tr class="table-dark">
                            <th>{!!implode('</th><th>', $weekdays)!!}</th>
                        </tr>
                        @foreach($weeks as $week => $days)
                        <tr>
                            @foreach($weekdays as $day)
                                @isset($days[$day])
                                    @php
                                        $fixdate="$year-$month-$days[$day]";
                                    @endphp
                                    <td>
                                        <div class="row m-0">
                                            <div class="col-auto p-0">
                                                <h1 class="text-left">{{$days[$day]}}</h1>
                                            </div>
                                            <div class="col text-right p-0">
                                                <i class="fa fa-comment-alt mr-2 text-primary"></i>
                                                <i class="fa fa-envelope-open-text mr-2 text-primary"></i>
                                                <i class="fa fa-map-marker-alt mr-2 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="row m-0 cn">
                                            <div class="col-4 p-0">
                                                <h1 class="text-left">IN</h1>
                                            </div>
                                            <div class="col p-0">
                                                <input  type    = "text"
                                                        class   = "calendardate form-control form-control-sm {{set_bg(@$date[$fixdate]['in'])}}"
                                                        inout   = "in"
                                                        weekday = "{{$day}}"
                                                        value   = "{{@$date[$fixdate]['in']}}"
                                                        date    = "{{$fixdate}}">
                                            </div>
                                        </div>
                                        <div class="row m-0 cn mt-1">
                                            <div class="col-4 p-0">
                                                <h1 class="text-left">OUT</h1>
                                            </div>
                                            <div class="col p-0">
                                                <input  type    = "text"
                                                        class   = "calendardate form-control form-control-sm {{set_bg(@$date[$fixdate]['out'])}}"
                                                        inout   = "out"
                                                        weekday = "{{$day}}"
                                                        value   = "{{@$date[$fixdate]['out']}}"
                                                        date    = "{{$fixdate}}">
                                            </div>
                                        </div>

                                    </td>
                                @else
                                    <td></td>
                                @endisset
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endforeach
            </div>



    </div>
</div>
@endsection

@section('script')

<script src="{{url('public/camera/jquery.min.js')}}"></script>
<script src="{{url('public/camera/bootstrap.min.js')}}"></script>
<script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

<script>
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

$(".procedure_special").focusout(function(){
    var code = $(this).attr('code');
    alert(code);
});

$(".procedure_text").focusout(function(){
    var code = $(this).attr('code');
    alert(code);
});





$(".calendardate").focusout(function(){
    var date    = $(this).attr("date");
    var inout   = $(this).attr("inout");
    var value   = $(this).val();
    var weekday = $(this).attr("weekday");

    $.post("{{url("api/bookset")}}",{
        event   : "departmentSETDATE",
        date    : date,
        weekday : weekday,
        inout   : inout,
        value   : value
    },function(data,status){});
});


$(".condition").focusout(function(){
    var key     = $(this).attr("id");
    var value   = $(this).val();

    $.post("{{url("api/bookset")}}",{
        event   : "department_condition_room",
        depID   : "GI",
        key     : key,
        value   : value
    },function(data,status){});
});

$(".procedure").focusout(function(){
    var procedure_name  = $(this).attr("procedure_name");
    var procedure_code  = $(this).attr("procedure_code");
    var min             = $("#min_"+procedure_code).val();
    var rooms           = $("#rooms_"+procedure_code).val();
    var times           = $("#times_"+procedure_code).val();
    $.post("{{url("api/bookset")}}",{
        event           : "department_condition_procedure",
        depID           : "GI",
        procedure_code  : procedure_code,
        procedure_name  : procedure_name,
        min             : min,
        rooms           : rooms,
        times           : times,
    },function(data,status){});
});



$(".calendardate").keyup(function(){
    var this_val = $(this).val()
    if(this_val>=1){
        $(this).removeClass('bg-pink')
        $(this).addClass('bg-skyblue')
    }else{
        $(this).removeClass('bg-skyblue')
        $(this).addClass('bg-pink')
    }
})

</script>


@endsection
