<style>
    .modal-xl {
        --vz-modal-width: 1686px;
    }
</style>
<div id="medi_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content  text-bbbb">
            <div class="modal-header mb-2">
                <h5 class="modal-title fw-light" id="myModalLabel">Nurse Record</h5>

                <button type="button" class="text-white btn" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div style="border-bottom: 1px solid #707070;"></div>
            <div class="modal-body mt-2">
                <div class="row">
                    <div class="col-6">
                        <div class="row mt-2">

                            <div class="col-12">
                                Medication &ensp; &ensp;
                                <button class="btn btn-dark-primary btn-sm btn-checkbox-camera" id="btn_medication">
                                    <i class="mdi mdi-checkbox-outline fs-12 me-2 text-white"></i> None
                                    Medication</button>
                            </div>
                            @php $mos = 1; @endphp
                            @php
                                $anesthesis = isset($this_procedure->anesthesis) ? $this_procedure->anesthesis : [];
                                $anes_arr = isset($tb_casemedication->medi_casejson) ? $tb_casemedication->medi_casejson : [];
                                // dd($anes_arr, $tb_casemedication);
                            @endphp

                            @foreach (isset($anesthesis) ? $anesthesis : [] as $index => $medi)
                                @php
                                    $medi = (object) $medi;
                                @endphp
                                <div class="col-4 mt-2 set-0">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input ck-medi" id="ck_{{ $index }}"
                                            index="{{ $index }}" value="{{ $medi->name }}"
                                            @isset($tb_casemedication->select)
                                     @if (in_array($medi->name, $tb_casemedication->select))  {{ 'checked' }}
                                      @endif  @endisset
                                            type="checkbox" >


                                        <input id="boxmedi{{ $medi->name }}" name="boxmedigroup"
                                            value="{{ $medi->name }}" {{-- type="checkbox" --}} type="hidden"
                                            class="boxmedi " @if (in_array($medi->name, isset($tb_casemedication->medication) ? $tb_casemedication->medication : [])) checked="checked" @endif>
                                        <label class="form-check-label " for="ck_{{$index}}">
                                            {{ $medi->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3 mt-2 m-0 p-0 set-0 ">
                                    <input id="medi{{ $medi->name }}" type="number" name="medigroup"
                                    class="form-control form-control-sm autotext medigroup inp_mi"
                                    medigroup_id="{{ $medi->name }}"
                                    index="{{$index}}"
                                    value="{{ @$tb_casemedication->medication_unit[$medi->name]['dose']}}"
                                    placeholder="Dose">
                                </div>
                                <input type="hidden" class="medi_unit" value="{{ @$medi->unit }}">
                                <div class="col-5 align-self-center" @if (@$mos == 2) @endif>{{ @$medi->unit }} </div>
                            @endforeach
                                <div class="row mt-2">
                                    <div class="col-8  set-0">
                                        <input type="text"
                                         placeholder="Other Medication"
                                        value="{{ @$tb_casemedication->medi_other }}"
                                        class="form-control medicationsave autotext"
                                        table="tb_casemedication"
                                        name="medi_other"
                                        id="medi_other">

                                    </div>
                                    <div class="col-2">
                                        <input id="medi_otherdose" name="medi_otherdose" table="tb_casemedication"
                                            class="form-control medicationsave autotext" type="Text" autocomplete="off"
                                            value="{{ @$tb_casemedication->medi_otherdose }}" placeholder="Dose">
                                    </div>
                                    <div class="col-2">

                                        <select id="medi_otherunit" name="medi_otherunit" class="form-control medicationsave" table="tb_casemedication">
                                            <option value="">Select unit</option>
                                            @foreach(isset($doseunit)?$doseunit:array() as $data)
                                                @if(@$tb_casemedication->medi_otherunit==$data)
                                                    <option value="{{$data}}" selected>{{$data}}</option>
                                                @else
                                                    <option value="{{$data}}">{{$data}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mt-2">
                            <div class="col-12">
                                Anesthesia &ensp; &ensp;
                                <button class="btn btn-dark-primary btn-sm btn-checkbox-camera" id="btn_anesthesia"><i
                                        class="mdi mdi-checkbox-outline fs-12 me-2 text-white"></i> None
                                    Anesthesia</button>
                            </div>
                            @php
                                $anesthesia = isset($case->anesthesia) ? $case->anesthesia : [];
                            @endphp
                            @foreach (isset($anes) ? $anes : [] as $box)
                                @php
                                    $is_checked_anes = in_array($box, $anesthesia) ? 'checked' : '';
                                @endphp
                                <div class="col-6 ">
                                    <div class="form-check mb-3 ">
                                        <input class="form-check-input savejson_checkbox ck-val anes-ck"
                                            name="anesthesia" type="checkbox" id="anesthesia{{ $box }}"
                                            value="{{ $box }}" {{ $is_checked_anes }}>
                                        <span></span>
                                        <label class="form-check-label" for="anesthesia{{ $box }}">
                                            &nbsp;{{ $box }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12">
                                <input type="text" placeholder="Other Anesthesia"
                                    value="{{ @$case->anesthesiaother }}"
                                    class="form-control anes-text save-text text-keypress" id="anesthesiaother"
                                    name="anesthesiaother">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
