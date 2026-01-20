<?php
use App\Models\Mongo;
?>

<style>
    .accordion {
        --vz-accordion-btn-bg: #4051890D;
    }
</style>


<div class="live-preview">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <b style="font-size: 16px; color:#245788;">Officer</b>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" ari -labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="row m-0">
                        <div class="col-lg-12">
                            <div class="row m-0">
                                <div class="col-lg-8 pl-3">
                                    <div class="h5 fw-bold">Location User Setting</div>
                                </div>
                                <div class="col-lg-4 pl-3 mb-2">
                                    <div class="h5 ">Noted</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            {{-- @dd($room_location) --}}
                            @foreach ($room_location ?? [] as $room)
                                {{-- @dd($room) --}}
                                @php
                                    $room = (object) $room;
                                    $users = [];
                                    try {
                                        // $doctor = isset($room->room_doctor) ? $room->room_doctor : [];
                                        // $nurse = isset($room->room_nurse) ? $room->room_nurse : [];
                                        // $nurse_assist = isset($room->room_nurse_assist) ? $room->room_nurse_assist : [];
                                        $temp = $room->room_user;
                                        foreach ($temp as $data) {
                                            $uid = (int) $data;
                                            $tb_user = Mongo::table('users')->where('uid', $uid)->first();
                                            if (isset($tb_user['id'])) {
                                                $fullname =
                                                    $tb_user['user_prefix'] .
                                                    $tb_user['user_firstname'] .
                                                    ' ' .
                                                    $tb_user['user_lastname'];
                                                array_push($users, $fullname);
                                            }
                                        }
                                    } catch (\Throwable $th) {
                                    }

                                @endphp
                                <div class="row m-0 p-2 cn">
                                    <div class="col-lg-2">
                                        {{-- <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox"
                                            id="ck_reprocess"
                                            onclick="change_room_ready('reprocess')"
                                            @if (@$room->room_ready . '' == 1) checked @endif />
                                        <span></span>
                                      {{ @$room->room_name }}
                                    </label> --}}
                                        {{ @$room->room_name }}

                                        {{-- <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox"
                                            id="ck_{{ @$room->_id }}"
                                            onclick="change_room_ready('{{ @$room->_id }}')"
                                            @if (@$room->room_ready . '' == 1) checked @endif />
                                        <span></span>
                                        &ensp; &ensp;
                                        @if (@$room->status == 'reprocess')
                                            Reprocess
                                        @elseif (@$room->status == 'leave')
                                            Leave
                                        @elseif (@$room->status == 'recovery')
                                            Recovery
                                        @elseif (@$room->status == 'incharge')
                                            Incharge
                                        @endif
                                    </label> --}}
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <button class="btn btn-primary btn-icon" type="button"
                                                        id="room_btn{{ @$room->room_id }}"
                                                        data-room-id="{{ @$room->_id }}"
                                                        room-name="{{ @$room->room_name }}"
                                                        onclick="open_room_setting('{{ $room->id }}')"
                                                        data-bs-toggle="modal" data-bs-target="#roomModal">
                                                        <i class="ri-settings-5-fill ri-lg"></i>
                                                    </button>
                                                    <input id="{{ @$room->_id }}_input" type="text"
                                                        class="form-control bg-gray-input" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1"
                                                        value="{{ implode(' | ', $users) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-4">
                            <div class="col-12">
                                {{-- <textarea name="" class="form-control" placeholder="Freetext" id="nurse_monitor_freetext" rows="10">{{ $writeboard }}</textarea> --}}
                                <textarea name="" class="form-control " placeholder="Freetext" id="nurse_monitor_freetext" rows="10">{{ $writeboard }}</textarea>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button id="monitor_update" class="btn btn-primary  monitor_update w-50"><i
                                        class="ri-refresh-line"></i>
                                    Update to Monitor</button>
                                {{-- <button class="btn btn-success  " data-bs-toggle="modal" data-bs-target="#changely_TV">Custom Layout &ensp;<i class="ri-settings-5-line"></i> </button> --}}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row m-0">
                                <div class="col-lg-8 pl-3">
                                    <div class="h5 fw-bold">Operation User Setting</div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-8">

                            @foreach ($room_captures as $room)
                                @php
                                    $room = (object) $room;
                                    $users = [];
                                    try {
                                        // $doctor = isset($room->room_doctor) ? $room->room_doctor : [];
                                        // $nurse = isset($room->room_nurse) ? $room->room_nurse : [];
                                        // $nurse_assist = isset($room->room_nurse_assist) ? $room->room_nurse_assist : [];
                                        // $room_user = $room->room_user;
                                        // $temp = array_merge($doctor, $nurse, $nurse_assist, $room_user);
                                        $temp = $room->room_user;
                                        foreach ($temp as $data) {
                                            $uid = (int) $data;
                                            $tb_user = Mongo::table('users')->where('uid', $uid)->first();
                                            if (isset($tb_user['id'])) {
                                                $fullname =
                                                    $tb_user['user_prefix'] .
                                                    $tb_user['user_firstname'] .
                                                    ' ' .
                                                    $tb_user['user_lastname'];
                                                array_push($users, $fullname);
                                            }
                                        }
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                    }

                                @endphp
                                <div class="row m-0 p-2 cn">
                                    <div class="col-lg-2">
                                        <label class="checkbox">
                                            <input class="form-check-input room_ready" type="checkbox"
                                                id="ck_{{ @$room->_id }}"
                                                onclick="change_room_ready('{{ @$room->id }}')"
                                                @if (@$room->room_ready . '' == 1) checked @endif />
                                            <span></span>
                                            &ensp; &ensp; {{ @$room->room_name }}
                                        </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <button class="btn btn-primary btn-icon" type="button"
                                                        id="room_btn{{ @$room->room_id }}"
                                                        data-room-id="{{ @$room->_id }}"
                                                        onclick="open_room_setting('{{ $room->id }}'  )"
                                                        data-bs-toggle="modal" data-bs-target="#roomModal">
                                                        <i class="ri-settings-5-fill ri-lg"></i>

                                                    </button>


                                                    <input id="{{ @$room->_id }}_input" type="text"
                                                        class="form-control bg-gray-input" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1"
                                                        value="{{ implode(' | ', $users) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    ClassicEditor
        .create( document.querySelector( '#nurse_monitor_freetext1' ) )
        .catch( error => {
            console.error( error );
        } );
