@php
    use App\models\Mongo;
    use Illuminate\Support\Carbon;
@endphp

@extends('mobile/book_emptylayout')
@section('title', 'EndoBook')
@section('style')
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('public/css/booking/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/booking/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/booking/jquerysctipttop.css') }}"> --}}
    <style>




        .fc-prev-button::before,
        .fc-next-button::before {
            display: none;
        }
        .fc-button-primary{
            background: #eef0f8 !important;
            color: #878a99 !important;
            border: 0px !important;
        }
        .fc .fc-col-header-cell{
            background: transparent !important;
        }
        /* .fc th, .fc td {
  border-style: none;
}
.fc .fc-scrollgrid{
    border: 0 !important;
} */
    </style>
@endsection
@section('title-left')
    <h4 class="mb-sm-0 fw-bold">DENSITY CALENDAR</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
        <li class="breadcrumb-item active">Density Calendar</li>
    </ol>
@endsection

@section('content')


            @include('mobile/cal')
       

@endsection

@section('modal')
    @include('EndoBOOK\home\modal\modal_select_doctor')
    @include('EndoBOOK\home\modal\modal_cancel_calendar')
    @include('EndoBOOK\home\modal\modal_confirm_calendar')
    @include('EndoBOOK\home\modal\modal_event_calendar')
    @include('EndoBOOK\home\modal\modal_addevent_calendar')
@endsection

@section('script')

    <script>
        $(".radio_patienttype").click(function() {
            var patient_type = $(this).val()
            $("#txt_patienttype").html(patient_type)
            // alert(patient_type)
        });
        $(".radio-type").click(function() {
            var time_type = $(this).val()
            $("#time_type").html(time_type)
        })

        $(".radio_urgency").click(function() {
            var txt_urgency = $(this).val()

            // alert(txt_urgency);
            $("#txt_urgent").html(txt_urgency)
        })
        $("#cal_physician").change(function() {
            var select_physician = $("#cal_physician option:selected").text();
            $("#txt_physician").html(select_physician)
            //    alert(select_physician);
        })

        $("#cal_physician").change(function() {
            var select_physician = $("#cal_physician option:selected").text();
            $("#txt_physician").html(select_physician)
            //    alert(select_physician);
        })


        $("#ga_anesthesia").click(function() {
            var txt_ga = $(this).val();
            $("#txt_anes_ga").html(txt_ga)
        })
        $("#sedation_anesthesia").click(function() {
            var txt_sedation = $(this).val();
            $("#txt_anes_sedation").html(txt_sedation)
        })
        $("#la_anesthesia").click(function() {
            var txt_la = $(this).val();
            $("#txt_anes_la").html(txt_la)
        })

        $("#cal_physician").change(function() {
            var select_physician = $("#cal_physician option:selected").text();
            $("#txt_physician").html(select_physician)
            //    alert(select_physician);
        })

        $("#cal_procedure01").change(function() {
            var select_procedure01 = $("#cal_procedure01 option:selected").text();
            console.log(select_procedure01, 'a');
            $("#txt_procedure01").html(select_procedure01)
        })

        $("#cal_procedure02").change(function() {
            var select_procedure02 = $("#cal_procedure02 option:selected").text();
            console.log(select_procedure02, 'b');
            $("#txt_procedure02").html(select_procedure02)
        })
        $("#cal_procedure03").change(function() {
            var select_procedure03 = $("#cal_procedure03 option:selected").text();
            console.log(select_procedure03, 'c');
            $("#txt_procedure03").html(select_procedure03)

        })


        $("#special_ck01").click(function() {
            var txt_spec_flu = $(this).val();
            $("#txt_spec_flu").html(txt_spec_flu)
        })
        $("#special_ck02").click(function() {
            var txt_spec_spy = $(this).val();
            $("#txt_spec_spyglass").html(txt_spec_spy)
        })
        $("#special_ck03").click(function() {
            var txt_spec_laser = $(this).val();
            $("#txt_spec_laser").html(txt_spec_laser)
        })
    </script>

<script>
  $(document).ready(function() {
        $('#s_physician').select2({
            placeholder: "Physician",
            allowClear: true
        });

        $('#s_physician').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });
    });
