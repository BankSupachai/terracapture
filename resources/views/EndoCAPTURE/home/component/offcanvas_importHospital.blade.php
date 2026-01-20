
<style>

    .border-bottom-solid{
        border-bottom: 1px solid #fff;
        opacity: 20%;
    }
    .box {
        width: 225px;
        height: 41px;
        border-radius: 16px;
    }

    .dotted {
        border: dotted 3px #E9EBEC;
    }
    .offcanvas-body tbody, .offcanvas-body td, .offcanvas-body tfoot, .offcanvas-body th, .offcanvas-body thead, .offcanvas-body tr {
        border-style: none !important;
    }
    .btn-cancel{
        background: #193d61;
        color: #fff;
    }
    .btn-cancel:hover{
        background: #193d61;
        color: #fff;
        border: 1px solid #fff;
    }
    .import-table-scroll{
        height: 74vh;
        overflow: auto;
    }
    .table-hover>tbody>tr:hover>* {
    --vz-table-accent-bg: #ffffff1A ;
    color: #fff;
}
.offcanvas-body .select2-container--default .select2-selection--single  {
    background: #193d61 !important;
}
.offcanvas-body .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #ffffff !important;
}
.offcanvas-body .select2-container--default .select2-results>.select2-results__options {
    background: #193d61 !important;
}
.offcanvas-body .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: #ffffff33 !important;

}
.offcanvas-body .select2-results__option {
    color: #ffffff !important;
}
.offcanvas-body .select2-container--default .select2-search--dropdown {
    background: #193d61 !important;
    border-radius: 0px !important;
}
.offcanvas-body .select2-dropdown{
    border: 0;
}
.offcanvas-body span.select2-search .select2-search--dropdown{
    border-radius: 0px !important;
}
.offcanvas-body .select2-container--default .select2-search--dropdown .select2-search__field {
    border: 0 !important;
    background: #245788 !important;
    color: #ffffff;
}
</style>

