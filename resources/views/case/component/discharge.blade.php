<div class="col-6">
    {!! editcard('discharge', 'discharge.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="cardcode col-12" style="background-color: red;color:white;display:none;">
                Cardcode : 0010
                <a href="{{ url("autoit?run=visualcode_open\\endo.exe&path=discharge") }}">Edit</a>
            </div>
            <label id="discharge_toggle">
                <font size='4'><b>DISCHARGE <i class="fa dripicons-chevron-down"></i></b></font>
            </label>
            <div class="row" id="discharge_showhide" style="display:none;">
                <div class="col-2">
                    Following guide
                </div>
                <div class="col-10">
                    <input id="following_guide" name="following_guide" type="text" class="form-control savejson"
                        value="{{ @$case->following_guide }}">
                </div>
                <div class="col-2">
                    Discharge to
                </div>
                <div class="col-10">
                    {!! Form::select('discharge_to', ['0' => 'Select'] + array_pluck($dd_discharge, 'discharge_name', 'discharge_id'), @$case->discharge_to, ['class' => 'form-control savejson', 'id' => 'discharge_to']) !!}
                </div>
                <div class="col-2">
                    Appointment information
                </div>
                <div class="col-10">
                    <input id="appointment_info" name="appointment_info" type="text" class="form-control savejson"
                        value="{{ @$case->appointment_info }}">
                </div>
            </div>
        </div>
    </div>
</div>
