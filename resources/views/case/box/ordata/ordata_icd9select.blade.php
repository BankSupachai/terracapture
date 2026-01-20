@foreach($icd9 as $data)
<tr class   ="icd9_orselctdata"
    code    ="{{$data["code"]}}"
    codeseq ="{{$data["codeseq"]}}">
    <td><span class="label label-pill label-inline mr-2">{{$data["code"]}}</span></td>
    <td>{{$data["codeseq"]}}</td>
    <td>{{$data["descript"]}}</td>
    <td>&nbsp;</td>
    <td>{{$data["gen_desc"]}}</td>
    <td>&nbsp;</td>
</tr>
@endforeach
<script>
    $(".icd9_orselctdata").click(function(){
        var code        = $(this).attr("code");
        var codeseq     = $(this).attr("codeseq");
        $.post("{{url('api/ordata')}}",{
            event   : "ordata_icd9remove",
            code    : code,
            codeseq : codeseq,
            cid     : "{{$cid}}"
        },function(data, status){
            $("#icd9_ordataselect").html(data);
        });
    });
</script>
