หน้าเก็บคำสั่ง แบบง่าย ๆ

มีคำสั่งในการค้นหา
มี autocomplete

<input type="text" name="search"> <button>ค้นหา</button><br>

<a href="{{url('function/create')}}">เพิ่ม function</a>

    <table border="1" width="100%">
        <tr>
            <td>ประเภทภาษา</td>
            <td>ชื่อฟังก์ชั่น</td>
            <td>ทำงานเกี่ยวกับ</td>
            <td>ตัวอย่าง</td>
            <td>แก้ไข</td>
            </tr>

        @foreach($tb_function as $data)
            <tr>
                <td>{{$data->function_lang}}</td>
                <td>{{$data->function_name}}</td>
                <td>{{$data->function_detail}}</td>
                <td>{{$data->function_text}}</td>
                <td><button>แก้ไข</button></td>
                </tr>
            @endforeach






        </table>

