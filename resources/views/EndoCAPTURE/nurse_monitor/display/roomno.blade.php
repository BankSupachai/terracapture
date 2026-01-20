<div class="col-12 fs-16" >
    <div class="bg-darkness px-1 pt-2 " >
        <div class="col-12 p-2 text-end">
            <span class="fs-16 mt-2">No Room</span>
        </div>
        <div class="col-12 height-right ">
            @php
                $i = 1;
            @endphp
            @foreach ($list_regis as $job)

                <div class= "@if (fmod($i, 2) == 1) bg-dark-tv @endif p-1" >
                    <div class="row fs-16 ">
                        <div class="col-2">
                            <span class="badge badge-dark time">
                                @if(@$job['timevisit']!=null && @$job['timevisit']!="0")

                                {{$job['timevisit']}}
                                @else
                                check
                                @endif</span>
                        </div>
                        <div class="col-10 fs-18">
                            <span class=" text-detail" style="color: #f7b84b">{{ $job['hn'] }} &ensp;
                                {{ $job['patientname'] }}
                            </span>
                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-10 fs-16">
                            <span class="text-detail">
                            {{implode("," ,array_unique($job['procedure']) ?? [])}}
                            </span>
                        </div>
                        {{-- <div class="col-2 text-center  fs-16 ">
                            {{ $job['location'] }}
                        </div>
                        <div class="col-8 text-danger text-nowrap fs-16">
                            {{ @$job['prediagnostic'] }}
                            @if ($job['remark'] != '')
                                //{{ $job['remark'] }}
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
