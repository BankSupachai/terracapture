<!-- Default Modals -->
<style>
    .select2.select2-container {
        display: none;
    }
</style>
<div id="attendant_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header mb-2">
                <h5 class="modal-title text-bbbb fw-light" id="myModalLabel">Attendant</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div style="border-bottom: 1px solid #707070;"></div>
            <div class="modal-body mt-2">
                <div class="row text-bbbb">
                    <div class="col-4" id="select_physician">
                        <select class="form-select text-bbbb change-user " data-choices data-type="physician"
                            placeholder="Doctor">
                            <option value="none">Physician</option>
                            @foreach ($doctor as $data)
                                <option value="{{ $data['id'] }}">{{ @$data['user_prefix'] }}
                                    {{ @$data['user_firstname'] }} {{ @$data['user_lastname'] }}</option>
                            @endforeach
                        </select>
                        @if (isset($doctor_select))
                            @foreach ($doctor_select as $data)
                                @php
                                    $class = 'user_assistant_' . $data['id'];
                                    $uid = isset($data['id']) ? $data['id'] : '';
                                @endphp
                                <div class=" mt-0 user_physician_{{ @$data['id'] }}" id="user_{{ @$data['id'] }}">
                                    <div class="row">
                                        <div class="col-3">
                                            {{ @$data['user_prefix'] }} {{ @$data['user_firstname'] }}
                                        </div>
                                        <div class="col-4">
                                            {{ @$data['user_lastname'] }}
                                        </div>
                                        @php
                                            $class = 'user_assistant_' . $data['id'];
                                            $uid = isset($data['id']) ? $data['id'] : '';
                                        @endphp
                                        <div class="col-3 ">
                                            Physician
                                        </div>
                                        <div class="col-2 text-end">
                                            <i onclick='del_selectuser(".{{ $class }}","assistant", "{{ $uid }}")'
                                                class="ri-close-fill text-danger close-hover"></i>
                                        </div>
                                    </div>
                                    {{-- <span>{{@$data['user_prefix']}} {{@$data['user_firstname']}} &ensp;  {{@$data['user_lastname']}}</span>
                <span>Physician</span> --}}
                                </div>
                                {{-- <div class="d-flex justify-content-between px-3 {{$class}} attendant" data-id="{{@$data['id']}}" >
                            {{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}
                            <i onclick='del_selectuser(".{{$class}}","physician", "{{$uid}}")' class="ri-close-fill text-danger"></i>

                        </div> --}}
                            @endforeach
                        @endif

                    </div>
                    <div class="col-4" id="select_nurse">
                        <select name="" class="form-control form-control-sm change-user js-example-templating"
                            data-choices name="choices-single-default" data-type="nurse" placeholder="Nurse">
                            <option value="none">Nurse</option>
                            @foreach ($nurse as $data)
                                <option value="{{ $data['id'] }}">{{ @$data['user_prefix'] }}
                                    {{ @$data['user_firstname'] }} {{ @$data['user_lastname'] }}</option>
                            @endforeach
                        </select>
                        @if (isset($nurse_select))
                            @foreach ($nurse_select as $data)
                                @php
                                    $class = 'user_assistant_' . $data['id'];
                                    $uid = isset($data['id']) ? $data['id'] : '';
                                @endphp
                                <div class=" mt-0 user_nurse_{{ @$data['id'] }}" id="user_{{ @$data['id'] }}">
                                    <div class="row">
                                        <div class="col-3">
                                            {{ @$data['user_prefix'] }} {{ @$data['user_firstname'] }}
                                        </div>
                                        <div class="col-4">
                                            {{ @$data['user_lastname'] }}
                                        </div>
                                        @php
                                            $class = 'user_assistant_' . $data['id'];
                                            $uid = isset($data['id']) ? $data['id'] : '';
                                        @endphp

                                        <div class="col-3 ">
                                            Nurse
                                        </div>
                                        <div class="col-2 text-end">
                                            <i onclick='del_selectuser(".{{ $class }}","assistant", "{{ $uid }}")'
                                                class="ri-close-fill text-danger close-hover"></i>
                                        </div>
                                    </div>
                                    {{-- <span>{{@$data['user_prefix']}} {{@$data['user_firstname']}} &ensp;  {{@$data['user_lastname']}}</span>
                 <span>Physician</span> --}}
                                </div>
                                {{-- <div class="d-flex justify-content-between px-3 {{$class}} attendant" data-id="{{@$data['id']}}">
                            <span>{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</span>

                            <i onclick='del_selectuser(".{{$class}}","nurse", "{{$uid}}")' class="ri-close-fill text-danger"></i>
                        </div> --}}
                            @endforeach
                        @endif
                    </div>
                    <div class="col-4" id="select_assistant">
                        <select name="" class="form-control form-control-sm change-user js-example-templating"
                            data-choices name="choices-single-default" data-type='assistant'
                            placeholder="Nurse Assistant">
                            <option value="none">Nurse Assistant</option>
                            @foreach ($nurse as $data)
                                <option value="{{ $data['id'] }}">{{ @$data['user_prefix'] }}
                                    {{ @$data['user_firstname'] }} {{ @$data['user_lastname'] }}</option>
                            @endforeach
                        </select>
                        @if (isset($assistant_select))
                            @foreach ($assistant_select as $data)
                                @php
                                    $class = 'user_assistant_' . $data['id'];
                                    $uid = isset($data['id']) ? $data['id'] : '';
                                @endphp

                                <div class="row">
                                    <div class="col-3">
                                        {{ @$data['user_prefix'] }} {{ @$data['user_firstname'] }}
                                    </div>
                                    <div class="col-4">
                                        {{ @$data['user_lastname'] }}
                                    </div>

                                    @php
                                        $class = 'user_assistant_' . $data['id'];
                                        $uid = isset($data['id']) ? $data['id'] : '';
                                    @endphp
                                    <div class="col-3">
                                        Nurse Assistant
                                    </div>
                                    <div class="col-2 text-end">
                                        <i onclick='del_selectuser(".{{ $class }}","assistant", "{{ $uid }}")'
                                            class="ri-close-fill text-danger ri-close-fill"></i>
                                    </div>

                                </div>
                                {{-- <span>{{@$data['user_prefix']}} {{@$data['user_firstname']}} &ensp;  {{@$data['user_lastname']}}</span>
                  <span>Physician</span> --}}
                    </div>
                    {{-- <div class="d-flex justify-content-between px-3 {{$class}} attendant" data-id="{{@$data['id']}}">
                            <span>{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}</span>
                            <i onclick='del_selectuser(".{{$class}}","assistant", "{{$uid}}")' class="ri-close-fill text-danger"></i>

                        </div> --}}
                    @endforeach
                    @endif
                </div>
            </div>

        </div>

        <div class="col-12 text-center mb-3" style="border-top: 1px solid #707070;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-danger mt-3 w-75">Confirm Attendant</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
