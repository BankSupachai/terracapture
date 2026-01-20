<div class="card p-2">
    <div class="card-body">
        <div class="row" id="gastric_content">
            <div class="row">

                <div class="col-lg-12">
                    <b>GASTRIC CONTENT</b>
                </div>
                <div class="col-lg-6">
                    <div class="row m-0">
                        <div class="col-lg-6">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes1"/>
                                <span></span>
                                Food content
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes1"/>
                                <span></span>
                                Coffee ground
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes1"/>
                                <span></span>
                                Blood
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes1"/>
                                <span></span>
                                Bile
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <textarea id="gastriccontent_other" name="gastriccontent_other" type="text" placeholder="Free text" class="savejson form-control autotext" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 58px;"></textarea>
                </div>
            </div>
        </div>

        <div class="row" id="complication">
            <div class="col-lg-12">
                <b>COMPLICATION</b>
            </div>
            <div class="col-lg-6">
                <div class="row m-0">
                    <div class="col-lg-6">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes1"/>
                            <span></span>
                            Perforation
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes1"/>
                            <span></span>
                            Hypoxia
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes1"/>
                            <span></span>
                            Bleeding
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes1"/>
                            <span></span>
                            Cardiovascular instability
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <textarea id="complication_other" name="complication_other" type="text" placeholder="Free text" class="savejson form-control autotext" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 58px;"></textarea>
            </div>
        </div>

        <div class="row" id="rapid_urease_test">
            <div class="col-12">
                <b>RAPID UREASE TEST</b>
            </div>
            <div class="col-6">
                <select class="form-control savejson" id="rapid" name="rapid" style="background: none;"><option value="" selected="selected">Select</option><option value="1">Positive</option><option value="2">Negative</option><option value="3">Pending</option></select>
            </div>
            <div class="col-6">
                <input class="form-control autotext savejson" id="rapid_other" placeholder="Free Text" type="text" autocomplete="off" value="">
            </div>
        </div>

        <div class="row" id="estimated_blood_loss">
            <div class="col-6">
                <b>ESTIMATED BLOOD LOSS</b>
            </div>
            <div class="col-6">
                <input class="form-control autotext savejson" id="blood_loss" placeholder="Free Text" type="text" autocomplete="off" value="0" style="background: rgb(210, 235, 246);">
            </div>
        </div>

        <div class="row" id="blood_transfusions">
            <div class="col-6">
                <b>BLOOD TRANSFUSION</b>
            </div>
            <div class="col-6">
                <input class="form-control autotext savejson" id="blood_transfusion" placeholder="Free Text" type="text" autocomplete="off" value="">
            </div>
        </div>

        <div class="row" style="align-items: center;" id="specimens">
            <div class="col-6">
                <b>SPECIMEN</b>&nbsp;&nbsp;
                <input id="specimen_na" type="checkbox" class="savejson_checkbox" name="specimen_na" value="N/A" checked=""><label for="specimen_na">&nbsp;&nbsp;N/A</label>
                <input id="specimen_wfp" type="checkbox" class="savejson_checkbox ml-2" name="specimen_wfp" value="Waiting for partho"><label for="specimen_wfp">&nbsp;&nbsp;Pending</label>
            </div>
            <div class="col-6">
                <input class="form-control autotext savejson" id="histopathology_volumn" placeholder="จำนวนสิ่งส่งตรวจ" type="text" autocomplete="off" value="">
            </div>
            <div class="col-1">&nbsp;</div>
            <div class="col-5">
                <div class="row">
                    <div class="col-12">
                        <label>
                            <input type="checkbox" class="savejson_checkbox histo_checkgroup" name="histopathology" value="Biopsy">
                            Biopsy
                        </label>
                    </div>
                    <div class="col-12">
                        <label>
                            <input type="checkbox" class="savejson_checkbox histo_checkgroup" name="histopathology" value="Hot biopsy">
                            Hot biopsy
                        </label>
                    </div>
                    <div class="col-12">
                        <label>
                            <input type="checkbox" class="savejson_checkbox histo_checkgroup" name="histopathology" value="Polypectomy">
                            Polypectomy
                        </label>
                    </div>
                    <div class="col-12">
                        <label>
                            <input type="checkbox" class="savejson_checkbox histo_checkgroup" name="histopathology" value="Flow Anesthsia">
                            Flow Anesthsia
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <textarea id="histopathology_other" name="histopathology_other" type="text" placeholder="Free text" class="savejson form-control" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 58px;"></textarea>
            </div>
        </div>

        <div class="row"  id="plans">
            <div class="col-12">
                <b>PLAN</b>
            </div>
            <div class="col-12">
                <textarea id="case_comment" name="case_comment" type="text" placeholder="Free text" class="savejson form-control autotext" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 58px;"></textarea>
            </div>
        </div>

        <div class="row" id="attendants">
            <div class="col-12"><b>Attendant</b></div>
            <div class="col-12">
                <select name="" id="" class="form-control" aria-placeholder="Select Users"></select>
            </div>
        </div>

        <div class="row" id="assistants">
            <div class="col-12">
                <b>Assistant</b>
            </div>
            <div class="col-12">
                <textarea id="assistant" name="assistant" type="text" placeholder="Free text" class="savejson form-control autotext"></textarea>
            </div>
        </div>

        <div class="row" id="endoscopists">
            <div class="col-12">
                <b>Endoscopist</b>
            </div>
            <div class="col-12">
                <select name="" id="" class="form-control"></select>
            </div>
        </div>

    </div>
</div>


