<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book</title>
    <style>
    @font-face {
        font-family: 'Kanit';
        src: url("{{ public_path('fonts/Kanit-Regular.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family: 'Kanit_semibold';
        src: url("{{ public_path('fonts/Kanit-SemiBold.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    *{
        font-family: "Kanit";
    }
    th{
        font-family: "Kanit_semibold";
        font-weight: 100;
    }
    .header{
        width: 100%;
    }
    .header div{
        width: 100%;
        text-align: center;
        font-size: large;
    }
    table, td, th {
        border: 1px solid black;
        font-size: 14px;
        padding-left: 0.5em;
    }
    td{
        line-height: 15px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    .text-center{
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="header">
        <div>โรงพยาบาลมหาราชนครราชสีมา</div>
        <div>ตารางนัดหมายส่องกล้อง</div>
        <div>วันที่ {{$date[2]}}/{{$date[1]}}/{{$date[0]}}</div>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <td class="text-center">No.</td>
                <td class="text-center">Time</td>
                <td>Name</td>
                <td>HN</td>
                <td class="text-center">Age</td>
                <td>Diagnosis</td>
                <td>Operation</td>
                <td>Physician</td>
                <td>สิทธิการรักษา</td>
                <td>Note</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $tcd)
            @php
                $json = json_decode($tcd->book_appoint);
                $time = date("H:i", strtotime($tcd->book_date_end));
            @endphp
            <tr>
                <td class="text-center">{{@$i}}</td>
                <td class="text-center">{{@$time}}</td>
                <td>{{@$json->PTNAME}}</td>
                <td>{{@$json->HN}}</td>
                <td class="text-center">{{@$json->AGE}}</td>
                <td>{{@$json->DIAG}}</td>
                <td>{{@$json->OPERATION}}</td>
                <td>{{@$json->SURGEON}}</td>
                <td>{{@$json->PTTYPE_NAME}}</td>
                <td>{{@$tcd->book_comment}}</td>
            </tr>

            @php
                $i++;
            @endphp

            @endforeach

        </tbody>
    </table>
</body>
</html>
