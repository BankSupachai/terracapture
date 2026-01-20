
<style>
    .modal .choices__list--dropdown {
            height: 20em;
        }
</style>


<div class="modal fade" id="modal_attendant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attendant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-4">
                            <select name="" id="select_camera_doctor" class="form-control form-control-sm change-user " data-choices  data-type="physician" placeholder="Doctor">
                                <option value="none">Doctor</option>
                                @foreach ($doctor as $data)
                                    <option value="{{$data['id']}}">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="select_camera_nurse" class="form-control form-control-sm change-user " data-choices  data-type="nurse" placeholder="Nurse">
                                <option value="none">Nurse</option>
                                @foreach ($nurse as $data)
                                <option value="{{$data['id']}}">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="select_camera_nurseassistant" class="form-control form-control-sm change-user " data-choices  data-type='assistant' placeholder="Nurse Assistant">
                                <option value="none">Nurse Assistant</option>
                                @foreach ($register as $data)
                                <option value="{{$data['id']}}">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-0 mt-3">
                        <div class="col-4" id="select_physician">
                            @if(isset($doctor_select))
                                @foreach ($doctor_select as $data)
                                @php
                                    $class = "user_assistant_".$data['id'];
                                    $uid   = isset($data['id']) ? $data['id'] : '';
                                @endphp
                                <div class="row mt-1 {{$class}}" data-id="{{@$data['id']}}">
                                    <div class="col">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</div>
                                    
                                    <div class="col-auto">
                                        <i onclick='del_selectuser(".{{$class}}","physician", "{{$uid}}")' class="ri-close-fill text-danger"></i>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-4" id="select_nurse">
                            @if(isset($nurse_select))
                                @foreach ($nurse_select as $data)
                                @php
                                    $class = "user_assistant_".$data['id'];
                                    $uid   = isset($data['id']) ? $data['id'] : '';
                                @endphp
                                <div class="row mt-1 {{$class}}" data-id="{{@$data['id']}}">
                                    <div class="col">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</div>
                                    <div class="col-auto">
                                        <i onclick='del_selectuser(".{{$class}}","nurse", "{{$uid}}")' class="ri-close-fill text-danger"></i>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-4" id="select_assistant">
                            @if(isset($assistant_select))
                                @foreach ($assistant_select as $data)
                                @php
                                    $class = "user_assistant_".$data['id'];
                                    $uid   = isset($data['id']) ? $data['id'] : '';
                                @endphp
                                <div class="row mt-1 {{$class}}" data-id="{{@$data['id']}}">
                                    <div class="col">{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</div>
                                    <div class="col-auto">
                                        <i onclick='del_selectuser(".{{$class}}","assistant", "{{$uid}}")' class="ri-close-fill text-danger"></i>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row m-0 w-100">
                        <div class="col"></div>
                        <div class="col-8">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
        </div>
    </div>
</div>
