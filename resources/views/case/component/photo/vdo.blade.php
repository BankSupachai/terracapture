<div class="row ">
    @forelse ($vdo as $v)

            <div class="col-4 m-0" style="padding: 20px;">
                <video src="{{ @$vdo_url }}/{{ $v }}" preload="none" controls width="100%"></video>

                        <div class="btn-group w-100" role="group">
                            <a href="{{url("cameracapvdo/$cid")}}?vdo={{@$v}}" class="btn btn-soft-primary ">
                              <i class="ri-video-line ri-xl"></i>  Capture Form Video
                            </a>
                            {{-- @if(@$project_name == 'capture')
                            <input type="text" class="form-control " placeholder="Free text">
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="{{url("cameracapvdo/$cid")}}?vdo={{@$v}}">Edit</a></li>
                            </ul>
                            @else
                            <input type="text" class="form-control " placeholder="Free text">
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="{{url("cameracapvdo/$cid")}}?vdo={{@$v}}">Edit</a></li>
                            </ul>
                            @endif --}}
                        </div>

            </div>

    @empty
        <div class="middle-screen text-center">
            <span class="h2">Video  </span> <span class="text-danger h2">Not Found !</span>
        </div>
    @endforelse
</div>

<script>
    $('.vdo_allow').focusout(function() {
        var vdo_name = $(this).attr('vdo_name');
        var value = $(this).val();
        $.post('{{ url('api/photomove') }}', {
            event: 'vdo_allow',
            vdo_name: vdo_name,
            value: value,
        }, function(data, status) {});
    });
</script>
