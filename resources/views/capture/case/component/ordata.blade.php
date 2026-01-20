<style>
    #ordata_icd10_found tr:hover,#ordata_icd9_found tr:hover{
        background: #e9ecef;
    }
</style>
@php
    $searchAnesTechnique= file_get_contents($DOCUMENT_ROOT."/config/or/searchAnesTechnique.json");
    $searchORTeam       = file_get_contents($DOCUMENT_ROOT."/config/or/searchORTeam.json");
    $searchSDLOCOR      = file_get_contents($DOCUMENT_ROOT."/config/or/searchSDLOCOR.json");
    $anes               = jsonDecode($searchAnesTechnique);
    $clinic             = jsonDecode($searchORTeam);
    $department         = jsonDecode($searchSDLOCOR);
@endphp
<div class="col-12">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <u>
                        <h3>OR data</h3>
                    </u>
                </div>
                <div class="col-5 border-right border-light">

                    <div class="row">
                        <div class="col-12">
                            Department
                            <select id="ordatadepartment" class="form-control">
                                <option value="">Select</option>
                                @foreach ($department->data->sdlocOR as $dpm)
                                    <option value="{{$dpm->sdloc}}">{{$dpm->desc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-4">
                            Clinic
                            <select id="ordataclinic" class="form-control">
                                <option value="">Select</option>
                                @foreach ($clinic->data->SDOGI01 as $cln)
                                    <option value="{{$cln->id}}">{{$cln->unit}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-5">
                            Anes Technic
                        </div>
                        @foreach ($anes->data->anestech as $an)
                            <div class="col-4 pt-4">
                                <label class="checkbox">
                                    <input type="checkbox" class="jsonboxSAVE" name="ordatatechanes" value="{{$an->no}}"/>
                                    <span></span>
                                    &nbsp; {{$an->desc}}
                                </label>
                            </div>
                        @endforeach
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
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
<script>





    $.post("http://localhost/endocapture5.0/api/ordata",{
        event   : "getdata_ordata",
        cid     : "{{$cid}}"
    },function(data, status){
        var obj = JSON.parse(data);
        $("#ordatadepartment").val(obj.ordatadepartment);
        $("#ordataclinic").val(obj.ordataclinic);
        for (let ele of obj.ordatatechanes) {
            $('input[name="ordatatechanes"][value='+ele+']').prop('checked', true);
        }
    });

    $("#ordatadepartment").change(function(){
        var id = $(this).val();
        $.post("http://localhost/endocapture5.0/api/ordata",{
            event   : "ordatadepartment",
            cid     : "{{$cid}}",
            val     : id
        },function(d,s){});
    });

    $("#ordataclinic").change(function(){
        var id = $(this).val();
        $.post("http://localhost/endocapture5.0/api/ordata",{
            event   : "ordataclinic",
            cid     : "{{$cid}}",
            val     : id
        },function(d,s){});
    });


    $.post("{{url('api/ordata')}}",{
        event   : "load_icd9select",
        cid     : "{{$cid}}"
    },function(data, status){
        $("#icd9_ordataselect").html(data);
    });

    $.post("{{url('api/ordata')}}",{
        event   : "load_icd10select",
        cid     : "{{$cid}}",
        prepost : "pre",
    },function(data, status){
        $("#icd10_ordataselect_pre").html(data);
    });

    $.post("{{url('api/ordata')}}",{
        event   : "load_icd10select",
        cid     : "{{$cid}}",
        prepost : "post",
    },function(data, status){
        $("#icd10_ordataselect_post").html(data);
    });



    $("#ordata_icd10_txt_pre").keyup(function(){
        var search = $("#ordata_icd10_txt_pre").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd10",
                cid     : "{{$cid}}",
                prepost : "pre",
                search  : search
            },function(data, status) {$("#ordata_icd10_found_pre").html(data);});
        }else{$("#ordata_icd10_found_pre").html("");}
    });

    $("#ordata_icd10_txt_post").keyup(function(){
        var search = $("#ordata_icd10_txt_post").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd10",
                cid     : "{{$cid}}",
                prepost : "post",
                search  : search
            },function(data, status) {$("#ordata_icd10_found_post").html(data);});
        }else{$("#ordata_icd10_found_post").html("");}
    });



    $("#ordata_icd9_txt").keyup(function(){
        var search = $("#ordata_icd9_txt").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd9",
                cid     : "{{$cid}}",
                search  : search
            },function(data, status) {$("#ordata_icd9_found").html(data);});
        }else{$("#ordata_icd9_found").html("");}
    });


    $("#ordata_icd10_txt_pre").keyup(function(){
        $("#ordata_sendstatus").html("");
        var search = $("#ordata_icd10_txt_pre").val();
        if(search.length>=1){
            $.post("{{url("api/ordata")}}", {
                event   : "ordata_icd10",
                cid     : "{{$cid}}",
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
                cid     : "{{$cid}}",
                prepost : "post",
                search  : search
            },function(data, status) {$("#ordata_icd10_found_post").html(data);});
        }else{$("#ordata_icd10_found_post").html("");}
    });
</script>
