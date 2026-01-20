@extends('layouts.layout_capture')


@section('title', 'EndoINDEX')

@section('style')
<link href="{{url("public/assets5/css/layout_home.css")}}" rel="stylesheet" type="text/css" />
<link href="{{url("public/css/capture/procedure.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('modal')

@endsection


@section('content')
<div class="row m-0 alt">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col-12"><b class="h4">Patient ID : {{@$case->case_hn}}</b></div>
                    <div class="col-12">&nbsp;</div>
                    <div class="col-12">
                        @if($case->firstname!="")
                            <b class="h4">{{@$case->prefix}} {{@$case->firstname}} {{@$case->middlename}} {{@$case->lastname}}</b><br/>
                        @else
                            <b class="h4">{{@$case->dicomname}}</b><br/>
                        @endif
                        <label class="lead">{{@$case->birthdate}} ({{age_form_bd($case->birthdate)}}) / {{@$case->gender_name[0]}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col p-2">
                        <b class="h4">Study Detail</b>
                    </div>
                    <div class="col-auto"><a href="{{url('registration')}}/1" class="btn btn-soft-primary waves-effect waves-light btn-sm"><i class="las la-edit"></i> Edit</a></div>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <th>Date :</th>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <th>Modality :</th>
                        <td>{{@$case->modality}}</td>
                    </tr>
                    <tr>
                        <th>Procedure :</th>
                        <td>{{@$case->procedure_name}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    {{-- @dd($json->graph_status) --}}
    <div class="col" id="menu_procedure">
        <div class="card">
            <div class="card-header align-items-center d-flex plb">
                <div class="flex-shrink-0 ms-2">
                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#home2" role="tab">
                                Medical History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#procedure_report" role="tab">
                                <i class="mdi mdi-check-circle @if(@$json->report_status=='un') active @endif" id="report_status"></i> Procedure Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages2" role="tab">
                               <i class="mdi mdi-check-circle @if(@$json->graph_status=='un') active @endif" id="graph_status"></i> Picture/Graph
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex-grow-1 oveflow-hidden text-end">
                    <a class="btn btn-primary" href="{{url('reportendocapture')}}/{{@$case->case_id}}">Generate Report</a>
                </div>

            </div>
            <div class="card-body">
                <div class="tab-content text-muted">
                    <div class="tab-pane" id="home2" role="tabpanel">
                        A
                    </div>
                    <div class="tab-pane active" id="procedure_report" role="tabpanel">
                        @component('Terra.case.report.growth_scan',$component)@endcomponent
                        <div class="col-12 text-end pt-4">
                            <button class="btn btn-primary waves-effect waves-light save-report" data-id="report_status">
                                @if(@$json->report_status=='un')
                                Uncomplete
                                @else
                                Complete
                                @endif
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane" id="messages2" role="tabpanel">
                        @component('Terra.case.report.picture',$component)@endcomponent
                        @component('Terra.case.report.graph',$component)@endcomponent
                        <div class="col-12 text-end pt-4">
                            <button class="btn btn-primary waves-effect waves-light save-report" data-id="graph_status">
                                @if(@$json->graph_status=='un')
                                Uncomplete
                                @else
                                Complete
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection






@section('lpage')
Procedure Record
@endsection
@section('rpage')
Procedure Record
@endsection
@section('rppage')
Cases List
@endsection


@section('script')
{{-- @dd($case) --}}
{{-- <script src="{{url("")}}/public/assets5/libs/prismjs/prism.js"></script> --}}
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(".ck-json").click(function(){
        var ch_size =  $(".ck-json").length
        var ck_array = [];
        var x = 0;
        for(i=0;i<ch_size;i++){
            if($($(".ck-json")[i]).is(':checked')){
                ck_array[x] = $($(".ck-json")[i]).val()
                x++;
            }
        }
        var json_ck = JSON.stringify(ck_array)
        save_json('charts',json_ck)
    })
    $(".ck-json-img").click(function(){
        var sort_img = parseInt($("#sort_img").val())
        if($(this).is(':checked')){
            var num = sort_img+1;
            $(this).attr('data-num',num)
            $(this).before(`<div class="box-number" sub-num="${num}">${num}</div>`)
        }else{
            var data_num = $(this).attr('data-num')
            var num = sort_img-1;
            $(".box-number[sub-num='"+data_num+"']").remove()
            var new_set = $(".ck-json-img:checked").length
            for(y=0;y<new_set;y++){
                var data_nums = $($(".ck-json-img:checked")[y]).attr('data-num')
                if(data_nums>data_num){
                    var new_num = parseInt(data_nums)-1;
                    $($(".ck-json-img:checked")[y]).attr('data-num',new_num)
                    $(".box-number[sub-num='"+data_nums+"']").html(new_num).attr('sub-num',new_num)
                }
            }
        }
        $("#sort_img").val(num)
        var ch_size =  $(".ck-json-img:checked").length
        var ck_array = [];
        var x = 0;
        for(i=1;i<=ch_size;i++){
            ck_array[x] = $(".ck-json-img[data-num='"+i+"']").val();
            x++;
        }
        // for(i=0;i<ch_size;i++){
        //     if($($(".ck-json-img")[i]).is(':checked')){
        //         ck_array[x] = $($(".ck-json-img")[i]).val();
        //         x++;
        //     }
        // }

        var json_ck = JSON.stringify(ck_array)
        save_json('photo',json_ck)
        save_json('photo_array',json_ck)
    })

    $(".save-json").on('change',function(){
        var name = $(this).attr('name')
        var val  = $(this).val()
        if($(this).attr('type')=='checkbox'){
            if($(this).is(':checked')){
                val = 'true';
            }else{
                val = 'false';
            }
        }
        save_json(name,val)
    })

    // $(".save-json-img").on('change',function(){
    //     var text = $(this).attr('name');
    //     console.log(text);
    // })


    function save_json(name,value){
        $.post('{{url('api/photomove')}}',{
            event       : 'savejson',
            name        : name,
            value       : value,
            table       : 'tb_case',
            field       : 'case_json',
            id          : "{{@$case->case_id}}",
            comcreate   : "{{@$case->comcreate}}",
            procedure   : "{{@$case->case_procedure}}",
        },function(data,status){});
    }

    $(".form-control").on('keyup change',function(){
        if($(this).val().length>0){
            $(this).addClass('bg-soft-info')
        }else{
            $(this).removeClass('bg-soft-info')
        }
    })


    $(".set-menu-checked").click(function(){
        var id = $(this).attr('data-id')
        if($(this).is(":checked")){
            $("#"+id).addClass('active');
        }else{
            $("#"+id).removeClass('active')
        }
    })
    $(".save-report").click(function(){
        var id = $(this).attr('data-id')
        var data = 'un';
        if($("#"+id).hasClass('active')){
            $("#"+id).removeClass('active')
            $(this).html('Complete')

        }else{
            $("#"+id).addClass('active')
            $(this).html('Uncomplete')
            data = 'complete';
        }
        save_json(id,data)
    })
</script>
@endsection
