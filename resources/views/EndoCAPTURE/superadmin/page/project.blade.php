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
                        @endphp


                        @component($textbox, ['type' => 'admin', 'name' => 'project', 'id' => 'project'])
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
