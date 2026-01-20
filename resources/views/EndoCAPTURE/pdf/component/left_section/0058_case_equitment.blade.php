{{-- <tr class="set-font-family" style="line-height:{{$body_line}};">
    <td width="100%">
        <span class="casetitle">CASE EQUIPMENT :</span>
        <span class="casetext">
            @dd($casedata)
            @foreach(isset($casedata->equipment)?$casedata->equipment:array() as $equipment)
                @php
                    $sc = "";
                    $tb_equitment = (object) Mongo::table('tb_equipment')->where('eq_id',(int) $equipment)->first();
                    if(isset($sc_u->name)){
                        $sc = @$sc_u->name;
                    }else{
                        $sc = $equipment;
                    }
                @endphp
                {!!$sc."<br>"!!}
            @endforeach
        </span>
    </td>
</tr> --}}
