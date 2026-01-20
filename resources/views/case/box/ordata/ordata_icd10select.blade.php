@foreach($icd10 as $data)
<tr class   ="icd10_orselctdata"
    code    ="{{$data["code"]}}"
    codeseq ="{{$data["codeseq"]}}"
    prepost ="{{$prepost}}">
    <td><span class="label label-pill label-inline mr-2">{{$data["code"]}}</span></td>
    <td>{{$data["codeseq"]}}</td>
    <td>{{$data["descript"]}}</td>
    <td>&nbsp;</td>
    <td>{{$data["gen_desc"]}}</td>
    <td>&nbsp;</td>
</tr>
@endforeach
<script>
    $(".icd10_orselctdata").click(function(){
        var code        = $(this).attr("code");
        var codeseq     = $(this).attr("codeseq");
        var prepost     = $(this).attr("prepost");
        $.post("{{url('api/ordata')}}",{
            event   : "ordata_icd10remove",
            code    : code,
            codeseq : codeseq,
            prepost : prepost,
            cid     : "{{$cid}}"
        },function(data, status){
            $("#icd10_ordataselect_"+prepost).html(data);
        });
    });
</script>
