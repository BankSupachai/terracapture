@php
    use App\Models\Mongo;
    $searchAnesTechnique= file_get_contents(htdocs("config/or/searchAnesTechnique.json"));
    $searchORTeam       = file_get_contents(htdocs("config/or/searchORTeam.json"));
    $searchSDLOCOR      = file_get_contents(htdocs("config/or/searchSDLOCOR.json"));
    $anes               = jsonDecode($searchAnesTechnique);
    $clinic             = jsonDecode($searchORTeam);
    $department         = jsonDecode($searchSDLOCOR);
@endphp

{{-- <div class="card">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-12" style="height:100%;">
                <button id="btn_ordata_modal" class="btn btn-danger text-center" style="width: 100%;height:100%;">
                    <i class="far fa-file-pdf"></i><br> OR DATA
                </button>
            </div>
        </div>
    </div>
</div> --}}



<div class="modal fade" id="modal_ordata_from" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xxl" role="document" style="max-width: 80% !important;">
        <div class="modal-content" style="box-shadow: none; border: none;">
            <div class="modal-body">
                <h1>OR Data</h1>
                <div class="row">
                    <div class="col-5 border-right border-light">
                        <div class="row">
                            <div class="col-12">
                                <b>User KeyIN</b>
                                <input id="ordata_userkeyin" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="col-12">
                                <b>Attendant</b>
                                <select class="form-control selectpicker" id="select_users" name="part" data-live-search="true">
                                    <option value="0">Select Users</option>
                                    @php
                                        if (isset($casedata->user_in_case)) {
                                            $lists = array();

                                            foreach($casedata->user_in_case as $data){
                                                $lists[] = (int) $data;
                                            }


                                            $user_list = Mongo::table('users')
                                                ->whereIn('id', $lists)
                                                ->get();
                                        }
                                    @endphp

                                    @if (isset($users))
                                        @foreach ($users as $data)
                                            @php
                                                $data = (object) $data;
                                            @endphp

                                            <option
                                                value       ="{{ @$data->id }}"
                                                data-tokens ="{{ @$data->id }}"
                                                data-name   ="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                data-type   ="{{ @$data->user_type }}"
                                                data-tab    ="{{ @$data->id }}">
                                                {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{@$data->user_code}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- <div class="row">
                                    .col
                                </div> --}}
                                <input type="hidden" name="user_in_case" id="user_in_case" class="user_in_case" value="{{@$json->user_in_case}}">
                                <div class="row m-0 scroll-list" id="scroll_list">
                                    @if (isset($user_list))
                                        @foreach ($user_list as $cl)
                                            @php
                                                $cl = (object) $cl;
                                            @endphp
                                            <div class="col-7 pt-2"
                                                sub-tab="{{ @$cl->id }}">{{ @$cl->user_prefix }}{{ @$cl->user_firstname }} {{ @$cl->user_lastname }}</div>
                                            <div class="col-3 pt-2" sub-tab="{{ @$cl->id }}">{{ @$cl->user_type }}</div>
                                            <div class="col-2 pt-2"
                                                sub-tab="{{ @$cl->id }}"><i
                                                class="mdi mdi-trash-can text-danger"
                                                onclick='del_list({{ @$cl->id }})'
                                                aria-hidden="true"></i>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                Department
                                <select id="ordatadepartment" class="form-control" data-choices>
                                    <option value="">Select</option>
                                    @foreach ($department->data->sdlocOR as $dpm)
                                        @if($dpm->sdloc==@$casedata->ordatadepartment)
                                            <option value="{{$dpm->sdloc}}" selected>{{$dpm->desc}}</option>
                                        @else
                                            <option value="{{$dpm->sdloc}}">{{$dpm->desc}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                Clinic
                                <select id="ordataclinic" class="form-control" data-choices>
                                    <option value="">Select</option>
                                    @foreach ($clinic->data->SDOGI01 as $cln)
                                        @if($cln->id==@$casedata->ordataclinic)
                                            <option value="{{$cln->id}}" selected>{{$cln->unit}}</option>
                                        @else
                                            <option value="{{$cln->id}}">{{$cln->unit}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                Anes Technic
                                <select id="ordatatechanes" class="form-control" data-choices>
                                    <option value="">Select</option>
                                    @foreach ($anes->data->anestech as $an)
                                        @if($an->desc==@$casedata->ordatatechanes)
                                            <option value="{{$an->desc}}" selected>{{$an->desc}}</option>
                                        @else
                                            <option value="{{$an->desc}}">{{$an->desc}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col pl-5">
                        <div class="row mt-5 pl-5">
                            <div class="col-12 border border-primary rounded">
                                ICD10 PRE-diagnostic
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th>code</th>
                                            <th>codeseq</th>
                                            <th>descript</th>
                                            <th>&emsp;</th>
                                            <th>gen_desc</th>
                                            <th>&emsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="icd10_ordataselect_pre">
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 mt-3 border border-warning rounded">
                                ICD10 POST-diagnostic
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th>code</th>
                                            <th>codeseq</th>
                                            <th>descript</th>
                                            <th>&emsp;</th>
                                            <th>gen_desc</th>
                                            <th>&emsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="icd10_ordataselect_post">
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 mt-3 border border-dark rounded">
                                ICD9 PROCEDURE
                                <table class="table table-borderless table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>code</th>
                                            <th>codeseq</th>
                                            <th>descript</th>
                                            <th>&emsp;</th>
                                            <th>gen_desc</th>
                                            <th>&emsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="icd9_ordataselect">
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 pt-5 border-top border-light px-0">
                                <div class="row m-0">

                                    <div class="col-12 p-0">
                                        <input id="ordata_icd10_txt_pre" type="text" class="form-control" placeholder="ICD10 PRE-diagnostic" autocomplete="off">
                                    </div>
                                    <div class="col-12 p-0">
                                        <table id="ordata_icd10_found_pre" class="table table-borderless table-hover bg-light">
                                        </table>
                                    </div>

                                    <!-- POST -->
                                    <div class="col-12 p-0">
                                        <input id="ordata_icd10_txt_post" type="text" class="form-control" placeholder="ICD10 POST-diagnostic" autocomplete="off">
                                    </div>
                                    <div class="col-12 p-0">
                                        <table id="ordata_icd10_found_post" class="table table-borderless table-hover bg-light">
                                        </table>
                                    </div>
                                    <div class="col-12 p-0">
                                        <input id="ordata_icd9_txt" type="text" class="form-control" placeholder="ICD9 PROCEDURE" autocomplete="off">
                                    </div>
                                    <div class="col-12 p-0">
                                        <table id="ordata_icd9_found" class="table table-borderless table-hover bg-light">
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="ordata_sendstatus" class="col-12" style="display: none">

                            </div>
                            <div class="col-12 pt-5 border-top border-light px-0">
                                <button id="btn_ordata_senddata" class="btn btn-success btn-block">ส่งข้อมูล</button>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_ordata_modal').click(function() {
        $("#ordata_sendstatus").html("");
        $("#modal_ordata_from").modal("show");
    });


    $(".jsonboxSAVE").click(function(){
        $("#ordata_sendstatus").html("");
    });

    $("#btn_ordata_senddata").click(function(){
        $("#ordata_sendstatus").show();
        var keyin = $("#ordata_userkeyin").val();
        $.post('{{url('api/ordata')}}',{
            event   : "senddata_ordata",
            cid     : "{{$casedata->_id}}",
            hn      : "{{$casedata->hn}}",
            keyin   : keyin
        },function(data, status){
            var json = JSON.parse(data);
            console.log(json)
            if(json.success){
                $("#modal_ordata_from").modal("hide");
                $("#modal_data_success").modal("show");
            }else{
                if(json.msg === undefined){
                    $("#ordata_sendstatus").html("<font size='8' color='red'>"+data+"</font>");
                }else{
                    $("#ordata_sendstatus").html("<font size='8' color='red'>"+json.msg+"</font>");
                }
            }
        });
    });


    $.post('{{url('api/ordata')}}',{
        event   : "load_icd9select",
        cid     : "{{$casedata->_id}}"
    },function(data, status){
        $("#icd9_ordataselect").html(data);
    });

    $.post('{{url('api/ordata')}}',{
        event   : "load_icd10select",
        cid     : "{{$casedata->_id}}",
        prepost : "pre"
    },function(data, status){
        $("#icd10_ordataselect_pre").html(data);
    });

    $.post('{{url('api/ordata')}}',{
        event   : "load_icd10select",
        cid     : "{{$casedata->_id}}",
        prepost : "post"
    },function(data, status){
        $("#icd10_ordataselect_post").html(data);
    });



    $("#ordata_icd10_txt_pre").keyup(function(){
        $("#ordata_sendstatus").html("");
        var search = $("#ordata_icd10_txt_pre").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd10",
                cid     : "{{$casedata->_id}}",
                prepost : "pre",
                search  : search
            },function(data, status) {$("#ordata_icd10_found_pre").html(data);});
        }else{$("#ordata_icd10_found_pre").html("");}
    });

    $("#ordata_icd10_txt_post").keyup(function(){
        $("#ordata_sendstatus").html("");
        var search = $("#ordata_icd10_txt_post").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd10",
                cid     : "{{$casedata->_id}}",
                prepost : "post",
                search  : search
            },function(data, status) {$("#ordata_icd10_found_post").html(data);});
        }else{$("#ordata_icd10_found_post").html("");}
    });





    $("#ordata_icd9_txt").keyup(function(){
        $("#ordata_sendstatus").html("");
        var search = $("#ordata_icd9_txt").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd9",
                cid     : "{{$casedata->_id}}",
                search  : search
            },function(data, status) {$("#ordata_icd9_found").html(data);});
        }else{$("#ordata_icd9_found").html("");}
    });



    $("#ordatadepartment").change(function(){
        $("#ordata_sendstatus").html("");
        var id = $(this).val();
        $.post('{{url('api/ordata')}}',{
            event   : "ordatadepartment",
            cid     : "{{$casedata->_id}}",
            val     : id
        },function(d,s){});
    });

    $("#ordataclinic").change(function(){
        $("#ordata_sendstatus").html("");
        var id = $(this).val();
        $.post('{{url('api/ordata')}}',{
            event   : "ordataclinic",
            cid     : "{{$casedata->_id}}",
            val     : id
        },function(d,s){});
    });


    $("#ordatatechanes").change(function(){
        $("#ordata_sendstatus").html("");
        var id = $(this).val();
        $.post('{{url('api/ordata')}}',{
            event   : "ordatatechanes",
            cid     : "{{$casedata->_id}}",
            val     : id
        },function(d,s){});
    });



    $("#select_users").change(function(){
        var data_id  = $(this).val()
        var data_name = $('#select_users option[value="'+data_id+'"]').attr('data-name')
        var data_type = $('#select_users option[value="'+data_id+'"]').attr('data-type')
        var fill      =  '<div class="col-7 pt-2"';
            fill      += 'sub-tab="'+data_id+'">'+data_name+'</div>';
            fill      += '<div class="col-3 pt-2" sub-tab="'+data_id+'">'+data_type+'</div>';
            fill      += '<div class="col-2 pt-2"';
            fill      += 'sub-tab="'+data_id+'"><i class="mdi mdi-trash-can text-danger" onclick="del_list('+data_id+')" aria-hidden="true"></i>'
        $("#scroll_list").append(fill)
        list_user_save()
    })

    $("#user_in_case").focusout(function(){
        var id = $(this).val();
        console.log(id);
        $.post('{{url('api/ordata')}}',{
            event   : "user_in_case",
            cid     : "{{$casedata->_id}}",
            val     : id
        },function(d,s){});
    });

    function del_list(id){
        $("div[sub-tab='"+id+"']").remove();
        list_user_save()
    }


    function list_user_save(){
        count_list = $("#scroll_list .col-7").length
        var data_array = []
        for(i=0;i<count_list;i++){
            data_array[i] = $($("#scroll_list .col-7")[i]).attr('sub-tab')
        }
        var my_json = JSON.stringify(data_array)
        $("#user_in_case").val(my_json)
        $("#user_in_case").focusout();
    }

    $('.savejson').bind('focusout',function(){
        var this_id     = $(this).attr('id');
        var this_type   = $(this).attr('type');
        var this_table  = $(this).attr('table');
        if (typeof this_table === 'undefined'){this_table = "tb_case";}
        if(this_type=="checkbox"){
            $.post('{{url('api/photomove')}}',{
                event       : 'savejson',
                name        : this_id,
                value       : $(this).prop('checked'),
                table       : this_table,
                field       : 'case_json',
                id          : '{{$casedata->_id}}',
                comcreate   : '{{$casedata->comcreate}}',
                procedure   : '{{$casedata->case_procedurecode}}',
            },function(data,status){});
        }else{
            $.post('{{url('api/photomove')}}',{
                event       : 'savejson',
                name        : this_id,
                value       : $('#'+this_id).val(),
                table       : this_table,
                field       : 'case_json',
                id          : '{{$casedata->_id}}',
                comcreate   : '{{$casedata->comcreate}}',
                procedure   : '{{$casedata->case_procedurecode}}',
            },function(data,status){});
        }
    });

</script>
