@php
    $i             = 0;
@endphp
@foreach ($worklist as $id=>$list)
    @php
        $list = (object) $list;
        $hn            = $list->hn;
        if(!isset($hn)){
            continue;
        }
        $patientname   = isset($list->patientname) ? $list->patientname : '';
        $doctorname    = isset($list->doctorname)  ? $list->doctorname  : '';
        $time          = isset($list->time)  ? $list->time  : '';
        $prediagnosis  = isset($list->prediagnosis) && @$list->prediagnosis."" != "" ? $list->prediagnosis : '';
        $patienteng  = isset($list->patienteng) && @$list->patienteng."" != "" ? $list->patienteng : '';
        $visitno     = isset($list->visitno) && @$list->visitno."" != "" ? $list->visitno : '';
        $accessionnumberstr = isset($list->accessionnumber) && @$list->accessionnumber."" != "" ? $list->accessionnumber : '';
        $procedurestr  = isset($list->procedure) && @$list->procedure."" != "" ? $list->procedure : '';
    @endphp
    <tr class="worklist-tr" id="worklist{{$i}}" data-hn="{{@$hn}}" data-patientname="{{@$patientname}}" data-doctorname="{{@$doctorname}}" data-procedure="{{@$procedurestr}}" data-prediagnosis="{{@$prediagnosis}}" data-accessionnumber="{{@$accessionnumberstr}}" data-patienteng="{{@$patienteng}}" data-visitno="{{@$visitno}}" data-time="{{@$time}}">
        <td class="ft-hn">
            <span  id="hn_{{@$i}}" @if(@$accessionnumberstr == "") style="color:yellow;" @endif>{{@$hn}}</span>
        </td>
        <td>
            <span id="patientname_{{@$i}}" @if(@$accessionnumberostr == "") style="color:yellow;" @endif>{{@$patientname}}</span>
        </td>
        <td colspan="2">
            <span id="doctorname_{{@$i}}">{{@$doctorname}}</span>
            <div id="userdiv{{@$i}}">
                <select name="user" id="user{{@$i}}" class="form-select mb-3 search-input" style="display: none" onchange="change_user('{{@$i}}')" >
                    @isset($users)
                        @foreach ($users as $index=>$u)
                            @if($index==0)
                            <option data-procedure="none" value="none"  >Select Physician</option>
                            @else
                            <option data-doctorid="{{@$u['id']}}" value="{{@$u['user_prefix']}} {{@$u['user_firstname']}} {{@$u['user_lastname']}}">{{@$u['user_prefix']}} {{@$u['user_firstname']}} {{@$u['user_lastname']}}</option>
                            @endif
                        @endforeach
                    @endisset
                </select>
            </div>
            <span id="userwarning_{{@$i}}" style="color: red; display: none" >Please select physician</span>

        </td>
        <td colspan="2">
            <span data-procedurestr="{{ @$procedurestr }}" id="procedure_{{@$i}}">
                {{ @$procedurestr }}
            </span>
            <div id="procedurediv{{@$i}}">
                <select name="procedure[]" id="procedure{{@$i}}" class="form-select mb-3 search-input" style="display: block" multiple="multiple" onchange="change_proc('{{@$index_id}}')">
                    <option value="">&nbsp;Procedure</option>
                    @isset($procedure)
                        @foreach ($procedure as $p)
                            <option data-procedure="{{@$p['code']}}" value="{{@$p['name']}}"  @if($p['name'] == $procedurestr) selected @endif >{{@$p['name']}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <span id="procwarning_{{@$index_id}}" style="color: red; display: none" >Please select procedure</span>
        </td>
        <td class="text-end">
            <button data-index="{{@$i}}" id="importwk{{@$i}}" class="btn btn-danger btn-icon import-worklist" onclick="import_case('{{@$i}}')">
                <i id="istart{{@$i}}" class="ri-download-2-fill ri-lg"></i>
                <div id="isloading{{@$i}}" class="spinner-border text-light" role="status" style="width:20px;height:20px;display:none">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                <i id="isuccess{{@$i}}" class="ri-check-double-fill ri-lg text-white" style="display:none"></i>
            </button>
        </td>
    </tr>
    @php $i = $i + 1; @endphp
@endforeach

<script>
    var count = "{{@$count}}"
    for (let j = 0; j < parseInt(count); j++) {
        $(`#user${j}`).select2({placeholder: '   User', dropdownParent: $(`#userdiv${j}`)});
        $(`#procedure${j}`).select2({placeholder: '   Procedure', dropdownParent: $(`#procedurediv${j}`)});

        let accessno = $(`#worklist${j}`).data('accessionnumber')
        let all_proc = $(`#procedure_${j}`).data('procedurestr')
        $.post('{{url("api")}}/siphconnect', {
            event: "match_procedure",
            procedure: all_proc,
            save: true,
            accessno:accessno,
        }, function (data, status){
            let parse = JSON.parse(data)
            $(`#procedure${j}`).val(parse).change();
        })

        $.post('{{url("api")}}/siphconnect', {
            event: "match_doctor",
            accessno: accessno,
            save: true,
        }, function (data, status){
            let parse = JSON.parse(data)
            $(`#user${j}`).val($(`#user${j}`).find(`option[data-doctorid="${parse}"]`).val()).change();
        })

    }

    
</script>
