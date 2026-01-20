<div class="col-12">
    {!! editcard('procedure', 'procedure.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">

            {{-- @dd($case->rigid_cysto); --}}
            <font size = '4'><b>PROCEDURE</b></font><br></br>
            <div class="row form-inline"><br>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input click-to-hide savejson_checkbox" name="rigid_cysto" type="checkbox"
                            id="rigid_cysto1" @checked(
                                @$case->cystoscope_was_done_with_sheath_cysto ||
                                    @$case->length_procedure_cysto ||
                                    @$case->finding_as_above_cysto ||
                                    @$case->cystolitholapraxy_cysto ||
                                    @$case->length2_procedure_cysto)>
                        <label class="form-check-label" for="rigid_cysto1">
                            Rigid cystoscopy
                        </label>
                    </div>
                </div>
                @php

                    if (@$case->cystoscope_was_done_with_sheath_cysto || @$case->length_procedure_cysto || @$case->finding_as_above_cysto || @$case->cystolitholapraxy_cysto || @$case->length2_procedure_cysto) {
                        $showdisplay = 'display: show;';
                    } else {
                        $showdisplay = 'display: none;';
                    }

                @endphp

                <div class="show-detail" style="{{ $showdisplay }}">
                    <div class="row">
                        <div class="col-4 form-group">
                            <div class="row">
                                <div class="col-8 align-self-center">
                                    <b>Cystoscope was done with sheath</b>
                                </div>
                                <div class="col-4">
                                    <input id='cystoscope_was_done_with_sheath_cysto'
                                        name="cystoscope_was_done_with_sheath_cysto" type="text"
                                        class="form-control autotext savejson" autocomplete="off"
                                        value="{{ @$case->cystoscope_was_done_with_sheath_cysto }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <div class="col-2 align-self-center">
                                    <b>length</b>
                                </div>
                                <div class="col-10">
                                    <input id='length_procedure_cysto' name="length_procedure_cysto" type="text"
                                        class="form-control autotext savejson" autocomplete="off"
                                        value="{{ @$case->length_procedure_cysto }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    cm. &ensp; Finding as above
                                </div>
                                <div class="col-8">
                                    <input id='finding_as_above_cysto' name="finding_as_above_cysto" type="text"
                                        class="form-control autotext savejson" autocomplete="off"
                                        value="{{ @$case->finding_as_above_cysto }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        if (@$case->finding_as_above_cysto != 'ureteric cath was inserted via Rt/Lt UO upto') {
                            $display = 'display: none';
                        } else {
                            $display = '';
                        }

                    @endphp
                    <div id="divfinding_as_above_cystonum" style="{{ $display }}">
                        <input id='finding_as_above_cystonum' name="finding_as_above_cystonum" type="text"
                            class="form-control autotext savejson" autocomplete="off"
                            value="{{ @$case->finding_as_above_cystonum }}"> cm.
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-4 form-group">
                            <div class="row">
                                <div class="col-8 align-self-center">
                                    Cystolitholapraxy was done with sheath
                                </div>
                                <div class="col-4">
                                    <input id='cystolitholapraxy_cysto' name="cystolitholapraxy_cysto" type="text"
                                        class="form-control autotext savejson" autocomplete="off"
                                        value="{{ @$case->cystolitholapraxy_cysto }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-2">
                                    length
                                </div>
                                <div class="col-10">
                                    <input id='length2_procedure_cysto' name="length2_procedure_cysto" type="text"
                                        class="form-control autotext savejson" autocomplete="off"
                                        value="{{ @$case->length2_procedure_cysto }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-inline mt-3"><br>
                    <div class="col-4 form-group">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-check mb-2">
                                    <input class="form-check-input click-to-hide2" name="flex_cystoscopy"
                                        type="checkbox" id="flex_cystoscopy" value="{{ @$case->flex_cystoscopy }}"
                                        @checked(@$case->cysto_serial)>
                                    <label class="form-check-label" for="flex_cystoscopy">
                                        Flexible cystoscopy (Serial no.)
                                    </label>
                                </div>
                            </div>
                            @php

                                if (@$case->cysto_serial) {
                                    $showdisplay2 = 'display: show;';
                                } else {
                                    $showdisplay2 = 'display: none;';
                                }

                            @endphp
                            <div class="col-4 show-detail2" style="{{ $showdisplay2 }}">

                                <select id="cysto_serial" class="form-select form-select-sm autotext savejson w-100  mb-3"
                                    data-choices>
                                    <option value="">Endoscope</option>
                                    @foreach ($scopes as $data)

                                        @if(@$case->cysto_serial==$data['scope_id'])
                                            <option value="{{ $data['scope_id'] }}" selected>
                                                {{ @$data['scope_name'] }} &nbsp;
                                                {{ @$data['scope_serial'] }}
                                            </option>
                                        @else
                                            <option value="{{ $data['scope_id'] }}">
                                                {{ @$data['scope_name'] }} &nbsp;
                                                {{ @$data['scope_serial'] }}
                                            </option>
                                        @endif




                                    @endforeach
                                </select>
                                {{-- <input type="text" id="cysto_serial" name="cysto_serial" class="form-control autotext savejson"
                                 value="{{@$case->cysto_serial}}"> --}}
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row form-inline mt-3"><br>
                    <div class="col-4 form-group">
                        <div class="row">
                            <div class="col-8">
                                Urethra was dilated with sound dilator
                            </div>
                            <div class="col-4">
                                <input id='urethra_was_dilated_cysto' name="urethra_was_dilated_cysto" type="text"
                                    class="form-control autotext savejson" autocomplete="off"
                                    value="{{ @$case->urethra_was_dilated_cysto }}">
                            </div>
                        </div>
                    </div>

                </div>



                <div class="row form-inline mt-3">
                    <div class="col-4 form-group">
                        <div class="row">
                            <div class="col-8 ">
                                Forley cath
                            </div>
                            <div class="col-4">
                                <input id='forley_cath_cysto' name="forley_cath_cysto" type="text"
                                    class="form-control autotext savejson" autocomplete="off"
                                    value="{{ @$case->forley_cath_cysto }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            if (@$case->forley_cath_cysto == 'three way') {
                                $display = '';
                                $wasdisplay = '';
                            } elseif (@$case->forley_cath_cysto == 'Four wiring#') {
                                $display = '';
                                $wasdisplay = '';
                            } elseif (@$case->forley_cath_cysto == 'Forley cath#') {
                                $display = '';
                                $wasdisplay = 'display: none;';
                            } elseif (@$case->forley_cath_cysto == 'SPC') {
                                $display = 'display: none;';
                                $wasdisplay = 'display: none;';
                            } elseif (@$case->forley_cath_cysto == 'two way') {
                                $display = 'display: none;';
                                $wasdisplay = 'display: none;';
                            } else {
                                $display = 'display: none;';
                                $wasdisplay = 'display: none;';
                            }
                        @endphp

                        <div id="divforley_cath_cystonum" style="{{ $display }}width: 100%">
                            <input id='forley_cath_cystonum' name="forley_cath_cystonum" type="text"
                                class="form-control autotext savejson" autocomplete="off"
                                value="{{ @$case->forley_cath_cystonum }}">
                        </div>
                        <div id="wasreplaced" style="{{ $wasdisplay }}">
                            was replaced
                        </div>
                        <div class="row mt-2"><br>

                            <div class="col-12">
                                Other Procedure
                                <textarea id='case_freetext' name="case_freetext" type="text" placeholder="Free text" row="10"
                                    class="savejson form-control autotext mt-2">{{ @$case->case_freetext }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(".click-to-hide").click(function() {
                $(".show-detail").toggle(300);

            })
            $(".click-to-hide2").click(function() {
                $(".show-detail2").toggle(300);

            })
        </script>






        <script>
            $('#finding_as_above_cysto').focusout(function() {
                setTimeout(function() {
                    var txt = $('#finding_as_above_cysto').val();
                    var n = txt.search("cath");
                    if (n > 0) {
                        $('#divfinding_as_above_cystonum').show();
                    } else {
                        $('#divfinding_as_above_cystonum').hide();
                    }
                }, 1000);
            });
        </script>

        <script>
            $('#forley_cath_cysto').focusout(function() {
                setTimeout(function() {
                    var txt = $('#forley_cath_cysto').val();
                    $('#forley_cath_cystonum').val('');
                    if (txt == "three way") {
                        $('#divforley_cath_cystonum').show();
                        $('#wasreplaced').show();
                    } else if (txt == "Four wiring#") {
                        $('#divforley_cath_cystonum').show();
                        $('#wasreplaced').show();
                    } else if (txt == "Forley cath#") {
                        $('#divforley_cath_cystonum').show();
                        $('#wasreplaced').hide();
                    } else if (txt == "SPC") {
                        $('#divforley_cath_cystonum').hide();
                        $('#wasreplaced').hide();
                    } else if (txt == "two way") {
                        $('#divforley_cath_cystonum').hide();
                        $('#wasreplaced').hide();
                    } else {
                        $('#divforley_cath_cystonum').hide();
                        $('#wasreplaced').hide();
                    }
                }, 1000);
            });
        </script>
