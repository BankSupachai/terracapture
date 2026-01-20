@extends('layouts.layoutsManagePhoto')
@section('Title')
Sort Photo
@endsection
@section('style')
<style>


    .text-sort-blue {
        color: #325684;
    }

    .bg-sortphoto {
        background: #ffffffa6;
    }
</style>
@endsection
@section('content')

<div class="row m-0 p-3">
    <div class="bg-sortphoto mb-3">
        <div class="col-12 d-flex justify-content-between py-3">
            <div>
                <span class="text-sort-blue h3">Sort Photo </span>
                <p class="text-sort-blue">Drag and Drop photo to right position and then click “Confirm”</p>
            </div>
            <div>
                <a type="button" class="btn btn-danger btn-label waves-effect right w-lg waves-light"
                    href="{{ url()->previous() }}">
                    <i class=" ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Cancel</a>
                <button id="btn_sort" type="button" class="btn btn-primary btn-label waves-effect right w-lg waves-light"><i
                        class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
            </div>
        </div>
        @php
            $i = 1;
        @endphp
        <div class="row m-0 mb-3">
            <div class="col-12">
                <div class="row text-center draggable-zone">
                        @foreach ($photo_select as $photo)
                        <div class="col-xl-2 draggable">
                            <span class="text-sort-blue  h3">{{$i}}</span> <br>
                            <img class="draggable-handle" id="mmm{{ $i }}" photo="{{ $photo['na'] }}"
                                src="{{ mePHOTO($case->case_hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                width="100%">
                            @php
                                $i++;
                            @endphp

                        </div>
                        @endforeach
                </div>
        </div>
    </div>
</div>


<footer  style="position: sticky; bottom: 0; text-align: center;  color: #ffffff80;">
    © 2024 EndoCAPTURE by Medica Healthcare Co.,Ltd.
</footer>
@endsection


@section('script')
    <script src="{{ url('public/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/js/jquery.imgcheckbox.js') }}"></script>
    <script src="{{ url('public/sample/assets/plugins/custom/draggable/draggable.bundle.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('public/js/imagesort/index.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $('#btn_sort').click(function() {

            var allVals = [];
            $('[class=draggable-handle]').each(function() {
                allVals.push($(this).attr('photo'));
            });
            console.log(allVals);
            $.post('{{ url('imagesort') }}', {
                event: 'imagesort',
                cid: '{{ @$cid }}',
                imgsort: allVals,
            }, function(data, status) {
                console.log(data);
                window.location = '{{ url("loadpic/$cid") }}';
            });
        });
    </script>
@endsection
