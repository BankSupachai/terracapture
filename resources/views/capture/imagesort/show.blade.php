{{-- @extends('layouts.app') --}}
@extends('layouts.layouts_index.main')
@section('style')
    <style>

    </style>
    {{-- <link href="{{url('public/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('public/css/imagesort/index.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

        <div class="cardcode col-12" style="padding: 0;display:none">
            <div class="card-box">
               <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
                <div class="row">
                  <div class="col-12">
                    Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=ImageSortController">ImageSortController</a>
                  </div>
                  <div class="col-12">
                    View : <a href="autoit?run=visualcode_open\\endo.exe&path=imagesort">imagesort</a>
                  </div>
               </div>
            </div>
        </div>
        @php
            $i=1;
        @endphp
        <div class="row m-0">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <button class="btn-lg btn-warning" onclick="goBack()" ><i class="fas fa-angle-double-left text-dark"></i>&nbsp; ย้อนกลับ</button>
                    </div>
                    <div class="card-body pb-0 pt-0">
                        <div class="row  m-0 draggable-zone">
                            @foreach($photo_select as $photo)
                                <div class="col-lg-2 card card-custom gutter-b draggable p-2" style="">
                                    <img class="draggable-handle" photo="{{$photo['na']}}" id="mmm{{$i}}" style="width:100%;box-shadow: 1px 1px 5px skyblue" src="{{mePHOTO($case->case_hn,$photo['na'],$folderdate)}}?a={{RandomString()}}">
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-right pt-0 border-0">
                        <button id="btn_sort" class="btn-lg btn-success w-100"><i class="far fa-save text-light"></i>&nbsp; Save</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{url('public/js/jquery.min.js')}}"></script>
    <script src="{{url('public/js/jquery.imgcheckbox.js')}}"></script>
    <script src="{{url('public/sample/assets/plugins/custom/draggable/draggable.bundle.js')}}" type="text/javascript"></script>
    <script src="{{url('public/js/imagesort/index.js')}}"></script>
    <script>
        $('#btn_sort').click(function(){
            var allVals = [];
            $('[class=draggable-handle]').each(function() {
                allVals.push($(this).attr('photo'));
            });
            console.log(allVals);
            $.post('{{ url('imagesort') }}', {
                event       : 'imagesort',
                cid         : '{{ @$cid }}',
                imgsort     : allVals,
            }, function(data, status) {
                console.log(data);
                window.location='{{url("loadpic/$cid")}}';
            });
        });
    </script>


@endsection
