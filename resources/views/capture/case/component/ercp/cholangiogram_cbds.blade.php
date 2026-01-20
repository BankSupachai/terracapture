<div class="col-6">
    <div class="row">

        <h5>CBDS Clearance</h5>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit ck-no" type="radio" name="CBDS" subgroup="CBDS" datagroup="CBDSClearance"
                    {{ checkradio($case, 'CBDSClearance', 'No') }} id="{{ md5('CBDS ClearanceRA No') }}" value="No"
                    @if(@$case->CBDS."" == "No") checked @endif>
                <label class="form-check-label ms-2 ms-2" for="{{ md5('CBDS ClearanceRA No') }}">
                    No
                </label>
            </div>
        </div>
        <div class="col-auto ">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit ck-CBDS" type="radio" name="CBDS" subgroup="CBDS"
                    datagroup="CBDSClearance" {{ checkradio($case, 'CBDSClearance', 'Yes,') }} value="Yes,"
                    id="{{ md5('CBDS Clearance RA Yes,') }}" @if(@$case->CBDS."" == "Yes,") checked @endif>
                <label class="form-check-label ms-2 ms-2" for="{{ md5('CBDS Clearance RA Yes,') }}">
                    Yes,
                </label>
            </div>
        </div>

        <div class="col-3">
            <select class="form-select form-select-sm w-100 savejson_edit ck-radio ck-CBDS-input" id="{{ md5('') }}"
            datagroup="CBDSClearance" subgroup="CBDS" name="CBDSClearance_select" type="select" >
                <option value="">Select</option>
                <option value="Complete" @if(@$case->CBDSClearance_select == 'Complete') selected @endif>Complete</option>
                <option value="Partial" @if(@$case->CBDSClearance_select == 'Partial') selected @endif>Partial</option>
                <option value="Failed" @if(@$case->CBDSClearance_select == 'Failed') selected @endif>Failed</option>
            </select>
        </div>

    </div>
</div>

<div class="col-6 mt-4">
    <textarea id="CBDSClearance_other" datagroup="CBDSClearance" class="form-control autotext savejson" name="CBDSClearance_other" rows="1" cols="50" placeholder="Free text">{{@$case->CBDSClearance_other}}</textarea>

</div>
