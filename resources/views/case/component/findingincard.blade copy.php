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
                    <div class="col-2">
                        <h6 class="fw-bold">Pooling saliva/mucous:</h6>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="pooling_saliva_no"
                                        value="no" id="pooling_no" {{ (@$case->pooling_saliva_no == 1 || @$case->pooling_saliva_no === true || @$case->pooling_saliva_no == '1' || @$case->pooling_saliva_no == 'no') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_no">no</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check-inline">
                                    <select class="form-select form-select-sm savejson_checkbox" name="pooling_saliva_severity"
                                        id="pooling_mild" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="mild" {{ @$case->pooling_saliva_severity == 'mild' ? 'selected' : '' }}>mild</option>
                                        <option value="moderate" {{ @$case->pooling_saliva_severity == 'moderate' ? 'selected' : '' }}>moderate</option>
                                        <option value="mark" {{ @$case->pooling_saliva_severity == 'mark' ? 'selected' : '' }}>mark</option>
                                    </select>
                                </div>
                                <span class="me-2">at vallecula</span>
                                <div class="form-check form-check-inline">
                                    <select class="form-select form-select-sm savejson_checkbox" name="pooling_saliva_position"
                                        id="pooling_left_right_both" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left" {{ @$case->pooling_saliva_position == 'left' ? 'selected' : '' }}>left</option>
                                        <option value="right" {{ @$case->pooling_saliva_position == 'right' ? 'selected' : '' }}>right</option>
                                        <option value="both" {{ @$case->pooling_saliva_position == 'both' ? 'selected' : '' }}>both</option>
                                    </select>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="pooling_saliva_pyriform"
                                        value="pyriform_sinus" id="pooling_pyriform_sinus" {{ (@$case->pooling_saliva_pyriform == 1 || @$case->pooling_saliva_pyriform === true || @$case->pooling_saliva_pyriform == '1' || @$case->pooling_saliva_pyriform == 'pyriform_sinus') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_pyriform_sinus">pyriform sinus</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="pooling_saliva_penetration"
                                        value="penetration" id="pooling_penetration" {{ (@$case->pooling_saliva_penetration == 1 || @$case->pooling_saliva_penetration === true || @$case->pooling_saliva_penetration == '1' || @$case->pooling_saliva_penetration == 'penetration') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pooling_penetration">penetration</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="pooling_saliva_aspiration"
                                        value="aspiration" id="pooling_aspiration" {{ (@$case->pooling_saliva_aspiration == 1 || @$case->pooling_saliva_aspiration === true || @$case->pooling_saliva_aspiration == '1' || @$case->pooling_saliva_aspiration == 'aspiration') ? 'checked' : '' }}>
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
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="tvc_movement_good"
                                        value="good" id="tvc_good" {{ (@$case->tvc_movement_good == 1 || @$case->tvc_movement_good === true || @$case->tvc_movement_good == '1' || @$case->tvc_movement_good == 'good') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tvc_good">good</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check-inline">
                                    <select class="form-select form-select-sm savejson_checkbox" name="tvc_movement_side"
                                        id="tvc_left_paresis" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left" {{ @$case->tvc_movement_side == 'left' ? 'selected' : '' }}>left</option>
                                        <option value="right" {{ @$case->tvc_movement_side == 'right' ? 'selected' : '' }}>right</option>
                                        <option value="both" {{ @$case->tvc_movement_side == 'both' ? 'selected' : '' }}>both</option>
                                    </select>
                                    <span class="me-2">side paresis</span>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check-inline">
                                    <select class="form-select form-select-sm savejson_checkbox" name="tvc_movement_paralysis_side"
                                        id="tvc_left_paralysis" style="width: auto; display: inline-block;">
                                        <option value="">-- เลือก --</option>
                                        <option value="left" {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('left', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'left' ? 'selected' : '') }}>left</option>
                                        <option value="right" {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('right', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'right' ? 'selected' : '') }}>right</option>
                                        <option value="both" {{ is_array(@$case->tvc_movement_paralysis_side) ? (in_array('both', @$case->tvc_movement_paralysis_side) ? 'selected' : '') : (@$case->tvc_movement_paralysis_side == 'both' ? 'selected' : '') }}>both</option>
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
                                value="good" id="sensation_good" {{ (@$case->sensation_good == 1 || @$case->sensation_good === true || @$case->sensation_good == '1' || @$case->sensation_good == 'good') ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_good">good</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input savejson_checkbox" type="checkbox" name="sensation_fair"
                                value="fair" id="sensation_fair" {{ (@$case->sensation_fair == 1 || @$case->sensation_fair === true || @$case->sensation_fair == '1' || @$case->sensation_fair == 'fair') ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_fair">fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input savejson_checkbox" type="checkbox" name="sensation_impair"
                                value="impair" id="sensation_impair" {{ (@$case->sensation_impair == 1 || @$case->sensation_impair === true || @$case->sensation_impair == '1' || @$case->sensation_impair == 'impair') ? 'checked' : '' }}>
                            <label class="form-check-label" for="sensation_impair">impair</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h6 class="fw-bold">Test:</h6>
                    </div>
                    <div class="col-9">
                        <select class="form-select savejson_checkbox" name="test" id="test_select">
                            <option value="">-- เลือก --</option>
                            <option value="thin_liquid" {{ is_array(@$case->test) ? (in_array('thin_liquid', @$case->test) ? 'selected' : '') : (@$case->test == 'thin_liquid' ? 'selected' : '') }}>thin liquid</option>
                            <option value="sightly_thick" {{ is_array(@$case->test) ? (in_array('sightly_thick', @$case->test) ? 'selected' : '') : (@$case->test == 'sightly_thick' ? 'selected' : '') }}>sightly thick</option>
                            <option value="nectar_honey" {{ is_array(@$case->test) ? (in_array('nectar_honey', @$case->test) ? 'selected' : '') : (@$case->test == 'nectar_honey' ? 'selected' : '') }}>nectar/honey</option>
                            <option value="pudding" {{ is_array(@$case->test) ? (in_array('pudding', @$case->test) ? 'selected' : '') : (@$case->test == 'pudding' ? 'selected' : '') }}>pudding</option>
                            <option value="IDDSI3" {{ is_array(@$case->test) ? (in_array('IDDSI3', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI3' ? 'selected' : '') }}>IDDSI3</option>
                            <option value="IDSIA" {{ is_array(@$case->test) ? (in_array('IDSIA', @$case->test) ? 'selected' : '') : (@$case->test == 'IDSIA' ? 'selected' : '') }}>IDSIA</option>
                            <option value="IDDSI" {{ is_array(@$case->test) ? (in_array('IDDSI', @$case->test) ? 'selected' : '') : (@$case->test == 'IDDSI' ? 'selected' : '') }}>IDDSI</option>
                            <option value="BIDDSI7" {{ is_array(@$case->test) ? (in_array('BIDDSI7', @$case->test) ? 'selected' : '') : (@$case->test == 'BIDDSI7' ? 'selected' : '') }}>BIDDSI7</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 mt-2">
                        <h6 class="fw-bold">Compensation:</h6>
                    </div>
                    <div class="col-9">
                        <div class="col-12 mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_small_volume"
                                    value="small_volume" id="compensation_small_volume" {{ (@$case->compensation_small_volume == 1 || @$case->compensation_small_volume === true || @$case->compensation_small_volume == '1' || @$case->compensation_small_volume == 'small_volume') ? 'checked' : '' }}>
                                <label class="form-check-label" for="compensation_small_volume">small volume</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_slow_rate"
                                    value="slow_rate" id="compensation_slow_rate" {{ (@$case->compensation_slow_rate == 1 || @$case->compensation_slow_rate === true || @$case->compensation_slow_rate == '1' || @$case->compensation_slow_rate == 'slow_rate') ? 'checked' : '' }}>
                                <label class="form-check-label" for="compensation_slow_rate">slow rate</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_chin_tuck"
                                    value="chin_tuck" id="compensation_chin_tuck" {{ (@$case->compensation_chin_tuck == 1 || @$case->compensation_chin_tuck === true || @$case->compensation_chin_tuck == '1' || @$case->compensation_chin_tuck == 'chin_tuck') ? 'checked' : '' }}>
                                <label class="form-check-label" for="compensation_chin_tuck">chin tuck</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_double_swallow"
                                    value="double_swallow" id="compensation_double_swallow" {{ (@$case->compensation_double_swallow == 1 || @$case->compensation_double_swallow === true || @$case->compensation_double_swallow == '1' || @$case->compensation_double_swallow == 'double_swallow') ? 'checked' : '' }}>
                                <label class="form-check-label" for="compensation_double_swallow">double
                                    swallow</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_multiple_swallow"
                                    value="multiple_swallow" id="compensation_multiple_swallow" {{ (@$case->compensation_multiple_swallow == 1 || @$case->compensation_multiple_swallow === true || @$case->compensation_multiple_swallow == '1' || @$case->compensation_multiple_swallow == 'multiple_swallow') ? 'checked' : '' }}>
                                <label class="form-check-label" for="compensation_multiple_swallow">multiple
                                    swallow</label>
                            </div>
                            <div class="form-check-inline">
                                <span class="me-2">tilt</span>
                                <select class="form-select form-select-sm savejson_checkbox" name="compensation_tilt_direction"
                                    id="compensation_tilt" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ is_array(@$case->compensation_tilt_direction) ? (in_array('left', @$case->compensation_tilt_direction) ? 'selected' : '') : (@$case->compensation_tilt_direction == 'left' ? 'selected' : '') }}>left</option>
                                    <option value="right" {{ is_array(@$case->compensation_tilt_direction) ? (in_array('right', @$case->compensation_tilt_direction) ? 'selected' : '') : (@$case->compensation_tilt_direction == 'right' ? 'selected' : '') }}>right</option>
                                </select>
                            </div>
                            <div class="form-check-inline">
                                   <span class="me-2">turn to</span>
                                <select class="form-select form-select-sm savejson_checkbox" name="compensation_turn_to_direction"
                                    id="compensation_turn_to" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ is_array(@$case->compensation_turn_to_direction) ? (in_array('left', @$case->compensation_turn_to_direction) ? 'selected' : '') : (@$case->compensation_turn_to_direction == 'left' ? 'selected' : '') }}>left</option>
                                    <option value="right" {{ is_array(@$case->compensation_turn_to_direction) ? (in_array('right', @$case->compensation_turn_to_direction) ? 'selected' : '') : (@$case->compensation_turn_to_direction == 'right' ? 'selected' : '') }}>right</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_recline_option"
                                        value="recline" id="compensation_recline_option" {{ (@$case->compensation_recline_option == 1 || @$case->compensation_recline_option === true || @$case->compensation_recline_option == '1' || @$case->compensation_recline_option == 'recline') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="compensation_recline_option">recline</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input savejson_checkbox" type="checkbox" name="compensation_mendelsohn_maneuver"
                                        value="mendelsohn_maneuver" id="compensation_mendelsohn_maneuver" {{ (@$case->compensation_mendelsohn_maneuver == 1 || @$case->compensation_mendelsohn_maneuver === true || @$case->compensation_mendelsohn_maneuver == '1' || @$case->compensation_mendelsohn_maneuver == 'mendelsohn_maneuver') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="compensation_mendelsohn_maneuver">Mendelsohn
                                        maneuver</label>
                                </div>
                                <div class=" form-check-inline">
                                    <input type="text" class="form-control form-control-sm savejson_checkbox"
                                        name="compensation_other_text" id="compensation_other_text" placeholder="ระบุ..."
                                        style="width: 200px; display: inline-block;" value="{{ @$case->compensation_other_text }}">
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
                                        value="no" id="residual_no" {{ @$case->residual_no ? 'checked' : '' }}>
                                <label class="form-check-label" for="residual_no">no </label>
                            </div>
                            <span class="me-3">| </span>
                            <div class="form-check-inline">
                                <select class="form-select form-select-sm savejson_checkbox" name="residual_yes_type"
                                    id="residual_yes" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="mild" {{ is_array(@$case->residual_yes_type) ? (in_array('mild', @$case->residual_yes_type) ? 'selected' : '') : (@$case->residual_yes_type == 'mild' ? 'selected' : '') }}>mild</option>
                                    <option value="moderate" {{ is_array(@$case->residual_yes_type) ? (in_array('moderate', @$case->residual_yes_type) ? 'selected' : '') : (@$case->residual_yes_type == 'moderate' ? 'selected' : '') }}>moderate</option>
                                    <option value="mark" {{ is_array(@$case->residual_yes_type) ? (in_array('mark', @$case->residual_yes_type) ? 'selected' : '') : (@$case->residual_yes_type == 'mark' ? 'selected' : '') }}>mark</option>
                                </select>
                                <span class="me-2 ms-2">at</span>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="residual_yes_check"
                                    value="vallecula" id="residual_vallecula" {{ @$case->residual_yes_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="residual_vallecula">vallecula</label>
                            </div>
                            <div class="form-check-inline">
                                <select class="form-select form-select-sm savejson_checkbox" name="residual_pyriform_sinus_type"
                                    id="residual_pyriform_sinus" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('left', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'left' ? 'selected' : '') }}>left</option>
                                    <option value="right" {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('right', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'right' ? 'selected' : '') }}>right</option>
                                    <option value="both" {{ is_array(@$case->residual_pyriform_sinus_type) ? (in_array('both', @$case->residual_pyriform_sinus_type) ? 'selected' : '') : (@$case->residual_pyriform_sinus_type == 'both' ? 'selected' : '') }}>both</option>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="pas_penetration"
                                    value="penetration" id="pas_penetration" {{ @$case->pas_penetration ? 'checked' : '' }}>
                                <label class="form-check-label" for="pas_penetration">penetration </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="pas_aspiration" value="aspiration"
                                    id="pas_aspiration" {{ @$case->pas_aspiration ? 'checked' : '' }}>
                                <label class="form-check-label" for="pas_aspiration">aspiration </label>
                            </div>
                            <div class="form-check-inline">
                                <span class="me-2">PAS</span>
                                <select class="form-select form-select-sm savejson_checkbox" name="pas_level"
                                    id="pas_level" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="1" {{ @$case->pas_level == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ @$case->pas_level == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ @$case->pas_level == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ @$case->pas_level == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ @$case->pas_level == '5' ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ @$case->pas_level == '6' ? 'selected' : '' }}>6</option>
                                    <option value="7" {{ @$case->pas_level == '7' ? 'selected' : '' }}>7</option>
                                    <option value="8" {{ @$case->pas_level == '8' ? 'selected' : '' }}>8</option>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="safety_safe" value="safe"
                                    id="safety_safe" {{ @$case->safety_safe ? 'checked' : '' }}>
                                <label class="form-check-label" for="safety_safe">safe </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="safety_not_safe"
                                    value="not_safe" id="safety_not_safe" {{ @$case->safety_not_safe ? 'checked' : '' }}>
                                <label class="form-check-label" for="safety_not_safe">not safe </label>
                            </div>
                            <div class="form-check-inline">
                                <span class="me-2">อื่นๆ</span>
                                <input type="text" class="form-control form-control-sm savejson_checkbox ms-2"
                                    id="safety_free_text" name="safety_free_text"
                                    style="width: 700px; display: inline-block;" value="{{ is_array(@$case->safety_free_text) ? implode(', ', @$case->safety_free_text) : @$case->safety_free_text }}">
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
                            <textarea class="form-control form-control-sm savejson_checkbox" id="diagnostic_free_text" name="diagnostic_free_text"
                                style="width: 925px; display: inline-block;" rows="2">{{ is_array(@$case->diagnostic_free_text) ? implode(', ', @$case->diagnostic_free_text) : @$case->diagnostic_free_text }}</textarea>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="complications_no"
                                    value="no" id="complications_no" {{ @$case->complications_no ? 'checked' : '' }}>
                                <label class="form-check-label" for="complications_no">no </label>
                            </div>
                            <div class="form-check-inline">
                                <input type="text" class="form-control form-control-sm savejson_checkbox ms-2"
                                    id="complications_free_text" name="complications_free_text"
                                    style="width: 885px; display: inline-block;" placeholder="ระบุ..." value="{{ is_array(@$case->complications_free_text) ? implode(', ', @$case->complications_free_text) : @$case->complications_free_text }}">
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
                            <select class="form-select form-select-sm savejson_checkbox" name="advice_liquid" id="advice_liquid"
                                style="width: auto; display: inline-block;">
                                <option value="">-- เลือก --</option>
                                <option value="thin" {{ @$case->advice_liquid == 'thin' ? 'selected' : '' }}>thin</option>
                                <option value="slighty thick" {{ @$case->advice_liquid == 'slighty thick' ? 'selected' : '' }}>slighty thick</option>
                                <option value="nectar" {{ @$case->advice_liquid == 'nectar' ? 'selected' : '' }}>nectar</option>
                                <option value="honey" {{ @$case->advice_liquid == 'honey' ? 'selected' : '' }}>honey</option>
                                <option value="pudding" {{ @$case->advice_liquid == 'pudding' ? 'selected' : '' }}>pudding</option>
                            </select>
                            <span class="ms-2">Food : IDDSI</span>
                            <select class="form-select form-select-sm savejson_checkbox ms-2" name="advice_food" id="advice_food"
                                style="width: auto; display: inline-block; width: 65px;">
                                <option value="">-- เลือก --</option>
                                <option value="4" {{ @$case->advice_food == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ @$case->advice_food == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ @$case->advice_food == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ @$case->advice_food == '7' ? 'selected' : '' }}>7</option>
                            </select>
                            <span class="ms-2">for</span>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="advice_purpose_eating" value="eating"
                                    id="advice_purpose_eating" {{ @$case->advice_purpose_eating ? 'checked' : '' }}>
                                <label class="form-check-label" for="advice_purpose_eating">eating</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="advice_purpose_training"
                                    value="training" id="advice_purpose_training" {{ @$case->advice_purpose_training ? 'checked' : '' }}>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_small_volume_check"
                                    value="small_volume" id="technique_small_volume_check" {{ @$case->technique_small_volume_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_small_volume_check">small
                                    volume</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_slow_rate_check" value="slow_rate"
                                    id="technique_slow_rate_check" {{ @$case->technique_slow_rate_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_slow_rate_check"> slow rate</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_chin_tuck_check" value="chin_tuck"
                                    id="technique_chin_tuck_check" {{ @$case->technique_chin_tuck_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_chin_tuck_check"> chin tuck </label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_double_swallow_check"
                                    value="double_swallow" id="technique_double_swallow_check" {{ @$case->technique_double_swallow_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_double_swallow_check"> double swallow
                                </label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_multiple_swallow_check"
                                    value="multiple_swallow" id="technique_multiple_swallow_check" {{ @$case->technique_multiple_swallow_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_multiple_swallow_check"> multiple
                                    swallow </label>
                            </div>
                            <div class="form-check-inline ms-2">
                                <select class="form-select form-select-sm savejson_checkbox" name="technique_tilt" id="technique_tilt"
                                    style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ @$case->technique_tilt == 'left' ? 'selected' : '' }}>left</option>
                                    <option value="right" {{ @$case->technique_tilt == 'right' ? 'selected' : '' }}>right</option>
                                </select>
                                <span class="me-2">tilt</span>
                            </div>
                            <div class="form-check-inline ms-2">
                                <select class="form-select form-select-sm savejson_checkbox" name="technique_turn_to"
                                    id="technique_turn_to" style="width: auto; display: inline-block;">
                                    <option value="">-- เลือก --</option>
                                    <option value="left" {{ @$case->technique_turn_to == 'left' ? 'selected' : '' }}>left</option>
                                    <option value="right" {{ @$case->technique_turn_to == 'right' ? 'selected' : '' }}>right</option>
                                </select>
                                <span class="me-2">turn to</span>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_recline_check"
                                    value="recline" id="technique_recline_check" {{ @$case->technique_recline_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_recline_check">recline</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="technique_mendelsohn_maneuver_check" value="mendelsohn_maneuver"
                                    id="technique_mendelsohn_maneuver_check" {{ @$case->technique_mendelsohn_maneuver_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="technique_mendelsohn_maneuver_check">Mendelsohn maneuver</label>
                            </div>
                            <div class="form-check-inline ms-2">
                                <input type="text" class="form-control form-control-sm savejson_checkbox ms-2"
                                id="technique_cough_technique_free_text" name="technique_cough_technique_free_text"
                                style="width: 700px; display: inline-block;" placeholder="Free text" value="{{ is_array(@$case->technique_cough_technique_free_text) ? implode(', ', @$case->technique_cough_technique_free_text) : @$case->technique_cough_technique_free_text }}">
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_basic_oromotor_check"
                                    value="basic_oromotor" id="exercise_basic_oromotor_check" {{ @$case->exercise_basic_oromotor_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_basic_oromotor_check">basic oromotor</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_lingual_check" value="lingual"
                                    id="exercise_lingual_check" {{ @$case->exercise_lingual_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_lingual_check">lingual</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_base_of_tongue_check" value="base_of_tongue"
                                id="exercise_base_of_tongue_check" {{ @$case->exercise_base_of_tongue_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_base_of_tongue_check">base of tongue</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_ctar_check" value="ctar"
                                id="exercise_ctar_check" {{ @$case->exercise_ctar_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_ctar_check">CTAR</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_shaker_check" value="shaker"
                                id="exercise_shaker_check" {{ @$case->exercise_shaker_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_shaker_check">shaker</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_vocal_cord_exercise_check" value="vocal_cord_exercise"
                                id="exercise_vocal_cord_exercise_check" {{ @$case->exercise_vocal_cord_exercise_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_vocal_cord_exercise_check">vocal cord exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_mendelsohn_check" value="mendelsohn"
                                id="exercise_mendelsohn_check" {{ @$case->exercise_mendelsohn_check ? 'checked' : '' }}>
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
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_neck_exercise_check"
                                    value="neck_exercise" id="exercise_neck_exercise_check" {{ @$case->exercise_neck_exercise_check ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_neck_exercise_check">neck exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_breathing_exercise_check" value="breathing_exercise"
                                    id="exercise_breathing_exercise_check" {{ (@$case->exercise_breathing_exercise_check == 1 || @$case->exercise_breathing_exercise_check === true || @$case->exercise_breathing_exercise_check == '1' || @$case->exercise_breathing_exercise_check == 'breathing_exercise') ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_breathing_exercise_check">breathing exercise</label>
                            </div>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input savejson_checkbox" type="checkbox" name="exercise_cough_technique_check" value="cough_technique"
                                id="exercise_cough_technique_check" {{ (@$case->exercise_cough_technique_check == 1 || @$case->exercise_cough_technique_check === true || @$case->exercise_cough_technique_check == '1' || @$case->exercise_cough_technique_check == 'cough_technique') ? 'checked' : '' }}>
                                <label class="form-check-label" for="exercise_cough_technique_check">cough technique</label>
                            </div>
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
                                group_name="finding" group_key="{{ $value }}" class="savejson_checkboxgroup form-control autotext mainpart_text">{{ @$case->mainpart[$value] }}</textarea>
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
            console.log(d);
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
        console.log(group_key);
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
        console.log(obj);
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);
    }

    // Function to restore gi095 form values from localStorage
    function restore_storage_gi095() {
        let retString = localStorage.getItem("{{ $cid }}");
        console.log('Restore storage for {{ $cid }}:', retString);
        if (retString == null) return;

        let storage = JSON.parse(retString);
        console.log('Parsed storage:', storage);
        restoreFormValues(storage);
    }

    // Function to restore form values from storage
    function restoreFormValues(storage) {

        // Pooling saliva restoration
        console.log('Checking pooling_saliva_no:', storage['pooling_saliva_no']);
        if (storage['pooling_saliva_no'] != undefined) {
            let shouldCheck = false;
            if (Array.isArray(storage['pooling_saliva_no']) && storage['pooling_saliva_no'].length > 0) {
                shouldCheck = true; // Array with values means checked
            } else if (storage['pooling_saliva_no'] === true) {
                shouldCheck = true; // Boolean true means checked
            }

            $('#pooling_no').prop('checked', shouldCheck);
            console.log('Set pooling_no to', shouldCheck ? 'checked' : 'unchecked');
        } else {
            $('#pooling_no').prop('checked', false);
            console.log('Set pooling_no to unchecked (undefined)');
        }

        if (storage['pooling_saliva_severity'] != undefined) {
            $('#pooling_mild').val(storage['pooling_saliva_severity']);
        }

        if (storage['pooling_saliva_position'] != undefined) {
            $('#pooling_left_right_both').val(storage['pooling_saliva_position']);
        }

        // Helper function to check if a value means checked
        function isChecked(value) {
            if (Array.isArray(value) && value.length > 0) {
                return true; // Array with values means checked
            } else if (value === true) {
                return true; // Boolean true means checked
            }
            return false;
        }

        if (storage['pooling_saliva_pyriform'] != undefined) {
            $('#pooling_pyriform_sinus').prop('checked', isChecked(storage['pooling_saliva_pyriform']));
        } else {
            $('#pooling_pyriform_sinus').prop('checked', false);
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
            $('#tvc_left_paresis_check').prop('checked', isChecked(storage['tvc_movement_paresis_check']));
        } else {
            $('#tvc_left_paresis_check').prop('checked', false);
        }

        if (storage['tvc_movement_side'] != undefined) {
            $('#tvc_left_paresis').val(storage['tvc_movement_side']);
        }

        if (storage['tvc_movement_paralysis_check'] != undefined) {
            $('#tvc_left_paralysis_check').prop('checked', isChecked(storage['tvc_movement_paralysis_check']));
        } else {
            $('#tvc_left_paralysis_check').prop('checked', false);
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

        // Test restoration
        if (storage['test'] != undefined) {
            $('#test_select').val(storage['test']);
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
                    console.log('Database cleared (select):', this_name);
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
                    console.log('Database saved (select):', this_name);
                });
            }

            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        });

    });
</script>
