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

                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn_checkfolder" >Check</button>
                        </div>
                        <div class="row">

                            <div class=" col-2"> </div>
                            <div class="col-2">
                                <h2>dicom</h2>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control check_folder " value="dicom"  placeholder="D:" readonly>
                            </div>

                            <div class="col-2">
                                <span id="message1" style="display: none; color:#38b634;">มีแล้ว</span>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class=" col-2"> </div>
                            <div class="col-2">
                                <h2>ScreenRecord</h2>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control  check_folder" value="screenrecord" name="create_ScreenRecord" placeholder="D:\laragon\htdocs">
                            </div>

                            <div class="col-2">
                                <span id="message1" style="display: none; color:#ff0000;">ไม่มีและกำลังสร้าง</span>
                                <span id="message2" style="display: none; color:#38b634;">มีแล้ว</span>

                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class=" col-2"> </div>
                            <div class="col-2">
                                <h2>store</h2>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control check_folder" value="store" placeholder="D:\laragon\htdocs">
                            </div>

                            <div class="col-2">
                                <span id="message3" style="display: none; color:#38b634;">มีแล้ว</span>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class=" col-2"> </div>
                            <div class="col-2">
                                <h2>Capture</h2>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control check_folder" value="capture" name="create_recorder" placeholder="D:">
                            </div>

                            <div class="col-2">
                                <span id="message4" style="display: none; color:#38b634;">มีแล้ว</span>
                            </div>
                        </div>





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


<script>
   $(".btn_checkfolder").click(function(){
    $(".check_folder").each(function(index, element){

        var value = $(element).val();
    });
    var dicom = $(".check_folder").eq(0).val();
    var screenrecord = $(".check_folder").eq(1).val();
    var store = $(".check_folder").eq(2).val();
    var capture = $(".check_folder").eq(3).val();

           $.post("{{url("admin/createfolder")}}",{
               event: "checkfolder",
               dicom : dicom,
               screenrecord : screenrecord,
               store : store,
               capture, capture,
           }, function(data , status){
               console.log(data == 2);
               $("#message2").show();

           })
   })

</script>

    @endsection