<div class="offcanvas offcanvas-end w-75" style="background: #245788;" tabindex="-1" id="importlisthos" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header p-3">
        <h5 id="offcanvasRightLabel" class="text-white"> <i class=" ri-download-2-fill"></i>&ensp; Import Case (Hospital System)</h5>
        <button type="button" class="btn btn-ghost-light" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="row">
            <div class="col-auto" id="file_inputs_div" style="display: none">
                <form action="{{ url('api') }}/home" method="POST" id="file_inputs_form" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="event" value="upload_file_excel">

                </form>
            </div>

            <div class="col-1">
                <div class="spinner-border text-light ms-3" role="status" id="loading" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-3" id="file_names_div" >

            </div>
            <div class="col-2">
                <button type="button" id="clear_btn" class="btn btn-danger  waves-effect waves-light p-1 w-100 " style="margin-right: 9px;margin-top:3px; display: none"><i class=" ri-delete-bin-2-fill me-2"></i> Clear All</button>
            </div>
        </div>
        <div class="border-bottom-solid"></div>
        <div class="row p-2" >
            @if(@$feature->worklist)
            <div class="col-2 ">
                <button type="button" id="update_worklist_btn" class="btn btn-success btn-load waves-effect waves-light p-1 w-100 " style="margin-left: 9px;">
                    <span class="d-flex align-items-center">
                        <span class="flex-grow-1 ms-2">
                            UPDATE Worklist
                        </span>
                        <span class="spinner-border flex-shrink-0" role="status" id="loading_worklist" style="display:  none">
                            <span class="visually-hidden">UPDATE Worklist</span>
                        </span>
                    </span>
                </button>
            </div>
            <div class="col-2 wk-warning mt-2" style="display:none;color:white">
                กรุณาตรวจสอบสาย LAN
            </div>
            @endif

            @if(uget('department') == 'GYNE')
                <div class="col-2 mt-1">
                    <input class="form-check-input" id="only_colpo" type="checkbox" @if(uget('department') == 'GYNE') checked @endif>
                    <label class="form-check-label text-white" for="only_colpo">
                        Only Colposcopy
                    </label>
                </div>
            @endif



            @if(@$feature->apiappointment)
                <div class="col-2">
                    <button type="button" id="btn_update_appoint" class="btn btn-info  waves-effect waves-light p-1 w-100 " style="margin-left: 9px;"><i class="ri-refresh-line me-2"></i> Update Appoint</button>
                </div>
            @endif

            <div class="col-2">
                <input type="text" autocomplete="off" id="search_worklist" placeholder="Hn..." class="form-control " style="background: #193d61; border: 0px ;height: 31px; color: #fff">
            </div>





            <div class="col-12 import-table-scroll mt-2">
                <table class="table table-nowrap  table-hover" id="worklist_table">
                    <thead>
                        <tr class="text-white fw-normal" style=>
                            <td class="radio">HN</td>
                            <td class="radio">Name</td>
                            <td class="radio"style="width: 30%;" >Physician</td>
                            <td class="radio" style="width: 30%;">Procedure</td>
                            <td class="text-end" style="width: 45%;">Import</td>
                        </tr>
                    </thead>

                    <tbody class=" radio text-white fw-light "  id="table_appointment" >
                    </tbody>

                    <tbody class=" radio text-white fw-light "  id="worklist_tbody" >
                            @php
                            $i = 0;
                            @endphp
                        @foreach ($case_worklist as $j=>$list)
                        @php $index_id      = $i."A";  @endphp
                        @php
                                $list               = (object) $list;
                                $hn                 = isset($list->patientid) ? $list->patientid : '';
                                $patientname        = isset($list->patient_nameTH) && @$list->patient_nameTH."" != "" ? $list->patient_nameTH : $list->patientname;
                                $doctorname         = isset($list->doctorname)  ? $list->doctorname  : '';
                                $physicianname      = isset($list->physicianname)? $list->physicianname : '';
                                $prediagnosis       = isset($list->prediagnosis) && @$list->prediagnosis."" != "" ? $list->prediagnosis : '';
                                $patienteng         = isset($list->patientname) && @$list->patientname."" != "" ? $list->patientname : '';
                                $visitno            = isset($list->visitno) && @$list->visitno."" != "" ? $list->visitno : '';
                                $time               = isset($list->time) && @$list->time."" != "" ? format_datestr($list->time) : '';
                                $accessionnumberstr = isset($list->accessionnumber) && @$list->accessionnumber."" != "" ? $list->accessionnumber : '';
                                $procedurestr       = isset($list->proceduredescription) && @$list->proceduredescription ."" != "" ? $list->proceduredescription  : '';
                                $match_procedure    = isset($list->match_procedure) && @$list->match_procedure != "" ? $list->match_procedure  : [];
                                $match_physician    = isset($list->match_physician) && @$list->match_physician ."" != "" ? $list->match_physician  : '';
                                @endphp
                            <tr class="worklist-tr" id="worklist{{$index_id}}" data-hn="{{@$hn}}" data-patientname="{{@$patientname}}" data-doctorname="{{@$doctorname}}" data-procedure="{{@$procedurestr}}" data-prediagnosis="{{@$prediagnosis}}" data-accessionnumber="{{@$accessionnumberstr}}" data-patienteng="{{@$patienteng}}" data-visitno="{{@$visitno}}" data-time="{{@$time}}">
                                <td class="ft-hn">
                                    <span  id="hn_{{@$index_id}}" @if(@$accessionnumberstr == "") style="color:yellow;" @endif>{{@$hn}}</span>
                                </td>
                                <td>
                                    <span id="patientname_{{@$index_id}}" @if(@$accessionnumberstr == "") style="color:yellow;" @endif>{{@$patientname}}</span>
                                </td>
                                <td style="width: 30%">

                                    <span id="doctorname_{{@$index_id}}xxx">{{$physicianname}}</span>
                                    <div id="userdiv{{@$index_id}}">
                                        <select name="user" id="user{{@$index_id}}" class="form-select mb-3  search-input" style="display: none" onchange="change_user('{{@$index_id}}')">
                                            @isset($doctor)
                                                @foreach ($doctor as $index=>$u)
                                                    @if($index==0)
                                                    <option data-procedure="none" value="none"  >Select Physician</option>
                                                    @else
                                                    <option data-doctorid="{{@$u['id']}}" value="{{@$u['user_prefix']}} {{@$u['user_firstname']}} {{@$u['user_lastname']}}" @if($u['id'] == $match_physician) selected @endif>{{@$u['user_prefix']}} {{@$u['user_firstname']}} {{@$u['user_lastname']}}</option>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <span id="userwarning_{{@$index_id}}" style="color: red; display: none" >Please select physician</span>
                                </td>
                                <td style="width: 30%">
                                    <span id="procedurestr_{{@$index_id}}">{{ @$procedurestr }}</span>
                                    <span data-procedurestr="{{ @$procedurestr }}"  id="procedure_{{@$index_id}}" style="display: none">
                                        {{ @$procedurestr }}
                                    </span>
                                    <div id="procedurediv{{@$index_id}}">
                                        <select name="procedure[]" id="procedure{{@$index_id}}" class="form-select mb-3 search-input" style="display: none" multiple="multiple" onchange="change_proc('{{@$index_id}}')">
                                            <option value="">&nbsp;Procedure</option>
                                            @isset($procedure)
                                                @foreach ($procedure as $p)
                                                    <option data-procedure="{{@$p['code']}}" value="{{@$p['name']}}"  @if(in_array($p['name'], $match_procedure)) selected @endif >{{@$p['name']}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <span id="procwarning_{{@$index_id}}" style="color: red; display: none">Please select procedure</span>
                                </td>
                                <td class="text-end">
                                   <button  id="importwk{{@$index_id}}" class="btn btn-danger btn-icon import-worklist" data-index="{{@$index_id}}" onclick="import_case('{{@$index_id}}')">
                                    <i id="istart{{@$index_id}}" class="ri-download-2-fill ri-lg"></i>
                                    <div id="isloading{{@$index_id}}" class="spinner-border text-light" role="status" style="width:20px;height:20px;display:none">
                                        <span class="visually-hidden">Loading...</span>
                                      </div>
                                    <i id="isuccess{{@$index_id}}" class="ri-check-double-fill ri-lg text-white" style="display:none"></i>
                                    </button>

                                </td>
                            </tr>
                            @php $i = $i + 1; @endphp
                            @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-12 text-end pt-1"  id="action_btn_div">
            <button type="button" id="upload_all_btn" class="btn btn-success  waves-effect me-3 waves-light p-1 w-lg " onclick="window.location.reload();" disabled><i class="ri-check-double-fill me-2" ></i>Confirm</button>
        </div>

    </div>
</div>
<script>
     $("#search_worklist").on("input", function() {
        let value = String($('#search_worklist').val()).toLowerCase();
        let id    =  'worklist_tbody'
        $(`#${id} tr`).filter(function(i, e) {
            $(this).toggle($(this).find('.ft-hn').text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
