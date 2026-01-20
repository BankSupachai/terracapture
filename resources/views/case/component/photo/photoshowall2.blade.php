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

<div class="row ">
    @foreach ($photoall as $photo)
        <div class="col-2 mt-2">
            <img id="imgselect{{ $photo['nu'] }}" class="imgselect_new" photo_id="{{ $photo['nu'] }}"
                src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}" width="100%">
            @php
                if ($photo['ns'] != 0) {
                    $color = 'green';
                    $style = '';
                } else {
                    $color = 'white';
                    $style = 'display: none';
                }
            @endphp
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <table>
                            <tr>
                                <td>
                                    <button class="btn btn-icon2 ">
                                        {{ $photo['nu'] }}
                                    </button>

                                </td>
                                <td>
                                    <button class="btn btn-icon2  zoomify_icon" pic_number="{{ $photo['nu'] }}"
                                        photo_id2="{{ $photo['nu'] }}"
                                        photo_name="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                        data-toggle="tooltip" title="zoom">
                                        <i class="ri-search-line"></i>
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-icon2 "
                                        href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $photo['na'] . "&caseuniq=$case->caseuniq&ppic=$procedure->img") }}"data-toggle="tooltip"
                                        title="Crop">
                                        <i class="ri-crop-line"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-icon2   picrollbacknew"
                                        id="picrollbacknew2{{ $photo['nu'] }}" hn="{{ $case->hn }}"
                                        photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}"
                                        photo_id="{{ $photo['nu'] }}" case_id="{{ $cid }}"
                                        data-toggle="tooltip" title="Undo">
                                        <i class="ri-arrow-go-back-line"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-icon2   json_del" pic_number="{{ $photo['nu'] }}"
                                        photo_id="{{ $photo['nu'] }}" data-toggle="tooltip" title="zoom">
                                        <i class=" ri-delete-bin-line"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-icon2   piccropblacknew "
                                        id="piccropblacknew2{{ $photo['nu'] }}" hn="{{ $case->hn }}"
                                        photoname="{{ $photo['na'] }}" photo_id="{{ $photo['nu'] }}"
                                        photo_num="{{ $photo['nu'] }}" data-toggle="tooltip" title="zoom">
                                        <i class="ri-scissors-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
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
            <a href="{{ url("procedure/$cid?select=1") }}" class="btn btn-success btn-xl btn-block btn-shadow w-100">
                <h5 class="text-white"> Confirm Select Photo</h5>
            </a>
        </div>
    </div>
@endif
