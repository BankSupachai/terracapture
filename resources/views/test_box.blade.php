<table class="table">
    @foreach($accessory as $data)
        @if($data->accessory_id<=10)
            <tr>
                <td>{{$data->accessory_id}}</td>
                <td>{{$data->accessory_name}}</td>
            </tr>
        @endif
    @endforeach
</table>
