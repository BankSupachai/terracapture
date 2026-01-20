<h5>
    <b>Finding</b> &emsp; &emsp;&emsp;&emsp;&emsp;&emsp; &nbsp;

    {{-- {{fidingtemp($case)}}


 --}}


    @if ($procedure->code != 'gi003S2' && $procedure->code != 'gi095')
        <button type="button" class="btn btn-checkbox waves-effect waves-light btn-sm mainpart_group" status="Normal">
            <i class=" ri-checkbox-blank-line ri-lg me-2" aria-hidden="true"></i>Normal All</button> &emsp;
        <button type="button" class="btn btn-checkbox waves-effect waves-light btn-sm mainpart_group mainpart_group"
            status="Unremarkable">
            <i class=" ri-checkbox-blank-line ri-lg me-2" aria-hidden="true"></i>Unremarkable All</button>
        @if ($procedure->name == 'ERCP')
            <a href="{{ url("procedureadvance/$cid") }}" class="btn btn-checkbox waves-effect waves-light btn-sm">
                <i class="ri-file-list-line ri-lg me-2" aria-hidden="true"></i>Advance</a>
        @endif
        <br />

    @endif  
</h5>
<style>
    .btn-finding {
        background-color: #E0E3E5
    }

    .btn-finding:hover {
        background-color: #acaeaf
    }

    .focus-hide:focus {
        background: #ffffff;
        border: 0px #ffffff;
    }

    /* .textarea:nth-child(2){
        margin-top: 2em;
    } */
</style>

