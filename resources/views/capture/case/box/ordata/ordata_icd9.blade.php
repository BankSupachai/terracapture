@foreach($icd9 as $data)
<tr class   ="icd9_orshowdata"
    code    ="{{$data["code"]}}"
    codeseq ="{{$data["codeseq"]}}">
    <td width="5%"><span class="label label-pill label-inline mr-2">{{$data["code"]}}</span></td>
    <td width="5%">{{$data["codeseq"]}}</td>
    <td width="40%">{{$data["descript"]}}</td>
    <td>&nbsp;</td>
    <td width="40%">{{$data["gen_desc"]}}</td>
    <td>&nbsp;</td>
</tr>
@endforeach
<script>
    $(".icd9_orshowdata").click(function(){
        var code        = $(this).attr("code");
        var codeseq     = $(this).attr("codeseq");
        $.post("{{url('api/ordata')}}",{
            event   : "ordata_icd9select",
            code    : code,
            codeseq : codeseq,
            cid     : "{{$cid}}"
        },function(data, status){
            $("#icd9_ordataselect").html(data);
        });
        $(".icd9_orshowdata").remove();
        $("#ordata_icd9_txt").val(null);
    });
</script>
