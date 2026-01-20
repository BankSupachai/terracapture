<div class="modal fade" id="more_icd_10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="text-right border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>&nbsp;
                </button>
            </div>
            <div class="modal-body" id='fancy-text'>
                <div class="row m-0 cn">
                    <div class="col-lg-4">
                        <h3>POST-Diagnosis (ICD-10)</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-icon input-icon-right">
                            <input type="text" class="form-control form-control-lg" placeholder="Search..."
                                id='fancy-input' />
                            <span><i class="flaticon2-search-1 icon-md"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-lg-5">
                        <h4>Esophagus</h4>
                        <table class="table table-borderless liheight_modal">
                            @foreach ($diagnostic as $di)
                                <tr id="set_data_{{ $di->diagnostic_id }}">
                                    <td class="vtc">
                                        <input type="checkbox" name="diagnostic"
                                            class="savejson_checkbox boxicd10 d-show"
                                            id="diagnostic_{{ $di->diagnostic_id }}" value="{{ $di->diagnostic_id }}">
                                    </td>
                                    <td>
                                        <label for="diagnostic_{{ $di->diagnostic_id }}"
                                            class="set_show_{{ $di->diagnostic_id }} d-show data_key">&nbsp;{{ $di->diagnostic_name }}</label>
                                        <input type="text" name="" id=""
                                            class="set_edit_{{ $di->diagnostic_id }} text_{{ $di->diagnostic_id }} d-hide form-control form-control-sm"
                                            value="{{ $di->diagnostic_name }}">
                                    </td>
                                    <td>
                                        <b
                                            class="set_show_{{ $di->diagnostic_id }} d-show data_key">{{ @$di->icd10 }}</b>
                                        <input type="text" name="" id=""
                                            class="set_edit_{{ $di->diagnostic_id }} text_{{ $di->diagnostic_id }} d-hide form-control form-control-sm"
                                            value="{{ @$di->icd10 }}">
                                    </td>
                                    <td class="vtc">
                                        <i class="far fa-star" status='0'></i>
                                    </td>
                                    <td class="vtc">
                                        <i class="fas fa-terminal d-show bt_edit set_show_{{ $di->diagnostic_id }}"
                                            sub_id="{{ $di->diagnostic_id }}"></i>
                                        <i class="fas fa-times text-danger  d-hide set_edit_{{ $di->diagnostic_id }}"
                                            onclick="del_icd('set_data_{{ $di->diagnostic_id }}')"></i>
                                    </td>
                                    <td class="vtc">
                                        <i class="fas fa-check text-success d-hide bt_success set_edit_{{ $di->diagnostic_id }}"
                                            sub_id="{{ $di->diagnostic_id }}"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-lg-7 h-100">
                        <div class="row pd_col">
                            <div class="col-12">&nbsp;<br></div>
                            <div class="col-4">Primary Diagnostic</div>
                            <div class="col-8 pt-1">
                                @php
                                    if (isset($case->texticd10)) {
                                        $icd10value = jsonDecode($case->texticd10);
                                    }
                                @endphp
                                <input type="text" name="texticd10" value="{{ @$icd10value[0] }}" id="cd11"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>
                            <div class="col-4 pt-1">Secondary Diagnostic</div>
                            <div class="col-8 pt-1">
                                <input type="text" name="texticd10" value="{{ @$icd10value[1] }}" id="cd12"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>
                            <div class="col-4 pt-1">Add Diagnostic</div>
                            <div class="col-8 pt-1">
                                <input type="text" name="texticd10" value="{{ @$icd10value[2] }}" id="cd13"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>
                            <div class="col-4 pt-1">Add Diagnostic</div>
                            <div class="col-8 pt-1">
                                <input type="text" name="texticd10" value="{{ @$icd10value[3] }}" id="cd14"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>


                            <div class="col-4">Add Diagnostic</div>
                            <div class="col-8">
                                <input type="text" name="texticd10" value="{{ @$icd10value[4] }}" id="cd15"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>

                            <div class="col-4">Add Diagnostic</div>
                            <div class="col-8">
                                <input type="text" name="texticd10" value="{{ @$icd10value[5] }}" id="cd16"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>

                            <div class="col-4">Add Diagnostic</div>
                            <div class="col-8">
                                <input type="text" name="texticd10" value="{{ @$icd10value[6] }}" id="cd17"
                                    class="form-control texticd10test autotext" autocomplete="off">
                            </div>

                            <div class="col-4">ICD-10 Diagnostic</div>
                            <div class="col-8"><input type="text" name="texticd10"
                                    value="{{ @$icd10value[7] }}" id="cd18" class="form-control texticd10test autotext"
                                    autocomplete="off"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
