@php
    $xy = 0;
    $x = 0;
    $photoall = [];
    foreach ($case->photo as $data) {
        $data = (object) $data;
        if (isset($data->st)) {
            if ($data->st == 0 || $data->st == 1) {
                $photoall[$x]['nu'] = $data->nu;
                $photoall[$x]['ns'] = $data->ns;
                $photoall[$x]['na'] = $data->na;
                $photoall[$x]['sc'] = $data->sc;
                $photoall[$x]['st'] = $data->st;
                $photoall[$x]['tx'] = $data->tx;
                $x++;
            }
        }
    }
@endphp

<div class="row">
    @foreach ($photoall as $photo)
        <div class="col-2 mb-5 large-responsive" id="photo_display">
            <div class="row ms-3 ">
                <div class="row left-menu">
                    <div class="col-12">
                        <span class="text-number-pic">{{ $photo['nu'] }}</span>
                    </div>
                    <div class="col-12 mt-4rem">
                        <a class="btn-left-menu zoomify_icon " pic_number="{{ $photo['nu'] }}"
                            photo_id2="{{ $photo['nu'] }}"
                            photosrc="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                            photoname="{{ $photo['na'] }}" case_id="{{ $cid }}" data-toggle="tooltip"
                            title="zoom">
                            <i class="ri-search-line me-3"></i>
                        </a>
                    </div>
                    @if (@$project_name == 'capture')
                        <div class="col-12 mt-1">
                            <a class="btn-left-menu"
                                href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $photo['na'] . "&caseuniq=$case->caseuniq&photo_id=" . $photo['nu'] . '&type=crop') }}"
                                data-toggle="tooltip" title="crop">
                                <i class="ri-crop-line"></i>
                            </a>
                        </div>
                    @else
                        <a class="btn-left-menu"
                            href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $photo['na'] . "&caseuniq=$case->caseuniq&photo_id=" . $photo['nu'] . '&type=crop') }}"
                            data-toggle="tooltip" title="crop">
                            <i class="ri-crop-line"></i>
                        </a>
                    @endif
                    <div class="col-12 mt-1">
                        <a class="btn-left-menu picrollbacknew" id="picrollbacknew2{{ $photo['nu'] }}" type="imgall"
                            hn="{{ $case->hn }}" photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}"
                            photo_id="{{ $photo['nu'] }}" case_id="{{ $cid }}">
                            <i class="ri-refresh-line"></i>
                        </a>
                    </div>
                    <div class="col-12 mt-1">
                        {{-- Hide photo --}}
                        <a class="btn-left-menu photohide"
                            photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}">
                            <i class="ri-close-fill ri-lg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <img id="imgall{{ $photo['nu'] }}" class="imgselect_new " photo_id="{{ $photo['nu'] }}"
                        src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                        data-title={{ @$photo['na'] }} width="100%">
                    @php
                        if ($photo['ns'] != 0) {
                            $color = 'green';
                            $style = '';
                        } else {
                            $color = 'white';
                            $style = 'display: none';
                        }
                    @endphp
                    <div align="center" class="bb" id="bb{{ $photo['nu'] }}" style="{{ $style }}">
                        {{ $photo['ns'] }}
                    </div>
                    <div id="picselect{{ $photo['nu'] }}" style="background-color:{{ $color }} ;display: none"
                        class="picselect">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if (count($photoall) > 0)
    <div class="row">
        <div class="col"></div>
        <div class="col-3">
            <a href="{{ url(@$project_name == 'capture' ? "capture/procedure/$cid?select=1" : "procedure/$cid?select=1") }}"
                class="btn btn-success btn-xl btn-block btn-loading btn-shadow w-100">
                <h5 class="text-white"> Confirm Select Photo </h5>
            </a>
        </div>
    </div>
@endif

