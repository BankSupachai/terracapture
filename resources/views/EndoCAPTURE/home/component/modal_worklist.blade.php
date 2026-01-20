<div class="modal fade none-border" id="modal_worklist" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Patient Detail Worklist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body p-b-0">
                <table class="table table-borderless">
                    <tr><td class="p-1">H.N.</td>       <td><h4 id="worklist_hn"></h4></td></tr>
                    <tr><td class="p-1">Name</td>       <td><h4 id="worklist_name"></h4></td></tr>
                    <tr><td class="p-1">Gender</td>     <td><h4 id="worklist_gender"></h4></td></tr>
                    <tr><td class="p-1">Age</td>        <td><h4 id="worklist_age"></h4></td></tr>
                    <tr><td class="p-1">Treatment Coverage</td>        <td><h4 id="worklist_righttotreatment"></h4></td></tr>
                    <tr><td class="p-1">Surgoen</td>
                        <td>
                            <form id="form_worklist" action="{{url("api/worklist")}}" method="post">
                                <input name="event" type="hidden" value="create_case">
                                <input id="righttotreatment" name="righttotreatment" type="hidden">
                                <input id="form_worklist_id" type="hidden" name="worklist_id">
                                <input id="form_worklist_hn" type="hidden" name="worklist_hn">
                                <input id="form_worklist_accessionnumber" type="hidden" name="accessionNUMBER">

                                <input name="date" type="hidden" value="{{date('Y-m-d')}}">
                                @csrf
                                <select id="form_worklist_surgeon" name="surgeon" class="form-control" required>
                                    @foreach ($doctor as $data)
                                    @php
                                    $data = (object)$data;
                                @endphp
                                        <option value="{{$data->id}}">{{"$data->user_prefix$data->user_firstname $data->user_lastname"}}
                                    @endforeach
                                </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            Pre-diagnostic
                        </td>
                        <td>
                            <h4 id="patient_prediagnostic"></h4>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="text-center">Operation</td>
                        <td class="p-3">
                                @foreach($procedure as $pro)
                                    {{-- <input type="checkbox"  name="operation[]" value="{{$pro['code']}}" id="worklist{{str_replace(" ","",$pro['name'])}}" class="worklist_operation">
                                    <label for="worklist{{str_replace(" ","",$pro['name'])}}">
                                    &nbsp;&nbsp;&nbsp;{{$pro['name']}}
                                    </label>
                                    <br> --}}
                                @endforeach
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button id="worklist_submit" type="button" class="btn btn-success save-event waves-effect waves-light w-100">Create Report</button>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script>
    $('#worklist_submit').click(function(){
        var count_if    = 0;
        var surgeon     = $('#form_worklist_surgeon').val();
        var his_id      = $('#form_worklist_id').val();
        var allVals     = [];
        var operation   = $('[class=worklist_operation]:checked').each(function() {allVals.push($(this).val());});
        var obj = JSON.stringify(allVals);

        if(obj=="[]"){
            alert('กรุณาเลือก Procedure');
            count_if++;
        }

        if(surgeon==null){
            alert('กรุณาเลือก แพทย์');
            count_if++;
        }

        if(count_if==0){
            $('#modal_worklist').modal('hide');
            $('#modal_progress').modal('show');
            $('#form_worklist').submit();
        }
    });
</script>
