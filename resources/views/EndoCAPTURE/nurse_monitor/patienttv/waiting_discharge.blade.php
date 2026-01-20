@php
    use App\Models\Patient;
    // $status_holding     = status_monitor('Holding');
    // $status_discharge   = status_monitor('Discharged');
    $status_hd = status_monitor_array(['Register', 'Holding', 'Discharged' , 'holding' , 'discharged','register' ]);
    // dd($status_hd);
    $page = 0;
    $perpage = 7;
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
                    <div class="@if (count($newdata) > 1) swiper-slide @endif" data-swiper-autoplay="10000">
                        <div class="row mt-3" style="width:600px">


                            @foreach ($datastep01 as $data)
                                @php
                                    $patientname = Patient::fullname_patient($data['hn']);
                                    // $exname = explode(' ', $data['patientname']);
                                    $exname     = explode(" ", $patientname);
                                    $firstname  = @$exname[0];
                                    // $lastname   = getMBStrSplit(@$exname[2], 1);
                                    $lastname   = @$exname[2];

                                    $fullname   = "$firstname";
                                @endphp

                                @if ($data['status'] == 'Holding' || $data['status'] == 'holding')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{ @$data['queue'] }}</span>
                                            <span class="text-blue fw-bold h1">&ensp;{{ $firstname }}</span>
                                        </div>
                                        <div class="col-12 mt-1 fs-16">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Holding</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-warning fs-18 px-3  fw-bold ">รอทำหัตถการ</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                @endif

                                @if ($data['status'] == 'Discharged' || $data['status'] == 'discharged')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{ @$data['queue'] }}</span>
                                            <span class="text-blue fw-bold h1"> &ensp;{{ $firstname }}</span>
                                        </div>
                                        <div class="col-12 mt-1 fs-16">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Discharged</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-success fs-18 px-3 fw-bold" style="min-width: 133px">เสร็จสิ้น</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                @endif


                                @if ($data['status'] == 'Register'|| $data['status'] == 'register')
                                    <div class="col-6 ">
                                        <div class="col-12">
                                            <span class="text-blue h4">#{{ @$data['queue'] }}</span>
                                            <span class="text-blue fw-bold h1"> &ensp;{{ @$firstname }} </span>
                                        </div>
                                        <div class="col-12 mt-1 fs-16">
                                            <span><i class="ri-time-line"></i></span>
                                            <span> &nbsp; {{ $data['timevisit'] }}</span>
                                            <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> &nbsp;
                                                Register</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="badge text-bg-warning fs-18 px-3  fw-bold ">รอทำหัตถการ</span>
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
