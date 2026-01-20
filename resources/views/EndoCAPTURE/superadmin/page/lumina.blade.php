@extends('capture.layoutv6')
@php
    // $lumina = getconfig('lumina');
    use App\Models\Mongo;
    $lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
    if(isset($lumina->picrow)) {
       $picrow = $lumina->picrow;
    }else{
        $picrow = '';
    }
@endphp
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

                        @component($swicth,  ["type"=>"lumina" ,"name"=>"Lumina Python" ,"id"=>"python" , 'otherclass' => 'tb_lumina switch'])              @endcomponent
                        @component($swicth,  ["type"=>"lumina" ,"name"=>"Lumina PACs" ,"id"=>"pacs", 'otherclass' => 'tb_lumina switch'])@endcomponent
                        @component($swicth,  ["type"=>"lumina" ,"name"=>"Room Name in Uploaded Path" ,"id"=>"room_in_uploadedpath" , 'otherclass' => 'tb_lumina switch'])              @endcomponent


                        <div class="row">
                            <div class="col-4 mt-1">
                                <h3>Page Orientation</h3>
                            </div>
                            <div class="col-8">
                                <select  class = "form-select  text-center config_type  mt-2 tb_lumina" config_type="lumina" name="" id="picrow">
                                    <option value="">กรุณาเลือก</option>
                                    <option @selected($picrow=="1x2|Portrait") value="1x2|Portrait">1x2 (Portrait)</option>
                                    <option @selected($picrow=="2x2|Portrait") value="2x2|Portrait">2x2 (Portrait)</option>
                                    <option @selected($picrow=="2x3|Portrait") value="2x3|Portrait">2x3 (Portrait)</option>
                                    <option @selected($picrow=="3x3|Portrait") value="3x3|Portrait">3x3 (Portrait)</option>
                                    <option @selected($picrow=="1x1|Landscape") value="1x1|Landscape">1x1 (Landscape)</option>
                                    <option @selected($picrow=="1x2|Landscape") value="1x2|Landscape">1x2 (Landscape)</option>
                                    <option @selected($picrow=="2x2|Landscape") value="2x2|Landscape">2x2 (Landscape)</option>
                                    <option @selected($picrow=="2x3|Landscape") value="2x3|Landscape">2x3 (Landscape)</option>
                                </select>
                            </div>
                        </div>

                        @component($textbox, ['type' => 'lumina', 'name' => 'Server Path (PDF Only)', 'id' => 'pdf_path', 'placeholder' => 'เช่น X:\\some\path', 'otherclass' => 'tb_lumina']) @endcomponent
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-6 text-center" style="color: red;">ห้ามใส่ / หรือ \ หลัง path</div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Server Drive', 'id' => 'pdf_pathname', 'placeholder' => 'SAP', 'otherclass' => 'tb_lumina']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Hospital Path (PDF and Video)', 'id' => 'pdf_video_path', 'placeholder' => 'เช่น N:\\some\path' , 'otherclass' => 'tb_lumina']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Hospital Drive', 'id' => 'pdf_video_pathname', 'placeholder' => 'Drive', 'otherclass' => 'tb_lumina']) @endcomponent
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-6 text-center" style="color: red;">ห้ามใส่ / หรือ \ หลัง path</div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Other Path (All Types)', 'id' => 'other_path', 'placeholder' => 'เช่น some\path', 'otherclass' => 'tb_lumina']) @endcomponent
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-6 text-center" style="color: red;">ห้ามใส่ / หรือ \ หลัง path</div>
                            <div class="col-auto"></div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-10 text-center" style="color: red;">Drive ที่ไม่ได้กำหนดใน Server Path และ Hospital Path จะมีการอัปโหลดไฟล์ทั้งหมด pdf, video และ image</div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Username', 'id' => 'username', 'otherclass' => 'tb_lumina']) @endcomponent
                        <div class="row username-required" style="visibility: hidden" >
                            <div class="col-6"></div>
                            <div class="col-4 text-center" style="color: red;">Required!</div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Password', 'id' => 'password', 'otherclass' => 'tb_lumina']) @endcomponent
                        <div class="row password-required" style="visibility: hidden"  >
                            <div class="col-6"></div>
                            <div class="col-4 text-center" style="color: red;">Required!</div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Department', 'id' => 'department' , 'placeholder' => 'เช่น OR', 'otherclass' => 'tb_lumina default']) @endcomponent
                        <div class="row department-required" style="visibility: hidden" >
                            <div class="col-6"></div>
                            <div class="col-4 text-center" style="color: red;">Required!</div>
                            <div class="col-auto"></div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-4 text-center" >
                                <button class="btn btn-success mt-2 action-user" type="button" data-action="create">Create User</button>
                                <button class="btn btn-warning mt-2 action-user" type="button" data-action="update" hidden>Update User</button>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Modality', 'id' => 'modality', 'otherclass' => 'tb_lumina default']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Room Name', 'id' => 'room', 'placeholder' => 'เช่น Room 1', 'otherclass' => 'tb_lumina default']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Procedure Name', 'id' => 'procedure', 'placeholder' => 'เช่น EGD', 'otherclass' => 'tb_lumina default']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Procedure Code', 'id' => 'procedure_code', 'placeholder' => 'เช่น gi001', 'otherclass' => 'tb_lumina default']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Default Signal Delay', 'id' => 'time_delay', 'placeholder' => 'ระยะเวลาดีเลย์ตัดสัญญาณ (วินาที) (มีผลตอนการเปลี่ยนสัญญาณกล้อง)', 'otherclass' => 'tb_lumina']) @endcomponent
                        @component($textbox, ['type' => 'lumina', 'name' => 'Auto Record', 'id' => 'auto_record', 'placeholder' => 'กรณีสัญญาณกลับมาหลังจากเปลี่ยนหรือถอดสาย ให้ทำการอัดวิดีโอต่อหรือไม่ (true หรือ false, default คือ true)', 'otherclass' => 'tb_lumina']) @endcomponent
                        {{-- @component($textbox, ['type' => 'lumina', 'name' => 'Room Name in Uploaded Path', 'id' => 'room_in_uploadedpath', 'placeholder' => 'false ถ้าไม่ต้องการเอา room name ใน uploaded path (true หรือ false, default คือ true)', 'otherclass' => 'tb_lumina']) @endcomponent --}}


            {{-- {{select_users($room,$connection->station_room,'room_id',['room_name'],'station_room','เลือกห้อง','form-control form-control-lg configtext')}} --}}






                        <div class="col-12 mt-2"></div>
                        {{-- @component($textbox, ['type' => 'recorder', 'name' => 'Picture Row', 'id' => 'picrow']) @endcomponent
                        <div class="col-12 mt-2"></div> --}}
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

            $('.tb_lumina').focusout(function () {
                let value = $(this).val();
                let id = $(this).attr('id');
                let is_default = $(this).hasClass('default')
                if($(this).hasClass('switch')){
                    value = $(this).is(':checked')
                }
                console.log(value, id, is_default);
                $.post("{{url('superadmin')}}", {
                    event: "update_lumina",
                    id: id,
                    value:value,
                    is_default: is_default
                }, function (data, status) {})
            })

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

            $('.config_option').click(function(){
                var id              = $(this).attr('id');
                console.log('c');

                var config_type     = $(this).attr('config_type');
                var value           = true;
                if($(this).prop("checked")==false){value='false';}
                $.post("{{url('jquery')}}",{
                    event           : "configcheck",
                    id              : id,
                    config_type     : config_type,
                    value           : value,
                },function(data, status){console.log(data);});
            });

            $('.action-user').on('click', function () {
                let username = $('#username').val()
                let password = $('#password').val()
                let department = $('#department').val()
                let action = $(this).data('action')
                // console.log(username , password ,department , action);
                if(username && password && department && action){
                    $.post("{{ url('api/recorder') }}", {
                        event: `${action}_user`,
                        username: username,
                        password: password,
                        department: department
                    }, function(data, status) {
                        location.reload()
                    })
                } else {
                    if(!username){$('.username-required').css('visibility', 'visible')}
                    if(!password){$('.password-required').css('visibility', 'visible')}
                    if(!department){$('.department-required').css('visibility', 'visible')}
                }
            })

        </script>




    @endsection
