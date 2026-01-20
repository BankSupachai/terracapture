<div class="col-12">
    {!! editcard('cysto', 'cysto.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <font size='4'><b>FINDING</b></font><br><br><br>
            <div class="row">
                <br>
                <div class="col-2">
                    <b>Prostatic Length</b>
                </div>
                <div class="col-2">
                    <input id='prostatic_length' name="prostatic_length" type="text"
                        class="form-control autotext savejson" value="{{ @$case->prostatic_length }}">
                </div>cm.
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>Prostate</b>
                </div>
                <div class="col-2">
                    <input id='prostate_cysto' name="prostate_cysto" type="text"
                        class="form-control autotext savejson" autocomplete="off" value="{{ @$case->prostate_cysto }}">
                </div>

                <br>
                <div class="col-2">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Obstruction</b>
                </div>
                <div class="col-2">
                    <input id='obstruction_cysto' name="obstruction_cysto" type="text"
                        class="form-control autotext savejson" autocomplete="off"
                        value="{{ @$case->obstruction_cysto }}">
                </div>
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>VC size</b>
                </div>
                <div class="col-2">
                    <input id='vc_size_cysto' name="vc_size_cysto" type="text" class="form-control autotext savejson"
                        value="{{ @$case->vc_size_cysto }}">
                </div>cm.
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>Intravesical pressure</b>
                </div>
                <div class="col-2">
                    <input id='intravesical_pressure_cysto' name="intravesical_pressure_cysto" type="text"
                        class="form-control autotext savejson" value="{{ @$case->intravesical_pressure_cysto }}">
                </div>cm.H2O
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>Trabeculac</b>
                </div>
                <div class="col-2">
                    <input id='trabeculac_cysto' name="trabeculac_cysto" type="text"
                        class="form-control autotext savejson" autocomplete="off"
                        value="{{ @$case->trabeculac_cysto }}">
                </div>
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>Bladder mass</b>
                </div>
                <div class="col-2">
                    <input id='bladder_mass_cysto' name="bladder_mass_cysto" type="text"
                        class="form-control autotext savejson" autocomplete="off"
                        value="{{ @$case->bladder_mass_cysto }}">
                </div>

                <br>
                <div class="col-1">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;size</b>
                </div>
                <div class="col-1">
                    <input id='size_cysto' name="size_cysto" type="text" class="form-control autotext savejson"
                        value="{{ @$case->size_cysto }}">
                </div>cm.

                <br>
                <div class="col-1">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;At</b>
                </div>
                <div class="col-4">
                    <input id='at_cysto' name="at_cysto" type="text" class="form-control autotext savejson"
                        autocomplete="off" value="{{ @$case->at_cysto }}">
                </div>
            </div>
            <br>

            <div class="row">
                <br>
                <div class="col-2">
                    <b>Stricture urethra
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;at</b>
                </div>
                <div class="col-2">
                    <input id='stricture_urethra_cysto' name="stricture_urethra_cysto" type="text"
                        class="form-control autotext savejson" autocomplete="off"
                        value="{{ @$case->stricture_urethra_cysto }}">
                </div>

                <br>
                <div class="col-1">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;length</b>
                </div>
                <div class="col-1">
                    <input id='length_cysto' name="length_cysto" type="text" class="form-control autotext savejson"
                        value="{{ @$case->length_cysto }}">
                </div>cm.
            </div>
            <br>
            <div class="row">
                <div class="col-2">Overall finding</div>
                <div class="col-10">
                    <textarea id='overall_cysto' name="overall_cysto" type="text" placeholder="Free text"
                        class="savejson form-control autotext">{{ @$case->overall_cysto }}</textarea>
                    <br></br>
                </div>
            </div>
        </div>
    </div>
</div>
