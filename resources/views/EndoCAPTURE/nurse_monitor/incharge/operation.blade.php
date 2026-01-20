





<div class="row mt-2">


    {{-- @for ($i=0;$i<=3;$i++)
    <div class="col-6 ">
        <div class="card ">
            <div class="col-12 text-end">
                <span class="badge text-bg-danger  fs-18 w-lg fw-normal ">Operation</span>
            </div>
            <div class="row px-4">
                <div class="col-12  " style="margin-top: -2em;">
                    <span class="h3 text-white">#A05 &ensp; สดายุ ทองลอย </span>
                </div>
                <div class="col-12">
                    <span> <i class="ri-time-line"></i> &ensp; 11:34 </span>
                    <span class="text-danger">&ensp;&nbsp; EGD </span>
                    <span class="text-success">&ensp; Colonoscopy </span>
                </div>
                <div class="col-12">
                    <span> <i class="ri-nurse-line"></i> &ensp; นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                </div>
                <div class="col-12 mb-3">
                    <span> <i class="ri-user-location-line"></i> &ensp; Endoscopy Room 1</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 ">
        <div class="card ">
            <div class="col-12 text-end">
                <span class="badge text-bg-secondary  fs-18 w-lg fw-normal ">Recovery</span>
            </div>
            <div class="row px-4">
                <div class="col-12  " style="margin-top: -2em;">
                    <span class="h3 text-white">#A05 &ensp; สดายุ ทองลอย </span>
                </div>
                <div class="col-12">
                    <span> <i class="ri-time-line"></i> &ensp; 11:34 </span>
                    <span class="text-danger">&ensp;&nbsp; EGD </span>
                    <span class="text-success">&ensp; Colonoscopy </span>
                </div>
                <div class="col-12">
                    <span> <i class="ri-nurse-line"></i> &ensp; นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                </div>
                <div class="col-12 mb-3">
                    <span> <i class="ri-user-location-line"></i> &ensp; Endoscopy Room 1</span>
                </div>
            </div>
        </div>
    </div>
    @endfor --}}

    @php
    use App\Models\Mongo;
    $status_operation = status_monitor_array(['Operation','Recovery']);
    $page = 0;
    $perpage = 9;
    $i = 1;
    $newdata = [];
    foreach ($status_operation as $data) {
        if ($i < $perpage) {
            $newdata[$page][] = $data;
        } else {
            $page++;
            $newdata[$page][] = $data;
            $i = 0;
        }
        $i++;
    }

    // $countcase = count($case);
    // dd($countcase);
@endphp

@foreach ($newdata as $datastep01)

{{-- @dd($datastep01) --}}
    <div class="col-12 @if(count($newdata)>1) swiper-slide @endif">
        <div class="row">
                @foreach ($datastep01 as $datastep02)

    @php
        $exname     = explode(" ", $datastep02['patientname']);
        $firstname  = @$exname[1];
        $lastname   = @$exname[1][0];
        $fullname   = "$firstname";


        $num = (int) $datastep02["room"];
        $room       = (object) Mongo::table("tb_room")->where("room_id",$num)->first();
        $roomname   = @$room->room_name."";
        // $droom[] = $roomname;
    @endphp
    
            {{-- @dd($datastep02); --}}
                    @if($datastep02['status'] =="Operation")
                        <div class="col-6 ">
                            <div class="card ">
                                <div class="col-12 text-end">
                                    <span class="badge text-bg-danger  fs-18 w-lg fw-normal ">Operation</span>
                                </div>
                                <div class="row px-4">
                                    <div class="col-12" style="margin-top: -2em;">
                                        <span class="h3 text-white">#{{@$datastep02['queue']}} &ensp; {{$datastep02['patientname']}} </span>

                                    </div>
                                    <div class="col-12">
                                        <span> <i class="ri-time-line"></i> &ensp; {{@$datastep02['timevisit']}} </span>
                                        <span class="text-danger">&ensp;&nbsp; {{@$datastep02['procedure'][0]}} </span>
                                        @isset($datastep02['procedure'][1])
                                        <span class="text-success">&ensp;  {{@$datastep02['procedure'][1]}} </span>
                                        @endisset
                                    </div>
                                    <div class="col-12">
                                        <span> <i class="ri-nurse-line"></i> &ensp; {{@$datastep02['doctorname']}}</span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <span> <i class="ri-user-location-line"></i> &ensp; {{$roomname}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="col-6 ">
                            <div class="card ">
                                <div class="col-12 text-end">
                                    <span class="badge text-bg-secondary  fs-18 w-lg fw-normal ">Recovery</span>
                                </div>
                                <div class="row px-4">
                                    <div class="col-12" style="margin-top: -2em;">
                                        <span class="h3 text-white">#{{@$datastep02['queue']}} &ensp; {{$fullname}} </span>

                                    </div>
                                    <div class="col-12">
                                        <span> <i class="ri-time-line"></i> &ensp; {{@$datastep02['timevisit']}} </span>
                                        <span class="text-danger">&ensp;&nbsp; {{@$datastep02['procedure'][0]}} </span>
                                        @isset($datastep02['procedure'][1])
                                        <span class="text-success">&ensp;  {{@$datastep02['procedure'][1]}} </span>
                                        @endisset
                                    </div>
                                    <div class="col-12">
                                        <span> <i class="ri-nurse-line"></i> &ensp; {{@$datastep02['doctorname']}}</span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <span> <i class="ri-user-location-line"></i> &ensp; {{$roomname}}</span>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
    </div>
@endforeach

<div class="col-12 footer-incharge">
    CASE Monitor  ©EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
</div>



</div>
