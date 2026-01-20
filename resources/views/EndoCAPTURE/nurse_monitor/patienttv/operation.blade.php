@php
    use App\Models\Mongo;
    use App\Models\Patient;
    $status_operation = status_monitor_array(['Operation','Recovery']);
    $page = 0;
    $perpage = 6;
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

@endphp

@foreach ($newdata as $datastep01)

{{-- @dd($datastep01) --}}
    <div class="col-12 @if(count($newdata)>1) swiper-slide @endif" data-swiper-autoplay="10000">
        <div class="row">
                @foreach ($datastep01 as $datastep02)

    @php
        $patientname = Patient::fullname_patient($datastep02['hn']);
        $exname     = explode(" ", $patientname);
        // dd($exname);
        $firstname  = @$exname[0];
        // $lastname   = @$exname[2];
        // // $lastname   = getMBStrSplit($exname[2], 1);

        // $fullname   = "$firstname";


        $num = (int) $datastep02["room"];
        $room       = (object) Mongo::table("tb_room")->where("room_id",$num)->first();
        $roomname   = @$room->room_name."";
        // $droom[] = $roomname;
    @endphp


                    @if($datastep02['status'] =="Operation")
                        <div class="col-6 ">
                            <div class="card ">
                                <div class="col-12 text-end">

                                        <span class="badge text-bg-danger box-skewX  fs-18 w-lg p-2 fw-bold ">ทำหัตถการ</span>

                                </div>
                                <div class="row p-3">
                                    <div class="col-12">
                                        <span class="text-blue h3">#{{@$datastep02['queue']}}</span>
                                        <span class="text-blue fw-bold h1"> &ensp; {{$firstname}} </span>
                                    </div>
                                    <div class="col-12 mt-1 fs-16">
                                        <span><i class="ri-time-line"></i></span>
                                        <span> &nbsp; {{@$datastep02['timevisit']}}</span>
                                        <span> &ensp; &ensp;<i class="ri-user-location-line  fw-bold"></i> {{$roomname}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-6 ">
                            <div class="card ">
                                <div class="col-12 text-end">
                                    <span class="badge text-bg-secondary fs-18 w-lg p-2 box-skewX  fw-bold ">พักฟื้น</span>
                                </div>
                                <div class="row p-3">
                                    <div class="col-12">
                                        <span class="text-blue h4">#{{$datastep02['queue']}}</span>
                                        <span class="text-blue fw-bold h1"> &ensp; {{$firstname}}</span>
                                    </div>
                                    <div class="col-12 mt-1 fs-16">
                                        <span><i class="ri-time-line"></i></span>
                                        <span> &nbsp; {{@$datastep02['timevisit']}}</span>
                                        <span> &ensp; &ensp;<i class="ri-user-location-line fw-bold"></i> Recovery room</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
    </div>
@endforeach


