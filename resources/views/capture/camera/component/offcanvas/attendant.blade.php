<style>
   #attendant_offcanvas .select2-container--default .select2-selection--single .select2-selection__rendered {
    background: transparent !important;
   }
   #attendant_offcanvas .select2-container .select2-selection--single {
    height: 38px;
   }
</style>

<div class="offcanvas offcanvas-start" tabindex="-1" id="attendant_offcanvas" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Operation Detail</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body py-1">
        <div class="row ">
            <h6>Endoscopist</h6>
            <div class="col-12">
                <select id="doctorname" class="form-select  physician-select  savejson " onchange="change_doctor(this.value)">
                    @foreach ($doctor??[] as $d)
                        @php
                            $d = (object) $d;
                            $fullname = fullname($d);
                        @endphp
                        <option value="{{@$d->uid}}"  @if (@$case->doctorname == @$fullname) selected @endif >{{@$fullname }} {{@$d->user_code}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <h6>Room : </h6>
            <div class="col-12">
                <select name="room" id="room_name" class=" form-select savejson editroom">
                    <option value=""></option>
                    @isset($room)
                        @foreach ($room as $r)
                            @php
                                $r = (object) $r;
                            @endphp
                            <option value="{{ $r->room_id }}"
                                @if ($r->room_name == @$this_room) selected @endif>{{ $r->room_name }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2"></div>
            <div class="col-8">
                <hr>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="col-12 mb-3">
            <h5>Select Attendant </h5>
        </div>

        <div class="row mt-2">
            <h6>Physician attend :</h6>
            <div class="col-12">
                <select name="" id="select_camera_doctor" data-type="physician" class="form-select change-user "
                     placeholder="Doctor">
                     <option value="none" selected>Doctor</option>

                    @foreach ($doctor as $data)

                        <option value="{{ $data->uid }}">{{ @$data->user_prefix }} {{ @$data->user_firstname }}
                            {{ @$data->user_lastname }} {{ @$data->user_code }}</option>
                    @endforeach
                </select>

            </div>

        </div>
        <div class="row mt-3">
            <h6>Nurse attend :</h6>
            <div class="col-12">
                <select name=""  data-type="nurse" class="form-select  change-user select_camera_nurse" data-choices
                     placeholder="Nurse">
                     <option value="none" selected>Nurse</option>

                    @foreach ($nurse as $data)
                        <option value="{{ $data->uid }}">{{ @$data->user_prefix }} {{ @$data->user_firstname }}
                            {{ @$data->user_lastname }} {{ @$data->user_code }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row mt-3">
            <h6>Nurse assistant attend :</h6>
            <div class="col-12">
                <select name="" id="select_nurseassistant" data-type="nurse_assistant" class="form-select  change-user select_camera_nurse" >
                    <option value="none" selected>Nurse Assistant</option>
                    @foreach ($assistant as $data)
                        <option value="{{ @$data->uid }}">{{ @$data->user_prefix }} {{ @$data->user_firstname }}
                            {{ @$data->user_lastname }} {{ @$data->user_code }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2"></div>
            <div class="col-8">
                <hr>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row select_physician" id="select_physician">
            @if (isset($doctor_select))
                @foreach ($doctor_select as $data)
                    @php
                        $class = 'user_assistant_' . $data->uid;
                        $uid = isset($data->uid) ? $data->uid : '';
                    @endphp
                    <div class="row {{$class}}" data-id="{{@$data->uid}}">
                        <div class="col-9">
                            {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                        </div>
                        {{-- <div class="col-2">
                            Physician
                        </div> --}}
                        <div class="col-3 text-end">
                            <i onclick='del_selectuser(".{{ $class }}","physician", "{{ $uid }}")'
                                class="ri-close-fill text-danger"></i>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="row select_nurse" id="select_nurse">
            @if (isset($nurse_select))
                @foreach ($nurse_select as $data)
                    @php

                        $class = 'user_assistant_' . $data->id;
                        $uid = isset($data->id) ? $data->id : '';
                    @endphp
                    <div class="row {{ $class }}" data-id="{{ @$data->id }}">
                        <div class="col-9">
                            {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                        </div>
                        {{-- <div class="col-2">
                            Nurse
                        </div> --}}
                        <div class="col-3 text-end">
                            <i onclick='del_selectuser(".{{ $class }}","nurse", "{{ $uid }}")'
                                class="ri-close-fill text-danger"></i>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>


        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                <button class="btn w-75" id="btnconfirm_attendant" data-bs-toggle="offcanvas" data-bs-target="#attendant_offcanvas" style="background-color: #245788; color: white;">Save and Close</button>
            </div>
        </div>

    </div>
</div>
