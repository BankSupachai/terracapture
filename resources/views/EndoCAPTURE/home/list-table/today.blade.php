<style>
    /* #table_casetoday tr:nth-child(odd){
        background: red;
    }
    #table_casetoday tr:nth-child(even){
        background: blue;
    } */
</style>

<div id="job_today" class="row m-0 mb-3 width-scroll">
    <div class="col-lg">
        <div class="input-icon">
            <input id="search_text" type="text" class="form-control bg-gray-input" placeholder="HN" autocomplete="off">

            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg">
        <div class="input-icon">
            <input id="search_name" type="text" class="form-control bg-gray-input" placeholder="Name"
                autocomplete="off">

            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="row mt-res">
            <div class="col-6 ">
                <select name="sel_physician" class="form-control search_today " id="select_home_physician">

                    <option value="">Physician</option>
                    @foreach ($doctor as $d)
                        <option value="{{ $d->user_firstname }} {{ $d->user_lastname }}">
                            {{ $d->user_prefix }} {{ $d->user_firstname }} {{ $d->user_lastname }}
                            {{ $d->user_code }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select name="sel_procedure" class="form-control search_today" id="select_home_procedure">
                    <option value="">Procedure</option>
                    @foreach ($procedure as $data)
                        <option value="{{ $data->name }}">
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <select class="form-select" name="" id="select2_room">
            <option value="">Room</option>
            @foreach ($room as $data)
                <option value="{{ $data->room_name }}">{{ $data->room_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-2"></div>

    <div class="list-table pt-0 active mt-2">
        <div class="alltodaycase-header">
            <table class="table table-today">
                <thead class="table-light TextTable-header " id="scroll-bottom" style="overflow-x: scroll;">
                    <tr class="bg-light TextTable-header">
                        <td> &ensp; &ensp; &ensp; &ensp; Action </td>
                        <td>HN</td>
                        <td>Name </td>
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
                <tbody id="table_casetoday">
                    @include('EndoCAPTURE.home.table.07alltoday')
                </tbody>
            </table>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {


        $("#select2_room").on("change", function() {
            var value = $(this).val();
            if(value) {
                $("#table_casetoday tr").filter(function() {
                    let find = $(this).find('td').get(6);
                    let this_text = $(find).text().trim();
                    $(this).toggle(this_text === value);
                });
            } else {
                $("#table_casetoday tr").show();
            }
        });

        $('#select2_room').select2({
            placeholder: "Select Room",
            allowClear: true
        });

        $('#select2_room').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });


        $('#select_home_physician').select2({
            placeholder: "Select Physician",
            allowClear: true
        });

        $('#select_home_physician').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

    });


    $(document).ready(function() {
        $('#select_home_procedure').select2({
            placeholder: "Select Procedure",
            allowClear: true
        });

        $('#select_home_procedure').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });

    });
</script>

<script>
    $(document).ready(function() {

        $(".slide").each(function() {
            var $slide = $(this),
                $select = $slide.find('.js-example-basic-single'),
                animationName = $slide.find('h6').text();

            $select.select2({
                placeholder: "Select a state",
                dropdownParent: $slide,
                data: select2Data,
                minimumResultsForSearch: -1,
                dropdownPosition: 'below'
            }).on('select2:open', function(e) {
                $slide.find('.select2-dropdown').addClass('animated ' + animationName);
            }).on('select2:closing', function(e) {
                // if removed, for some examples, the Select2 will not highlight the selected element
                $slide.find('.select2-dropdown').removeClass('animated ' + animationName);
            });

        });

    });
</script>



<script>
    $("#search_text").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_casetoday tr").filter(function() {
            let find = $(this).find('td').get(1)
            let this_text = String($(find).data('text'))
            $(this).toggle(this_text.indexOf(value) > -1)
            // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#search_name').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_casetoday tr").filter(function() {
            let find = $(this).find('td').get(2)
            let this_text = $(find).data('text')
            $(this).toggle(this_text.indexOf(value) > -1)
            // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".select-status").on("click", function() {
        var value = $(this).attr("status");
        $("#table_casetoday tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        if (value == 'recovery') {
            $("#table_casetoday tr").filter(function() {
                if ($(this).text().toLowerCase().indexOf('recovery') > -1) {
                    return
                }
                $(this).toggle($(this).text().toLowerCase().indexOf('discharged') > -1)
            });
        }
    });

    $(".search_today").on("change", function() {
        var value = $(this).val().toLowerCase();
        $("#table_casetoday tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
