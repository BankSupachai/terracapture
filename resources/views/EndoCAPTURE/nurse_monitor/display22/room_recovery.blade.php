


<div class="col-12 fs-16 mt-2" >
    <div class="bg-darkness px-1 pt-2 " >
        <div class="col-12 p-2 text-end">
            <span class="fs-16 mt-2">Recovery room</span>
        </div>
        <div class="col-12 height-right ">
            @php
            $arr    = operation_room($room->room_id);
            $hn     = array();
        @endphp
            @php
            $arr    = recovery_room($room->room_id,$hn);
            $i      = 1;
            // dd($arr);

        @endphp
              @foreach ($arr as $a)
              <div class="@if (fmod($i, 2) == 1) bg-dark-tv  @endif p-1">
                        <div class="row fs-16">
                      <div class="col-2 ps-3">
                          <span class="badge badge-dark time">
                              @if(@$a['timevisit']!=null && @$a['timevisit']!="0")

                              {{$a['timevisit']}}
                              @else
                              check
                              @endif</span>

                      </div>
                      <div class="col-10">
                          <span class=" text-detail" style="color: #f7b84b">{{ $a['hn'] }} &ensp;{{ $a['patientname'] }}
                          </span>
                      </div>
                      <div class="col-2">

                      </div>
                      <div class="col-10">
                          <span class="text-detail">
                              {{ implode(', ', array_unique(array_filter($a['procedure']))) }}
                          </span>
                      </div>
                      {{-- <div class="col-2 text-center ">
                          {{ $a['location'] }}
                      </div>
                      <div class="col-10 text-danger text-nowrap ">
                          {{ $a['prediagnostic'] }}
                          @if ($a['remark'] != '')
                              // {{ $a['remark'] }}
                          @endif  &nbsp;
                      </div> --}}
                  </div>
              </div>
              @php
                  $i++;
              @endphp
          @endforeach

            <div style="padding-bottom: 5rem;"></div>
        </div>
    </div>
</div>
