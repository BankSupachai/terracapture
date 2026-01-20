@if (@$feature->vna)
    <div class="col-9">
        <div class="row">
            <div class="col-auto">
                <input class="form-check-input ck-vna" name="send_to" value="vna" type="checkbox" id="formCheck1" checked>
                <label class="form-check-label" for="formCheck1">
                    &ensp; VNA Server ({{ @$vna->vnaserver }})
                    <span class="d-block text-muted"> &ensp; Report and Photo</span>
                    @isset($casedata->case_vna)
                        @php
                            $lastsendvna = end($casedata->case_vna);
                        @endphp
                        @isset($lastsendvna['when'])
                            <span class="text-muted">&ensp; Last send : {{ @$lastsendvna['when'] }}</span>
                        @else
                            <span class="text-muted">&ensp; Last send : -</span>
                        @endisset
                    @else
                        <span class="text-muted">&ensp; Last send : -</span>
                    @endisset
                </label>
            </div>
            <div class="col-2">
                <span class="d-inline" id="btn_vna_encounter">[x]</span>
            </div>
        </div>
    </div>
    <div class="col-2" id="vnareload" style="display: none;">
        <div class="spinner-border text-spin-primary " role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="col-2" id="vnasuccess" style="display: none; ">
        <button class="btn btn-success btn-status-vna btn-sm fw-bold">Success</button>
    </div>
    <div class="col-3" id="vnanotsuccess" style="display: none; ">
        <button class="btn btn-danger btn-sm fw-bold">Not success</button>
    </div>
    <div class="col-12" id="vnanotsuccess_text" style="display: none; color:red;" >

    </div>

    <div class="col-4">
        <input type="text" name="" id="vna_usercode" class="form-control focus" placeholder="User ID" autocomplete="off">
    </div>
    <div class="col-4">
        <input type="text" name="" id="vna_encounter"  class="form-control" placeholder="Encounter ID" autocomplete="off" style="display: none">
    </div>
@endif
