@if (@$feature->softcon)
    <div class="col-9">
        <div class="row">
            <div class="col-auto">
                <input class="form-check-input ck-softcon" name="send_to" value="softcon" type="checkbox" id="ck-softcon" checked>
                <label class="form-check-label" for="ck-softcon">
                    &ensp; SoftCon ({{ @$softcon->softconserver }})
                    <span class="d-block text-muted"> &ensp; Report and Photo</span>
                    @isset($casedata->case_softcon)
                        @php
                            $lastsendsoftcon = end($casedata->case_softcon);
                        @endphp
                        @isset($lastsendsoftcon['when'])
                            <span class="text-muted">&ensp; Last send : {{ @$lastsendsoftcon['when'] }}</span>
                        @else
                            <span class="text-muted">&ensp; Last send : -</span>
                        @endisset
                    @else
                        <span class="text-muted">&ensp; Last send : -</span>
                    @endisset
                </label>
            </div>
            <div class="col-2">
                {{-- <span class="d-inline" id="btn_softcon_encounter">[x]</span> --}}
            </div>
        </div>
    </div>
    <div class="col-3 " id="softconreload" style="display: none;">
        <div class="spinner-border text-spin-primary " role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="col-3" id="softconsuccess" style="display: none; ">
        <button class="btn btn-success btn-status-softcon btn-sm fw-bold">Success</button>
    </div>
    <div class="col-3" id="softconnotsuccess" style="display: none; ">
        <button class="btn btn-danger btn-sm fw-bold">Not success</button>
    </div>
    <div class="col-12" id="softconnotsuccess_text" style="display: none; color:red;" >

    </div>

    {{-- <div class="col-4">
        <input type="text" name="" id="softcon_usercode" class="form-control focus" placeholder="User ID" autocomplete="off">
    </div>
    <div class="col-4">
        <input type="text" name="" id="softcon_encounter"  class="form-control" placeholder="Encounter ID" autocomplete="off" style="display: none">
    </div> --}}
@endif
