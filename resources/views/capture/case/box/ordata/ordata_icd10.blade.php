@foreach($icd10 as $data)
<tr class   ="icd10_orshowdata"
    code    ="{{$data["code"]}}"
    codeseq ="{{$data["codeseq"]}}"
    prepost ="{{$prepost}}">
    <td width="5%"><span class="label label-pill label-inline mr-2">{{$data["code"]}}</span></td>
    <td width="5%">{{$data["codeseq"]}}</td>
    <td width="40%">{{$data["descript"]}}</td>
    <td>&nbsp;</td>
    <td width="40%">{{$data["gen_desc"]}}</td>
    <td>&nbsp;</td>
</tr>
@endforeach
<script>
    $(".icd10_orshowdata").click(function(){
        var code        = $(this).attr("code");
        var codeseq     = $(this).attr("codeseq");
        var prepost     = $(this).attr("prepost");
        $.post("{{url('api/ordata')}}",{
            event   : "ordata_icd10select",
            code    : code,
            codeseq : codeseq,
            prepost : prepost,
            cid     : "{{$cid}}"
        },function(data, status){
            $("#icd10_ordataselect_"+prepost).html(data);
        });
        $(".icd10_orshowdata").remove();
        $("#ordata_icd10_txt_"+prepost).val(null);
    });
</script>
