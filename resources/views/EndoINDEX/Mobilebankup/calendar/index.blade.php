@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')

<style>

    :root {

    --fc-border-color: #EEF0F8;
    --fc-daygrid-event-dot-width: 5px;

}
    #calendar{height: 76vh;}
    .fc-prev-button::before {
            display: none;
        }
        .fc .fc-col-header-cell {background: #ffffff;}
        .fc a[data-navlink]{
            color: #878a99 !important;
        }
        .fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
            color: #ffffff !important;
        }
        .fc-next-button::before {
            display: none;
        }

        .fc .fc-daygrid-day-frame: {color: #878a99;}
        .fc .fc-button-primary { color: #878A99; background-color: #EEF0F8 !important; border-color: none !important; }
        .fc .fc-button-group>.fc-button.fc-button-active, .fc .fc-button-group>.fc-button:active, .fc .fc-button-group>.fc-button:focus, .fc .fc-button-group>.fc-button:hover {color: #245788;}
</style>
@endsection
@section('modal')
@endsection
@section('Offcanvas')

@endsection


@section('content')
<div class="card">
    <div class="card-body">
        <div id="external-events"></div>
        <div id="calendar"></div>
    </div>
</div>
@endsection






@section('script')
    <script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
    <script src='{{ url('assets/extra/fullcalendar/index.global.js') }}'></script>

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
    </script>


<script>
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
                $('#appointment_card').attr('href', `{{ url('book/prepare') }}/${id}?template=egd`)
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


    <script src='{{ url('assets/extra/fullcalendar/index.global.js') }}'></script>
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
                modal_calendareventclick(arg);
            },
            dateClick: function(info) {
                alert('Clicked on: ' + info.dateStr);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('Current view: ' + info.view.type);
                // change the day's background color just for fun
                info.dayEl.style.backgroundColor = 'red';
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: mday
        });
        calendar.render();

    </script>




<script>
    let caselist = {};
    setTimeout(() => {
        $.post("{{ url('api/calbook') }}", {
            event: "caselist",
        }, function(d, s) {
            caselist = d;
            calendarrefresh(d, '{}');
        });
    }, 1000);


    function getcaselist(){

    }


</script>

<script>
    $(".calbook").on('change click', function() {

        $.post("{{ url('api/calbook') }}", {
            event: "caselist",
            physician: $("#cal_physician").val(),
        }, function(data01,s) {
            $.post("{{ url('api/calbook') }}", {
                event: "calbook",
                physician: $("#cal_physician").val(),
                procedure1: $("#cal_procedure01").val(),
                procedure2: $("#cal_procedure02").val(),
                procedure3: $("#cal_procedure03").val(),
                period: $("#cal_period").val(),
            }, function(d, s) {
                calendarrefresh(d,data01);
            });
        });











    });
</script>
<script>
    function render_caselist(date) {
        $.post("{{ url('book/cal') }}", {
            event: "render_caselist",
            date: date,
        }, function(d, s) {
            $("#render_caselist").html(d);
            let case_count = $(".count-case").length
            $(".modal_countcase").html(case_count)
            console.log(case_count);

        });
    }
</script>


<script>
    $("#btn_confirmbooking").click(function() {
        $("#btn_bookingsubmit").trigger("click");
    });

    $("#type_working").click(function() {
        $("#cal_period").val("am");
    });
    $("#type_overtime").click(function() {
        $("#cal_period").val("out");
    });
</script>



<script>
    function calendarrefresh(data, caselist) {
        const events = calendar.getEvents();
        events.forEach(event => event.remove());
        calendar.addEventSource(JSON.parse(data));
        calendar.addEventSource(JSON.parse(caselist));
    }

    function modal_calendareventclick(data) {

        alert(data);
        let title = data.event.title;
        if (title == "case list") {
            render_caselist(data.event.startStr)
            $(".label_date").html(data.event.startStr);
            $("#Modal-addEvent-calendar").modal("show");
        }
        if (title == "work") {
            $("#modal_calendareventclick").modal("show");
            $("#txt_date").val(data.event.startStr);
        }
    }









</script>

@endsection
