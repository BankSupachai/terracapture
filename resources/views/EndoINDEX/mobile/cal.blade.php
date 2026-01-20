<form id="frm_confirmbooking" action="{{ url('tablet/cal') }}" method="post">
    @csrf
    <input type="hidden" class="form-control" placeholder="" name="event" value="booking_insert">

        {{-- @dd(1); --}}

    <div class=" mt-2">
        <div id="external-events"></div>
        <div id="calendar"></div>

    </div>


        <button id="btn_bookingsubmit" type="submit" style="display: none;">Submit</button>

</form>

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
  $(document).ready(function() {
        $('#cal_physician').select2({
            placeholder: "Physician",
            allowClear: true
        });

        $('#cal_physician').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

    });
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
  $(document).ready(function() {
        $('#cal_procedure01').select2({
            placeholder: "Procedure",
            allowClear: true
        });

        $('#cal_procedure01').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

        $('#cal_procedure02').select2({
            placeholder: "Procedure",
            allowClear: true
        });

        $('#cal_procedure02').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

        $('#cal_procedure03').select2({
            placeholder: "Procedure",
            allowClear: true
        });

        $('#cal_procedure03').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });

        });
    });
</script>

<script>
    function render_caselist(date) {

        window.location.replace("{{url("mobile/book")}}/"+date);
        // $.post("{{ url('api/calbook') }}", {
        //     event: "render_caselist",
        //     date: date,
        // }, function(d, s) {
        //     $("#render_caselist").html(d);
        //     let case_count = $(".count-case").length
        //     $(".modal_countcase").html(case_count)
        //     console.log(case_count);

        // });
    }
</script>


<script>
    $("#btn_confirmbooking").click(function() {
        $("#btn_bookingsubmit").trigger("click");
    });

    $("#type_working").click(function() {
        $("#cal_period").val("am");
    });
    $("#type_working").click(function() {
        $("#cal_period").val("pm");
    });
    $("#type_overtime").click(function() {
        $("#cal_period").val("ot");
    });
</script>



<script>
    function calendarrefresh(data, caselist) {
        const events = calendar.getEvents();
        events.forEach(event => event.remove());
        calendar.addEventSource(JSON.parse(data));
        calendar.addEventSource(JSON.parse(caselist));
    }



    function offcavnas_confirmbook(data) {
        let title = data.event.title;
        if (title == "case list") {
            render_caselist(data.event.startStr)
            $(".label_date").html(data.event.startStr);
            $("#Modal-addEvent-calendar").modal("show");
        }
        if (title == "work") {
            // console.log(data.event.startStr);
            $("#offcavnas_confirmbook").offcanvas("show");
            $("#txt_date").html(data.event.startStr);
            $("#input_date").val(data.event.startStr);
        }
    }
</script>
