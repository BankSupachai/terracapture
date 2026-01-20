@if (@$feature->pacs)
    <div class="col-9">
        <input class="form-check-input ck-pacs" name="send_to" value="pacs" type="checkbox" id="formCheckpac1"
            @if (@$pacs->accessionnumberrequest) checked
        @else
            checked @endif>
        <label class="form-check-label" for="formCheckpac1">
            &ensp; PACs Server ({{ @$pacs->pacsserver }})
            <span class="d-block text-muted"> &ensp; Report and Photo</span>
            @isset($casedata->case_pacs)
                @php
                    $lastsendpacs = end($casedata->case_pacs);
                @endphp
                @isset($lastsendpacs['when'])
                    <span class="text-muted">&ensp; Last send : {{ @$lastsendpacs['when'] }}</span>
                @else
                    <span class="text-muted">&ensp; Last send : -</span>
                @endisset
            @else
                <span class="text-muted">&ensp; Last send : -</span>
            @endisset
        </label>
    </div>
    <div class="col-3 " id="pacsreload" style="display: none;">
        <div class="spinner-border text-spin-primary " role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="col-3" id="pacssuccess" style="display: none; ">
        <button class="btn btn-status-pacs btn-sm fw-bold">Success</button>
    </div>
    <div class="col-3" id="pacsnotsuccess" style="display: none; ">
        <button class="btn btn-danger btn-sm fw-bold">Not success</button>
    </div>
    @if (@$pacs->accessionnumberrequest)
        <div class="col-6">
            <input id="input_assesion" type="text" class="form-control input_assesion" placeholder="Please fill Accession number"
                value="{{ @$casedata->accessionno }}">
        </div>
        <div class="col-4">
            @php
                $btn_class = empty($casedata->accessionno) ? 'verify' : 'primary';
                $btn_style = empty($casedata->accessionno) ? 'background: #BBBBBB; color: #ffffff;' : '';
                $span_style = empty($casedata->accessionno) ? 'none' : 'block';
            @endphp
            <button class="btn btn-{{ @$btn_class }} verify-btn" style="{{ @$btn_style }}">
                Verify</button>
            <button id="btn-accessionno-save" class="btn btn-primary">
                <i class="ri-save-line"></i>
            </button>
        </div>
        <span style="color:#F06548; display:{{ @$span_style }};" class="patient-detail-success mt-2">Patient Detail :
            <span class="hn-detail">{{ @$casedata->case_hn }}</span> <span
                class="patientname-detail">{{ @$casedata->patientname }}</span> (<span
                class="procedurename-detail">{{ @$casedata->procedurename }}</span> : <span
                class="visitno-detail">{{ @$casedata->visitno }}</span>)</span>
        <span style="color:#F06548;display:none" class="patient-detail-warning">Not Found</span>
    @endif
@endif
<script>
    $(document).ready(function(){
        $('#btn-accessionno-save').click(function(){
            var accessionno = $('#input_assesion').val();
            $.post('{{ url('api/pacspython') }}', {
                event: 'saveaccessionno',
                cid: '{{ $casedata->id }}',
                accessionno: accessionno,
            }, function(response){
                console.log(response);
            });
        });
    });
</script>
