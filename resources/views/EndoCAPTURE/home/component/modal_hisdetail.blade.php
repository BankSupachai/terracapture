<div class="modal fade none-border" id="modal_hisdetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Patient Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body p-b-0">
                <table class="table table-borderless">
                    <tr><td class="p-1">H.N.</td>       <td><h4 id="patient_hn"></h4></td></tr>
                    <tr><td class="p-1">Name</td>       <td><h4 id="patient_name"></h4></td></tr>
                    <tr><td class="p-1">Gender</td>     <td><h4 id="patient_gender"></h4></td></tr>
                    <tr><td class="p-1">Age</td>        <td><h4 id="patient_age"></h4></td></tr>
                    <tr><td class="p-1">Treatment Coverage</td>        <td><h4 id="patient_righttotreatment"></h4></td></tr>
                    <tr><td class="p-1">Surgoen</td>
                        <td>
                            <form id="form_hisconnet" action="{{url("appointment")}}" method="post">
                                <input type="hidden"    name="event"            value="createcase">
                                <input type="hidden"    name="date"             value="{{date('Y-m-d')}}">
                                <input type="hidden"    name="appid"            id="appid">
                                <input type="hidden"    name="formtype"         id="formtype"   value="">
                                <input type="hidden"    name="righttotreatment" id="righttotreatment"  >
                                @csrf
                                <select id="patient_surgeon" name="patient_surgeon" class="form-control">
                                    @foreach ($doctor as $data)
                                        @php
                                            $data = (object)$data;
                                        @endphp
                                        <option value="{{$data->id}}">{{"$data->user_prefix$data->user_firstname $data->user_lastname"}}
                                    @endforeach
                                </select>
                                {{-- {!!userSELECT('patient_surgeon','เลือกแพทย์',$doctor,@$_GET['doctor'],'class="forclass form-control form-control-sm"')!!} --}}
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
                                    {{-- <input type="checkbox"  name="patient_operation[]" value="{{$pro['code']}}" class="patient_operation">
                                    <label for="pro{{$pro['name']}}">
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
                <button id="his_submit" type="button" class="btn btn-success save-event waves-effect waves-light w-100">Create Report</button>
            </div>
        </div>
    </div>
</div>
