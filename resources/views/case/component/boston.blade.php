<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 10px;
        gap: 10px;
    }

    .form-select {
        margin-top: 5px
    }

    .center {
        text-align: center;
    }

.btn-soft-primary-capture {
    --vz-btn-color: #192D4B;
    --vz-btn-bg: rgba(64, 81, 137, 0.1);
    --vz-btn-border-color: transparent;
    --vz-btn-hover-color: #fff;
    --vz-btn-hover-bg: #192D4B;
    --vz-btn-hover-border-color: transparent;
    --vz-btn-focus-shadow-rgb: 64, 81, 137;
    --vz-btn-active-color: var(--vz-btn-hover-color);
    --vz-btn-active-bg: #192D4B;
    --vz-btn-active-border-color: transparent;
}
</style>
@include('reportendocapture.component.modal_boston')
<div class="col-12 p-0">
    {!! editcard('histopathology', 'histopathology.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5><b>Boston Bowel Prep Score</b></h5>

            <div class="row">
                <div class="col-4">
                    3 = Excellent <br>
                    2 = Good <br>
                    1 = Poor <br>
                    0 = Inadequate <br>
                    <!-- center modal -->

                        {{-- <button type="button" class="btn btn-soft-primary w-100 mt-2" data-bs-toggle="modal"
                            data-bs-target="#modal_bostun">Example Score</button> --}}

                </div>
                <div class="col-6">
                    <div class="grid-container">
                        {{-- <div class="grid-item">
                            <b>Rectum</b>
                            <select class="form-select boston_save boston_cal" id="rectum">
                                <option value="" selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['rectum'] == '0')>0</option>
                                <option value="1" @selected(@$case->bowel_score['rectum'] == '1')>1</option>
                                <option value="2" @selected(@$case->bowel_score['rectum'] == '2')>2</option>
                                <option value="3" @selected(@$case->bowel_score['rectum'] == '3')>3</option>
                                <option value="4" @selected(@$case->bowel_score['rectum'] == '4')>4</option>
                            </select>
                        </div> --}}
                        {{-- <div class="grid-item">
                            <b>Sigmoid Colon</b>
                            <select class="form-select boston_save boston_cal" name="" id="sigmoid">
                                <option value=""selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['sigmoid'] == '0')>0</option>
                                <option value="1" @selected(@$case->bowel_score['sigmoid'] == '1')>1</option>
                                <option value="2" @selected(@$case->bowel_score['sigmoid'] == '2')>2</option>
                                <option value="3" @selected(@$case->bowel_score['sigmoid'] == '3')>3</option>
                                <option value="4" @selected(@$case->bowel_score['sigmoid'] == '4')>4</option>
                            </select>
                        </div> --}}
                        <div class="grid-item">
                            <b>Left Side Colon</b>
                            <select class="form-select boston_save boston_cal" name="" id="left_side">
                                <option value="" selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['left_side'] == '0')>0</option>
                                <option value="1" @selected(@$case->bowel_score['left_side'] == '1')>1</option>
                                <option value="2" @selected(@$case->bowel_score['left_side'] == '2')>2</option>
                                <option value="3" @selected(@$case->bowel_score['left_side'] == '3')>3</option>
                                {{-- <option value="4" @selected(@$case->bowel_score['descending'] == '4')>4</option> --}}
                            </select>
                        </div>
                        <div class="grid-item">
                            <b>Transverse Colon</b>
                            <select class="form-select boston_save boston_cal" name="" id="transverse_colon">
                                <option value="" selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['transverse_colon'] == '0')>0 </option>
                                <option value="1" @selected(@$case->bowel_score['transverse_colon'] == '1')>1</option>
                                <option value="2" @selected(@$case->bowel_score['transverse_colon'] == '2')>2</option>
                                <option value="3" @selected(@$case->bowel_score['transverse_colon'] == '3')>3</option>
                                {{-- <option value="4" @selected(@$case->bowel_score['transverse'] == '4')>4 </option> --}}
                            </select>
                        </div>
                        <div class="grid-item">
                            <b>Right Side Colon</b>
                            <select class="form-select boston_save boston_cal" name="" id="right_side">
                                <option value="" selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['right_side'] == '0')>0</option>
                                <option value="1" @selected(@$case->bowel_score['right_side'] == '1')>1 </option>
                                <option value="2" @selected(@$case->bowel_score['right_side'] == '2')>2</option>
                                <option value="3" @selected(@$case->bowel_score['right_side'] == '3')>3 </option>
                                {{-- <option value="4" @selected(@$case->bowel_score['ascending'] == '4')>4 </option> --}}
                            </select>
                        </div>
                        {{-- <div class="grid-item">
                            <b>Cecum</b>
                            <select class="form-select boston_save boston_cal" name="" id="cecum">
                                <option value="" selected>Score</option>
                                <option value="0" @selected(@$case->bowel_score['cecum'] == '0')>0 </option>
                                <option value="1" @selected(@$case->bowel_score['cecum'] == '1')>1 </option>
                                <option value="2" @selected(@$case->bowel_score['cecum'] == '2')>2 </option>
                                <option value="3" @selected(@$case->bowel_score['cecum'] == '3')>3 </option>
                                <option value="4" @selected(@$case->bowel_score['cecum'] == '4')>4 </option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="col-2 align-self-center text-center" style="justify-items: center;">
                    <div class="w-50">
                        Score
                        <hr>
                        <input type="text" class="form-control text-center" id="cal_boston"
                            value="{{ @$case->boston_score }}">
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(".boston_save").change(function() {
        var location = $(this).attr('id');
        var score = $(this).val();
        var cid = "{{ $cid }}"
        $.post("{{ url('api/procedure') }}", {
            event: "boston_bowel",
            cid: cid,
            location: location,
            score: score,
        }, function(data, status) {

        })
    });




    $(".boston_cal").change(function() {

        var left_side_val = $("#left_side").val();
        var transverse_colon_val = $("#transverse_colon").val();
        var right_side_val = $("#right_side").val();


        var left_side = left_side_val || 0;
        var transverse_colon = transverse_colon_val || 0;
        var right_side = right_side_val || 0;

        // แปลงเป็นตัวเลขและบวกกัน
        var total = parseInt(left_side) + parseInt(transverse_colon) + parseInt(right_side);

        // แสดงผลรวมในช่อง score
        $("#cal_boston").val(total);

        console.log(total);

        $.post("{{ url('api/procedure') }}", {
            event: "save_boston",
            cid: "{{ $cid }}",
            total: total,
            left_side: left_side_val === "" ? "" : (left_side_val || 0),
            transverse_colon: transverse_colon_val === "" ? "" : (transverse_colon_val || 0),
            right_side: right_side_val === "" ? "" : (right_side_val || 0),
        }, function(data, status) {

        })


    });
</script>
