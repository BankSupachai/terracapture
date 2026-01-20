{{-- <div class="modal-header pb-2">
    <span class="text-blue fs-16" id="myModalLabel">HN : {{ @$patient->hn }} &ensp; {{ @$patient->prefix }}
        {{ @$patient->firstname }} {{ @$patient->lastname }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
</div>
<div class="modal-body" style="border-top: 1px solid #e9ebec;">

    <p class="text-muted">Select your operation </p>
    <div class="row mt-3 p-3">
        @isset($tb_case)
            @foreach ($tb_case as $in => $data)
                @php
                    $caseuniq = isset($data->caseuniq) ? $data->caseuniq : '';
                    $patient_name = isset($data->patientname) ? $data->patientname : $data->firstname . ' ' . $data->lastname;
                    $procedure = isset($data->procedurename) ? $data->procedurename : $data->procedure;
                    $id = (array) $data->id;
                    $id = isset($id) ? $id->oid : '';
                    $case_id = isset($data->case_id) ? $data->case_id : '';
                    $image = get_procedure_image($procedure);
                    $to_url = isset($type) && $type != 'cancel' ? url($type) . "/$id" : url('api') . '/home?action=cancel&cid=' . @$id;
                @endphp
                <div class="col-6 m-0">
                    <div class="row" >
                        <div class="col-6 ">
                            <a href="{{ @$to_url }}">
                                <img src="{{ @$image }}" width="250" height="250" class="img-procedure"
                                    alt="">
                                <span class="d-block text-center ms-4 mt-2" style="color: #878a99">{{ @$procedure }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div> --}}




<div class="modal-header pb-2">
    <span class="text-blue fs-16" id="myModalLabel">HN : {{ @$patient->hn }} &ensp; {{ @$patient->prefix }}
        {{ @$patient->firstname }} {{ @$patient->lastname }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
</div>
<div class="modal-body" style="border-top: 1px solid #e9ebec;">

    <p class="text-muted">Select your operation</p>
    <div class="row mt-3 p-3">
        @isset($tb_case)
            @foreach ($tb_case as $in => $data)
                @php
                    $caseuniq = isset($data->caseuniq) ? $data->caseuniq : '';
                    $patient_name = isset($data->patientname) ? $data->patientname : $data->firstname . ' ' . $data->lastname;
                    $procedure = isset($data->procedurename) ? $data->procedurename : $data->procedure;
                    $id = (array) $data->id;
                    $id = isset($id) ? $id['oid'] : '';
                    $case_id = isset($data->case_id) ? $data->case_id : '';
                    $image = get_procedure_image($procedure);
                    $to_url = isset($type) && $type != 'cancel' ? url($type) . "/$id" : url('api') . '/home?action=cancel&cid=' . @$id;
                @endphp
                <div class="col-4 m-0">
                    <div class="row" >
                        <div class="col-12 text-center">
                            <a href="{{ @$to_url }}">
                                <img src="{{ @$image }}" width="200" height="200" class="img-procedure"
                                    alt="">
                                <span class="d-block text-center ms-2 mt-2 mb-2" style="color: #878a99">{{ @$procedure }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>
