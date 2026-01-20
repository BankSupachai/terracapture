
<form action="{{url('deletereport')}}" method="post">
    @csrf

        <table border="1">
        @foreach ($tb_report_one as $key)
            <tr>
                <td>#</td>
            @foreach ($key as $v=>$vv)
                <td>{{$v}}</td>
            @endforeach
            </tr>
        @endforeach

        @foreach ($tb_report as $key)
            <tr>
                <td><input type="checkbox" name="report[]" value="{{$key->report_id}}">
            @foreach ($key as $v=>$vv)

                <td>{{$vv}}</td>
            @endforeach
            </tr>
        @endforeach
        </table>
</form>
