@php
    // $status_holding     = status_monitor('Holding');
    // $status_discharge   = status_monitor('Discharged');
    $status_hd = status_monitor_array(['Register','Holding', 'Discharged']);
    $page = 0;
    $perpage = 8;
    $i = 1;
    $newdata = [];
    foreach ($status_hd as $data) {
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

<div class="card px-3">
    <h3 class="text-blue fw-bold mt-3">รายการรอทำหัตถการ & เสร็จสิ้น</h3>
    <div class="card-body">
        <div class="swiper pagination-dynamic-swiper rounded" style="height: 83vh;">
            <div class="swiper-wrapper">


                @foreach ($newdata as $datastep01)
                    <div class="@if (count($newdata) > 1) swiper-slide @endif">
                        <div class="row mt-3" style="width:600px">


                            @foreach ($datastep01 as $data)
                                @php
                                    $exname = explode(' ', $data['patientname']);
                                    $firstname  = @$exname[1];
                                    $lastname   = @$exname[1][0];
                                    $fullname   = "$firstname";
                                @endphp

                                @if ($data['status'] == 'Holding')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{@$data['queue']}}</span>
                                            <span class="text-blue fw-bold h2"> &ensp; {{ $fullname }}</span>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Holding</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-warning fs-16 px-3  fw-normal ">รอทำหัตถการ</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                @endif

                                @if ($data['status'] == 'Discharged')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{@$data['queue']}}</span>
                                            <span class="text-blue fw-bold h3"> &ensp; {{ $fullname }}</span>
                                        </div>
                                        <div class="col-12 mt-1 fs-16">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Discharged</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-success fs-14 px-3  fw-normal ">เสร็จสิ้น</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                @endif


                                @if ($data['status'] == 'Register')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{@$data['queue']}}</span>
                                            <span class="text-blue fw-bold h3"> &ensp; {{ $fullname }}</span>
                                        </div>
                                        <div class="col-12 mt-1 fs-16">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Register</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-warning fs-14 px-3  fw-normal ">รอทำหัตถการ</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                @endif



                            @endforeach
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>
