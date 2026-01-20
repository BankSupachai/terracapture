<div id="roomModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ url('casemonitor') }}" method="post" class="modal-content">
            @csrf
            <input type="hidden" name="event" value="set_officer">
            <div class="modal-header border-bottom p-2">
                <h5 class="modal-title" id="myModalLabel" style="font-weight: 100;">&ensp; Room </h5>
                {{-- <select name=""  class="form-select w-25 bg-gray-input ms-3">
                    <option value="" selected>Room1</option>
                </select> --}}
                <input id="current_room" type="text" class="form-control w-25 ms-3" readonly>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body border-bottom p-">
                {{-- <form  class="form-control" action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="set_officer"> --}}
                <input type="hidden" id="room_id" name="room_id">
                <input type="hidden" id="room_name" name="page" value="control">
                <div class="row">
                    <div class="col-4">
                        <p>Physician</p>
                        <select name="doctor_select[]" id="doctor_select" multiple="multiple"
                            class="form-select w-100 bg-gray-input select2 append_doctor selected_doctor" user_type="doctor" >
                            {{-- <option  value="" selected>Select Doctor</option> --}}
                            @foreach (isset($doctor) ? $doctor : [] as $d)
                                @php
                                    $d = (object) $d;
                                @endphp
                                <option value="{{ @$d->id }}">{{ @$d->user_prefix }}{{ @$d->user_firstname }}
                                    {{ @$d->user_lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <p>Nurse</p>
                        <select name="nurse_select[]" id="nurse_select"multiple="multiple"
                            class="form-select w-100 bg-gray-input select2 append_nurse selected_nurse" user_type="nurse" >
                            {{-- <option id="nurse_fix" value="0" selected>Nurse</option> --}}
                            {{-- <option value=""selected>Select Nurse</option> --}}
                            @foreach (isset($nurse) ? $nurse : [] as $n)
                                @php
                                    $n = (object) $n;
                                @endphp
                                <option value="{{ @$n->id }}">{{ @$n->user_prefix }}{{ @$n->user_firstname }}
                                    {{ @$n->user_lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <p>Nurse Assistant</p>
                        <select name="nurse_assist_select[]" id="nurse_assist_select" user_type="nurse_assist"
                            multiple="multiple" class="form-select w-100 bg-gray-input select2 append_nurse_assist selected_nurse_assist"     >
                            {{-- <option value="0" selected>Nurse Assistant</option> --}}
                            {{-- <option value=""selected>Select Nurse</option> --}}
                            @foreach (isset($nurse) ? $nurse : [] as $na)
                                @php
                                    $na = (object) $na;
                                @endphp
                                <option value="{{ @$na->id }}">{{ @$na->user_prefix }}{{ @$na->user_firstname }}
                                    {{ @$na->user_lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-4">

                            <div class="append_doctor_html row">

                            </div>

                    </div>
                    <div class="col-4">
                        <div class="col-12">
                            <span class="append_nurse_html"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-12">
                            <span class="append_nurse_assist_html"></span>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}

            </div>
            <div class="modal-footer p-2">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-orange w-75">Confirm Setting</button>
                </div>
            </div>

        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {


        $('.select2').select2({

            // allowClear: true,
            dropdownParent: $('#roomModal')

        });

        $('.select2').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });


        });
    })


    $(".append_doctor").change(function() {
        let doctor_name = $(this).find("option:selected").text();
        console.log(doctor_name);
        let doctor_name2 = doctor_name.split(' ');
        var html = ``;
        for(let i = 0; i < doctor_name2.length; i++) {
            html += `<div class="col-12 " style="width: 100%;">${doctor_name2[i]}</div>`;
        }
        $(`.append_doctor_html`).html(html);
    });

    $(".append_nurse").change(function() {
        let nurse_name = $(this).find("option:selected").text();
        var html = `

            <div class="col-12 ">
                ${nurse_name}
            </div>

        `
        $(`.append_nurse_html`).html(html);
    });

    $(".append_nurse_assist").change(function() {
        let nurse_assist_name = $(this).find("option:selected").text();
        var html = `

            <div class="col-12 ">
                ${nurse_assist_name}
            </div>

        `
        $(`.append_nurse_assist_html`).html(html);
    });
</script>