</script> --}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(".select_user").change(function() {
    //     user_id = $(this).val();
    //     user_type = $(this).attr('user_type');
    //     room_id = $("#room_id").val();
    //     console.log(room_id);

    //     $.post('{{ url('api') }}/jquery', {
    //         event: 'action_user_room',
    //         room_id: room_id,
    //         user_id: user_id,
    //         type: user_type,
    //         action: 'add'
    //     }, function(data, status) {
    //         console.log(data);
    //     });


    // });

    function open_room_setting(room_id ) {


        $.post('{{ url('api') }}/jquery', {
            event: 'get_user_room',
            room_id: room_id,
        }, function(data, status) {
            // console.log(data);
            $(".selected_doctor").val(data.doctor).change()
            $(".selected_nurse").val(data.nurse).change()
            $(".selected_nurse_assist").val(data.nurse_assist).change()
            $(`#room_id`).val(room_id)
            $(`#current_room`).val(data.room_name)
        });
    }





    $('#roomModal').on('shown.bs.modal', function(e) {
        console.log($(this));
    })

    $("#monitor_update").click(function() {
        socket.emit('chat message', 'casemonitor');
        window.location.reload();
    });





    $("#roomModal").on("hidden.bs.modal", function() {
        var room_id = $('#room_id').val()
    });








    function change_room_ready(room_id) {
        var is_checked = $(`#ck_${room_id}`).is(':checked')
        var to_update = is_checked == true ? 1 : 0
        console.log(is_checked, to_update);
        $.post('{{ url('api') }}/jquery', {
            event: 'change_room_ready',
            room_id: room_id,
            status: to_update
        }, function(data, status) {});
    }
</script>





<script>

</script>
