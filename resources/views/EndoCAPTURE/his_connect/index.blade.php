<table border="1" width="100%">
    <tr>
        <td>#</td>
        <td>HN</td>
        <td>Patient name</td>
        <td>Gender</td>
        <td>Age</td>
        <td>OPERATION</td>
        <td>SURGEON</td>
        <td>Create</td>
    </tr>
    @foreach($tb_hisconnect as $his)
        @php
        $json   = jsonDecode($his->his_json);
        $aaa    = explode(".",$json->SURGEON);
        $bbb    = explode(" ",end($aaa));
        $doctor = DB::table('users')
        ->where('user_firstname',$bbb[0])
        ->where('user_lastname',$bbb[1])
        ->first();
        $operation = checkPROCEDURE($json->OPERATION);

                // "HN" => "1561603"
                // "PTNAME" => "นางประภาพร  อนุวรรณ"
                // "MALE" => "หญิง"
                // "AGE" => "59"
                // "PTTYPE" => "400"
                // "PTTYPE_NAME" => "ข้าราชการเบิกจ่ายตรง/บำนาญ"
                // "OPERATION" => "EGD"
                // "SURGEON" => "ผศ.นพ.ศิษฏ์ ศิรมลพิวัฒน์"
                // "DIAG" => "dyspepsia"
                // "REQDATE" => "8/4/2564 0:00:00"
                // "VIP" => null
        @endphp
        <form action="his_connect" method="POST">
            @csrf
            <tr>
                <td>{{$his->his_id}}</td>
                <td>{{$his->his_hn}}</td>
                <td>{{$json->PTNAME}}</td>
                <td>{{$json->MALE}}</td>
                <td>{{$json->AGE}}</td>
                <td>{{$json->OPERATION}}
                    @foreach($operation as $oper)
                        <br><font color="green">{{$oper}}</font>
                    @endforeach
                </td>
                <td>{{$json->SURGEON}}</td>
                <td>
                    <input type="hidden" name="date" value="{{$date}}">
                    <button type="submit" name="his_id" value="{{$his->his_id}}">Create</button>

                </td>
            </tr>
        </form>
    @endforeach
</table>
