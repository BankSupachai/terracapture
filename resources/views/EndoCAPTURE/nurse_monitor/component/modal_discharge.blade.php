{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#Modal_Discharge"></button> --}}
<div id="Modal_Discharge" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <div class="px-2">
                    <div class="col-12 d-flex justify-content-between">
                        <span class="h5 font-blue " id="patient_detail">HN : - </span>
                    </div>
                    <span class="h5 font-blue">Contact : -</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 p-0 mt-2" style="border-bottom: 1px solid #e9ebec"></div>
            <form action="{{ url('casemonitor') }}" method="POST">
                @csrf
                <input type="hidden" id="data_hn" name="data_hn" value="">
                <input type="hidden" name="event" value="casemonitor_discharge_to">
                <input type="hidden" id="data_id" name="id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row mt-2">
                                <div class="row d-flex align-items-center my-2">
                                    <div class="col-12 mb-3">
                                        <span class="fs-14">Discharge to</span>
                                    </div>
                                    <div class="col-12">

                                        <select name="discharged_to" id="discharged_to" class="form-control">
                                            <option value="Home">Home</option>
                                            <option value="Admit">Admit</option>
                                            <option value="Consult">Consult</option>
                                            <option value="Followup">Follow Up</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input  radio_check" type="radio" name="discharged_to" id="{{ md5('home') }}"
                                            value="home">
                                            <label class="form-check-label" for="{{ md5('home') }}">
                                                &ensp; Home
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input  radio_check" type="radio"
                                                name="discharged_to" id="{{ md5('Admit') }}" value="admit">
                                            <label class="form-check-label" for="{{ md5('Admit') }}">
                                                &ensp; Admit
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input  radio_check" type="radio"
                                                name="discharged_to" id="{{ md5('Consult') }}" value="consult">
                                            <label class="form-check-label" for="{{ md5('Consult') }}">
                                                &ensp; Consult
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input radio_check"
                                                type="radio" name="discharged_to" id="{{ md5('นัด Follow Up') }}"
                                                value="followup">
                                            <label class="form-check-label" for="{{ md5('นัด Follow Up') }}">
                                                &ensp; นัด Follow Up
                                            </label>
                                        </div>
                                    </div> --}}

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="print" class="btn btn-primary btn-label waves-effect right waves-light w-lg btn-discharge " name="discharged_redirect"  cid="" id="btn-discharge-print">Confirm & Print</button>
                    <button type="submit" value="reload" class="btn btn-primary btn-label waves-effect right waves-light w-lg btn-discharge" name="discharged_redirect" discharge="reload"><i
                class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    // $(".btn-discharge").click(function () {
    //     socket.emit('chat message', 'casemonitor');
    // })
</script>
{{-- <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <span class="h5">Discharge Score Calculate</span>
                            </div>
                            <div class="col-6 text-center">
                                Score
                            </div>
                            <div class="col-6 mt-2">

                                Vital Signs (blood pressure, pulse, heart rate) <br>
                                0 = >40% of preoperative value <br>
                                1 = 20 - 40% of preoperative value <br>
                                2 = < 20% of preoperative value </div>
                                    <div class="col-6 text-center align-self-center">
                                        <input type="text" class="form-control bg-light border-0 w-50">
                                    </div>
                                    <div class="col-6 mt-4">

                                        Activity, mental status <br>
                                        0 = Neither <br>
                                        1 = Oriented or steady gait <br>
                                        2 = Oriented and steady gait </div>
                                    <div class="col-6 text-center align-self-center">
                                        <input type="text" class="form-control bg-light border-0 w-50">
                                    </div>

                                    <div class="col-6 mt-4">

                                        Pain, nausea, vomitting <br>
                                        0 = Severe <br>
                                        1 = Moderate <br>
                                        2 = Minimal </div>
                                    <div class="col-6 text-center align-self-center">
                                        <input type="text" class="form-control bg-light border-0 w-50">
                                    </div>

                                    <div class="col-6 mt-4">

                                        Surgical bleeding <br>
                                        0 = Severe <br>
                                        1 = Moderate <br>
                                        2 = Minimal </div>
                                    <div class="col-6 text-center align-self-center">
                                        <input type="text" class="form-control bg-light border-0 w-50">
                                    </div>

                                    <div class="col-6 mt-4">

                                        Intake and output <br>
                                        0 = Neither <br>
                                        1 = PO fluids or voided <br>
                                        2 = PO fluids and voided </div>
                                    <div class="col-6 text-center align-self-center">
                                        <input type="text" class="form-control bg-light border-0 w-50">
                                    </div>
                            </div>
                        </div>
                        </div> --}}
