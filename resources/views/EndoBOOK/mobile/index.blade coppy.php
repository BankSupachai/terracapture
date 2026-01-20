@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
<style>
    .ct{
        align-items: center;
    }
    .fc-unthemed .fc-event.fc-start .fc-content:before, .fc-unthemed .fc-event-dot.fc-start .fc-content:before {
        position: absolute;
        opacity: 0;
    }
    .fc-unthemed .fc-event .fc-content, .fc-unthemed .fc-event-dot .fc-content {
        padding: 0.55rem 0.55rem 0.55rem 5px;
    }
    .fc-header-toolbar{
        display: none;
    }
</style>
@endsection

@section('modal')
<div class="modal fade" id="isday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="row m-0">
    <div class="col-lg-9">
        <div class="card card-custom h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="kt_calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="row m-0">
            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-header p-3">
                        <h2 class="m-0">FILTER</h2>
                    </div>
                    <form action="{{url('home')}}" method="POST" class="card-body" id="form_insert">
                        @csrf
                        @method('POST')
                        <div class="row m-0 ct">
                            <div class="col-lg-4">Doctor</div>
                            <div class="col-lg-8">
                                <select class="form-control selectpicker" data-size="7" id="insert_dc" name="book_doctor_search" data-live-search="true">
                                    @if ($doctor != '')
                                        <option value="">Select Doctor</option>
                                        @foreach ($doctor as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    @else
                                    <option>ไม่มีขู้มูล Doctor</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row m-0 mt-2 ct">
                            <div class="col-lg-4">
                                RATE
                            </div>
                            <div class="col-lg-8">
                                <select name="" id="" class="form-control selectpicker">
                                    <option value="select" data-content="<i class='fas fa-circle text-secondary'></i>&emsp; select">Select</option>
                                    <option value="high" data-content="<i class='fas fa-circle text-danger'></i>&emsp; high">High</option>
                                    <option value="medium" data-content="<i class='fas fa-circle text-warning'></i>&emsp; medium">Medium</option>
                                    <option value="low" data-content="<i class='fas fa-circle text-success'></i>&emsp; low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-0 mt-3">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4">
                                <button class="btn btn-primary btn-sm w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-12 p-0 mt-3">
                <div class="card h-100">
                    <div class="card-header p-3">
                        <h2 class="m-0">Create Booking</h2>
                    </div>
                    <form action="{{url('home')}}" method="POST" class="card-body" id="form_insert">
                        @csrf
                        @method('POST')
                        <div class="row m-0 ct">
                            <div class="col-lg-4">Doctor</div>
                            <div class="col-lg-8">
                                <select class="form-control selectpicker" data-size="7" id="insert_dc" name="book_doctor" data-live-search="true">
                                    @if ($doctor != '')
                                        <option value="">Select Doctor</option>
                                        @foreach ($doctor as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    @else
                                    <option>ไม่มีขู้มูล Doctor</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row m-0 mt-2 ct">
                            <div class="col-lg-4">Topic</div>
                            <div class="col-lg-8"><input type="text" name="book_topic" id="" class="form-control form-control-sm"></div>
                        </div>
                        <div class="row m-0 mt-2 ct">
                            <div class="col-lg-4">
                                RATE
                            </div>
                            <div class="col-lg-8">
                                <select name="" id="" class="form-control selectpicker">
                                    <option value="select" data-content="<i class='fas fa-circle text-secondary'></i>&emsp; select">Select</option>
                                    <option value="high" data-content="<i class='fas fa-circle text-danger'></i>&emsp; high">High</option>
                                    <option value="medium" data-content="<i class='fas fa-circle text-warning'></i>&emsp; medium">Medium</option>
                                    <option value="low" data-content="<i class='fas fa-circle text-success'></i>&emsp; low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-0 mt-2 ct">
                            <div class="col-lg-4">Date Time</div>
                            <div class="col-lg-8"><input type="datetime-local" name="book_date_start" id="book_date_start" class="form-control form-control-sm"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8 mt-2"><input type="datetime-local" name="book_date_end" id="book_date_end" class="form-control form-control-sm"></div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="col-lg-4">Comment</div>
                            <div class="col-lg-8">
                                <textarea name="book_comment" id="" rows="10" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
{{-- <script src="{{asset('public/js/book/calendar.js')}}"></script> --}}

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(".card-scroll").hide();
    function date_select(){
        $(".fc-event-container").click(function(){
            $("#isday").modal('toggle')
        })
        $(".fc-day-top").click(function(){
            alert()
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var calendar_date = $(this).attr('data-date')+' '+time;
            $('#kt_daterangepicker_4 .form-control').val( '['+calendar_date + '],[' + calendar_date+']');
            $('#date_start').val(calendar_date);
            $('#date_end').val(calendar_date);
            $("#insert_dc").val('').change();
            $("#insert_procedure").val('').change();
            $("#insert_room").val('').change();
            $("#insert_comment").val();
            $("#date_start").val(calendar_date);
            $("#date_end").val(calendar_date);
            $("#btn_submit").val('insert').text('Create').attr('class','btn btn-primary');
        });
    }
    $("#search_doctor, #search_procedure, #search_room").change(function(){
        var doctor_val = $('#search_doctor').val();
        var procedure_val = $('#search_procedure').val();
        var room_val = $('#search_room').val();
        $.post('{{url('jquery')}}',{
            event           : 'search_calendar',
            doctor_val      : doctor_val,
            procedure_val   : procedure_val,
            room_val        : room_val,
            },function(data,status){
                var show_data = JSON.parse(data);
                var fruits = [];
                show_data.forEach(show_event);
                function show_event(item, index) {
                    event_is={'title':item.bookdoctor_name,
                    'start':item.ap_date_start,
                    'end:':item.ap_date_end,
                    'description':item.ap_id,
                    'appointment_id' : item.ap_id,
                    'className':"fc-event"+item.bookroom_id,
                    };
                    fruits.push(event_is);
                }
                calendar(fruits);
                date_select();
                save_point();
            });
    });
    // function start_page(){
    //     $.post('{{url('jquery')}}',{
    //         event           : 'search_calendar',
    //         },function(data,status){
    //             var show_data = JSON.parse(data);
    //             var fruits = [];
    //             show_data.forEach(show_event);

    //             function show_event(item, index) {
    //                 event_is={'title':item.bookdoctor_name,
    //                 'start':item.ap_date_start,
    //                 'end:':item.ap_date_end,
    //                 'description':item.ap_id,
    //                 'appointment_id' : item.ap_id,
    //                 'className':"fc-event"+item.bookroom_id,
    //                 };
    //                 fruits.push(event_is);
    //             }

    //             calendar(fruits);
    //             date_select();
    //         });
    // }
    // $(document).ready(function(){
    //     start_page();
    // });
    $("#show_doctor_list").click(function(){
        start_page();
        $('#search_doctor').val('').change();
        $('#search_procedure').val('').change();
        $('#search_room').val('').change();

        $('#kt_daterangepicker_4 .form-control').val('');
            $('#date_start').val();
            $('#date_end').val();
            $("#insert_dc").val('').change();
            $("#insert_procedure").val('').change();
            $("#insert_room").val('').change();
            $("#insert_comment").val();
            $("#date_start").val();
            $("#date_end").val();
            $("#btn_submit").val('insert').text('Create').attr('class','btn btn-primary');
        save_point();
    });
</script>


<script>
    var KTCalendarBasic = function() {

return {
    //main function to initiate the module
    init: function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('kt_calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            themeSystem: 'bootstrap',

            isRTL: KTUtil.isRTL(),

            // header: {
            //     left: 'prev,next today',
            //     center: 'title',
            //     right: 'dayGridMonth,timeGridWeek,timeGridDay'
            // },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            defaultView: 'dayGridMonth',
            defaultDate: TODAY,

            editable: true,
            eventLimit: true,
            navLinks: true,
            events: [
                @foreach ($tb_casebooking as $cb)
                {
                    title: 'กิจกรรมจาก Appointment System',
                    start: "{{$cb->book_date_start}}",
                    description: "{{$cb->book_comment}}",
                    className: "fc-event-solid-info"
                },
                @endforeach
            ],

            eventRender: function(info) {
                var element = $(info.el);

                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.description);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                }
            }
        });

        calendar.render();
    }
};
}();

jQuery(document).ready(function() {
KTCalendarBasic.init();
});
</script>
<script>
    if( /Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        window.location.href = "{{url('layout_mobile')}}";
    }
    $("#book_date_start").change(function(){
        $("#book_date_end").val($(this).val())
    })
</script>
@endsection