<div class="row">
    <div class="col-12 mt-1">
        @if ($procedure->code == 'gi003S2')
            @include('case.component.ercp.finding_typeofmajor')
            @include('case.component.ercp.finding_Infundibulum')
            @include('case.component.ercp.finding_transverse')
            @include('case.component.ercp.finding_diverticulum')
            @include('case.component.ercp.finding_periampullary')
        @else
            {{-- Special Finding Form for gi095 --}}
            @if ($procedure->code == 'gi095')
                <div class="row mb-3 mt-2">
                    <div class="col-2"></div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <textarea type="text" rows="2" class="form-control autotext savejson" name="finding_freetext"
                                id="finding_freetext" placeholder="Freetext" autocomplete="off">{{ is_array(@$case->finding_freetext) ? implode(', ', @$case->finding_freetext) : @$case->finding_freetext }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <h6 class="fw-bold">Pooling saliva/mucous:</h6>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pooling_saliva_no" value="no" id="pooling_no"
                                        {{ @$case->pooling_saliva_no ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_no">no</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="pooling_saliva_mild" value="mild" id="pooling_mild_checkbox"
                                        {{ @$case->pooling_saliva_mild ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_mild_checkbox"></label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="pooling_saliva_severity" id="pooling_severity_select"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="trace"
                                            {{ @$case->pooling_saliva_severity == 'trace' ? 'selected' : '' }}>trace
                                        </option>
                                        <option value="mild"
                                            {{ @$case->pooling_saliva_severity == 'mild' ? 'selected' : '' }}>mild
                                        </option>
                                        <option value="moderate"
                                            {{ @$case->pooling_saliva_severity == 'moderate' ? 'selected' : '' }}>
                                            moderate</option>
                                        <option value="severe"
                                            {{ @$case->pooling_saliva_severity == 'severe' ? 'selected' : '' }}>severe
                                        </option>
                                    </select>
                                </div>
                                <span class="me-2">at</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pooling_saliva_vallecula" value="vallecula" id="pooling_vallecula"
                                        {{ @$case->pooling_saliva_vallecula ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_vallecula">vallecula</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="pooling_saliva_position_enable" value="position"
                                        id="pooling_position_checkbox"
                                        {{ @$case->pooling_saliva_position_enable ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_position_checkbox"></label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="pooling_saliva_position" id="pooling_position_select"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left"
                                            {{ @$case->pooling_saliva_position == 'left' ? 'selected' : '' }}>left
                                        </option>
                                        <option value="right"
                                            {{ @$case->pooling_saliva_position == 'right' ? 'selected' : '' }}>right
                                        </option>
                                        <option value="both"
                                            {{ @$case->pooling_saliva_position == 'both' ? 'selected' : '' }}>both
                                        </option>
                                    </select>
                                </div>

                                <span class="me-2">pyriform sinus</span>

                            </div>
                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pooling_saliva_penetration" value="penetration" id="pooling_penetration"
                                        {{ @$case->pooling_saliva_penetration ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_penetration">penetration</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pooling_saliva_aspiration" value="aspiration" id="pooling_aspiration"
                                        {{ @$case->pooling_saliva_aspiration ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_aspiration">aspiration</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2">
                        <h6 class="fw-bold">TVC movement:</h6>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="tvc_movement_good" value="good" id="tvc_good"
                                        {{ @$case->tvc_movement_good ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tvc_good">good</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="tvc_movement_side_enable" value="side_paresis"
                                        id="tvc_side_paresis_checkbox"
                                        {{ @$case->tvc_movement_side_enable ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tvc_side_paresis_checkbox"></label>

                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="tvc_movement_side" id="tvc_side_paresis_select"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left"
                                            {{ @$case->tvc_movement_side == 'left' ? 'selected' : '' }}>left
                                        </option>
                                        <option value="right"
                                            {{ @$case->tvc_movement_side == 'right' ? 'selected' : '' }}>right
                                        </option>
                                        <option value="both"
                                            {{ @$case->tvc_movement_side == 'both' ? 'selected' : '' }}>both
                                        </option>
                                    </select>
                                    <span class="me-2">side paresis</span>

                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="tvc_movement_paralysis_side_enable" value="paralysis"
                                        id="tvc_paralysis_checkbox"
                                        {{ @$case->tvc_movement_paralysis_side_enable ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tvc_paralysis_checkbox"></label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="tvc_movement_paralysis_side" id="tvc_left_paralysis"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left"
                                            {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('left', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'left' ? 'selected' : '') }}>
                                            left</option>
                                        <option value="right"
                                            {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('right', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'right' ? 'selected' : '') }}>
                                            right</option>
                                        <option value="both"
                                            {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('both', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'both' ? 'selected' : '') }}>
                                            both</option>
                                    </select>
                                    <span class="me-2">paralysis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2">
                        <h6 class="fw-bold">Sensation:</h6>
                    </div>
                    <div class="col-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input savejson_checkbox" type="checkbox" name="sensation_good"
                                value="good" id="sensation_good" {{ @$case->sensation_good ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_good">good</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input savejson_checkbox" type="checkbox" name="sensation_fair"
                                value="fair" id="sensation_fair" {{ @$case->sensation_fair ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_fair">fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input savejson_checkbox" type="checkbox" name="sensation_impair"
                                value="impair" id="sensation_impair" {{ @$case->sensation_impair ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_impair">impair</label>
                        </div>
                    </div>
                </div>
                <!-- Test to Safety Section with Border -->
                <div class="border border-2 border rounded p-3 mb-3" id="test-safety-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text mb-0">Test</h5>
                        <button type="button" class="btn btn-success btn-sm" id="add-test-safety-btn">
                            เพิ่มชุดข้อมูล
                        </button>
                    </div>

                    <div id="test-safety-container">
                        <div class="test-safety-item border border-light rounded p-3 mb-3" data-index="0">
                            <div class="row mb-3">
                                <div class="col-2">
                                    <h6 class="fw-bold mt-2">Test:</h6>
                                </div>

                                <div class="col-9">
                                    <select class="form-select savejson_checkbox" name="test" id="test_select_0">
                                        <option value="">-- เลือก --</option>
                                        <option value="thin_liquid"
                                            {{ is_array(@$case->test) ? (in_array('thin_liquid', @$case->test) ? 'selected' : '') : (@$case->test == 'thin_liquid' ? 'selected' : '') }}>
                                            thin liquid</option>
                                        <option value="sightly_thick"
                                            {{ is_array(@$case->test) ? (in_array('sightly_thick', @$case->test) ? 'selected' : '') : (@$case->test == 'sightly_thick' ? 'selected' : '') }}>
                                            sightly thick</option>
                                        <option value="nectar"
                                            {{ is_array(@$case->test) ? (in_array('nectar', @$case->test) ? 'selected' : '') : (@$case->test == 'nectar' ? 'selected' : '') }}>
                                            nectar</option>
                                        <option value="honey"
                                            {{ is_array(@$case->test) ? (in_array('honey', @$case->test) ? 'selected' : '') : (@$case->test == 'honey' ? 'selected' : '') }}>
                                            honey</option>
                                        <option value="pudding"
                                            {{ is_array(@$case->test) ? (in_array('pudding', @$case->test) ? 'selected' : '') : (@$case->test == 'pudding' ? 'selected' : '') }}>
                                            pudding</option>
                                        <option value="IDDSI3"
                                            {{ is_array(@$case->test) ? (in_array('IDDSI3', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI3' ? 'selected' : '') }}>
                                            IDDSI3</option>
                                        <option value="IDDSI4"
                                            {{ is_array(@$case->test) ? (in_array('IDDSI4', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI4' ? 'selected' : '') }}>
                                            IDDSI4</option>
                                        <option value="IDDSI5"
                                            {{ is_array(@$case->test) ? (in_array('IDDSI5', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI5' ? 'selected' : '') }}>
                                            IDDSI5</option>
                                        <option value="IDDSI6"
                                            {{ is_array(@$case->test) ? (in_array('IDDSI6', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI6' ? 'selected' : '') }}>
                                            IDDSI6</option>
                                        <option value="IDDSI7"
                                            {{ is_array(@$case->test) ? (in_array('IDDSI7', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI7' ? 'selected' : '') }}>
                                            IDDSI7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <h6 class="fw-bold"></h6>
                                </div>
                                <div class="col-9">
                                    <div class="col-12 mb-2">
                                        <input type="text"
                                            class="form-control form-control-sm autotext savejson_checkbox"
                                            id="test_free_text" name="test_free_text"
                                            style="width: 925px; display: inline-block;" placeholder="Freetext"
                                            autocomplete="off"
                                            value="{{ is_array(@$case->test_free_text) ? implode(', ', @$case->test_free_text) : @$case->test_free_text }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <h6 class="fw-bold">Compensation:</h6>
                                </div>
                                <div class="col-9">
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="compensation_small_volume" value="small_volume"
                                                id="compensation_small_volume_0"
                                                {{ @$case->compensation_small_volume ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_small_volume_0">small
                                                volume</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="compensation_slow_rate" value="slow_rate"
                                                id="compensation_slow_rate_0"
                                                {{ @$case->compensation_slow_rate ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_slow_rate_0">slow
                                                rate</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="compensation_chin_tuck" value="chin_tuck"
                                                id="compensation_chin_tuck_0"
                                                {{ @$case->compensation_chin_tuck ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_chin_tuck_0">chin
                                                tuck</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="compensation_double_swallow" value="double_swallow"
                                                id="compensation_double_swallow_0"
                                                {{ @$case->compensation_double_swallow ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_double_swallow_0">double
                                                swallow</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="compensation_multiple_swallow" value="multiple_swallow"
                                                id="compensation_multiple_swallow_0"
                                                {{ @$case->compensation_multiple_swallow ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="compensation_multiple_swallow_0">multiple
                                                swallow</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="compensation_tilt_enable" value="tilt"
                                                id="compensation_tilt_checkbox_0"
                                                {{ @$case->compensation_tilt_enable ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_tilt_checkbox_0">
                                                tilt</label>
                                            <select class="form-select form-select-sm savejson_checkbox"
                                                name="compensation_tilt_direction" id="compensation_tilt_select_0"
                                                style="width: auto; display: inline-block;">
                                                <option value="">-- เลือก --</option>
                                                <option value="left"
                                                    {{ is_array(@$case->compensation_tilt_direction) ? (in_array('left', @$case->compensation_tilt_direction) ? 'selected' : '') : (@$case->compensation_tilt_direction == 'left' ? 'selected' : '') }}>
                                                    left</option>
                                                <option value="right"
                                                    {{ is_array(@$case->compensation_tilt_direction) ? (in_array('right', @$case->compensation_tilt_direction) ? 'selected' : '') : (@$case->compensation_tilt_direction == 'right' ? 'selected' : '') }}>
                                                    right</option>
                                            </select>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="compensation_turn_to_enable" value="turn_to"
                                                id="compensation_turn_to_checkbox_0"
                                                {{ @$case->compensation_turn_to_enable ? 'checked' : '' }}>
                                            <label class="form-check-label" for="compensation_turn_to_checkbox_0">
                                                turn to</label>
                                            <select class="form-select form-select-sm savejson_checkbox"
                                                name="compensation_turn_to_direction"
                                                id="compensation_turn_to_select_0"
                                                style="width: auto; display: inline-block;">
                                                <option value="">-- เลือก --</option>
                                                <option value="left"
                                                    {{ is_array(@$case->compensation_turn_to_direction) ? (in_array('left', @$case->compensation_turn_to_direction) ? 'selected' : '') : (@$case->compensation_turn_to_direction == 'left' ? 'selected' : '') }}>
                                                    left</option>
                                                <option value="right"
                                                    {{ is_array(@$case->compensation_turn_to_direction) ? (in_array('right', @$case->compensation_turn_to_direction) ? 'selected' : '') : (@$case->compensation_turn_to_direction == 'right' ? 'selected' : '') }}>
                                                    right</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                                    name="compensation_recline_option" value="recline"
                                                    id="compensation_recline_option_0"
                                                    {{ @$case->compensation_recline_option ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="compensation_recline_option_0">recline</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                                    name="compensation_mendelsohn_maneuver"
                                                    value="mendelsohn_maneuver"
                                                    id="compensation_mendelsohn_maneuver_0"
                                                    {{ @$case->compensation_mendelsohn_maneuver ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="compensation_mendelsohn_maneuver_0">Mendelsohn
                                                    maneuver</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                    name="compensation_other_enable" value="other"
                                                    id="compensation_other_checkbox_0"
                                                    {{ @$case->compensation_other_enable ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="compensation_other_checkbox_0"></label>
                                                <input type="text"
                                                    class="form-control form-control-sm savejson_checkbox"
                                                    name="compensation_other_text"
                                                    id="compensation_other_text_input_0" placeholder="ระบุ..."
                                                    style="width: 200px; display: inline-block;"
                                                    value="{{ is_array(@$case->compensation_other_text) ? implode(', ', @$case->compensation_other_text) : @$case->compensation_other_text }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <h6 class="fw-bold">residual:</h6>
                                </div>
                                <div class="col-9">
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="residual_no" value="no" id="residual_no_0"
                                                {{ @$case->residual_no ? 'checked' : '' }}>
                                            <label class="form-check-label" for="residual_no_0">no </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="residual_yes_enable" value="yes"
                                                id="residual_yes_checkbox_0"
                                                {{ @$case->residual_yes_enable ? 'checked' : '' }}>
                                            <label class="form-check-label" for="residual_yes_checkbox_0"></label>
                                            <select class="form-select form-select-sm savejson_checkbox"
                                                name="residual_yes_type" id="residual_yes_0"
                                                style="width: auto; display: inline-block;">
                                                <option value="">-- เลือก --</option>
                                                <option value="trace"
                                                    {{ @$case->residual_yes_type == 'trace' ? 'selected' : '' }}>
                                                    trace
                                                </option>
                                                <option value="mild"
                                                    {{ @$case->residual_yes_type == 'mild' ? 'selected' : '' }}>
                                                    mild
                                                </option>
                                                <option value="moderate"
                                                    {{ @$case->residual_yes_type == 'moderate' ? 'selected' : '' }}>
                                                    moderate</option>
                                                <option value="severe"
                                                    {{ @$case->residual_yes_type == 'severe' ? 'selected' : '' }}>
                                                    severe
                                                </option>
                                            </select>
                                            <span class="me-2 ms-2">at</span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="residual_yes_check" value="vallecula" id="residual_vallecula_0"
                                                {{ @$case->residual_yes_check ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="residual_vallecula_0">vallecula</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="residual_pyriform_sinus_enable" value="pyriform_sinus"
                                                id="residual_pyriform_sinus_checkbox_0"
                                                {{ @$case->residual_pyriform_sinus_enable ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="residual_pyriform_sinus_checkbox_0"></label>
                                            <select class="form-select form-select-sm savejson_checkbox"
                                                name="residual_pyriform_sinus_type"
                                                id="residual_pyriform_sinus_select_0"
                                                style="width: auto; display: inline-block;">
                                                <option value="">-- เลือก --</option>
                                                <option value="left"
                                                    {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('left', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'left' ? 'selected' : '') }}>
                                                    left</option>
                                                <option value="right"
                                                    {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('right', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'right' ? 'selected' : '') }}>
                                                    right</option>
                                                <option value="both"
                                                    {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('both', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'both' ? 'selected' : '') }}>
                                                    both</option>
                                            </select>
                                            <span class="me-2">pyriform sinus</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <h6 class="fw-bold">PAS:</h6>
                                </div>
                                <div class="col-9">
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="pas_penetration" value="penetration" id="pas_penetration_0"
                                                {{ @$case->pas_penetration ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pas_penetration_0">penetration
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="pas_aspiration" value="aspiration" id="pas_aspiration_0"
                                                {{ @$case->pas_aspiration ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pas_aspiration_0">aspiration </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="pas_level_enable" value="pas_level" id="pas_level_checkbox_0"
                                                {{ @$case->pas_level_enable ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pas_level_checkbox_0">PAS</label>
                                            <select class="form-select form-select-sm savejson_checkbox"
                                                name="pas_level" id="pas_level_select_0"
                                                style="width: auto; display: inline-block;">
                                                <option value="">-- เลือก --</option>
                                                <option value="1"
                                                    {{ @$case->pas_level == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2"
                                                    {{ @$case->pas_level == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3"
                                                    {{ @$case->pas_level == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4"
                                                    {{ @$case->pas_level == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5"
                                                    {{ @$case->pas_level == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6"
                                                    {{ @$case->pas_level == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7"
                                                    {{ @$case->pas_level == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8"
                                                    {{ @$case->pas_level == '8' ? 'selected' : '' }}>8</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <h6 class="fw-bold">Safety:</h6>
                                </div>
                                <div class="col-9">
                                    <div class="col-12 mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="safety_safe" value="safe" id="safety_safe_0"
                                                {{ @$case->safety_safe ? 'checked' : '' }}>
                                            <label class="form-check-label" for="safety_safe_0">safe </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox" type="checkbox"
                                                name="safety_not_safe" value="not_safe" id="safety_not_safe_0"
                                                {{ @$case->safety_not_safe ? 'checked' : '' }}>
                                            <label class="form-check-label" for="safety_not_safe_0">not safe </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                                name="safety_free_text_enable" value="free_text"
                                                id="safety_free_text_checkbox_0"
                                                {{ @$case->safety_free_text_enable ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="safety_free_text_checkbox_0">อื่นๆ</label>
                                            <input type="text"
                                                class="form-control form-control-sm savejson_checkbox"
                                                id="safety_free_text_input_0" name="safety_free_text"
                                                style="width: 700px; display: inline-block;"
                                                value="{{ is_array(@$case->safety_free_text) ? implode(', ', @$case->safety_free_text) : @$case->safety_free_text }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-9">
                                    <div class="col-12 mb-2">
                                        <textarea type="text" rows="2" class="form-control autotext savejson" name="safety_freetext"
                                            id="safety_freetext" placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->safety_freetext }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-test-safety-btn"
                                        style="display: none;">
                                        <i class="fas fa-trash"></i> ลบชุดข้อมูลนี้
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Diagnostic:</h6>
                    </div>

                    <div class="col-9">
                        <div class="col-12 mb-2">
                            {{-- <textarea type="text" value="" autocomplete="off" class="form-control form-control-sm savejson_checkbox" id="diagnostic_free_text"
                                name="diagnostic_free_text" style="width: 925px; display: inline-block;" rows="2">{{ is_array(@$case->diagnostic_free_text) ? implode(', ', @$case->diagnostic_free_text) : @$case->diagnostic_free_text }}</textarea> --}}
                            <textarea type="text" rows="2" class="form-control autotext savejson" name="diagnostic_free_text"
                                id="diagnostic_free_text" placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->diagnostic_free_text }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Complications:</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="complications_no" value="no" id="complications_no"
                                    {{ @$case->complications_no ? 'checked' : '' }}>
                                <label class="form-check-label" for="complications_no">no </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                    name="complications_free_text_enable" value="free_text"
                                    id="complications_free_text_checkbox"
                                    {{ @$case->complications_free_text_enable ? 'checked' : '' }}>
                                <label class="form-check-label" for="complications_free_text_checkbox"></label>
                                <input type="text" class="form-control form-control-sm savejson_checkbox"
                                    id="complications_free_text_input" name="complications_free_text"
                                    style="width: 885px; display: inline-block;" placeholder=""
                                    value="{{ is_array(@$case->complications_free_text) ? implode(', ', @$case->complications_free_text) : @$case->complications_free_text }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Advice:</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <span>Liquid :</span>
                            <select class="form-select form-select-sm savejson_checkbox" name="advice_liquid"
                                id="advice_liquid" style="width: auto; display: inline-block;">
                                <option value="">-- เลือก --</option>
                                <option value="thin" {{ @$case->advice_liquid == 'thin' ? 'selected' : '' }}>thin
                                </option>
                                <option value="slighty thick"
                                    {{ @$case->advice_liquid == 'slighty thick' ? 'selected' : '' }}>slighty thick
                                </option>
                                <option value="nectar" {{ @$case->advice_liquid == 'nectar' ? 'selected' : '' }}>
                                    nectar</option>
                                <option value="honey" {{ @$case->advice_liquid == 'honey' ? 'selected' : '' }}>honey
                                </option>
                                <option value="pudding" {{ @$case->advice_liquid == 'pudding' ? 'selected' : '' }}>
                                    pudding</option>
                            </select>
                            <span class="ms-2">Food : IDDSI</span>
                            <select class="form-select form-select-sm savejson_checkbox ms-2" name="advice_food"
                                id="advice_food" style="width: auto; display: inline-block; width: 65px;">
                                <option value="">-- เลือก --</option>
                                <option value="4" {{ @$case->advice_food == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ @$case->advice_food == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ @$case->advice_food == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ @$case->advice_food == '7' ? 'selected' : '' }}>7</option>
                            </select>
                            <span class="ms-2">for</span>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="advice_purpose_eating" value="eating" id="advice_purpose_eating"
                                    {{ @$case->advice_purpose_eating ? 'checked' : '' }}>
                                <label class="form-check-label" for="advice_purpose_eating">eating</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="advice_purpose_training" value="training" id="advice_purpose_training"
                                    {{ @$case->advice_purpose_training ? 'checked' : '' }}>
                                <label class="form-check-label" for="advice_purpose_training">training</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Compensate technique:</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_small_volume_check" value="small_volume"
                                    id="technique_small_volume_check"
                                    {{ @$case->technique_small_volume_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_small_volume_check">small
                                    volume</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_slow_rate_check" value="slow_rate" id="technique_slow_rate_check"
                                    {{ @$case->technique_slow_rate_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_slow_rate_check"> slow rate</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_chin_tuck_check" value="chin_tuck" id="technique_chin_tuck_check"
                                    {{ @$case->technique_chin_tuck_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_chin_tuck_check"> chin tuck </label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_double_swallow_check" value="double_swallow"
                                    id="technique_double_swallow_check"
                                    {{ @$case->technique_double_swallow_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_double_swallow_check"> double swallow
                                </label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_multiple_swallow_check" value="multiple_swallow"
                                    id="technique_multiple_swallow_check"
                                    {{ @$case->technique_multiple_swallow_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_multiple_swallow_check"> multiple
                                    swallow </label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                    name="technique_tilt_enable" value="tilt" id="technique_tilt_checkbox"
                                    {{ @$case->technique_tilt_enable ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_tilt_checkbox">tilt</label>
                                <select class="form-select form-select-sm savejson_checkbox" name="technique_tilt"
                                    id="technique_tilt_select" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ @$case->technique_tilt == 'left' ? 'selected' : '' }}>
                                        left</option>
                                    <option value="right" {{ @$case->technique_tilt == 'right' ? 'selected' : '' }}>
                                        right</option>
                                </select>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                    name="technique_turn_to_enable" value="turn_to" id="technique_turn_to_checkbox"
                                    {{ @$case->technique_turn_to_enable ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_turn_to_checkbox">turn to</label>
                                <select class="form-select form-select-sm savejson_checkbox" name="technique_turn_to"
                                    id="technique_turn_to_select" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left"
                                        {{ @$case->technique_turn_to == 'left' ? 'selected' : '' }}>left</option>
                                    <option value="right"
                                        {{ @$case->technique_turn_to == 'right' ? 'selected' : '' }}>right</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 mt-2">

                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_recline_check" value="recline" id="technique_recline_check"
                                    {{ @$case->technique_recline_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_recline_check">recline</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="technique_mendelsohn_maneuver_check" value="mendelsohn_maneuver"
                                    id="technique_mendelsohn_maneuver_check"
                                    {{ @$case->technique_mendelsohn_maneuver_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_mendelsohn_maneuver_check">Mendelsohn
                                    maneuver</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                    name="technique_cough_technique_enable" value="cough_technique"
                                    id="technique_cough_technique_checkbox"
                                    {{ @$case->technique_cough_technique_enable ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_cough_technique_checkbox"></label>
                                <input type="text" class="form-control form-control-sm savejson_checkbox"
                                    id="technique_cough_technique_free_text_input"
                                    name="technique_cough_technique_free_text"
                                    style="width: 700px; display: inline-block;" placeholder="Free text"
                                    value="{{ is_array(@$case->technique_cough_technique_free_text) ? implode(', ', @$case->technique_cough_technique_free_text) : @$case->technique_cough_technique_free_text }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Exercise:</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_basic_oromotor_check" value="basic_oromotor"
                                    id="exercise_basic_oromotor_check"
                                    {{ @$case->exercise_basic_oromotor_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_basic_oromotor_check">basic
                                    oromotor</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_lingual_check" value="lingual" id="exercise_lingual_check"
                                    {{ @$case->exercise_lingual_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_lingual_check">lingual</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_base_of_tongue_check" value="base_of_tongue"
                                    id="exercise_base_of_tongue_check"
                                    {{ @$case->exercise_base_of_tongue_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_base_of_tongue_check">base of
                                    tongue</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_ctar_check" value="ctar" id="exercise_ctar_check"
                                    {{ @$case->exercise_ctar_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_ctar_check">CTAR</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_shaker_check" value="shaker" id="exercise_shaker_check"
                                    {{ @$case->exercise_shaker_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_shaker_check">shaker</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_vocal_cord_exercise_check" value="vocal_cord_exercise"
                                    id="exercise_vocal_cord_exercise_check"
                                    {{ @$case->exercise_vocal_cord_exercise_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_vocal_cord_exercise_check">vocal cord
                                    exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_mendelsohn_check" value="mendelsohn"
                                    id="exercise_mendelsohn_check"
                                    {{ @$case->exercise_mendelsohn_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_mendelsohn_check">Mendelsohn</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 mt-2">

                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_neck_exercise_check" value="neck_exercise"
                                    id="exercise_neck_exercise_check"
                                    {{ @$case->exercise_neck_exercise_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_neck_exercise_check">neck
                                    exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_breathing_exercise_check" value="breathing_exercise"
                                    id="exercise_breathing_exercise_check"
                                    {{ @$case->exercise_breathing_exercise_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_breathing_exercise_check">breathing
                                    exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox"
                                    name="exercise_cough_technique_check" value="cough_technique"
                                    id="exercise_cough_technique_check"
                                    {{ @$case->exercise_cough_technique_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_cough_technique_check">cough
                                    technique</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Suggestion :</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-2">
                            <textarea type="text" rows="2" class="form-control autotext savejson" name="suggestion" id="suggestion"
                                placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->suggestion }}</textarea>
                        </div>
                    </div>
                </div>
            @else
                @foreach (@$mainpart as $key => $value)
                    {{-- @dd($case->photo_advance["analcanal"]) --}}
                    <div class="row">
                        <div class="col-2 mt-2">
                            {{ $value }}
                        </div>
                        @if (@$project_name == 'capture')
                            <div class="col-auto mt-2 ">
                                <a class="btn border btn-light text_delfind btn_mainpart_na"
                                    group_key="{{ $value }}">N/A</a>

                            </div>
                        @else
                            <div class="col-auto mt-2 ">
                                <a class="btn border btn-light text_delfind btn_mainpart_na"
                                    group_key="{{ $value }}">N/A</a>
                                @if (@$file_check_advance && $case->case_procedurecode == 'gi002')
                                    {{-- <button type="button" class="btn border btn-light btn_advance"
                                mainpart="{{ $value }}">Advance</button> --}}
                                @endif

                            </div>
                        @endif
                        <div class="col-8 mt-2">
                            <input type="hidden" name="mainpart_name[]" value="{{ $value }}">
                            <textarea id="mainpart{{ $key }}" rows="1" name="mainpart_value[]" placeholder="Free text"
                                group_name="finding" group_key="{{ $value }}"
                                class="savejsongroup form-control autotext mainpart_text">{{ @$case->mainpart[$value] }}</textarea>
                        </div>
                        <div id="advance_mainpart_{{ smalltext($value) }}" class="col-12 advance_mainpart px-5 my-2"
                            text="{{ $value }}"
                            style="display: @if (isset($case->advance[smalltext($value)])) show @else none @endif; border: 1px solid #245788; border-radius: 4px;">
                            <div class="row my-2">
                                <div class="col-6 align-self-center">
                                    <span class="text-danger fw-bold"> Advance {{ @$value }}</span>
                                    <a class="btn border lesion_add" mainpart="{{ smalltext($value) }}">Add
                                        Lesion</a>
                                </div>
                            </div>

                            @php
                                $temp = url('');
                                $explode = explode('/', $temp);
                                $end = end($explode);
                            @endphp

                            @if (is_file(getCONFIG('admin')->htdocs_path . "$end\\resources\\views\\mainpart\\lesion\\$value.blade.php"))
                                @php
                                    $view['value'] = $value;
                                    $view['case'] = $case;
                                    $view['num'] = 1;

                                    if (isset($case->advance[smalltext($value)])) {
                                        $temparray = $case->advance[smalltext($value)];
                                        $temp2 = [];
                                        foreach ($temparray as $tempkey => $tempvalue) {
                                            $temp2[] = $tempkey;
                                        }
                                        $maxs = max($temp2);
                                        $maxs++;
                                    } else {
                                        $maxs = 2;
                                    }
                                @endphp
                                @forelse ($case->advance[smalltext($value)]??[] as $key => $val)
                                    @php($view['num'] = $key)
                                    @component('mainpart.lesion.' . $value, $view)
                                    @endcomponent
                                @empty
                                    @php($view['num'] = 1)
                                    @component('mainpart.lesion.' . $value, $view)
                                    @endcomponent
                                @endforelse
                                <div id="theme_{{ smalltext($value) }}" style="display: none">
                                    @php($view['num'] = 999)
                                    @component('mainpart.lesion.' . $value, $view)
                                    @endcomponent
                                </div>
                            @else
                                @include('mainpart.lesion.blank')
                            @endif
                        </div>
                        {{-- <input type="text" id="num_{{smalltext($value)}}" value="{{ @$maxs }}" class="focus-hide" style="width: 0px;height:0px; background: #ffffff; border: 0px #ffffff;"> --}}
                    </div>
                @endforeach
            @endif
        @endif

    </div>

    @if ($procedure->code != 'gi003S2' && $procedure->code != 'gi095')
        <div class="row" style="padding-right: 0px;">
            <div class="col-2 " style="margin-top: px;">
                Overall Finding
            </div>
            <div class="col-10 " style="padding-right: 0px;">
                <textarea style="overflow:hidden" id='overall_finding' name='formsubmit_overall_finding'
                    class="form-control savejson_checkbox w-100" type="text" placeholder="Free text">{{ @$case->overall_finding }}</textarea>
            </div>
        </div>
    @elseif ($procedure->code == 'gi095')
</div>
</div>
@endif
</div>


<div class="modal fade" id="modal_lesion_del" tabindex="-1" role="dialog" aria-labelledby="modal_lesion_delLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_lesion_delLabel">Delete Lesion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this lesion?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal_lesion_del_hide">Cancel</button>
                <button type="button" class="btn btn-danger modal_lesion_del_hide"
                    id="confirm_lesion_del">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#confirm_lesion_del', function() {
        $.post("{{ url('api/procedure') }}", {
            event: "lesion_delete",
            mainpart: lesion_mainpart,
            lesion: lesion_lesion,
            cid: '{{ $cid }}'
        }, function(d, s) {
            $("#" + lesion_del_div).remove();
        });
    });

    $(document).on('click', '.modal_lesion_del_hide', function() {
        $("#modal_lesion_del").modal("hide");
    });
</script>




<script>
    let lesion_del_div = "";
    let lesion_mainpart = "";
    let lesion_lesion = "";
    $(document).on('click', '.lesion_del', function() {
        let mainpart = $(this).attr("mainpart");
        let lesion = $(this).attr("lesion");
        lesion_mainpart = mainpart;
        lesion_lesion = lesion;
        lesion_del_div = mainpart + lesion;
        $("#modal_lesion_del").modal("show");
    });

    $(document).on('click', '.lesion_add', function() {
        let mainpart = $(this).attr("mainpart");
        let html = $("#theme_" + mainpart).html();
        let num = $("#num_" + mainpart).val();
        $.post("{{ url('api/procedure') }}", {
            event: "lesion_add",
            html: html,
            num: num,
        }, function(d, s) {
            // Data received and processed
            $("#advance_mainpart_" + mainpart).append(d);
            $("#num_" + mainpart).focus();
        });
        num++;
        $("#num_" + mainpart).val(num);
    });


    function clickfocus() {
        $(".mainpart_text").focusout()
    }

    $(document).on('focusout', '.advance_phototext', function() {
        let mainpart = $(this).attr("mainpart");
        let photo = $(this).attr("photo");
        let text = $(this).val();
        $.post("{{ url('api/procedure') }}", {
            event: "mainpart_photo_text",
            mainpart: mainpart,
            photo: photo,
            lesion: $(this).attr("lesion"),
            cid: '{{ $cid }}',
            text: text
        }, function(d, s) {});
    });

    $(document).on('focusout', '.advance_text', function() {
        $.post("{{ url('api/procedure') }}", {
            cid: '{{ $cid }}',
            event: "mainpart_text",
            mainpart: $(this).attr("mainpart"),
            lesion: $(this).attr("lesion"),
            component_name: $(this).attr("component_name"),
            text: $(this).val(),
        }, function(d, s) {});
    });

    $(document).on('click', '.advance_checkbox', function() {
        let group = $(this).attr("group");
        let lesion = $(this).attr("lesion");
        let mainpart = $(this).attr("mainpart");
        let component_name = $(this).attr("component_name");
        let checkall = [];
        $("input[mainpart='" + mainpart + "'][group='" + group + "'][lesion='" + lesion + "']").each(
            function() {
                if ($(this).prop("checked")) {
                    checkall.push($(this).val());
                }
            });
        $.post("{{ url('api/procedure') }}", {
            event: "mainpart_checkbox",
            cid: '{{ $cid }}',
            mainpart: $(this).attr("mainpart"),
            lesion: $(this).attr("lesion"),
            group: $(this).attr("group"),
            component_name: $(this).attr("component_name"),
            checkall: checkall
        }, function(d, s) {});
    });

    $(document).ready(function() {
        var text = $('#overall_finding').val();
        text = text.replace(/^\s*$(?:\r\n?|\n)/gm, "");
        $('#overall_finding').val(text);
    });
</script>


<script>
    $(".btn_advance").click(function() {
        var mainpart = $(this).attr("mainpart")
        $(".advance_mainpart[text='" + mainpart + "']").toggle(300);
    })
</script>

<script>
    $(".mainpart_text").focusout(function() {
        restore_finding()
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update",
            group_key: $(this).attr("group_key"),
            value: $(this).val(),
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    $(".mainpart_group").click(function() {
        const group = [];
        var value = $(this).attr("status");
        $(".mainpart_text").val(value);
        $(".mainpart_text").each(function() {
            $(this).focus();

            group.push($(this).attr("group_key"));
        });
        restore_finding()
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update_group",
            group: group,
            value: value,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    $(".btn_mainpart_na").click(function() {
        var group_key = $(this).attr("group_key");
        // Group key processed
        $("textarea[group_key='" + group_key + "']").val("N/A");
        restore_finding()
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update",
            group_key: group_key,
            value: "N/A",
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    function restore_finding() {
        let sub = []
        for (let i = 0; i < $('.mainpart_text').length; i++) {
            let inp_val = $($('.mainpart_text')[i]).val()
            inp_val = inp_val != undefined && inp_val != '' ? inp_val : ''
            sub.push(inp_val)
        }

        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}
        if (retString != null) {
            obj = JSON.parse(retString)
        }
        obj['finding'] = sub
        // Object prepared for storage
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);
    }

    // Function to restore gi095 form values from localStorage
    function restore_storage_gi095() {
        let retString = localStorage.getItem("{{ $cid }}");
        if (retString == null) return;

        let storage = JSON.parse(retString);
        restoreFormValues(storage);
    }

    // Function to restore form values from storage
    function restoreFormValues(storage) {

        // Pooling saliva restoration
        if (storage['pooling_saliva_no'] != undefined) {
            let shouldCheck = false;
            if (Array.isArray(storage['pooling_saliva_no']) && storage['pooling_saliva_no'].length > 0) {
                shouldCheck = true; // Array with values means checked
            } else if (storage['pooling_saliva_no'] === true) {
                shouldCheck = true; // Boolean true means checked
            } else if (storage['pooling_saliva_no'] === 'no') {
                shouldCheck = true; // String value means checked
            }

            $('#pooling_no').prop('checked', shouldCheck);
        } else {
            $('#pooling_no').prop('checked', false);
        }

        if (storage['pooling_saliva_severity'] != undefined) {
            $('#pooling_severity_select').val(storage['pooling_saliva_severity']);
        }

        if (storage['pooling_saliva_position'] != undefined) {
            $('#pooling_position_select').val(storage['pooling_saliva_position']);
        }

        // Helper function to check if a value means checked
        function isChecked(value) {
            if (Array.isArray(value) && value.length > 0) {
                return true; // Array with values means checked
            } else if (value === true) {
                return true; // Boolean true means checked
            } else if (typeof value === 'string' && value !== '') {
                return true; // Non-empty string means checked
            }
            return false;
        }

        if (storage['pooling_saliva_position_enable'] != undefined) {
            let shouldCheck = isChecked(storage['pooling_saliva_position_enable']);
            $('#pooling_position_checkbox').prop('checked', shouldCheck);
        } else {
            $('#pooling_position_checkbox').prop('checked', false);
        }

        if (storage['pooling_saliva_penetration'] != undefined) {
            $('#pooling_penetration').prop('checked', isChecked(storage['pooling_saliva_penetration']));
        } else {
            $('#pooling_penetration').prop('checked', false);
        }

        if (storage['pooling_saliva_aspiration'] != undefined) {
            $('#pooling_aspiration').prop('checked', isChecked(storage['pooling_saliva_aspiration']));
        } else {
            $('#pooling_aspiration').prop('checked', false);
        }

        // TVC movement restoration
        if (storage['tvc_movement_good'] != undefined) {
            $('#tvc_good').prop('checked', isChecked(storage['tvc_movement_good']));
        } else {
            $('#tvc_good').prop('checked', false);
        }

        if (storage['tvc_movement_paresis_check'] != undefined) {
            $('#tvc_side_paresis_checkbox').prop('checked', isChecked(storage['tvc_movement_paresis_check']));
        } else {
            $('#tvc_side_paresis_checkbox').prop('checked', false);
        }

        if (storage['tvc_movement_side'] != undefined) {
            $('#tvc_side_paresis_select').val(storage['tvc_movement_side']);
        }

        if (storage['tvc_movement_paralysis_check'] != undefined) {
            $('#tvc_paralysis_checkbox').prop('checked', isChecked(storage['tvc_movement_paralysis_check']));
        } else {
            $('#tvc_paralysis_checkbox').prop('checked', false);
        }

        if (storage['tvc_movement_paralysis_side'] != undefined) {
            $('#tvc_left_paralysis').val(storage['tvc_movement_paralysis_side']);
        }

        // Sensation restoration
        if (storage['sensation_good'] != undefined) {
            $('#sensation_good').prop('checked', isChecked(storage['sensation_good']));
        } else {
            $('#sensation_good').prop('checked', false);
        }

        if (storage['sensation_fair'] != undefined) {
            $('#sensation_fair').prop('checked', isChecked(storage['sensation_fair']));
        } else {
            $('#sensation_fair').prop('checked', false);
        }

        if (storage['sensation_impair'] != undefined) {
            $('#sensation_impair').prop('checked', isChecked(storage['sensation_impair']));
        } else {
            $('#sensation_impair').prop('checked', false);
        }

        // Safety freetext restoration
        if (storage['safety_freetext'] != undefined) {
            $('#safety_freetext').val(storage['safety_freetext']);
        } else {
            $('#safety_freetext').val('');
        }

        // Test restoration
        if (storage['test'] != undefined) {
            $('#test_select_0').val(storage['test']);
        }

        // Compensation restoration
        if (storage['compensation_small_volume'] != undefined) {
            $('#compensation_small_volume').prop('checked', isChecked(storage['compensation_small_volume']));
        } else {
            $('#compensation_small_volume').prop('checked', false);
        }

        if (storage['compensation_slow_rate'] != undefined) {
            $('#compensation_slow_rate').prop('checked', isChecked(storage['compensation_slow_rate']));
        } else {
            $('#compensation_slow_rate').prop('checked', false);
        }

        if (storage['compensation_chin_tuck'] != undefined) {
            $('#compensation_chin_tuck').prop('checked', isChecked(storage['compensation_chin_tuck']));
        } else {
            $('#compensation_chin_tuck').prop('checked', false);
        }

        if (storage['compensation_double_swallow'] != undefined) {
            $('#compensation_double_swallow').prop('checked', isChecked(storage['compensation_double_swallow']));
        } else {
            $('#compensation_double_swallow').prop('checked', false);
        }

        if (storage['compensation_multiple_swallow'] != undefined) {
            $('#compensation_multiple_swallow').prop('checked', isChecked(storage['compensation_multiple_swallow']));
        } else {
            $('#compensation_multiple_swallow').prop('checked', false);
        }

        if (storage['compensation_recline_option'] != undefined) {
            $('#compensation_recline_option').prop('checked', isChecked(storage['compensation_recline_option']));
        } else {
            $('#compensation_recline_option').prop('checked', false);
        }

        if (storage['compensation_mendelsohn_maneuver'] != undefined) {
            $('#compensation_mendelsohn_maneuver').prop('checked', isChecked(storage[
                'compensation_mendelsohn_maneuver']));
        } else {
            $('#compensation_mendelsohn_maneuver').prop('checked', false);
        }

        if (storage['compensation_tilt_direction'] != undefined) {
            $('#compensation_tilt').val(storage['compensation_tilt_direction']);
        }

        if (storage['compensation_turn_to_direction'] != undefined) {
            $('#compensation_turn_to').val(storage['compensation_turn_to_direction']);
        }

        if (storage['compensation_other_text'] != undefined) {
            $('#compensation_other_text').val(storage['compensation_other_text']);
        }

        // Residual restoration
        if (storage['residual_no'] != undefined) {
            $('#residual_no').prop('checked', isChecked(storage['residual_no']));
        } else {
            $('#residual_no').prop('checked', false);
        }

        if (storage['residual_yes_check'] != undefined) {
            $('#residual_vallecula').prop('checked', isChecked(storage['residual_yes_check']));
        } else {
            $('#residual_vallecula').prop('checked', false);
        }

        if (storage['residual_yes_type'] != undefined) {
            $('#residual_yes').val(storage['residual_yes_type']);
        }

        if (storage['residual_pyriform_sinus_type'] != undefined) {
            $('#residual_pyriform_sinus').val(storage['residual_pyriform_sinus_type']);
        }

        // PAS restoration
        if (storage['pas_penetration'] != undefined) {
            $('#pas_penetration').prop('checked', isChecked(storage['pas_penetration']));
        } else {
            $('#pas_penetration').prop('checked', false);
        }

        if (storage['pas_aspiration'] != undefined) {
            $('#pas_aspiration').prop('checked', isChecked(storage['pas_aspiration']));
        } else {
            $('#pas_aspiration').prop('checked', false);
        }

        if (storage['pas_level'] != undefined) {
            $('#pas_level').val(storage['pas_level']);
        }

        // Safety restoration
        if (storage['safety_safe'] != undefined) {
            $('#safety_safe').prop('checked', isChecked(storage['safety_safe']));
        } else {
            $('#safety_safe').prop('checked', false);
        }

        if (storage['safety_not_safe'] != undefined) {
            $('#safety_not_safe').prop('checked', isChecked(storage['safety_not_safe']));
        } else {
            $('#safety_not_safe').prop('checked', false);
        }

        if (storage['safety_freetext'] != undefined) {
            $('#safety_freetext').val(storage['safety_freetext']);
        }

        // Test freetext restoration
        if (storage['test_free_text'] != undefined) {
            $('#test_free_text').val(storage['test_free_text']);
        }

        if (storage['diagnostic_free_text'] != undefined) {
            $('#diagnostic_free_text').val(storage['diagnostic_free_text']);
        }

        // Complications restoration
        if (storage['complications_no'] != undefined) {
            $('#complications_no').prop('checked', isChecked(storage['complications_no']));
        } else {
            $('#complications_no').prop('checked', false);
        }

        if (storage['complications_free_text'] != undefined) {
            $('#complications_free_text').val(storage['complications_free_text']);
        }

        // Advice restoration
        if (storage['advice_purpose_eating'] != undefined) {
            $('#advice_purpose_eating').prop('checked', isChecked(storage['advice_purpose_eating']));
        } else {
            $('#advice_purpose_eating').prop('checked', false);
        }

        if (storage['advice_purpose_training'] != undefined) {
            $('#advice_purpose_training').prop('checked', isChecked(storage['advice_purpose_training']));
        } else {
            $('#advice_purpose_training').prop('checked', false);
        }

        if (storage['advice_liquid'] != undefined) {
            $('#advice_liquid').val(storage['advice_liquid']);
        }

        if (storage['advice_food'] != undefined) {
            $('#advice_food').val(storage['advice_food']);
        }

        // Technique restoration
        if (storage['technique_small_volume_check'] != undefined) {
            $('#technique_small_volume_check').prop('checked', isChecked(storage['technique_small_volume_check']));
        } else {
            $('#technique_small_volume_check').prop('checked', false);
        }

        if (storage['technique_slow_rate_check'] != undefined) {
            $('#technique_slow_rate_check').prop('checked', isChecked(storage['technique_slow_rate_check']));
        } else {
            $('#technique_slow_rate_check').prop('checked', false);
        }

        if (storage['technique_chin_tuck_check'] != undefined) {
            $('#technique_chin_tuck_check').prop('checked', isChecked(storage['technique_chin_tuck_check']));
        } else {
            $('#technique_chin_tuck_check').prop('checked', false);
        }

        if (storage['technique_double_swallow_check'] != undefined) {
            $('#technique_double_swallow_check').prop('checked', isChecked(storage['technique_double_swallow_check']));
        } else {
            $('#technique_double_swallow_check').prop('checked', false);
        }

        if (storage['technique_cough_technique_free_text'] != undefined) {
            $('#technique_cough_technique_free_text').val(storage['technique_cough_technique_free_text']);
        }

        if (storage['technique_tilt'] != undefined) {
            $('#technique_tilt').val(storage['technique_tilt']);
        }

        if (storage['technique_turn_to'] != undefined) {
            $('#technique_turn_to').val(storage['technique_turn_to']);
        }

        // Exercise restoration
        if (storage['exercise_basic_oromotor_check'] != undefined) {
            $('#exercise_basic_oromotor_check').prop('checked', isChecked(storage['exercise_basic_oromotor_check']));
        } else {
            $('#exercise_basic_oromotor_check').prop('checked', false);
        }

        if (storage['exercise_lingual_check'] != undefined) {
            $('#exercise_lingual_check').prop('checked', isChecked(storage['exercise_lingual_check']));
        } else {
            $('#exercise_lingual_check').prop('checked', false);
        }

        if (storage['exercise_base_of_tongue_check'] != undefined) {
            $('#exercise_base_of_tongue_check').prop('checked', isChecked(storage['exercise_base_of_tongue_check']));
        } else {
            $('#exercise_base_of_tongue_check').prop('checked', false);
        }

        if (storage['exercise_ctar_check'] != undefined) {
            $('#exercise_ctar_check').prop('checked', isChecked(storage['exercise_ctar_check']));
        } else {
            $('#exercise_ctar_check').prop('checked', false);
        }

        if (storage['exercise_shaker_check'] != undefined) {
            $('#exercise_shaker_check').prop('checked', isChecked(storage['exercise_shaker_check']));
        } else {
            $('#exercise_shaker_check').prop('checked', false);
        }

        if (storage['exercise_vocal_cord_exercise_check'] != undefined) {
            $('#exercise_vocal_cord_exercise_check').prop('checked', isChecked(storage[
                'exercise_vocal_cord_exercise_check']));
        } else {
            $('#exercise_vocal_cord_exercise_check').prop('checked', false);
        }

        if (storage['exercise_mendelsohn_check'] != undefined) {
            $('#exercise_mendelsohn_check').prop('checked', isChecked(storage['exercise_mendelsohn_check']));
        } else {
            $('#exercise_mendelsohn_check').prop('checked', false);
        }

        if (storage['exercise_neck_exercise_check'] != undefined) {
            $('#exercise_neck_exercise_check').prop('checked', isChecked(storage['exercise_neck_exercise_check']));
        } else {
            $('#exercise_neck_exercise_check').prop('checked', false);
        }

        if (storage['exercise_breathing_exercise_check'] != undefined) {
            $('#exercise_breathing_exercise_check').prop('checked', isChecked(storage[
                'exercise_breathing_exercise_check']));
        } else {
            $('#exercise_breathing_exercise_check').prop('checked', false);
        }

        if (storage['exercise_cough_technique_check'] != undefined) {
            $('#exercise_cough_technique_check').prop('checked', isChecked(storage['exercise_cough_technique_check']));
        } else {
            $('#exercise_cough_technique_check').prop('checked', false);
        }
    }

    // Clear values when checkboxes are unchecked or selects are reset
    $(document).ready(function() {
        // Restore values from localStorage on page load
        setTimeout(function() {
            restore_storage_gi095();
        }, 500);

        // Handle select changes for gi095 form (both savejson and savejson_checkbox)
        $('select.savejson, select.savejson_checkbox').change(function() {
            let this_name = $(this).attr('name');
            let selected_value = $(this).val();

            let retString = localStorage.getItem("{{ $cid }}");
            let obj = {};
            if (retString != null) {
                obj = JSON.parse(retString);
            }

            if (selected_value === '' || selected_value === null) {
                // Clear the value if reset to default
                delete obj[this_name];
                // Send to database immediately to clear the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database cleared successfully
                });
            } else {
                obj[this_name] = selected_value;
                // Send to database immediately to save the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [selected_value],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database saved successfully
                });
            }

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        });

        // Handle text input changes for gi095 form
        $('input[type="text"].savejson_checkbox').change(function() {
            let this_name = $(this).attr('name');
            let input_value = $(this).val();

            let retString = localStorage.getItem("{{ $cid }}");
            let obj = {};
            if (retString != null) {
                obj = JSON.parse(retString);
            }

            if (input_value === '' || input_value === null) {
                // Clear the value if empty
                delete obj[this_name];
                // Send to database immediately to clear the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database cleared successfully
                });
            } else {
                obj[this_name] = input_value;
                // Send to database immediately to save the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [input_value],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database saved successfully
                });
            }

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        });

        // Handle textarea changes for autotext savejson
        $(document).off('change', 'textarea.autotext.savejson').on('change', 'textarea.autotext.savejson',
            function() {
                let this_name = $(this).attr('name');
                let this_id = $(this).attr('id');
                let textarea_value = $(this).val();

                // Check if this is an additional test-safety item (has index in ID)
                let indexMatch = this_id.match(/_(\d+)$/);
                if (indexMatch) {
                    let index = indexMatch[1];

                    // Only handle additional items (index > 0)
                    if (parseInt(index) > 0) {
                        let retString = localStorage.getItem("{{ $cid }}");
                        let obj = {};
                        if (retString != null) {
                            obj = JSON.parse(retString);
                        }

                        if (textarea_value === '' || textarea_value === null) {
                            delete obj[this_name];
                        } else {
                            obj[this_name] = textarea_value;
                        }

                        let text = JSON.stringify(obj);
                        localStorage.setItem("{{ $cid }}", text);

                        // Send to database
                        $.post('{{ url('api/jquery') }}', {
                            event: 'savejson_checkbox2',
                            idhtml: this_name,
                            value: obj[this_name] ? [obj[this_name]] : [],
                            table: 'tb_case',
                            idname: 'case_id',
                            id: '{{ $cid }}',
                            procedure: '{{ $procedure->code }}',
                        });

                        return;
                    }
                }

                // Handle main form (index 0 or no index)
                let retString = localStorage.getItem("{{ $cid }}");
                let obj = {};
                if (retString != null) {
                    obj = JSON.parse(retString);
                }

                if (textarea_value === '' || textarea_value === null) {
                    // Clear the value if empty
                    delete obj[this_name];
                    // Send to database immediately to clear the value
                    $.post('{{ url('api/jquery') }}', {
                        event: 'savejson_checkbox2',
                        idhtml: this_name,
                        value: [],
                        table: 'tb_case',
                        idname: 'case_id',
                        id: '{{ $cid }}',
                        procedure: '{{ $procedure->code }}',
                    }, function(data, status) {
                        // Database cleared successfully
                    });
                } else {
                    obj[this_name] = textarea_value;
                    // Send to database immediately to save the value
                    $.post('{{ url('api/jquery') }}', {
                        event: 'savejson_checkbox2',
                        idhtml: this_name,
                        value: [textarea_value],
                        table: 'tb_case',
                        idname: 'case_id',
                        id: '{{ $cid }}',
                        procedure: '{{ $procedure->code }}',
                    }, function(data, status) {
                        // Database saved successfully
                    });
                }

                let text = JSON.stringify(obj);
                localStorage.setItem("{{ $cid }}", text);
            });

        // Handle textarea changes for gi095 form
        $('textarea.savejson_checkbox').change(function() {
            let this_name = $(this).attr('name');
            let textarea_value = $(this).val();

            let retString = localStorage.getItem("{{ $cid }}");
            let obj = {};
            if (retString != null) {
                obj = JSON.parse(retString);
            }

            if (textarea_value === '' || textarea_value === null) {
                // Clear the value if empty
                delete obj[this_name];
                // Send to database immediately to clear the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database cleared successfully
                });
            } else {
                obj[this_name] = textarea_value;
                // Send to database immediately to save the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [textarea_value],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database saved successfully
                });
            }

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        });

        // Handle checkbox changes for gi095 form
        $('input[type="checkbox"].savejson_checkbox').change(function() {
            let this_name = $(this).attr('name');
            let is_checked = $(this).is(':checked');
            let checkbox_value = $(this).val();

            let retString = localStorage.getItem("{{ $cid }}");
            let obj = {};
            if (retString != null) {
                obj = JSON.parse(retString);
            }

            if (is_checked) {
                obj[this_name] = checkbox_value;
                // Send to database immediately to save the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [checkbox_value],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database saved successfully
                });
            } else {
                delete obj[this_name];
                // Send to database immediately to clear the value
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: this_name,
                    value: [],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                }, function(data, status) {
                    // Database cleared successfully
                });
            }

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        });

        // Handle checkbox to enable/disable select box
        $('#pooling_mild_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#pooling_severity_select').prop('disabled', false);
            } else {
                $('#pooling_severity_select').prop('disabled', true);
                $('#pooling_severity_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#pooling_severity_select').trigger('change');
            }
        });

        // Initialize select box state based on checkbox
        if ($('#pooling_mild_checkbox').is(':checked')) {
            $('#pooling_severity_select').prop('disabled', false);
        } else {
            $('#pooling_severity_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable position select box
        $('#pooling_position_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#pooling_position_select').prop('disabled', false);
            } else {
                $('#pooling_position_select').prop('disabled', true);
                $('#pooling_position_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#pooling_position_select').trigger('change');
            }
        });

        // Initialize position select box state based on checkbox
        if ($('#pooling_position_checkbox').is(':checked')) {
            $('#pooling_position_select').prop('disabled', false);
        } else {
            $('#pooling_position_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable side paresis select box
        $('#tvc_side_paresis_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#tvc_side_paresis_select').prop('disabled', false);
            } else {
                $('#tvc_side_paresis_select').prop('disabled', true);
                $('#tvc_side_paresis_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#tvc_side_paresis_select').trigger('change');
            }
        });

        // Initialize side paresis select box state based on checkbox
        if ($('#tvc_side_paresis_checkbox').is(':checked')) {
            $('#tvc_side_paresis_select').prop('disabled', false);
        } else {
            $('#tvc_side_paresis_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable paralysis select box
        $('#tvc_paralysis_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#tvc_left_paralysis').prop('disabled', false);
            } else {
                $('#tvc_left_paralysis').prop('disabled', true);
                $('#tvc_left_paralysis').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#tvc_left_paralysis').trigger('change');
            }
        });

        // Initialize paralysis select box state based on checkbox
        if ($('#tvc_paralysis_checkbox').is(':checked')) {
            $('#tvc_left_paralysis').prop('disabled', false);
        } else {
            $('#tvc_left_paralysis').prop('disabled', true);
        }

        // Handle checkbox to enable/disable tilt select box
        $('#compensation_tilt_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#compensation_tilt_select').prop('disabled', false);
            } else {
                $('#compensation_tilt_select').prop('disabled', true);
                $('#compensation_tilt_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#compensation_tilt_select').trigger('change');
            }
        });

        // Initialize tilt select box state based on checkbox
        if ($('#compensation_tilt_checkbox').is(':checked')) {
            $('#compensation_tilt_select').prop('disabled', false);
        } else {
            $('#compensation_tilt_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable turn to select box
        $('#compensation_turn_to_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#compensation_turn_to_select').prop('disabled', false);
            } else {
                $('#compensation_turn_to_select').prop('disabled', true);
                $('#compensation_turn_to_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#compensation_turn_to_select').trigger('change');
            }
        });

        // Initialize turn to select box state based on checkbox
        if ($('#compensation_turn_to_checkbox').is(':checked')) {
            $('#compensation_turn_to_select').prop('disabled', false);
        } else {
            $('#compensation_turn_to_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable other text input
        $('#compensation_other_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#compensation_other_text_input').prop('disabled', false);
            } else {
                $('#compensation_other_text_input').prop('disabled', true);
                $('#compensation_other_text_input').val(''); // Clear text
                // Trigger change event to save the cleared value
                $('#compensation_other_text_input').trigger('change');
            }
        });

        // Initialize other text input state based on checkbox
        if ($('#compensation_other_checkbox').is(':checked')) {
            $('#compensation_other_text_input').prop('disabled', false);
        } else {
            $('#compensation_other_text_input').prop('disabled', true);
        }

        // Handle checkbox to enable/disable residual yes select box
        $('#residual_yes_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#residual_yes').prop('disabled', false);
            } else {
                $('#residual_yes').prop('disabled', true);
                $('#residual_yes').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#residual_yes').trigger('change');
            }
        });

        // Initialize residual yes select box state based on checkbox
        if ($('#residual_yes_checkbox').is(':checked')) {
            $('#residual_yes').prop('disabled', false);
        } else {
            $('#residual_yes').prop('disabled', true);
        }

        // Handle checkbox to enable/disable residual pyriform sinus select box
        $('#residual_pyriform_sinus_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#residual_pyriform_sinus_select').prop('disabled', false);
            } else {
                $('#residual_pyriform_sinus_select').prop('disabled', true);
                $('#residual_pyriform_sinus_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#residual_pyriform_sinus_select').trigger('change');
            }
        });

        // Initialize residual pyriform sinus select box state based on checkbox
        if ($('#residual_pyriform_sinus_checkbox').is(':checked')) {
            $('#residual_pyriform_sinus_select').prop('disabled', false);
        } else {
            $('#residual_pyriform_sinus_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable PAS select box
        $('#pas_level_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#pas_level_select').prop('disabled', false);
            } else {
                $('#pas_level_select').prop('disabled', true);
                $('#pas_level_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#pas_level_select').trigger('change');
            }
        });

        // Initialize PAS select box state based on checkbox
        if ($('#pas_level_checkbox').is(':checked')) {
            $('#pas_level_select').prop('disabled', false);
        } else {
            $('#pas_level_select').prop('disabled', true);
        }

        // Handle checkbox to enable/disable safety free text input
        $('#safety_free_text_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#safety_free_text_input').prop('disabled', false);
            } else {
                $('#safety_free_text_input').prop('disabled', true);
                $('#safety_free_text_input').val(''); // Clear text
                // Trigger change event to save the cleared value
                $('#safety_free_text_input').trigger('change');
            }
        });

        // Initialize safety free text input state based on checkbox
        if ($('#safety_free_text_checkbox').is(':checked')) {
            $('#safety_free_text_input').prop('disabled', false);
        } else {
            $('#safety_free_text_input').prop('disabled', true);
        }

        // Handle checkbox to enable/disable technique cough technique free text input
        $('#technique_cough_technique_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#technique_cough_technique_free_text_input').prop('disabled', false);
            } else {
                $('#technique_cough_technique_free_text_input').prop('disabled', true);
                $('#technique_cough_technique_free_text_input').val(''); // Clear text
                // Trigger change event to save the cleared value
                $('#technique_cough_technique_free_text_input').trigger('change');
            }
        });

        // Initialize technique cough technique free text input state based on checkbox
        if ($('#technique_cough_technique_checkbox').is(':checked')) {
            $('#technique_cough_technique_free_text_input').prop('disabled', false);
        } else {
            $('#technique_cough_technique_free_text_input').prop('disabled', true);
        }

        // Handle checkbox to enable/disable complications free text input
        $('#complications_free_text_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#complications_free_text_input').prop('disabled', false);
            } else {
                $('#complications_free_text_input').prop('disabled', true);
                $('#complications_free_text_input').val(''); // Clear text
                // Trigger change event to save the cleared value
                $('#complications_free_text_input').trigger('change');
            }
        });

        // Initialize complications free text input state based on checkbox
        if ($('#complications_free_text_checkbox').is(':checked')) {
            $('#complications_free_text_input').prop('disabled', false);
        } else {
            $('#complications_free_text_input').prop('disabled', true);
        }

        // Handle checkbox to enable/disable technique tilt select box
        $('#technique_tilt_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#technique_tilt_select').prop('disabled', false);
            } else {
                $('#technique_tilt_select').prop('disabled', true);
                $('#technique_tilt_select').val(''); // Clear selection
                // Trigger change event to save the cleared value
                $('#technique_tilt_select').trigger('change');
            }
        });

        // Initialize technique tilt select box state based on checkbox
        if ($('#technique_tilt_checkbox').is(':checked')) {
            $('#technique_tilt_select').prop('disabled', false);
        } else {
            $('#technique_tilt_select').prop('disabled', true);
        }


        $('#technique_turn_to_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#technique_turn_to_select').prop('disabled', false);
            } else {
                $('#technique_turn_to_select').prop('disabled', true);
                $('#technique_turn_to_select').val(''); // Clear selection

                $('#technique_turn_to_select').trigger('change');
            }
        });


        if ($('#technique_turn_to_checkbox').is(':checked')) {
            $('#technique_turn_to_select').prop('disabled', false);
        } else {
            $('#technique_turn_to_select').prop('disabled', true);
        }


        let testSafetyIndex = 1;


        function loadAdditionalTestSafetyItems() {
            let retString = localStorage.getItem("{{ $cid }}");
            if (retString != null) {
                let obj = JSON.parse(retString);


                let additionalItems = obj['test_safety_additional_items'];
                if (additionalItems && Array.isArray(additionalItems) && additionalItems.length > 0) {

                    additionalItems.forEach(function(index) {
                        const newItem = createTestSafetyItem(index);
                        $('#test-safety-container').append(newItem);
                        testSafetyIndex = Math.max(testSafetyIndex, index + 1);


                        loadSavedDataForAdditionalItem(index);
                    });

                    initializeSaveJsonCheckbox();


                    if ($('.test-safety-item').length > 1) {
                        $('.remove-test-safety-btn').show();
                    }
                }
            }
        }


        function loadSavedDataForAdditionalItem(index) {
            let retString = localStorage.getItem("{{ $cid }}");
            if (retString != null) {
                let obj = JSON.parse(retString);

                // Load test data
                if (obj['test_' + index]) {
                    $('#test_select_' + index).val(obj['test_' + index]);
                }

                // Load test freetext data
                if (obj['test_free_text_' + index]) {
                    $('#test_free_text_' + index).val(obj['test_free_text_' + index]);
                }

                // Load compensation data
                if (obj['compensation_small_volume_' + index]) {
                    $('#compensation_small_volume_' + index).prop('checked', true);
                }
                if (obj['compensation_slow_rate_' + index]) {
                    $('#compensation_slow_rate_' + index).prop('checked', true);
                }
                if (obj['compensation_chin_tuck_' + index]) {
                    $('#compensation_chin_tuck_' + index).prop('checked', true);
                }
                if (obj['compensation_double_swallow_' + index]) {
                    $('#compensation_double_swallow_' + index).prop('checked', true);
                }
                if (obj['compensation_multiple_swallow_' + index]) {
                    $('#compensation_multiple_swallow_' + index).prop('checked', true);
                }
                if (obj['compensation_tilt_enable_' + index]) {
                    $('#compensation_tilt_checkbox_' + index).prop('checked', true);
                }
                if (obj['compensation_tilt_direction_' + index]) {
                    $('#compensation_tilt_select_' + index).val(obj['compensation_tilt_direction_' + index]);
                }
                if (obj['compensation_turn_to_enable_' + index]) {
                    $('#compensation_turn_to_checkbox_' + index).prop('checked', true);
                }
                if (obj['compensation_turn_to_direction_' + index]) {
                    $('#compensation_turn_to_select_' + index).val(obj['compensation_turn_to_direction_' +
                        index]);
                }
                if (obj['compensation_recline_option_' + index]) {
                    $('#compensation_recline_option_' + index).prop('checked', true);
                }
                if (obj['compensation_mendelsohn_maneuver_' + index]) {
                    $('#compensation_mendelsohn_maneuver_' + index).prop('checked', true);
                }
                if (obj['compensation_other_enable_' + index]) {
                    $('#compensation_other_checkbox_' + index).prop('checked', true);
                }
                if (obj['compensation_other_text_' + index]) {
                    $('#compensation_other_text_input_' + index).val(obj['compensation_other_text_' + index]);
                }

                // Load residual data
                if (obj['residual_no_' + index]) {
                    $('#residual_no_' + index).prop('checked', true);
                }
                if (obj['residual_yes_enable_' + index]) {
                    $('#residual_yes_checkbox_' + index).prop('checked', true);
                }
                if (obj['residual_yes_type_' + index]) {
                    $('#residual_yes_' + index).val(obj['residual_yes_type_' + index]);
                }
                if (obj['residual_yes_check_' + index]) {
                    $('#residual_vallecula_' + index).prop('checked', true);
                }
                if (obj['residual_pyriform_sinus_enable_' + index]) {
                    $('#residual_pyriform_sinus_checkbox_' + index).prop('checked', true);
                }
                if (obj['residual_pyriform_sinus_type_' + index]) {
                    $('#residual_pyriform_sinus_select_' + index).val(obj['residual_pyriform_sinus_type_' +
                        index]);
                }

                // Load PAS data
                if (obj['pas_penetration_' + index]) {
                    $('#pas_penetration_' + index).prop('checked', true);
                }
                if (obj['pas_aspiration_' + index]) {
                    $('#pas_aspiration_' + index).prop('checked', true);
                }
                if (obj['pas_level_enable_' + index]) {
                    $('#pas_level_checkbox_' + index).prop('checked', true);
                }
                if (obj['pas_level_' + index]) {
                    $('#pas_level_select_' + index).val(obj['pas_level_' + index]);
                }

                // Load Safety data
                if (obj['safety_safe_' + index]) {
                    $('#safety_safe_' + index).prop('checked', true);
                }
                if (obj['safety_not_safe_' + index]) {
                    $('#safety_not_safe_' + index).prop('checked', true);
                }
                if (obj['safety_free_text_enable_' + index]) {
                    $('#safety_free_text_checkbox_' + index).prop('checked', true);
                }
                if (obj['safety_free_text_' + index]) {
                    $('#safety_free_text_input_' + index).val(obj['safety_free_text_' + index]);
                }
                if (obj['safety_freetext_' + index]) {
                    $('#safety_freetext_' + index).val(obj['safety_freetext_' + index]);
                }
            }
        }

        // Call this function when page loads
        loadAdditionalTestSafetyItems();

        // Add new test-safety item
        $('#add-test-safety-btn').click(function() {
            const newIndex = testSafetyIndex++;
            const newItem = createTestSafetyItem(newIndex);
            $('#test-safety-container').append(newItem);

            // Initialize savejson_checkbox functionality for the new item
            initializeSaveJsonCheckbox();

            // Save the additional item index to localStorage
            let retString = localStorage.getItem("{{ $cid }}");
            let obj = {};
            if (retString != null) {
                obj = JSON.parse(retString);
            }

            if (!obj['test_safety_additional_items']) {
                obj['test_safety_additional_items'] = [];
            }
            obj['test_safety_additional_items'].push(newIndex);

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);

            // Send additional items list to database
            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox2',
                idhtml: 'test_safety_additional_items',
                value: obj['test_safety_additional_items'] ? obj[
                    'test_safety_additional_items'] : [],
                table: 'tb_case',
                idname: 'case_id',
                id: '{{ $cid }}',
                procedure: '{{ $procedure->code }}',
            });

            // Show delete buttons for all items if there are more than 1
            if ($('.test-safety-item').length > 1) {
                $('.remove-test-safety-btn').show();
            }
        });

        // Remove test-safety item
        $(document).on('click', '.remove-test-safety-btn', function() {
            const itemToRemove = $(this).closest('.test-safety-item');
            const itemIndex = parseInt(itemToRemove.data('index'));

            // Remove from DOM
            itemToRemove.remove();

            // Update localStorage
            let retString = localStorage.getItem("{{ $cid }}");
            if (retString != null) {
                let obj = JSON.parse(retString);

                if (obj['test_safety_additional_items']) {
                    obj['test_safety_additional_items'] = obj['test_safety_additional_items'].filter(
                        index => index !== itemIndex);
                }

                // Remove all saved data for this item
                let fieldsToRemove = [
                    'test', 'compensation_small_volume', 'compensation_slow_rate',
                    'compensation_chin_tuck',
                    'compensation_double_swallow', 'compensation_multiple_swallow',
                    'compensation_tilt_enable',
                    'compensation_tilt_direction', 'compensation_turn_to_enable',
                    'compensation_turn_to_direction',
                    'compensation_recline_option', 'compensation_mendelsohn_maneuver',
                    'compensation_other_enable',
                    'compensation_other_text', 'residual_no', 'residual_yes_enable',
                    'residual_yes_type',
                    'residual_yes_check', 'residual_pyriform_sinus_enable',
                    'residual_pyriform_sinus_type',
                    'pas_penetration', 'pas_aspiration', 'pas_level_enable', 'pas_level',
                    'safety_safe', 'safety_not_safe', 'safety_free_text_enable', 'safety_free_text'
                ];

                fieldsToRemove.forEach(function(field) {
                    delete obj[field + '_' + itemIndex];
                });

                let text = JSON.stringify(obj);
                localStorage.setItem("{{ $cid }}", text);

                // Send updated additional items list to database
                $.post('{{ url('api/jquery') }}', {
                    event: 'savejson_checkbox2',
                    idhtml: 'test_safety_additional_items',
                    value: obj['test_safety_additional_items'] ? obj[
                        'test_safety_additional_items'] : [],
                    table: 'tb_case',
                    idname: 'case_id',
                    id: '{{ $cid }}',
                    procedure: '{{ $procedure->code }}',
                });
            }

            // Hide delete buttons if only 1 item left
            if ($('.test-safety-item').length <= 1) {
                $('.remove-test-safety-btn').hide();
            }
        });


        // Function to initialize savejson_checkbox functionality for new elements
        function initializeSaveJsonCheckbox() {
            // Handle text input changes for additional items
            $(document).off('change', 'input[type="text"].savejson_checkbox').on('change',
                'input[type="text"].savejson_checkbox',
                function() {
                    let this_name = $(this).attr('name');
                    let this_id = $(this).attr('id');
                    let input_value = $(this).val();

                    console.log('Text input changed:', this_name, this_id, input_value);

                    // Check if this is an additional test-safety item (has index in ID)
                    let indexMatch = this_id.match(/_(\d+)$/);
                    if (indexMatch) {
                        let index = indexMatch[1];

                        // Only handle additional items (index > 0)
                        if (parseInt(index) > 0) {
                            console.log('Processing additional item:', index);
                            let retString = localStorage.getItem("{{ $cid }}");
                            let obj = {};
                            if (retString != null) {
                                obj = JSON.parse(retString);
                            }

                            let fieldName = this_name;
                            console.log('Field name:', fieldName);

                            if (input_value === '' || input_value === null) {
                                delete obj[fieldName];
                                console.log('Deleted field:', fieldName);
                            } else {
                                obj[fieldName] = input_value;
                                console.log('Saved field:', fieldName, 'value:', input_value);
                            }

                            // Save to localStorage
                            let text = JSON.stringify(obj);
                            localStorage.setItem("{{ $cid }}", text);
                            console.log('Saved to localStorage:', obj);

                            // Send to database
                            $.post('{{ url('api/jquery') }}', {
                                event: 'savejson_checkbox2',
                                idhtml: fieldName,
                                value: obj[fieldName] ? [obj[fieldName]] : [],
                                table: 'tb_case',
                                idname: 'case_id',
                                id: '{{ $cid }}',
                                procedure: '{{ $procedure->code }}',
                            });

                            return;
                        }
                    }
                });

            // Handle textarea changes for autotext savejson (additional items)
            $(document).off('change', 'textarea.autotext.savejson').on('change', 'textarea.autotext.savejson',
                function() {
                    let this_name = $(this).attr('name');
                    let this_id = $(this).attr('id');
                    let textarea_value = $(this).val();

                    // Check if this is an additional test-safety item (has index in ID)
                    let indexMatch = this_id.match(/_(\d+)$/);
                    if (indexMatch) {
                        let index = indexMatch[1];

                        // Only handle additional items (index > 0)
                        if (parseInt(index) > 0) {
                            console.log('Processing additional textarea item:', index);
                            let retString = localStorage.getItem("{{ $cid }}");
                            let obj = {};
                            if (retString != null) {
                                obj = JSON.parse(retString);
                            }

                            let fieldName = this_name;
                            console.log('Textarea field name:', fieldName);

                            if (textarea_value === '' || textarea_value === null) {
                                delete obj[fieldName];
                                console.log('Deleted textarea field:', fieldName);
                            } else {
                                obj[fieldName] = textarea_value;
                                console.log('Saved textarea field:', fieldName, 'value:', textarea_value);
                            }

                            // Save to localStorage
                            let text = JSON.stringify(obj);
                            localStorage.setItem("{{ $cid }}", text);
                            console.log('Saved textarea to localStorage:', obj);

                            // Send to database
                            $.post('{{ url('api/jquery') }}', {
                                event: 'savejson_checkbox2',
                                idhtml: fieldName,
                                value: obj[fieldName] ? [obj[fieldName]] : [],
                                table: 'tb_case',
                                idname: 'case_id',
                                id: '{{ $cid }}',
                                procedure: '{{ $procedure->code }}',
                            });

                            return;
                        }
                    }
                });

            // Override the existing savejson_checkbox system for additional items (non-text inputs)
            $(document).off('change', '.savejson_checkbox:not(input[type="text"])').on('change',
                '.savejson_checkbox:not(input[type="text"])',
                function() {
                    let this_name = $(this).attr('name');
                    let this_value = $(this).val();
                    let this_id = $(this).attr('id');
                    let is_checked = $(this).is(':checked');
                    let is_select = $(this).is('select');

                    // Check if this is an additional test-safety item (has index in ID)
                    let indexMatch = this_id.match(/_(\d+)$/);
                    if (indexMatch) {
                        let index = indexMatch[1];

                        // Only handle additional items (index > 0)
                        if (parseInt(index) > 0) {
                            let retString = localStorage.getItem("{{ $cid }}");
                            let obj = {};
                            if (retString != null) {
                                obj = JSON.parse(retString);
                            }

                            let fieldName = this_name + '_' + index;

                            if (is_checked) {
                                // For checkboxes
                                obj[fieldName] = this_value;
                            } else if (!is_checked && !is_select) {
                                // For unchecked checkboxes
                                delete obj[fieldName];
                            } else if (is_select) {
                                // For select inputs
                                if (this_value === '' || this_value === null) {
                                    delete obj[fieldName];
                                } else {
                                    obj[fieldName] = this_value;
                                }
                            }

                            // Save to localStorage
                            let text = JSON.stringify(obj);
                            localStorage.setItem("{{ $cid }}", text);

                            // Send to database
                            $.post('{{ url('api/jquery') }}', {
                                event: 'savejson_checkbox2',
                                idhtml: fieldName,
                                value: obj[fieldName] ? [obj[fieldName]] : [],
                                table: 'tb_case',
                                idname: 'case_id',
                                id: '{{ $cid }}',
                                procedure: '{{ $procedure->code }}',
                            });

                            // Also save the additional items list to database
                            if (fieldName.includes('_')) {
                                $.post('{{ url('api/jquery') }}', {
                                    event: 'savejson_checkbox2',
                                    idhtml: 'test_safety_additional_items',
                                    value: obj['test_safety_additional_items'] ? obj[
                                        'test_safety_additional_items'] : [],
                                    table: 'tb_case',
                                    idname: 'case_id',
                                    id: '{{ $cid }}',
                                    procedure: '{{ $procedure->code }}',
                                });
                            }

                            return;
                        }
                    }


                });
        }


        function createTestSafetyItem(index) {
            return `
                <div class="test-safety-item border border-light rounded p-3 mb-3" data-index="${index}">
                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="fw-bold mt-2">Test:</h6>
                        </div>
                        <div class="col-9">
                            <select class="form-select savejson_checkbox" name="test" id="test_select_${index}">
                                <option value="">-- เลือก --</option>
                                <option value="thin_liquid">thin liquid</option>
                                <option value="sightly_thick">sightly thick</option>
                                <option value="nectar">nectar</option>
                                <option value="honey">honey</option>
                                <option value="pudding">pudding</option>
                                <option value="IDDSI3">IDDSI3</option>
                                <option value="IDDSI4">IDDSI4</option>
                                <option value="IDDSI5">IDDSI5</option>
                                <option value="IDDSI6">IDDSI6</option>
                                <option value="IDDSI7">IDDSI7</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 mt-2">
                            <h6 class="fw-bold"></h6>
                        </div>
                        <div class="col-9">
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control form-control-sm autotext savejson_checkbox" id="test_free_text_${index}"
                                    name="test_free_text_${index}" style="width: 925px; display: inline-block;" placeholder="Freetext" autocomplete="off" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 mt-2">
                            <h6 class="fw-bold">Compensation:</h6>
                        </div>
                        <div class="col-9">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="compensation_small_volume" value="small_volume"
                                        id="compensation_small_volume_${index}">
                                    <label class="form-check-label" for="compensation_small_volume_${index}">small volume</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="compensation_slow_rate" value="slow_rate" id="compensation_slow_rate_${index}">
                                    <label class="form-check-label" for="compensation_slow_rate_${index}">slow rate</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="compensation_chin_tuck" value="chin_tuck" id="compensation_chin_tuck_${index}">
                                    <label class="form-check-label" for="compensation_chin_tuck_${index}">chin tuck</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="compensation_double_swallow" value="double_swallow"
                                        id="compensation_double_swallow_${index}">
                                    <label class="form-check-label" for="compensation_double_swallow_${index}">double swallow</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="compensation_multiple_swallow" value="multiple_swallow"
                                        id="compensation_multiple_swallow_${index}">
                                    <label class="form-check-label" for="compensation_multiple_swallow_${index}">multiple swallow</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="compensation_tilt_enable" value="tilt" id="compensation_tilt_checkbox_${index}">
                                    <label class="form-check-label" for="compensation_tilt_checkbox_${index}"> tilt</label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="compensation_tilt_direction" id="compensation_tilt_select_${index}"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left">left</option>
                                        <option value="right">right</option>
                                    </select>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="compensation_turn_to_enable" value="turn_to"
                                        id="compensation_turn_to_checkbox_${index}">
                                    <label class="form-check-label" for="compensation_turn_to_checkbox_${index}"> turn to</label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="compensation_turn_to_direction" id="compensation_turn_to_select_${index}"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left">left</option>
                                        <option value="right">right</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input savejson_checkbox" type="checkbox"
                                            name="compensation_recline_option" value="recline"
                                            id="compensation_recline_option_${index}">
                                        <label class="form-check-label" for="compensation_recline_option_${index}">recline</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input savejson_checkbox" type="checkbox"
                                            name="compensation_mendelsohn_maneuver" value="mendelsohn_maneuver"
                                            id="compensation_mendelsohn_maneuver_${index}">
                                        <label class="form-check-label" for="compensation_mendelsohn_maneuver_${index}">Mendelsohn maneuver</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                            name="compensation_other_enable" value="other"
                                            id="compensation_other_checkbox_${index}">
                                        <label class="form-check-label" for="compensation_other_checkbox_${index}"></label>
                                        <input type="text" class="form-control form-control-sm savejson_checkbox"
                                            name="compensation_other_text" id="compensation_other_text_input_${index}"
                                            placeholder="ระบุ..." style="width: 200px; display: inline-block;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 mt-2">
                            <h6 class="fw-bold">residual:</h6>
                        </div>
                        <div class="col-9">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="residual_no"
                                        value="no" id="residual_no_${index}">
                                    <label class="form-check-label" for="residual_no_${index}">no </label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="residual_yes_enable" value="yes" id="residual_yes_checkbox_${index}">
                                    <label class="form-check-label" for="residual_yes_checkbox_${index}"></label>
                                    <select class="form-select form-select-sm savejson_checkbox" name="residual_yes_type"
                                        id="residual_yes_${index}" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="trace">trace</option>
                                        <option value="mild">mild</option>
                                        <option value="moderate">moderate</option>
                                        <option value="severe">severe</option>
                                    </select>
                                    <span class="me-2 ms-2">at</span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="residual_yes_check" value="vallecula" id="residual_vallecula_${index}">
                                    <label class="form-check-label" for="residual_vallecula_${index}">vallecula</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="residual_pyriform_sinus_enable" value="pyriform_sinus"
                                        id="residual_pyriform_sinus_checkbox_${index}">
                                    <label class="form-check-label" for="residual_pyriform_sinus_checkbox_${index}"></label>
                                    <select class="form-select form-select-sm savejson_checkbox"
                                        name="residual_pyriform_sinus_type" id="residual_pyriform_sinus_select_${index}"
                                        style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left">left</option>
                                        <option value="right">right</option>
                                        <option value="both">both</option>
                                    </select>
                                    <span class="me-2">pyriform sinus</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 mt-2">
                            <h6 class="fw-bold">PAS:</h6>
                        </div>
                        <div class="col-9">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pas_penetration" value="penetration" id="pas_penetration_${index}">
                                    <label class="form-check-label" for="pas_penetration_${index}">penetration </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="pas_aspiration" value="aspiration" id="pas_aspiration_${index}">
                                    <label class="form-check-label" for="pas_aspiration_${index}">aspiration </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="pas_level_enable" value="pas_level" id="pas_level_checkbox_${index}">
                                    <label class="form-check-label" for="pas_level_checkbox_${index}">PAS</label>
                                    <select class="form-select form-select-sm savejson_checkbox" name="pas_level"
                                        id="pas_level_select_${index}" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 mt-2">
                            <h6 class="fw-bold">Safety:</h6>
                        </div>
                        <div class="col-9">
                            <div class="col-12 mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="safety_safe"
                                        value="safe" id="safety_safe_${index}">
                                    <label class="form-check-label" for="safety_safe_${index}">safe </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox"
                                        name="safety_not_safe" value="not_safe" id="safety_not_safe_${index}">
                                    <label class="form-check-label" for="safety_not_safe_${index}">not safe </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox mt-2" type="checkbox"
                                        name="safety_free_text_enable_${index}" value="free_text" id="safety_free_text_checkbox_${index}">
                                    <label class="form-check-label" for="safety_free_text_checkbox_${index}">อื่นๆ</label>
                                    <input type="text" class="form-control form-control-sm savejson_checkbox"
                                        id="safety_free_text_input_${index}" name="safety_free_text_${index}"
                                        style="width: 700px; display: inline-block;">
                                </div>
                            </div>
                        </div>

                    </div>
                     <div class="row">
                                <div class="col-2"></div>
                                <div class="col-9">
                                    <div class="col-12 mb-2">
                                        <textarea type="text" rows="2" class="form-control autotext savejson" name="safety_freetext_${index}" id="safety_freetext_${index}"
                                            placeholder="Freetext" type="text" autocomplete="off" value=""></textarea>
                                    </div>
                                </div>
                            </div>

                    <!-- Delete button for this test-safety item -->
                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-danger btn-sm remove-test-safety-btn">
                                <i class="fas fa-trash"></i> ลบชุดข้อมูลนี้
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

    });
</script>
