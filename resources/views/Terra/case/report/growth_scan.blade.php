<div class="row m-0 mt-3">
    <div class="col-lg-6">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="brief_history" type="checkbox" name="ck_brief_history" id="ck_brief_history" @if(@$json->ck_brief_history!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_brief_history">
                Brief History
            </label>
        </div>
        <input type="text" name="brief_history" id="brief_history" class="form-control set-menu-change {{data_check_active(@$json->ck_brief_history,'auto')}} save-json {{data_check_bg(@$json->brief_history)}}" value="{{@$json->brief_history}}">
    </div>
    <div class="col-lg-6">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="indication" type="checkbox" name="ck_indication" id="ck_indication" @if(@$json->ck_indication!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_indication">
                Indication
            </label>
        </div>
        <input type="text" name="indication" id="indication" class="form-control set-menu-change {{data_check_active(@$json->ck_indication,'auto')}} save-json {{data_check_bg(@$json->indication)}}" value="{{@$json->indication}}">
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_pregnancy" type="checkbox" name="ck_pregnancy" id="ck_pregnancy" @if(@$json->ck_pregnancy!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_pregnancy">
                Pregnancy
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_pregnancy,'auto')}}" id="menu_pregnancy">
            <div class="row">
                <div class="col-lg">
                    Number of fetuses :
                </div>
                <div class="col-lg-4">
                    <input type="number" name="fetuses" id="fetuses" class="form-control save-json {{data_check_bg(@$json->fetuses)}}" value="{{@$json->fetuses}}">
                </div>
                <div class="col-lg">
                    Type of gestation :
                </div>
                <div class="col-lg-4">
                    <input type="text" name="gestation" id="gestation" class="form-control save-json {{data_check_bg(@$json->gestation)}}" value="{{@$json->gestation}}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_dating" type="checkbox" name="ck_dating" id="ck_dating" @if(@$json->ck_dating!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_dating">
                Dating
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_dating,'auto')}}" id="menu_dating">
            <div class="row">
                <div class="col-2">Method of dating</div>
                <div class="col-2">Date</div>
                <div class="col-4">Details</div>
                <div class="col-2">Gest. age</div>
                <div class="col-2">EDD</div>
            </div>
            <div class="row mt-2">
                <div class="col-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input save-json" type="radio" name="radio_dating" id="ck_lmp" value="lmp" @if(@$json->radio_dating=='lmp') checked @endif>
                        <label class="form-check-label" for="ck_lmp">
                            LMP
                        </label>
                    </div>
                </div>
                <div class="col-2"><input type="text" name="lmp_date" id="lmp_date" class="form-control save-json {{data_check_bg(@$json->lmp_date)}}" value="@if(count($dic) != 0) {{$dic['LMP']}} @else {{@$json->lmp_date}} @endif"></div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-3">Cycle</div>
                        <div class="col-3"><input type="text" name="lmp_cycle" id="lmp_cycle" class="form-control save-json {{data_check_bg(@$json->lmp_cycle)}}" value="{{@$json->lmp_cycle}}"></div>
                        <div class="col-auto">Length</div>
                        <div class="col"><input type="number" name="lmp_length" id="lmp_length" class="form-control save-json {{data_check_bg(@$json->lmp_length)}}" value="{{@$json->lmp_length}}"></div>
                        <div class="col">Day</div>
                    </div>
                </div>
                <div class="col-2"><input type="text" name="lmp_age" id="lmp_age" class="form-control save-json {{data_check_bg(@$json->lmp_age)}}" value="{{@$json->lmp_age}}"></div>
                <div class="col-2"><input type="text" name="lmp_egd" id="lmp_egd" class="form-control save-json {{data_check_bg(@$json->lmp_egd)}}" value="{{@$json->lmp_egd}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input save-json" type="radio" name="radio_dating" id="ck_egd" value="egd" @if(@$json->radio_dating=='egd') checked @endif>
                        <label class="form-check-label" for="ck_egd">
                            Stated EDD
                        </label>
                    </div>
                </div>
                <div class="col-2"><input type="text" name="egd_date" id="egd_date" class="form-control save-json {{data_check_bg(@$json->egd_date)}}" value="@if(count($dic) != 0) {{$dic['EDD']}} @else {{@$json->egd_date}}  @endif"></div>
                <div class="col-4"><input type="text" name="egd_detail" id="egd_detail" class="form-control save-json {{data_check_bg(@$json->egd_detail)}}" value="{{@$json->egd_detail}}"></div>
                <div class="col-2"><input type="text" name="egd_age" id="egd_age" class="form-control save-json {{data_check_bg(@$json->egd_age)}}" value="{{@$json->egd_age}}"></div>
                <div class="col-2"><input type="text" name="egd_egd" id="egd_egd" class="form-control save-json {{data_check_bg(@$json->egd_egd)}}" value="{{@$json->egd_egd}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input save-json" type="radio" name="radio_dating" id="ck_us" value="us" @if(@$json->radio_dating=='us') checked @endif>
                        <label class="form-check-label" for="ck_us">
                            U/S
                        </label>
                    </div>
                </div>
                <div class="col-2"><input type="text" name="us_date" id="us_date" class="form-control save-json {{data_check_bg(@$json->us_date)}}" value="{{@$json->us_date}}"></div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-3">Based upon</div>
                        <div class="col-3"><input type="text" name="us_upon" id="us_upon" class="form-control save-json {{data_check_bg(@$json->us_upon)}}" value="{{@$json->us_upon}}"></div>
                    </div>
                </div>
                <div class="col-2"><input type="text" name="us_age" id="us_age" class="form-control save-json {{data_check_bg(@$json->us_age)}}" value="{{@$json->us_age}}"></div>
                <div class="col-2"><input type="text" name="us_egd" id="us_egd" class="form-control save-json {{data_check_bg(@$json->us_egd)}}" value="{{@$json->us_egd}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Assigned dating :</div>
                <div class="col-6"><input type="text" name="assigned" id="assigned" class="form-control save-json {{data_check_bg(@$json->assigned)}}" value="{{@$json->assigned}}"></div>
                <div class="col-2"><input type="text" name="assigned_age" id="assigned_age" class="form-control save-json {{data_check_bg(@$json->assigned_age)}}" value="{{@$json->assigned_age}}"></div>
                <div class="col-2"><input type="text" name="assigned_egd" id="assigned_egd" class="form-control save-json {{data_check_bg(@$json->assigned_egd)}}" value="{{@$json->assigned_egd}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_general_evaluation" type="checkbox" name="ck_general_evaluation" id="ck_general_evaluation" @if(@$json->ck_general_evaluation!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_general_evaluation">
                General Evaluation
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_general_evaluation,'auto')}}" id="menu_general_evaluation">
            <div class="row">
                <div class="col-2">Cardiac activity :</div>
                <div class="col-4"><input type="text" name="cardiac_activity" id="cardiac_activity" class="form-control save-json {{data_check_bg(@$json->cardiac_activity)}}" value="{{@$json->cardiac_activity}}"></div>
                <div class="col-2">Fetal movements :</div>
                <div class="col-4"><input type="text" name="fetal_movements" id="fetal_movements" class="form-control save-json {{data_check_bg(@$json->fetal_movements)}}" value="{{@$json->fetal_movements}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">FHR :</div>
                <div class="col-2"><input type="number" name="fhr" id="fhr" class="form-control save-json {{data_check_bg(@$json->fhr)}}" value="{{@$json->fhr}}"></div>
                <div class="col-2">bpm</div>
                <div class="col-2">Presentation :</div>
                <div class="col-4"><input type="text" name="presentation" id="presentation" class="form-control save-json {{data_check_bg(@$json->presentation)}}" value="{{@$json->presentation}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Placenta :</div>
                <div class="col"><input type="text" name="placenta" id="placenta" class="form-control save-json {{data_check_bg(@$json->placenta)}}" value="{{@$json->placenta}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Umbilical Cord :</div>
                <div class="col"><input type="text" name="umbilical_cord" id="umbilical_cord" class="form-control save-json {{data_check_bg(@$json->umbilical_cord)}}" value="{{@$json->umbilical_cord}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Amniotic Fluid :</div>
                <div class="col"><input type="text" name="amniotic_fluid" id="amniotic_fluid" class="form-control save-json {{data_check_bg(@$json->amniotic_fluid)}}" value="{{@$json->amniotic_fluid}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_non_stress_test" type="checkbox" name="ck_non_stress_test" id="ck_non_stress_test" @if(@$json->ck_non_stress_test=='true') checked @endif>
            <label class="form-check-label label-underline" for="ck_non_stress_test">
                Non Stress Test
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_non_stress_test,'none')}}" id="menu_non_stress_test">
            <div class="row">
                <div class="col-2">NST interpretation</div>
                <div class="col-1"><input type="text" name="nst_num" id="nst_num" class="form-control save-json {{data_check_bg(@$json->nst_num)}}" value="{{@$json->nst_num}}"></div>
                <div class="col-3"><input type="text" name="nst_text" id="nst_text" class="form-control save-json {{data_check_bg(@$json->nst_text)}}" value="{{@$json->nst_text}}"></div>
                <div class="col-2">Accelerations</div>
                <div class="col-1"><input type="text" name="accelerations_num" id="accelerations_num" class="form-control save-json {{data_check_bg(@$json->accelerations_num)}}" value="{{@$json->accelerations_num}}"></div>
                <div class="col-3"><input type="text" name="accelerations_text" id="accelerations_text" class="form-control save-json {{data_check_bg(@$json->accelerations_text)}}" value="{{@$json->accelerations_text}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Test duration :</div>
                <div class="col-2"><input type="number" name="test_duration" id="test_duration" class="form-control save-json {{data_check_bg(@$json->test_duration)}}" value="{{@$json->test_duration}}"></div>
                <div class="col-2">min</div>
                <div class="col-2">Decelerations :</div>
                <div class="col-4"><input type="text" name="decelerations" id="decelerations" class="form-control save-json {{data_check_bg(@$json->decelerations)}}" value="{{@$json->decelerations}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Baseline FHR :</div>
                <div class="col-2"><input type="number" name="baseline_fhr" id="baseline_fhr" class="form-control save-json {{data_check_bg(@$json->baseline_fhr)}}" value="{{@$json->baseline_fhr}}"></div>
                <div class="col-2">bpm</div>
                <div class="col-2">Uterine activity :</div>
                <div class="col-4"><input type="text" name="uterine_activity" id="uterine_activity" class="form-control save-json {{data_check_bg(@$json->uterine_activity)}}" value="{{@$json->uterine_activity}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Baseline variability :</div>
                <div class="col-4"><input type="text" name="baseline_variability" id="baseline_variability" class="form-control save-json {{data_check_bg(@$json->baseline_variability)}}" value="{{@$json->baseline_variability}}"></div>
                <div class="col-2">CTG category :</div>
                <div class="col-4"><input type="text" name="ctg_category" id="ctg_category" class="form-control save-json {{data_check_bg(@$json->ctg_category)}}" value="{{@$json->ctg_category}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Acoustic stimulation :</div>
                <div class="col-auto">
                    <div class="form-check mb-2">
                        <input class="form-check-input save-json" type="radio" name="stimulation" id="stimulation_yes" value="yes" @if(@$json->stimulation=='yes') checked @endif>
                        <label class="form-check-label" for="stimulation_yes">
                            Yes
                        </label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check mb-2">
                        <input class="form-check-input save-json" type="radio" name="stimulation" id="stimulation_no" value="no" @if(@$json->stimulation=='no') checked @endif>
                        <label class="form-check-label" for="stimulation_no">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Other :</div>
                <div class="col"><input type="text" name="non_stress_test_other" id="non_stress_test_other" class="form-control save-json {{data_check_bg(@$json->non_stress_test_other)}}" value="{{@$json->non_stress_test_other}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_biophysical_profilet" type="checkbox" name="ck_biophysical_profile" id="ck_biophysical_profile" @if(@$json->ck_biophysical_profile=='true') checked @endif>
            <label class="form-check-label label-underline" for="ck_biophysical_profile">
                Biophysical Profile
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_biophysical_profile,'none')}}" id="menu_biophysical_profilet">
            <div class="row">
                <div class="col-2">Breating movements :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_movements" id="biophysical_profile_movements" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_movements)}}" value="{{@$json->biophysical_profile_movements}}"></div>
                <div class="col-2">NST :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_nts" id="biophysical_profile_nts" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_nts)}}" value="{{@$json->biophysical_profile_nts}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Body movements :</div>
                <div class="col-4"><input type="text" name="body_movements" id="body_movements" class="form-control save-json {{data_check_bg(@$json->body_movements)}}" value="{{@$json->body_movements}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Fetal tone :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_tone" id="biophysical_profile_tone" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_tone)}}" value="{{@$json->biophysical_profile_tone}}"></div>
                <div class="col-2">Total score :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_score" id="biophysical_profile_score" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_score)}}" value="{{@$json->biophysical_profile_score}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">AF volume :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_af" id="biophysical_profile_af" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_af)}}" value="{{@$json->biophysical_profile_af}}"></div>
                <div class="col-2">Interpretation :</div>
                <div class="col-4"><input type="text" name="biophysical_profile_interpretation" id="biophysical_profile_interpretation" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_interpretation)}}" value="{{@$json->biophysical_profile_interpretation}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Other :</div>
                <div class="col-10"><input type="text" name="biophysical_profile_other" id="biophysical_profile_other" class="form-control save-json {{data_check_bg(@$json->biophysical_profile_other)}}" value="{{@$json->biophysical_profile_other}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_fetal_biometry" type="checkbox" name="ck_fetal_biometry" id="ck_fetal_biometry" @if(@$json->ck_fetal_biometry!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_fetal_biometry">
                Fetal Biometry
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_fetal_biometry,'auto')}}" id="menu_fetal_biometry">
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless bg-light fetal-biometry">
                        @php
                            $bpd = isset($dic['BPD']) && $dic['BPD'] != '' ? explode(' ',$dic['BPD']) : null;
                            $hc = isset($dic['HC']) && $dic['HC'] != '' ? explode(' ', $dic['HC']) : null;
                            $ac = isset($dic['AC']) && $dic['AC'] != '' ? explode(' ', $dic['AC'] ): null;
                            $fl = isset($dic['FL']) && $dic['FL'] != '' ? explode(' ', $dic['FL'] ): null;
                            $efw = isset($dic['EFW']) && $dic['EFW'] != '' ? explode(' ', $dic['EFW']) : null;

                        @endphp
                        {{-- @dd($bpd, $hc, $ac, $fl, $efw) --}}
                        <tr>
                            <td>BPD</td>
                            <td class="text-right">@if(isset($bpd[0])) {{$bpd[0]}} @else 94.3 @endif</td>
                            <td>@if(isset($bpd[1])) {{$bpd[1]}} @else mm @endif</td>
                            <td>@if(isset($bpd[2])) {{$bpd[2]}} @else 40w 3d  @endif</td>
                            <td>99%</td>
                            <td>@if(isset($bpd[3])) {{$bpd[3]}} @else Thai Siriraj selection @endif</td>
                        </tr>
                        <tr>
                            <td>HC</td>
                            <td class="text-right">@if(isset($hc[0])) {{$hc[0]}} @else 331.1 @endif</td>
                            <td>@if(isset($hc[1])) {{$hc[1]}} @else mm @endif</td>
                            <td>@if(isset($hc[2])) {{$hc[2]}} @else 40w 6d  @endif</td>
                            <td>94%</td>
                            <td>@if(isset($hc[3])) {{$hc[3]}} @else Thai Siriraj selection @endif</td>
                        </tr>
                        <tr>
                            <td>AC</td>
                            <td class="text-right">@if(isset($ac[0])) {{$ac[0]}} @else 354.7 @endif</td>
                            <td>@if(isset($ac[1])) {{$ac[1]}} @else mm @endif</td>
                            <td>@if(isset($ac[2])) {{$ac[2]}} @else 39w 6d  @endif</td>
                            <td>97%</td>
                            <td>@if(isset($ac[3])) {{$ac[3]}} @else Thai Siriraj selection @endif</td>
                        </tr>
                        <tr>
                            <td>femur</td>
                            <td class="text-right">@if(isset($fl[0])) {{$fl[0]}} @else 354.7 @endif</td>
                            <td></td>
                            <td>@if(isset($fl[1])) {{$fl[1]}} @else 39w 6d  @endif</td>
                            <td>18%</td>
                            <td>@if(isset($fl[2])) {{$fl[2]}} @else Thai Siriraj selection @endif</td>
                        </tr>
                    </table>
                </div>
                <div class="col-12">
                    Fetal Weight Calculation :
                    <table class="table table-borderless bg-light fetal-biometry">
                        <tr>
                            <td>EFW</td>
                            <td class="text-right">@if(isset($efw[0])) {{str_replace("g","",$efw[0])}} @else 3.312 @endif</td>
                            <td>g</td>
                            <td>38w 3 d</td>
                            <td>52%</td>
                            <td>Hadlock</td>
                        </tr>
                        <tr>
                            <td>EFW (lb,oz)</td>
                            <td class="text-right">7lb 5</td>
                            <td>oz</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EFW by</td>
                            <td class="text-right">Hadlock(BPD-HC-AC-FL)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="col-2">Other :</div>
                <div class="col-10"><input type="text" name="fetal_biometry_other" id="fetal_biometry_other" class="form-control save-json {{data_check_bg(@$json->fetal_biometry_other)}}" value="{{@$json->fetal_biometry_other}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_fetal_doppler" type="checkbox" name="ck_fetal_doppler" id="ck_fetal_doppler" @if(@$json->ck_fetal_doppler!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_fetal_doppler">
                Fetal Doppler
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_fetal_doppler,'auto')}}" id="menu_fetal_doppler">
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless bg-light fetal-biometry">
                        <tr class="border-bottom">
                            Umbilical Artery :
                        </tr>
                        <tr>
                            <td>PI</td>
                            <td class="text-right">0.76</td>
                            <td></td>
                            <td></td>
                            <td>46%</td>
                            <td>Acharya</td>
                        </tr>
                        <tr>
                            <td>RI</td>
                            <td class="text-right">0.53</td>
                            <td></td>
                            <td></td>
                            <td>41%</td>
                            <td>Acharya</td>
                        </tr>
                        <tr>
                            <td>PS</td>
                            <td class="text-right">34.65</td>
                            <td>cm/s</td>
                            <td></td>
                            <td>4%</td>
                            <td>Ebbing</td>
                        </tr>
                        <tr>
                            <td>ED</td>
                            <td class="text-right">16.23</td>
                            <td>cm/s</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>TAmax</td>
                            <td class="text-right">24.15</td>
                            <td>cm/s</td>
                            <td></td>
                            <td>5%</td>
                            <td>Ebbing</td>
                        </tr>
                        <tr>
                            <td>MD</td>
                            <td class="text-right">13.29</td>
                            <td>cm/s</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>S / D</td>
                            <td class="text-right">2.13</td>
                            <td></td>
                            <td></td>
                            <td>38%</td>
                            <td>Acharya</td>
                        </tr>
                        <tr>
                            <td>HR</td>
                            <td class="text-right">129</td>
                            <td>bpm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                        <table class="table table-borderless bg-light fetal-biometry">
                        <tr class="border-bottom">
                        Right Mid Cerebral Artery :
                        </tr>
                        <tr>
                            <td>PI</td>
                            <td class="text-right">1.09</td>
                            <td></td>
                            <td></td>
                            <td>2%</td>
                            <td>Ebbing</td>
                        </tr>
                        <tr>
                            <td>RI</td>
                            <td class="text-right">0.67</td>
                            <td></td>
                            <td></td>
                            <td>35%</td>
                            <td><u>Bahlmann</u></td>
                        </tr>
                        <tr>
                            <td>PS</td>
                            <td class="text-right">80.12</td>
                            <td>cm/s</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ED</td>
                            <td class="text-right">26.47</td>
                            <td>cm/s</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>TAmax</td>
                            <td class="text-right">49.24</td>
                            <td>cm/s</td>
                            <td></td>
                            <td>+3.1SD</td>
                            <td>Ebbing</td>
                        </tr>
                        <tr>
                            <td>MD</td>
                            <td class="text-right">22.39</td>
                            <td>cm/s</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>S / D</td>
                            <td class="text-right">3.03</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>HR</td>
                            <td class="text-right">131</td>
                            <td>bpm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-2">Impression :</div>
                <div class="col-10"><input type="text" name="fetal_doppler_impression" id="fetal_doppler_impression" class="form-control save-json {{data_check_bg(@$json->fetal_doppler_impression)}}" value="{{@$json->fetal_doppler_impression}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Other :</div>
                <div class="col-10"><input type="text" name="fetal_doppler_other" id="fetal_doppler_other" class="form-control save-json {{data_check_bg(@$json->fetal_doppler_other)}}" value="{{@$json->fetal_doppler_other}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_maternal_doppler" type="checkbox" name="ck_maternal_doppler" id="ck_maternal_doppler" @if(@$json->ck_maternal_doppler=='true') checked @endif>
            <label class="form-check-label label-underline" for="ck_maternal_doppler">
                Maternal Doppler
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_maternal_doppler,'none')}}" id="menu_maternal_doppler">
            <div class="row">
                <div class="col-12">
                    <input type="text" name="maternal_doppler" id="maternal_doppler" class="form-control save-json {{data_check_bg(@$json->maternal_doppler)}}" value="{{@$json->maternal_doppler}}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Impression :</div>
                <div class="col-10"><input type="text" name="maternal_doppler_impression" id="maternal_doppler_impression" class="form-control save-json {{data_check_bg(@$json->maternal_doppler_impression)}}" value="{{@$json->maternal_doppler_impression}}"></div>
            </div>
            <div class="row mt-2">
                <div class="col-2">Other :</div>
                <div class="col-10"><input type="text" name="maternal_doppler_other" id="maternal_doppler_other" class="form-control save-json {{data_check_bg(@$json->maternal_doppler_other)}}" value="{{@$json->maternal_doppler_other}}"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="impression" type="checkbox" name="ck_impression" id="ck_impression" @if(@$json->ck_impression!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_impression">
                Impression
            </label>
        </div>
        <input type="text" name="impression" id="impression" class="form-control set-menu-change {{data_check_active(@$json->ck_impression,'auto')}} save-json {{data_check_bg(@$json->impression)}}" value="{{@$json->impression}}">
    </div>
    <div class="col-lg-6 mt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="comment" type="checkbox" name="ck_comment" id="ck_comment" @if(@$json->ck_comment!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_comment">
                Comment
            </label>
        </div>
        <input type="text" name="comment" id="comment" class="form-control set-menu-change {{data_check_active(@$json->ck_comment,'auto')}} save-json {{data_check_bg(@$json->comment)}}" value="{{@$json->comment}}">
    </div>
    <div class="col-lg-12 mt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="follow_up" type="checkbox" name="ck_follow_up" id="ck_follow_up" @if(@$json->ck_follow_up!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_follow_up">
                Follow up
            </label>
        </div>
        <input type="text" name="follow_up" id="follow_up" class="form-control set-menu-change {{data_check_active(@$json->ck_follow_up,'auto')}} save-json {{data_check_bg(@$json->follow_up)}}" value="{{@$json->follow_up}}">
    </div>
</div>

