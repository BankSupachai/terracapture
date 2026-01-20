@foreach($tb_bookworklist as $data)
@php
$json = jsonDecode($data->worklist_json);
@endphp

<tr>
    <td>{{$data->worklist_pid}}        </td>
    <td>{{$data->worklist_modality}}   </td>
    <td>{{@$json->patientName}}         </td>
    <td>{{@$json->procedureDescription}}</td>
    <td>{{@$json->procedureID}}         </td>
    <td>{{@$json->aetitle}}             </td>
    <td></td>
    <td><button class="btn btn-primary call_modal_worklist"
        accessionnumber="{{$json->accessionNUMBER}}"
        worklistID="{{$data->id}}"
        pid="{{$data->worklist_pid}}">
        Create</button>
    </td>
</tr>
@endforeach





<script>
$(".call_modal_worklist").click(function(){
    var id = $(this).attr("worklistID");
    var hn = $(this).attr("pid");
    var accessionnumber = $(this).attr("accessionnumber");

    $("#modal_worklist").modal("show");


    $.post("{{url("api/worklist")}}", {
        event   : "getworklistBYID",
        id      : id,
        hn      : hn
    },function(data, status) {
        console.log(data);
        var json01 = JSON.parse(data);
        $("#form_worklist_id").val(id);
        $("#form_worklist_hn").val(hn);
        $("#form_worklist_accessionnumber").val(accessionnumber);
        $('#worklist_hn').html(json01.hn);
        $('#worklist_name').html(json01.patientname);
        $('#worklist_gender').html(json01.gender);
        $('#worklist_age').html(json01.age);
        $('.worklist_operation').prop('checked', false);
        json01.procedure.forEach(el => {
            console.log(el);
            $('#worklist'+el).prop('checked', true);
        });
    });
});
</script>
