<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="{{url("checkphoto")}}" method="get">
        @csrf
        <input type="text" class="form-control" name="datestart" placeholder="Start" value="{{@$_GET['datestart']}}">
        <input type="text" class="form-control" name="dateend" placeholder="End" value="{{@$_GET['dateend']}}">
        <button type="submit">กดตรงนี้นะ</button>
    </form>

    <table border="1" style="margin-top: 1em;">
        @foreach ($tb_case as $data)
        <tr>
            <td>{{@$data['date']}}</td>
            <td>{{$data['hn']}}</td>
            <td>{{$data['roomid']}}</td>
            <td>{{$data['room']}}</td>
            @if($data['photohave']=="yes")
                <td>{{$data['photohave']}}</td>
                <td></td>
            @else
                <td style="background-color: red">{{$data['photohave']}}</td>
                <td>
                    <a href="http://endocapture.siph.com/endotemp/synchronize?com_name={{@$data['comname']}}&hn={{$data['hn']}}" target="_blank">pull photo</a>
                </td>
            @endif



        </tr>
        @endforeach
        </table>





</body>
</html>
