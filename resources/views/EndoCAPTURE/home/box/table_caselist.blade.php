@foreach($caseall as $data)
<tr>
    <td>{{$data->case_id}}</td>
    <td>
        <span class="label label-{{$data->colorstatus}} label-pill label-inline mr-2">{{$data->case_status}}</span>
    </td>
    <td>{{$data->case_hn}}</td>
    <td>
        <a href="loadpic/{{$data->case_id}}">
            {{$data->case_patient}}
        </a>
    </td>
    <td class="thage">{{$data->case_age}}</td>
    <td>{{$data->case_doctor}}</td>
    <td>{{$data->case_procedure}}</td>
    <td>
        {{$data->case_room}}
    </td>
    <td>{{$data->case_appointment}}</td>
    <td style="padding: 12px 4px;text-align: right;">
        <div class="btn-group">
            <a data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top"
                class="btn btn-{{$data->colorreport}}" data-original-title=""
                {{$data->href}}
                title="">
                <i class="far fa-calendar-times"></i>
            </a>
            <a data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top"
                data-content="Record" href="loadpic/{{$data->case_id}}"
                class="btn btn-icon waves-effect waves-light btn-info" data-original-title="" title="">
                <i class="far fa-folder-open"></i>
            </a>
            <a data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top"
                data-content="Capture" href="camera/{{$data->case_id}}"
                class="btn btn-icon waves-effect waves-light btn-success" data-original-title="" title="">
                <i class="fas fa-camera"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach


<script>
    $(".btn_modalrapid").click(function(){
        var cid = $(this).attr("cid");
        $.post("api/case",{
            event   : "get_casedata",
            cid     : cid
        },function(data,status){
            const json = JSON.parse(data);
            $("#modalrapid_hn").html(json.hn);
            $("#modalrapid_procedure").html(json.procedurename);
            $("#modalrapid_patientname").html(json.patientname);
            $("#modalrapid_doctorname").html(json.doctorname);
            $("#modalrapid_cid").val(cid);
            if(typeof json.rapid_other !== 'undefined'){$("#modalrapid_rapid_other").val(json.rapid_other)}
            if(typeof json.rapid !== 'undefined'){$("#modalrapid_rapid").val(json.rapid).change();}
            $("#modalrapid").modal('show');
        });
    });
</script>
