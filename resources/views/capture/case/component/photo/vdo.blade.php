<div class="row video-scroll video-scroll-bar">
    @forelse ($vdo as $v)
        <div class="col-12">
            <div class="col-8 m-0" style="padding: 20px;">
                <video src="{{ @$vdo_url }}/{{ $v }}" width="100%" preload="none" controls></video>
                <div class="row">
                    <div class="">
                        <div class="btn-group w-100" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                            </button>
                            <input type="text" class="form-control " placeholder="Free text">
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="{{url("cameracapvdo/$cid")}}?vdo={{@$v}}">Edit</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="middle-screen text-center">
            <span class="h2">Video Not </span> <span class="text-danger h2">Found !</span>
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
