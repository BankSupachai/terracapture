@extends('layouts.layoutsManagePhoto')
@section('style')
    <style>
        .img-box {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 2.5em;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .img-container {
            position: relative;
            text-align: center;
        }

        .img-number {
            position: absolute;
            top: -1.5em;
            left: 50%;
            transform: translateX(-50%);
            color: #325684;
            font-size: 1.4em;

            padding: 0.2em 0.5em;
            border-radius: 0.3em;
        }

        .img-box img {
            margin-top: 0.5em;
            width: 100%;
            height: 34vh;
        }

        .card {
            border-radius: 30px;
        }

        .img-container.selected img {
            border: #0AB39C 8px solid;

        }
    </style>
@endsection
@php
    $i = 0;
    $xy = 0;
    $x = 0;
    $photoall = [];
    foreach (@$case->photo as $data) {
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
@section('content')
    <div class="p-3 pt-4">
        <form action="{{ url('selectphoto') }}" method="POST">
            @method('POST')
            @csrf
            <input type="hidden" name="event" value="sel_photo">
            <input type="hidden" name="lesion" value="{{ @$_GET['lesion'] }}">
            <input type="hidden" name="mainpart" value="{{ @$_GET['mainpart'] }}">
            <input type="hidden" name="cid" value="{{ $cid }}">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url("procedure/$cid") }}" class="btn btn-danger w-lg btn-label waves-effect right waves-light">
                    <i class="ri-arrow-go-back-fill label-icon align-middle fs-16 ms-2"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary w-lg btn-label waves-effect right waves-light">
                    <i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Confirm
                </button>
            </div>
            <div class="col-12 text-center">
                <div id="photoall" style="display: none"></div>
                <h2 style="color: #f3f6f9">Select Photo</h2>
                <h4 style="color: #ffffff80">Choose photo for this position and then click “Confirm”</h4>
            </div>
            <div class="card bg-white mt-3">
                <div class="card-body"
                    style="height: 78vh; overflow:auto; margin: 2em; padding-left: 3em; padding-right: 3em;">
                    <div class="text-primary d-flex justify-content-between h4">
                        <span class="mb-4">Select Photo for
                            <b>
                                “ {{ @$_GET['mainpart'] }} ”
                            </b>
                        </span>
                        <span>Total Selected : <span id="photo_select_count">0</span> </span>
                    </div>
                    <div class="img-box">
                        @php $i = 0; @endphp
                        @foreach ($photoall as $photo)
                            <div class="img-container" photoname="{{ $photo['na'] }}">
                                <span class="img-number">{{ ++$i }}</span>
                                <input type="checkbox" class="img-checkbox" id="checkbox-{{ $i }}"
                                    style="display: none;" value="{{ $photo['na'] }}" name="photo[]">
                                <img class="sel-img"
                                    src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                    alt="">
                            </div>
                        @endforeach
                        <input type="hidden" name="photonameall" id="photonameall">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

    <script>
        $('.img-container').on('click', function() {
            let photoname = $(this).attr('photoname');
            var checkbox = $(this).find('.img-checkbox');
            let html = $("#photoall").html();
            let position = html.search(photoname);
            if (position > 0) {
                let result = html.replace(photoname, "");
                $("#photoall").html(result);
            } else {
                $("#photoall").append(photoname);
            }
            checkbox.prop('checked', !checkbox.prop('checked'));
            $(this).toggleClass('selected', checkbox.prop('checked'));
            $("#photonameall").val($("#photoall").html());
        });







    </script>



<script>
          var i = 0;
        $('.img-checkbox').on('change', function() {

            if ($(this).prop('checked')) {
                i++;
                console.log(i);
            } else {
            i--;
            }
            $('.photo_select_count').text(i);
        });

</script>
@endsection
