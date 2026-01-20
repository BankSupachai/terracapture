@foreach($case as $data)
<tbody>
    <tr>
        <tr>
            {{$data->hn}}
        </tr>
        <td>
            {{$data->fullname}}
        </td>
        <td>
            {{$data->procedurename}}
        </td>
        <td>
            <a href="loadpic/{{$data->cid}}" class="btn btn-icon waves-effect waves-light btn-info  btn-sm">
                <i class="far fa-folder-open"></i>
            </a>
            &nbsp;
            <a href="camera/{{$data->cid}}" class="btn btn-icon waves-effect waves-light btn-success btn-sm">
                <i class="fas fa-camera"></i>
            </a>
        </td>
    </tr>
</tbody>
@endforeach