</script>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_book");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function search_data() {
            var doctor = $("#s_physician").val()
            var search_all = $("#search_all").val()
            // console.log(doctor , search_all);

            $('#table_book tbody tr').each(function() {
                if (doctor != 'none') {
                    find_physician = ($(this).find('td').eq(3).text()).includes(doctor);
                } else {
                    find_physician = false;
                }
                if (search_all != '') {
                    find_hn = ($(this).find('td').eq(1).text()).includes(search_all);
                    find_name = ($(this).find('td').eq(2).text()).includes(search_all);
                    if (doctor == 'none') {
                        find_physician = true;
                    }
                } else {
                    find_hn = false;
                    find_name = false;
                }
                if (find_physician && (find_hn || find_name)) {
                    $(this).show();
                } else {
                    $(this).hide()
                }
            });
            if (doctor == 'none' && search_all == '') {
                $('#table_book tbody tr').show()
            }

        }

        function select_day(day, month, year) {
            $("#search_day").val(day)
            $("#search_month").val(month)
            $("#search_year").val(year)
            $("#date_select").val(year + "-" + month + "-" + day);
            $("#filters").submit()
        }

        function change_month(status, month, year) {
            var s_day = $("#search_day").val()
            var s_month = $("#search_month").val()
            var s_year = $("#search_year").val()
            $.post("{{ url('book/doctor') }}", {
                event: 'gen_calendar',
                year: year,
                month: month,
                s_day: s_day,
                s_month: s_month,
                s_year: s_year,
                status: status,
            },function(data, status) {
                $("#show_calendar").html(data)
            });
        }

        $("#call_modal_select_doctor").click(function() {
            $("#modal_select_doctor").modal("show");
        });
    </script>

    <script>
        let noteid_temp = "";
        $("#btn_modalcancel").click(function() {
            noteid_temp = $(this).attr("noteid");
            $("#confirm_booking").modal("hide");
            $("#modalcancel").modal("show");
        });

        $("#btn_bookingcancel").click(function() {
            $.post("{{ url('api/photo') }}", {
                event: "cancel_booking",
                noteid: noteid_temp
            }, function(data, status) {
                window.location.reload();
            });
        });

        $("#btn_modalcancel_close").click(function() {
            $("#modalcancel").modal("hide");
        });
    </script>


    <script>
        var myModal = new bootstrap.Modal(document.getElementById("confirm_booking"), {});

        function modal_detail(id, _id) {
            $.post('{{url("api/calbook")}}', {
                event: "get_book",
                bookid: _id
            }, function (data, status) {
                let values      = JSON.parse(data)
                let id          = values.bookid
                let procedures  = values.procedure_name ?? []
                let procs       = procedures.filter(item => item !== null && item !== undefined).join(', ');
                console.log(values);
                $("#confirm_booking_title01").text(`HN : ${values.hn || ''}   ${values.patient_name || ''} (${values.age || ''})`);
                $("#confirm_booking_title02").text(`Contact : ${values.phone || ''}`);
                $("#modal_note_id").val(id || '')
                $("#modal_date").text(values.date || '')
                $("#modal_physician").text(values.physician_name || '')
                $("#moda_period").text(values.period || '')
                $("#modal_procedure").text(procs || '')
                $("#modal_urgent").text(values.urgent || '')
                $("#modal_patient_type").text(values.service || '')
                $("#modal_anesthesia").text(values.anesthesia || 'N/A')
                $("#modal_special").text(values.special || 'N/A')
                if (values.user_id != '') {
                    $("#modal_user_id").val(values.user_id).change()
                }
                $("#btn_modalcancel").attr('noteid', `${id}`)
                $('#edit_history').attr('href', `{{ url('book/registration') }}/${id}`)
                $('#appointment_card').attr('href', `{{ url('book/prepare') }}/${id}`)
            })
            myModal.show();
        }

        $(".book-confirm").on('click', function() {
            var id = $("#modal_note_id").val();
            var td_id = $("#modal_select_id").val();
            var user_id = $('#modal_user_id').val()
            var abstain_from_food = '';
            var switt = '';
            var pressure_medication = '';
            var clear_water = '';
            if ($("#abstain_from_food").is(':checked')) {
                abstain_from_food = $("#abstain_from_food").val()
            }
            if ($("#switt").is(':checked')) {
                switt = $("#switt").val()
            }
            if ($("#pressure_medication").is(':checked')) {
                pressure_medication = $("#pressure_medication").val()
            }
            if ($("#clear_water").is(':checked')) {
                clear_water = $("#clear_water").val()
            }
            $.post("{{ url('api/jquery') }}", {
                event: 'book_confirm',
                id: id,
                abstain_from_food: abstain_from_food,
                switt: switt,
                pressure_medication: pressure_medication,
                clear_water: clear_water,
                user_id: user_id
            }, function(data, status) {
                if (data == 'success') {
                    if ($("#" + id).hasClass('active')) {

                    } else {
                        $("#" + id).addClass('active')
                    }
                }
            });
        })
    </script>


    <script src='{{ url('assets/extra/fullcalendar/index.global.min.js') }}'></script>
    <script>
        let mday = {};
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            CustomButtons: {
                myCustombutton: {
                    text: 'button',
                    click: function() {
                        alert(1);
                    }
                }
            },
            initialDate: '{{ date('Y-m-d') }}',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function(arg) {},
            eventClick: function(arg) {
                offcavnas_confirmbook(arg);
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: mday
        });
        calendar.render();
    </script>




@endsection
