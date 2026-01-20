@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
@endsection
@section('modal')
@endsection
@section('content')
    <div class="row" style="margin: 0;margin-top:-0.5em;margin-bottom: 5em;">
        <div class="col-lg-12">
            <div class="w-100" style="width: 100%;">
                <div class="w-100 bg-white pb-2 pt-1" style="padding: 0;">
                    <div class="row" style="display: flex; justify-content: flex-end">
                        <div class="col-2">

                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4" style="margin-left: auto; margin-right: 0;"></div>
                                <div class="col-6">
                                    <input type="text" name="user_code" id="user_code" class="form-control" placeholder="User code">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-primary form-control" id="check_user">ค้นหา</button>
                                </div>
                            </div>

        <form method="POST" action="{{url("api/ramaconnect")}}">
            @csrf
            <input type="hidden" name="event" value="user_add_formcode">

            <div class="row">
                <div class="col-2" style="margin-left: auto; margin-right: 0;">User Code</div>
                <div class="col-10"><input type="text" name="usercode" id="usercode" class="form-control" placeholder="User Code" readonly></div>
                <div class="col-2" style="margin-left: auto; margin-right: 0;">ชื่อ</div>
                <div class="col-10"><input type="text" name="firstname" id="firstname" class="form-control" placeholder="ชื่อ"></div>
                <div class="col-2" style="margin-left: auto; margin-right: 0;">นามสกุล</div>
                <div class="col-10"><input type="text" name="lastname" id="lastname" class="form-control" placeholder="นามสกุล"></div>
                <div class="col-2" style="margin-left: auto; margin-right: 0;">ตำแหน่ง</div>
                <div class="col-10"><input type="text" name="position" id="position" class="form-control" placeholder="ตำแหน่งงาน"></div>
                <div class="col-2" style="margin-left: auto; margin-right: 0;"></div>
                <div class="col-10">
                    <button type="submit" class="btn btn-primary form-control" id="btn_user_add" style="display: none">เพิ่ม user</button>
                </div>
            </div>
        </form>






                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{url('public/sample/assets/js/scripts.bundle.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $('#check_user').click(function () {
            var user_code = $('#user_code').val();
            $("#user_code").val("");
            $("#firstname").val("");
            $("#lastname").val("");
            $("#position").val("");
            $("#usercode").val("");


            $.post("{{url('api/ramaconnect')}}", {
                'event'     : 'check_user_formcode',
                'user_code' : user_code
            }, function (res) {
                var obj     = JSON.parse(res);
                var data    = obj.data;
                if(obj.success){
                    $('#firstname').val(data.firstName);
                    $('#lastname').val(data.lastName);
                    $('#position').val(data.positionName);
                    $('#usercode').val(data.staffId);
                    $('#btn_user_add').show();
                }
            });
        });

    </script>






@endsection
