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
                    <div class="row cn">
                        <div class="col-12 mb-3">
                            <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบ {{ $id }}</h2>
                        </div>
                        @include('EndoCAPTURE.superadmin.component.menutopbar')

                        @php
                            $swicth = 'EndoCAPTURE.superadmin.component.switch';
                            $textbox = 'EndoCAPTURE.superadmin.component.textbox';
                        @endphp


                        @component($textbox, ['type' => 'emr', 'name' => 'Path', 'id' => 'path1'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($textbox, ['type' => 'emr', 'name' => 'Label', 'id' => 'label1'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'Checked', 'id' => 'checked1'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'PDF', 'id' => 'pdf1'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'JPG', 'id' => 'img1'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'VDO', 'id' => 'vdo1'])
                        @endcomponent


                        <div class="border-bottom m-4"></div>
                        @component($textbox, ['type' => 'emr', 'name' => 'Path', 'id' => 'path2'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($textbox, ['type' => 'emr', 'name' => 'Label', 'id' => 'label2'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'Checked', 'id' => 'checked2'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'PDF', 'id' => 'pdf2'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'JPG', 'id' => 'img2'])
                        @endcomponent
                        <div class="col-12 mt-2"></div>
                        @component($swicth, ['type' => 'emr', 'name' => 'VDO', 'id' => 'vdo2'])
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
                    event: "configpacs",
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
