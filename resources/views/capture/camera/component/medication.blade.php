<div class="row mt-4">
    <div class="col-auto"><b>Medication</b></div>
    <div class="col">
        <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm btn btn-checkbox-camera" id="btn_medication">
            <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-white"></i>
            None Medication
        </button>
    </div>
</div>
<div class="row">
    <div class="row">
        @php $mos = 1; @endphp
        @php
            $anesthesis = isset($this_procedure['anesthesis']) ? $this_procedure['anesthesis'] : [];
            $anes_arr   = isset($tb_casemedication->medi_casejson) ? $tb_casemedication->medi_casejson : [];
            // dd($anes_arr, $tb_casemedication);
        @endphp
        @foreach (isset($anesthesis)?$anesthesis:array() as $index=>$medi)
            @php
            $medi = (object) $medi;
        @endphp

        <div class="col-lg-6">
            <div class="row mt-2">
                <div class="form-group col-md-7 set-0">
                    <input type="checkbox" class="form-check-input ck-medi me-2" id="ck_{{$index}}" index="{{$index}}" value="{{ $medi->name }}" @isset($tb_casemedication->select) @if(in_array($medi->name, $tb_casemedication->select))  {{'checked'}}  @endif  @endisset>
                    <input  id="boxmedi{{ $medi->name }}" name="boxmedigroup"
                            value="{{$medi->name}}"
                            {{-- type="checkbox" --}}
                            type="hidden"
                            class="boxmedi "
                            @if(in_array($medi->name, isset($tb_casemedication->medication)?$tb_casemedication->medication:[])) checked="checked" @endif>
                    <label for="ck_{{$index}}">
                        {{ $medi->name }}
                    </label>

                </div>
                <div class="form-group col-md-3 set-0">
                    <input id="medi{{ $medi->name }}" type="number" name="medigroup"
                        class="form-control form-control-sm autotext medigroup inp_mi"
                        medigroup_id="{{ $medi->name }}"
                        index="{{$index}}"
                        value="{{ @$tb_casemedication->medication_unit[$medi->name]['dose']}}"
                        placeholder="Dose">

                    <input type="hidden" class="medi_unit" value="{{@$medi->unit}}">
                </div>
                <div class="form-group col-md-2 set-0"
                    @if (@$mos == 2) style="border-right: 1px solid darkgrey;" @endif>
                    {{ @$medi->unit }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row" style="width:100%;margin-top: 1em;">
        <div class="col-lg-8">
            <input id="medi_other" name="medi_other" table="tb_casemedication"
                class="form-control medicationsave autotext" type="Text" autocomplete="off"
                value="{{ @$tb_casemedication->medi_other }}" placeholder="Other Medication">
        </div>
        <div class="col-lg-2">
            <input id="medi_otherdose" name="medi_otherdose" table="tb_casemedication"
                class="form-control medicationsave autotext" type="Text" autocomplete="off"
                value="{{ @$tb_casemedication->medi_otherdose }}" placeholder="Dose">
        </div>
        <div class="col-lg-2">

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

    {{--  --}}
</div>
