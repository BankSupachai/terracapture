<style>
    /* #table_casetoday tr:nth-child(odd){
        background: red;
    }
    #table_casetoday tr:nth-child(even){
        background: blue;
    } */
    .fs-12 {
        font-size: 12px;
    }

    .bold {
        font-weight: bold;
    }

    .fs-11 {
        font-size: 11px;
    }
</style>

<div id="job_today" class="row m-0 ps-1 mb-3" >
    <div class="col-lg-2">
        <div class="input-icon" style="padding-right: 5px;">
            <input id="search_text" type="text" class="form-control bg-gray-input" placeholder="HN" autocomplete="off">
            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="input-icon">
            <input id="search_name" type="text" class="form-control bg-gray-input" placeholder="Name"
                autocomplete="off">

            <span><i class="flaticon2-search-1 icon-md"></i></span>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="row mt-res">
            <div class="col-5 ps-3">
                <select name="sel_physician" class="form-control search_today bg-gray-input " id="select_home_physician" style="color: #9599AD;">

                    <option value="">Endoscopist</option>

                        <option value="{{ $d->user_firstname }} {{ $d->user_lastname }}">

                        </option>

                </select>
            </div>
            <div class="col-5">
                <select name="sel_procedure" class="form-control search_today bg-gray-input" id="select_home_procedure" style="color: #9599AD;">
                    <option value="">Procedure</option>

                        <option value="{{ $data->name }}">

                        </option>

                </select>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-danger" id="btn_clear_today">Clear</button>
            </div>

        </div>
    </div>



    <div class="pt-3 "></div>
    <div class="list-table pt-0 active">
        <div class="alltodaycase-header">
            <table class="table table-today">
                <thead class="table-light TextTable-header " id="scroll-bottom" style="overflow-x: scroll; font-size:14px;">
                    <tr class="bg-light TextTable-header">
                        <td> &ensp; &ensp;&ensp; HN </td>
                        <td>Name</td>
                        <td>&ensp;&ensp;Status </td>
                        <td> Procedure</td>
                        <td>Physician</td>
                        <td>Room</td>
                        <td>Urease Test</td>
                        <td>Pre - Diagnosis&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</td>
                        <td>&ensp; &ensp;&ensp;&ensp;&ensp; Action</td>
                    </tr>
                </thead>
                <tbody id="table_casetoday" style="font-size:14px;">
                    <!-- @include('capture.home.table.07alltoday') -->

                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
      // Add clear button functionality
      $('#btn_clear_today').click(function() {
        // Clear all search inputs
        $('#search_text').val('');
        $('#search_name').val('');
        $('#select_home_physician').val('').trigger('change');
        $('#select_home_procedure').val('').trigger('change');

        // Trigger search with cleared values
        jobAll();
    });
</script>
<script>
    $(document).ready(function() {


        $("#select2_room").on("change", function() {
            var value = $(this).val().toLowerCase();
            // alert(value)
            $(".table-today tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
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
            let find = $(this).find('td').get(0)
            let this_text = String($(find).data('text'))
            $(this).toggle(this_text.indexOf(value) > -1)
            // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#search_name').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_casetoday tr").filter(function() {
            let find = $(this).find('td').get(1)
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
