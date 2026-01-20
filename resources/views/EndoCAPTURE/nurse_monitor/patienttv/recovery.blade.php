{{-- @php
    $status_recovery     = status_monitor('Recovery');
    $page = 0;
    $perpage = 3;
    $i = 1;
    $newdata = [];
    foreach ($status_recovery as $data) {
        if ($i < $perpage) {
            $newdata[$page][] = $data;
        } else {
            $page++;
            $newdata[$page][] = $data;
            $i = 0;
        }
        $i++;
    }
@endphp

@foreach ($newdata as $datastep01)
    @php
        $exname     = explode(" ", $data['patientname']);
        $firstname  = @$exname[0];
        $lastname   = @$exname[1][0];
        $fullname   = "$firstname $lastname";
    @endphp
    <div class="swiper-slide">
        <div class="row">
            @foreach ($datastep01 as $datastep02)
                <div class="col-6 ">
                    <div class="card ">
                        <div class="col-12 text-end">
                            <span class="badge text-bg-secondary fs-16 w-lg p-2 fw-normal ">พักฟื้น</span>
                        </div>
                        <div class="row p-3">
                            <div class="col-12">
                                <span class="text-blue h4">#{{$data['queue']}}</span>
                                <span class="text-blue fw-bold h3"> &ensp; {{$fullname}}</span>
                            </div>
                            <div class="col-12 mt-1 fs-16">
                                <span><i class="ri-time-line"></i></span>
                                <span> &nbsp; 09:34</span>
                                <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> Recovery room</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach --}}
