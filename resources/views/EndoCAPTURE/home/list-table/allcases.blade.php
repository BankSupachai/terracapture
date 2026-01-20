<link href="{{ url('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
<script src="{{url("assets/js/bootstrap-datepicker.js")}}"></script>
<script src="{{url("assets/js/bootstrap-datepicker.min.js")}}"></script>

<div id="job_all" class="row m-0 mb-3" style="display: none">
    <div class="col-lg-2">
        <div class="input-icon">
            <input id="search_hnall" type="text" class="form-control bg-gray-input search_all" autocomplete="off"
                placeholder="HN" />

            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="input-icon">
            <input id="search_nameall" type="text" class="form-control bg-gray-input search_all" autocomplete="off"
                placeholder="Name" />

            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="row mt-res">
            <div class="col-6 ">

                <select id="search_physician" name="" class="form-control search_all">
                    <option value="">Physician</option>
                    @foreach ($doctor as $d)
                        <option value="{{ $d->user_firstname }} {{ $d->user_lastname }}">
                            {{ $d->user_prefix }} {{ $d->user_firstname }} {{ $d->user_lastname }} {{ $d->user_code }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select id="search_procedure" name="" class="form-control search_all">
                    <option value="">Procedure</option>
                    @foreach ($procedure as $p)
                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <input type="text" class="form-control bg-gray-input" id="start_search_allcasedate" placeholder="Start-Date">
    </div>
    <div class="col-lg-1">
        <input type="text" class="form-control bg-gray-input" id="stop_search_allcasedate" placeholder="End-Date">

    </div>

    <div class="col-lg-1">
        <select class="form-select search_all" name="search_room" id="search_room">
            <option value="">Select Room</option>
            @foreach ($room as $data)
            <option value="{{$data->room_id}}">{{$data->room_name}}</option>
            @endforeach
        </select>

    </div>
    {{-- <div class="col-lg-3">

        @php
            $now = date('Y-m-d');
        @endphp
        <input type="text" class="form-control flatpickr-input search_date_all bg-gray-input search_all"
            id="search_date" data-provider="flatpickr" data-date-format="Y-m-d" data-range-date="true"
            readonly="readonly" placeholder="Date Select">
        <input type="hidden" id="date_from" value="">
        <input type="hidden" id="date_to" value="">
    </div> --}}

    <div class="list-table pt-0 active mt-2">
        <div class="allcase-header mt-2 ">
            <table class="table " style="overflow-x:auto;">
                <thead>
                    <tr class="bg-light TextTable-header">
                        <td> &ensp; &ensp; Action </td>
                        <td>Operation Date</td>
                        <td>HN</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>Physician</td>
                        <td>Procedure</td>
                        <td>Room</td>
                        <td>Urease Test</td>
                        <td>Pre - Diagnosis</td>
                        <td>Complication</td>
                        <td>Description</td>
                    </tr>
                </thead>
                <tbody id="all_tbody"></tbody>
            </table>
        </div>
    </div>
</div>



<script>
     $('#start_search_allcasedate').datepicker({
        format: "yyyy-mm-dd",
    });
    $('#stop_search_allcasedate').datepicker({
        format: "yyyy-mm-dd",
    });
</script>
<script>
    $(document).ready(function() {
        $('#search_room').select2({
            placeholder: "Select Room",
            allowClear: true
        });

        // เพิ่ม animation เวลาเปิด dropdown (optional)
        $('#search_room').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });
    });
</script>

    <script>


    $(document).ready(function() {
        $('#search_physician').select2({
            placeholder: "Select Physician",
            allowClear: true
        });

        $('#search_physician').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

    });


    $(document).ready(function() {
        $('#search_procedure').select2({
            placeholder: "Select Procedure",
            allowClear: true
        });

        $('#search_procedure').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

    });

    $("#show_joball").click(function() {
        $("#job_today").hide();
        $("#job_all").show();
        $("#show_jobtodaygroup").hide();
        jobAll();
    });

    // $(".search_all").change(jobAll());
    $(".search_all").on("change focusout keyup", function(e) {
        jobAll();
    });

    $('#start_search_allcasedate').on("change focusout keyup", function(e) {
        jobAll();
    });

    $('#stop_search_allcasedate').on("change focusout keyup", function(e) {
        jobAll();
    });

    function jobAll() {
        $.post("{{ url('home') }}", {
            event: "job_all",
            search_hn: $("#search_hnall").val(),
            search_name: $("#search_nameall").val(),
            search_physician: $("#search_physician").val(),
            search_room: $("#search_room").val(),

            search_procedure: $("#search_procedure").val(),
            search_datefrom: $('#start_search_allcasedate').val(),
            search_dateto: $('#stop_search_allcasedate').val()
            // console.log(search_room);
        }, function(data, status) {
            console.log(data);
            $("#all_tbody").html(data);
            $(".modal_ureasetest").click(function() {
                let subname = $(this).attr('sub-name')
                $(`#urease_${subname}`).prop('checked', true)
                $("#ureasetest").modal('show');
                $('#span_hn').html($(this).attr('hn'))
                $('#span_patientname').html($(this).attr('patientname'))
                $('#span_contact').html($(this).attr('contact'))
                $('#urease_text').val($(this).attr('other'))
                $('#case_id').val($(this).attr('cid'))
            });
        });
    }

    function change_urease_text(type) {
        let text = ''
        if (type.includes('positive')) {
            text = 'Positive (+)'
        } else if (type.includes('negative')) {
            text = 'Negative (-)'
        } else if (type.includes('pending')) {
            text = ' Positive [   ]         Negative [   ]'
        }
        $('#urease_text').val(text)
    }

</script>
