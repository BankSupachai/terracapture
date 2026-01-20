    {!! editcard('pre-diagnostic-pleuroscipy', 'pre-diagnostic-pleuroscipy.blade.php') !!}
    <div class="card card-custom p-1">
        <div class="card-body ">
            <div class="row ">
                <div class="h5">Pre-Diagnosic-Pleuroscopy &nbsp;&nbsp; <i class="ri-equalizer-line"></i></div>
                <div class="col-6" style="margin-top: 5px;">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            Pleural effusion profile</div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="effusion_profile" value="{{ @$case->effusion_profile }}">
                        </div>
                    </div>
                </div>
                <div class="col-6" style="margin-top: 5px;">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">Patient position</div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="patient_position" value="{{ @$case->patient_position }}">
                        </div>
                    </div>
                </div>
                <div class="col-6" style="margin-top: 5px;">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            ASA Class</div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext" autocomplete="off"
                        id="asa_class" value="{{ @$case->asa_class }}">
                        </div>
                    </div>
                </div>
                <div class="col-6" style="margin-top: 5px;">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">Date of intubation</div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext" autocomplete="off"
                            id="date_of" value="{{ @$case->date_of }}">
                        </div>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 5px;">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-2 align-self-center">Port of entry</div>
                        <div class="col-2">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="port_of_entry" value="{{ @$case->port_of_entry }}">
                        </div>
                        <div class="col-1 text-center align-self-center">
                            at
                        </div>
                        <div class="col-2">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="entry_at" value="{{ @$case->entry_at }}">
                        </div>
                        <div class="col-1 text-center align-self-center">
                            ICS
                        </div>
                        <div class="col-2">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="entry_at_ics" value="{{ @$case->entry_at_ics }}">
                        </div>
                        <div class="col-2 align-self-center">
                            axillary line
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
