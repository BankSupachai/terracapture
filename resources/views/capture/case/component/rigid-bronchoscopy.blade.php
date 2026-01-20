<div class="col-12">
    {!! editcard('rigid-bronchoscopy', 'rigid-bronchoscopy.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="col-12" style="margin-top: 10px;"><font size="4">PROCEDURE NOTE</font></div>
            <div class="col-12">
                <div class="row" style="padding-left: 15px;">
                    <div class="col-12">1. Initial bronchoscopy</div>

                    <div class="col-12" style="padding-left: 2%;">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox"  id="flexible_bronchoscopy" class="savejson boxtoggle" name="flexible_bronchoscopy" {{box(@$case->flexible_bronchoscopy)}}>
                                <label class="form-check-label" for="flexible_bronchoscopy" style="margin: 0;padding: 0;">Flexible bronchoscopy was done to evaluation of tracheobronchial tree</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="padding-left: 2%;">
                        <div class="row" style="align-items: center;">
                            <div class="col-2">
                                <input type="checkbox"  id="rigid_bronchoscope" class="savejson boxtoggle" subis="rigid_b" name="rigid_bronchoscope" {{box(@$case->rigid_bronchoscope)}}>
                                <label class="form-check-label" for="rigid_bronchoscope" style="margin: 0;padding: 0;">Rigid bronchoscope</label> &nbsp;&nbsp;<k class="rigid_b">,size</k>
                            </div>
                            <div class="col-1 rigid_b">
                                <input type="text" name="rigid_txt_01" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_txt_01" value="{{@$case->rigid_txt_01}}">
                            </div>
                            <div class="col-2 text-center rigid_b">
                                mm. &nbsp; , was placed at
                            </div>
                            <div class="col-6 rigid_b" style="padding-right: 40px;">
                                <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_txt_02" value="{{@$case->rigid_txt_02}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 15px;">2. Procedure</div>
                    <div class="col-12" style="padding-left: 2%;">
                        <div class="row" style="align-items: unset;">
                            <div class="col-12">
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-1">
                                        <input type="checkbox"  id="dilatation" class="savejson boxtoggle" subis="dilatation" name="dilatation" {{box(@$case->dilatation)}}>
                                        <label class="form-check-label" for="dilatation" style="margin: 0;padding: 0;">Dilatation at
                                    </div>
                                    <div class="col-5 dilatation">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="dilatation_txt" value="{{@$case->dilatation_txt}}">
                                    </div>
                                    <div class="col-6 dilatation">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="checkbox"  id="elctrocauterrization" name="elctrocauterrization" class="savejson" {{box(@$case->elctrocauterrization)}}>
                                                <label class="form-check-label" for="elctrocauterrization" style="margin: 0;padding: 0;">Electrocauterrization
                                            </div>
                                            <div class="col-6" style="margin-left: -4%;">
                                                <input type="checkbox"  id="laser" name="laser" class="savejson" {{box(@$case->laser)}}>
                                                <label class="form-check-label" for="laser" style="margin: 0;padding: 0;">Laser
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-7">
                                                        <input type="checkbox"  id="balloon" name="balloon" class="savejson" {{box(@$case->balloon)}}>
                                                        <label class="form-check-label" for="balloon" style="margin: 0;padding: 0;">Balloon to (mm.)
                                                    </div>
                                                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="balloon_txt" value="{{@$case->balloon_txt}}"></div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-6">
                                                        <input type="checkbox"  id="rigid_bronchoscope" name="rigid_bronchoscope" class="savejson" {{box(@$case->rigid_bronchoscope)}}>
                                                        <label class="form-check-label" for="rigid_bronchoscope" style="margin: 0;padding: 0;">Rigid bronchoscope to (mm.)
                                                    </div>
                                                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_bronchoscope_txt" value="{{@$case->rigid_bronchoscope_txt}}"></div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="align-items: center;">
                                            <div class="col-3">
                                                <input type="checkbox"  id="others_01" name="others_01" class="savejson" {{box(@$case->others_01)}}>
                                                <label class="form-check-label" for="others_01" style="margin: 0;padding: 0;">Others
                                            </div>
                                            <div class="col-8" style="padding-left: 5%;">
                                                <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="others_01_txt" value="{{@$case->others_01_txt}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-1">
                                        <input type="checkbox"  id="dilatation_at" name="dilatation_at" class="savejson boxtoggle" subis="dilatation_at" {{box(@$case->dilatation_at)}}>
                                        <label class="form-check-label" for="dilatation_at" style="margin: 0;padding: 0;">Dilatation at
                                    </div>
                                    <div class="col-5 dilatation_at">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="dilatation_at_txt" value="{{@$case->dilatation_at_txt}}">
                                    </div>
                                    <div class="col-6 dilatation_at">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="checkbox"  id="electrocauterrization" name="electrocauterrization" class="savejson" {{box(@$case->electrocauterrization)}}>
                                                <label class="form-check-label" for="electrocauterrization" style="margin: 0;padding: 0;">Electrocauterrization
                                            </div>
                                            <div class="col-6" style="margin-left: -4%;">
                                                <input type="checkbox"  id="laser_" name="laser_" class="savejson" {{box(@$case->laser_)}}>
                                                <label class="form-check-label" for="laser_" style="margin: 0;padding: 0;">Laser
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-7">
                                                        <input type="checkbox" id="ballon_to" name="ballon_to" class="savejson" {{box(@$case->ballon_to)}}>
                                                        <label class="form-check-label" for="ballon_to" style="margin: 0;padding: 0;">Balloon to (mm.)
                                                    </div>
                                                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="ballon_to_txt" value="{{@$case->ballon_to_txt}}"></div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-6">
                                                        <input type="checkbox"  id="rigid_bronchosope_to" name="rigid_bronchosope_to" class="savejson" {{box(@$case->rigid_bronchosope_to)}}>
                                                        <label class="form-check-label" for="rigid_bronchosope_to" style="margin: 0;padding: 0;">Rigid bronchoscope to (mm.)
                                                    </div>
                                                    <div class="col-4"><input type="text" name="rigid_bronchosope_to_txt" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_bronchosope_to_txt" value="{{@$case->rigid_bronchosope_to_txt}}"></div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="align-items: center;">
                                            <div class="col-3">
                                                <input type="checkbox" id="rigid_others" name="rigid_others" class="savejson" {{box(@$case->rigid_others)}}>
                                                <label class="form-check-label" for="rigid_others" style="margin: 0;padding: 0;">Others
                                            </div>
                                            <div class="col-8" style="padding-left: 5%;">
                                                <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_others_txt" value="{{@$case->rigid_others_txt}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-1">
                                        <input type="checkbox"  id="dilatation_at_02" name="dilatation_at_02" class="savejson boxtoggle" subis="dilatation_at_02" {{box(@$case->dilatation_at_02)}}>
                                        <label class="form-check-label" for="dilatation_at_02" style="margin: 0;padding: 0;">Dilatation at
                                    </div>
                                    <div class="col-5 dilatation_at_02">
                                        <input type="text" name="dilatation_at_02_txt" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="dilatation_at_02_txt" value="{{@$case->dilatation_at_02_txt}}">
                                    </div>
                                    <div class="col-6 dilatation_at_02">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="checkbox"  id="electrocauterrization_01" name="electrocauterrization_01" class="savejson" {{box(@$case->electrocauterrization_01)}}>
                                                <label class="form-check-label" for="electrocauterrization_01" style="margin: 0;padding: 0;">Electrocauterrization
                                            </div>
                                            <div class="col-6" style="margin-left: -4%;">
                                                <input type="checkbox"  id="laser_02" name="laser_02" class="savejson" {{box(@$case->laser_02)}}>
                                                <label class="form-check-label" for="laser_02" style="margin: 0;padding: 0;">Laser
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-7">
                                                        <input type="checkbox"  id="balloon_to_02" name="balloon_to_02" class="savejson" {{box(@$case->balloon_to_02)}}>
                                                        <label class="form-check-label" for="balloon_to_02" style="margin: 0;padding: 0;">Balloon to
                                                    </div>
                                                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="balloon_to_02_txt" value="{{@$case->balloon_to_02_txt}}"></div>
                                                    <div class="col-1">mm.</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-6">
                                                        <input type="checkbox"  id="rigid_bronchoscope_to" name="rigid_bronchoscope_to" class="savejson" {{box(@$case->rigid_bronchoscope_to)}}>
                                                        <label class="form-check-label" for="rigid_bronchoscope_to" style="margin: 0;padding: 0;">Rigid bronchoscope to
                                                    </div>
                                                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_bronchoscope_to_txt" value="{{@$case->rigid_bronchoscope_to_txt}}"></div>
                                                    <div class="col-1">mm.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="align-items: center;">
                                            <div class="col-3">
                                                <input type="checkbox"  id="others_03" name="others_03" class="savejson" {{box(@$case->others_03)}}>
                                                <label class="form-check-label" for="c001" style="margin: 0;padding: 0;">Others
                                            </div>
                                            <div class="col-8" style="padding-left: 5%;">
                                                <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="others_03_txt" value="{{@$case->others_03_txt}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="tumor_removal_at" name="tumor_removal_at" class="savejson boxtoggle" subis="tumor_removal_at" {{box(@$case->tumor_removal_at)}}>
                                        <label class="form-check-label" for="tumor_removal_at" style="margin: 0;padding: 0;">Tumor removal at
                                    </div>
                                    <div class="col-4 tumor_removal_at">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="tumor_removal_at_txt" value="{{@$case->others_03_txt}}">
                                    </div>
                                    <div class="col-6 tumor_removal_at">
                                        <div class="row" style="margin-top: 5px;">
                                            <div class="col-4">
                                                <input type="checkbox" id="electrocauterrization_03" name="electrocauterrization_03" class="savejson" {{box(@$case->electrocauterrization_03)}}>
                                                <label class="form-check-label" for="electrocauterrization_03" style="margin: 0;padding: 0;">Electrocauterrization
                                            </div>
                                            <div class="col-6" style="margin-left: -4%;">
                                                <input type="checkbox" id="lazer_03" name="lazer_03" class="savejson" {{box(@$case->lazer_03)}}>
                                                <label class="form-check-label" for="lazer_03" style="margin: 0;padding: 0;">Laser
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row" style="align-items: center;margin-top:10px;">
                                                    <div class="col-4">
                                                        <input type="checkbox" id="rigid_bronchoscope_03" name="rigid_bronchoscope_03" class="savejson" {{box(@$case->rigid_bronchoscope_03)}}>
                                                        <label class="form-check-label" for="rigid_bronchoscope_03" style="margin: 0;padding: 0;">Rigid bronchoscope
                                                    </div>
                                                    <div class="col-7" style="margin-left: -4%;"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="rigid_bronchoscope_03_txt" value="{{@$case->rigid_bronchoscope_03_txt}}"></div>
                                                    <div class="col-1" style="text-align: center;">mm.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;align-items: unset;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="body_removal_at" name="body_removal_at" class="savejson boxtoggle" subis="body_removal_at" {{box(@$case->body_removal_at)}}>
                                        <label class="form-check-label" for="body_removal_at" style="margin: 0;padding: 0;">Foreign body removal at
                                    </div>
                                    <div class="col-4 body_removal_at">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="body_removal_at_txt" value="{{@$case->body_removal_at_txt}}">
                                    </div>
                                    <div class="col-6 body_removal_at">
                                        <div class="row" style="align-items: center;margin-top: 5px;">
                                            <div class="col-4">
                                                <input type="checkbox"  id="cryotherapy_01" name="cryotherapy_01" class="savejson" {{box(@$case->cryotherapy_01)}}>
                                                <label class="form-check-label" for="cryotherapy_01" style="margin: 0;padding: 0;">Cryotherapy
                                            </div>
                                            <div class="col-4" style="margin-left: -4%;">
                                                <input type="checkbox"  id="electrocauterization" name="electrocauterization" class="savejson" {{box(@$case->electrocauterization)}}>
                                                <label class="form-check-label" for="electrocauterization" style="margin: 0;padding: 0;">Electrocauterization
                                            </div>
                                            <div class="col-4">
                                                <input type="checkbox" id="laser_03" name="laser_03" class="savejson" {{box(@$case->laser_03)}}>
                                                <label class="form-check-label" for="laser_03" style="margin: 0;padding: 0;">laser
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row" style="align-items: center;margin-top: 10px;">
                                                    <div class="col-4">
                                                        <input type="checkbox"  id="others_04" name="others_04" class="savejson" {{box(@$case->others_04)}}>
                                                        <label class="form-check-label" for="others_04" style="margin: 0;padding: 0;">Others
                                                    </div>
                                                    <div class="col-8" style="margin-left: -4%;"><input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="others_04_txt" value="{{@$case->others_04_txt}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;align-items: center;">
                                    <div class="col-12">
                                        <input type="checkbox" id="stent_placement" name="stent_placement" class="savejson boxtoggle" subis="stent_placement" {{box(@$case->stent_placement)}}>
                                        <label class="form-check-label" for="stent_placement" style="margin: 0;padding: 0;">Stent placement
                                    </div>
                                </div>
                                <div class="row stent_placement" style="margin-top: 5px;padding-left:2%;align-items: center;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="smetal_stent" name="smetal_stent" class="savejson" {{box(@$case->smetal_stent)}}>
                                        <label class="form-check-label" for="smetal_stent" style="margin: 0;padding: 0;">SMetal stent
                                    </div>
                                    <div class="col-3" style="margin-left: -2%;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="smetal_stent_txt" value="{{@$case->smetal_stent_txt}}">
                                    </div>
                                    <div class="col-1 text-center">at</div>
                                    <div class="col-6">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="smetal_stent_at" value="{{@$case->smetal_stent_at}}">
                                    </div>
                                </div>
                                <div class="row stent_placement" style="margin-top: 5px;padding-left:2%;align-items: center;">
                                    <div class="col-2">
                                        <input type="checkbox" id="silicone_stent" name="silicone_stent" class="savejson" {{box(@$case->silicone_stent)}}>
                                        <label class="form-check-label" for="silicone_stent" style="margin: 0;padding: 0;">Silicone stent
                                    </div>
                                    <div class="col-3" style="margin-left: -2%;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="silicone_stent_txt" value="{{@$case->silicone_stent_txt}}">
                                    </div>
                                    <div class="col-1 text-center">at</div>
                                    <div class="col-6">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="silicone_stent_at" value="{{@$case->silicone_stent_at}}">
                                    </div>
                                </div>
                                <div class="row stent_placement" style="margin-top: 5px;padding-left:2%;align-items: center;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="y_stent" name="y_stent" class="savejson" {{box(@$case->y_stent)}}>
                                        <label class="form-check-label" for="y_stent" style="margin: 0;padding: 0;">Y stent
                                    </div>
                                    <div class="col-2" style="margin-left: -2%;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="y_stent_txt" value="{{@$case->y_stent_txt}}">
                                    </div>
                                    <div class="col-2 text-center">Length in trachea</div>
                                    <div class="col-1">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="y_stent_in" value="{{@$case->y_stent_in}}">
                                    </div>
                                    <div class="col-1 text-center">cm, Rt main</div>
                                    <div class="col-1">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="y_stent_rt" value="{{@$case->y_stent_rt}}">
                                    </div>
                                    <div class="col-1 text-center">cm, Lt main</div>
                                    <div class="col-1">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="y_stent_cm" value="{{@$case->y_stent_cm}}">
                                    </div>
                                    <div class="col-1 text-center">cm</div>
                                </div>
                                <div class="row stent_placement" style="margin-top: 5px;padding-left:2%;align-items: center;">
                                    <div class="col-2">
                                        <label class="form-check-label" for="" style="margin: 0;padding: 0;">Comment
                                    </div>
                                    <div class="col-10" style="margin-left: -2%;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="comment_txt" value="{{@$case->comment_txt}}">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;align-items: center;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="endobronchial_block_at" name="endobronchial_block_at" class="savejson boxtoggle" subis="endobronchial_block_at" {{box(@$case->endobronchial_block_at)}}>
                                        <label class="form-check-label" for="endobronchial_block_at" style="margin: 0;padding: 0;">Endobronchial Block at
                                    </div>
                                    <div class="col-3 endobronchial_block_at" style="padding-left: 2px;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="endobronchial_block_at_txt" value="{{@$case->endobronchial_block_at_txt}}">
                                    </div>
                                    <div class="col-1 text-center endobronchial_block_at">by</div>
                                    <div class="col-6 endobronchial_block_at" style="padding-right: 40px;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="endobronchial_block_by" value="{{@$case->endobronchial_block_by}}">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;align-items: center;">
                                    <div class="col-2">
                                        <input type="checkbox"  id="others_05" name="others_05" class="savejson boxtoggle" subis="others_05" {{box(@$case->others_05)}}>
                                        <label class="form-check-label" for="others_05" style="margin: 0;padding: 0;">Others
                                    </div>
                                    <div class="col-10 others_05" style="padding-right: 40px;padding-left: 2px;">
                                        <input type="text" name="" class="form-control form-control-sm mr5 savejson autotext" autocomplete="off" id="others_05_txt" value="{{@$case->others_05_txt}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="margin-top: 15px;">3. Specimen</div>
                    <div class="col-12" style="padding-left: 2%;margin-bottom:15px;">
                        <div class="row">
                            <div class="col-4">
                                <input type="checkbox"  id="histopathology_3" name="histopathology_3" class="savejson" {{box(@$case->histopathology_3)}}>
                                <label class="form-check-label" for="histopathology_3" style="margin: 0;padding: 0;">Histopathology
                            </div>
                            <div class="col-4">
                                <input type="checkbox"  id="cytology_3" name="cytology_3" class="savejson" {{box(@$case->cytology_3)}}>
                                <label class="form-check-label" for="cytology_3" style="margin: 0;padding: 0;">Cytology
                            </div>
                            <div class="col-4">
                                <input type="checkbox"  id="culture_3" name="culture_3" class="savejson" {{box(@$case->culture_3)}}>
                                <label class="form-check-label" for="culture_3" style="margin: 0;padding: 0;">Culture
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(".boxtoggle").click(function(){
    let id = $(this).attr("id");
    if($(this).is(':checked')){
        $('.'+id).show();}
    else{
        $('.'+id).hide();}
});
</script>

