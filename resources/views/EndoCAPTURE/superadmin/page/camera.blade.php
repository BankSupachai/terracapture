@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/superadmin/index.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row m-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบ {{ $id }}</h2>
                        </div>
                        @include('EndoCAPTURE.superadmin.component.menutopbar')

                        @php
                            $swicth = 'EndoCAPTURE.superadmin.component.switch';
                            $textbox = 'EndoCAPTURE.superadmin.component.textbox';
                            $select = 'EndoCAPTURE.superadmin.component.select';

                            // Read sound files from directory
                            $sound_dir = "D:/laragon/htdocs/config/sound/capture";
                            $sound_files = [];
                            if (is_dir($sound_dir)) {
                                $files = scandir($sound_dir);
                                foreach ($files as $file) {
                                    if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) == "mp3") {
                                        $name = pathinfo($file, PATHINFO_FILENAME);
                                        $sound_files[$file] = ucfirst($name);
                                    }
                                }
                            }
                        @endphp

                        @component($textbox,    ['type'=>'camera','name'=>'จำนวนกล้อง','id'=>'camera_num'])
                        @endcomponent
                        @component($textbox,    ['type'=>'camera','name'=>'เสียงภาษา','id'=>'sound_lang'])
                        @endcomponent
                        @component($textbox,    ['type'=>'camera','name'=>'Marker Height','id'=>'marker_height', 'placeholder'=>'ใส่แค่ตัวเลข']) @endcomponent
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-8 text-center"><span>Min: 60.1693</span></div>
                        </div>
                        @component($select,    ['type'=>'camera','name'=>'Times','id'=>'seconds', 'options'=>[
                            '10' => '10',
                            '15' => '15',
                            '20' => '20',
                            '25' => '25',
                            '30' => '30'
                        ]])
                        @endcomponent
                        @component($select,    ['type'=>'camera','name'=>'Sounds','id'=>'sound', 'options'=>$sound_files])
                        @endcomponent
                        @component($select,    ['type'=>'camera','name'=>'Start video Sound','id'=>'start_video_sound', 'options'=>$sound_files])
                        @endcomponent
                        @component($select,    ['type'=>'camera','name'=>'Stop Video Sound','id'=>'stop_video_sound', 'options'=>$sound_files])
                        @endcomponent
                        @component($select,    ['type'=>'camera','name'=>'Capture Sound','id'=>'capture_sound', 'options'=>$sound_files])
                        @endcomponent
                        @component($swicth,     ["type"=>"camera","name"=>"OBS source","id"=>"obs_source"])
                        @endcomponent
                        @component($textbox,    ['type'=>'camera','name'=>'OBS Password','id'=>'obs_password'])
                        @endcomponent

                        @component($swicth,     ["type"=>"camera","name"=>"แจ้งเตือนสัญญาณภาพมีปัญหา","id"=>"alert_signallost"])
                        @endcomponent

                        @component($swicth,     ["type"=>"camera","name"=>"บังคับเลือกกล้อง","id"=>"force_select"])
                        @endcomponent
                        @component($swicth,     ["type"=>"camera","name"=>"ถ่ายรูปแรกแล้วนับเวลา StartTime","id"=>"firstimg_starttime"])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".config_type").focusout(function() {
                var value = $(this).val();
                var id = $(this).attr('id');
                var config_type = $(this).attr('config_type');
                $.post("{{ url('superadmin') }}", {
                    event: "config_type",
                    config_type: config_type,
                    id: id,
                    value: value,
                }, function(data, status) {});
            });

            $(".configtext").focusout(function() {
                var value = $(this).val();
                var id = $(this).attr('id');
                $.post("{{ url('jquery') }}", {
                    event: "configtext",
                    id: id,
                    value: value,
                }, function(data, status) {});
            });

            $('.config_option').click(function() {
                var id = $(this).attr('id');
                var config_type = $(this).attr('config_type');
                var value = true;
                if ($(this).prop("checked") == false) {
                    value = 'false';
                }
                $.post("{{ url('jquery') }}", {
                    event: "configcheck",
                    id: id,
                    config_type: config_type,
                    value: value,
                }, function(data, status) {
                    console.log(data);
                });
            });
        </script>
    @endsection
