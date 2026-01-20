@php
    $status_hd = status_monitor_array(['Register', 'Holding', 'Discharged']);
    // dd($status_hd)
    $page = 0;
    $perpage = 8;
    $i = 1;
    $e = 0;
    $b = 0;
    $newdata = [];
    foreach ($status_hd as $data) {
        if ($i = $perpage) {
            $newdata[$page][] = $data;
        } else {
            $page++;
            $newdata[$page][] = $data;
            $i = 0;
        }
        $i++;
    }
@endphp

<style>

    .tab-pane {
      display: none;
    }

    .tab-pane.active {
      display: block;
    }
    .animation-nav li a{
        color: #ffffff;
    }
    .scroll-data{
        overflow-y: scroll;
        overflow-x: hidden;

        height: 81vh;
    }

        ::-webkit-scrollbar {
    width: 5px;
    border-radius: 4px;

    }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #222529;
        border-radius: 4px;

        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555;
        }
</style>
<div class="card tab-content">
    {{-- @foreach ($room_all as $data0)
    <div class="tab-pane px-3 pb-3 roomholding" id ="room_holding{{$data0['room_id']}}" @if($e != 0 ) style="display: none;" @endif  >
        <p class="text-white fw-normal mt-3 h3">Holding - {{$data0['room_name']}}</p>
                @foreach ($newdata as $datastep01)
                @foreach ($datastep01 as $data)
                            @php
                                $exname = explode(' ', $data['patientname']);
                                $firstname = @$exname[1];
                                $lastname = @$exname[1][0];
                                $fullname = "$firstname";
                            @endphp

                            @if ($data['status'] == 'Holding' && $data0['room_id'] ==  $data['room'])
                                <div class="row mt-2" style="padding: 4.9px;">
                                    <div class="col-12">
                                        <span class="text-white"> #{{ @$data['queue'] }} &ensp; {{ $fullname }} </span>
                                    </div>
                                    <div class="col-12">
                                        <span>
                                            <i class="ri-time-line"></i> &ensp; {{ $data['timevisit'] }} &ensp; <i
                                                class="ri-user-location-line"></i> RR
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <span> <i class="ri-dashboard-line"></i> &ensp;{{implode(' | ',$data['procedure'])}}</span>
                                    </div>
                                    <div class="col-12 mb-3 ">
                                        <span> <i class="ri-sticky-note-line"></i> &ensp; </span>
                                        <span class="text-danger">Peptic ulcer perforation // เตรียมเงินมา 5,000 บาท</span>
                                    </div>
                                    <div class="col-12 border-bottom mb-4"></div>

                                </div>
                            @endif
                        @endforeach
                    @endforeach

    </div>
    @php
        $e++;
    @endphp

        @endforeach --}}
        {{-- <div class="row">

            @foreach ($room_all as $data)
            <div class="col-4">
                <button class="btn btn-primary roomshow" room ="{{$data['room_id']}}"> {{$data['room_name']}}</button>
            </div>

            @endforeach
        </div>
 --}}

 {{-- <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
     @foreach ($room_all as $data)
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link active roomshow" room ="{{$data['room_id']}}" data-bs-toggle="tab" href="#animation-home" role="tab">
            {{$data['room_name']}}
        </a>
    </li>
    @endforeach

</ul> --}}



  <div class="tab-content p-3">
    @foreach ($room_all as $data0)
    @if ($e == 0)
      <div class="tab-pane active scroll-data " id="room_holding{{$data0['room_id']}}"  >
    @else
        <div class="tab-pane scroll-data " id="room_holding{{$data0['room_id']}}"  >
    @endif

        <p class="text-white fw-normal mt-3 h3">Holding - {{$data0['room_name']}}</p>

        @foreach ($newdata as $datastep01)
        @foreach ($datastep01 as $data)
                    @php
                        $exname = explode(' ', $data['patientname']);
                        $firstname = @$exname[1];
                        $lastname = @$exname[1][0];
                        $fullname = "$firstname";
                    @endphp
                    {{-- @dd($data); --}}
                    @if ($data['status'] == 'Holding' && $data0['room_id'] ==  $data['room'])
                        <div class="row mt-2" style="padding: 4.9px;">
                            <div class="col-12">
                                <span class="text-white"> #{{ @$data['queue'] }} &ensp; {{ $fullname }} </span>
                            </div>
                            <div class="col-12">
                                <span>
                                    <i class="ri-time-line"></i> &ensp; {{ $data['timevisit'] }} &ensp; <i
                                        class="ri-user-location-line"></i> RR
                                </span>
                            </div>
                            <div class="col-12">
                                <span> <i class="ri-dashboard-line"></i> &ensp;{{implode(' | ',$data['procedure'])}}</span>
                            </div>
                            <div class="col-12 mb-3 ">
                                <span> <i class="ri-sticky-note-line"></i> &ensp; </span>
                                <span class="text-danger">Peptic ulcer perforation // เตรียมเงินมา 5,000 บาท</span>
                            </div>
                            <div class="col-12 border-bottom mb-4"></div>

                        </div>
                    @endif
                @endforeach
            @endforeach
            @php
            $e++;
        @endphp
      </div>

    @endforeach
  </div>

  <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3 align-self-center" role="tablist">
    @foreach ($room_all as $data)
    @php
        $number_room = preg_replace('/\D/','', $data['room_name'])
    @endphp
    <div class="col-auto">
        @if ($b != 0)
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link  roomshow" room="{{$data['room_id']}}" data-bs-toggle="pill" href="#room_holding{{$data['room_id']}}" role="tab">
            {{$number_room}}
          </a>

        </li>
        @else
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link  roomshow " room="{{$data['room_id']}}" data-bs-toggle="pill" href="#room_holding{{$data['room_id']}}" role="tab">
              {{$number_room}}
            </a>

          </li>
        @endif

    </div>
    @endforeach
</ul>
</div>
</div>

