@php
    use App\Models\Patient;
@endphp

<div class="col-6 px-1 ">
    <div class="card mb-2 " >
        <div class="bg-darkness px-1 pt-2" >
            <div class="col-12 p-0 text-end">
                <span class="fs-14">{{ $room->room_name }}</span>
                @php
                    $arr    = operation_room($room->room_id);

                    $hn     = array();

                @endphp
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 " style="height: 294.5px; overflow:auto">
                        <div class="row p-2">
                            <div class="col-2 fs-14 fw-bold ">HN</div>
                            <div class="col-4 text-center fs-14 fw-bold">Name</div>
                            <div class="col-6 fs-14 fw-bold">Procedure</div>
                        </div>

                        @forelse ($arr as $a)
                            @php
                                $a = (object) $a;
                                $hn[] = $a['hn'];
                                $patient = Patient::fullname_patient($a['hn']);

                            @endphp
                            <div class="row">
                                <div class="col-2 fs-14 text-nowrap">{{ $a['hn'] }}</div>
                                <div class="col-4 text-center fs-14 text-nowrap">{{ $a['patientname'] }}</div>
                                <div class="col-5">
                                    <div class="row ps-0 ms-0">
                                            @foreach ($a['procedure'] as $key => $value)
                                                <div class="col-7 ps-0 m-0 fs-14">{{ $value }}</div>
                                                <div class="col-5  fs-14 ">
                                                    <span class="badge badge-soft-{{ @$a['color'][$key] }}">
                                                        {{ @$a['status'][$key] }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- <div class="row ps-0 ms-0">
                                            @foreach ($a['procedure'] as $key => $value)
                                                <div class="col-12 ps-0 m-0 fs-10">{{ $value }}
                                                    <span class="badge badge-soft-{{ @$a['color'][$key] }}">
                                                        {{ @$a['status'][$key] }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div> --}}
                                </div>

                            </div>
                        @empty
                            <div class="col-12 fs-10" style="text-align: center;">
                                No Operation !!
                            </div>
                        @endforelse

                        @php
                            $arr    = holding_room($room->room_id,$hn);

                            $i      = 1;
                        @endphp
                        <div class="mt-2 p-0 "
                            style="border-top: 1px solid #707070; overflow-x:hidden;  overflow-y:auto;">
                            @foreach ($arr as $a)

                                @php
                                    $patient = Patient::fullname_patient($a->hn);
                                @endphp
                                <div class="@if (fmod($i, 2) == 1) bg-dark-tv  @endif p-1">
                                    <div class="row fs-14">
                                        <div class="col-2 ps-3">
                                            <span class="badge badge-dark time">
                                                @if(@$a->timevisit!=null && @$a->timevisit!="0")

                                                {{$a->timevisit}}
                                                @else
                                                check
                                                @endif</span>
                                        </div>
                                        <div class="col-2">
                                                <span class=" text-detail fs-14">{{ $a->hn }} &ensp;
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class=" text-detail fs-14"> {{ $patient }}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-detail fs-14">
                                                @foreach ($a->procedure as $key => $value)
                                                    {{ $value }}
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="col-2 text-center ">
                                            {{ $a->location }}
                                        </div>
                                        <div class="col-10 text-danger text-nowrap fs-12">
                                            {{ $a->prediagnostic }}
                                            @if ($a->remark != '')
                                                // {{ $a->remark }}
                                            @endif  &nbsp;
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>

                    </div>

                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span class="fs-14">Endoscopist </span>
                                <div style="overflow: auto; height: 50px;">
                                    <div class="row m-0">
                                        @php
                                        $users = get_user_in_room($room->room_id, 'doctor');
                                    @endphp

                                    @foreach (isset($users)?$users:[] as $name)
                                    {{-- @dd($name); --}}
                                        @if (@$name."" == '' || !isset($name))
                                            @php continue;  @endphp
                                        @endif

                                            <div class="col-12">
                                                {{@$name}}
                                            </div>
                                            @endforeach
                                        </div>




                                        {{-- <span>นพ.สดายุ01</span>
                                        <span>นพ.จุ๊มเหม่ง02</span> --}}

                                </div>

                            </div>
                            <div class="col-6">
                                <span class="fs-14">Nurse and Practical</span>
                                <div style="overflow: auto; overflow-x: hidden; height: 50px;">
                                    <div class="row m-0">
                                        @php
                                            $nurses = get_user_in_room($room->room_id, 'nurse');
                                            $assist = get_user_in_room($room->room_id, 'nurse assist');

                                        @endphp
                                        @foreach (isset($nurses)?$nurses:[] as $name)
                                            @if (@$name."" == '' || !isset($name))
                                                @php continue;  @endphp
                                            @endif
                                            <div>{{@$name}}</div>
                                        @endforeach
                                        @foreach (isset($assist)?$assist:[] as $name)
                                            @if (@$name."" == '' || !isset($name))
                                                @php continue;  @endphp
                                            @endif
                                            <div class="col-12">
                                                <span>{{@$name}}</span>
                                            </div>
                                        @endforeach
                                        {{-- <span>นพ.สดายุ01</span>
                                        <span>นพ.จุ๊มเหม่ง02</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
<div class="col-4 px-1 ">
    <div class="card mb-2 " >
        <div class="bg-darkness px-3 pt-2" style="height: 100vh;">
            <div class="col-12 p-0 text-end">
                <span class="fs-14">Recovery room</span>
                @php
                    $arr    = operation_room($room['room_id']);
                    $hn     = array();
                @endphp
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 p-0 height-right-room2" >
                        @php
                            $arr    = recovery_room($room['room_id'],$hn);
                            $i      = 1;
                        @endphp
                        <div class="mt-2 p-0 "
                            style="border-top: 1px solid #707070; overflow-x:hidden;  overflow-y:auto;">
                            @foreach ($arr as $a)
                                <div class="@if (fmod($i, 2) == 1) bg-dark-tv  @endif p-1">
                                    <div class="row fs-14">
                                        <div class="col-2 ps-3">
                                            <span class="badge badge-dark time">
                                                @if(@$a['timevisit']!=null && @$a['timevisit']!="0")

                                                {{$a['timevisit']}}
                                                @else
                                                check
                                                @endif</span>

                                        </div>
                                        <div class="col-6">
                                            <span class=" text-detail">{{ $a['hn'] }} &ensp;{{ $a['patientname'] }}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-detail">
                                                @foreach ($a['procedure'] as $key => $value)
                                                    {{ $value }}
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="col-2 text-center ">
                                            {{ $a['location'] }}
                                        </div>
                                        <div class="col-10 text-danger text-nowrap ">
                                            {{ $a['prediagnostic'] }}
                                            @if ($a['remark'] != '')
                                                // {{ $a['remark'] }}
                                            @endif  &nbsp;
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

