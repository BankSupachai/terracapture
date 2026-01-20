@php
    $view['tb_department']  = $tb_department;
    $view['department']     = @$department;
    $view['endo']           = $endo;
    $view['doctor']         = $doctor;
    $view['anes']           = $anes;

    $view['nurse']          = $nurse;
    $view['repocess']       = $repocess;
    $view['register']       = $register;
    $view['tb_procedure']   = $tb_procedure;
    $view['tb_room']        = $tb_room;
    $view['tb_scope']       = $tb_scope;
    $view['part_image']     = @$part_image;

@endphp

@extends('layouts.appindex')
@section('style')

@endsection
@section('content')
    <div class="row m-0">
        <div class="col-lg-3">
            <div class="card card-custom card-stretch">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-8">
                        <h3>All Department</h3>
                        </div>
                        <div class="col-lg-4" align="right">
                            <a class="btn btn-secondary" href="{{url('department')}}">Clear filter</a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-7">
                            <input type="text" id="txt_department_add" class="form-control form-control-sm" placeholder="department">
                        </div>
                        <div class="col-lg-5 text-right">
                            <button id="btn_department_add" class="btn btn-primary">+ Department</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <ul class="nav flex-column nav-pills" id="list_depart">
                            @foreach($tb_department as $data)
                                @if(Request::segment(2)==$data->department_id)
                                    <li class="nav-item mb-2" style="background:#c0c0c0">
                                @else
                                    <li class="nav-item mb-2">
                                @endif

                                    <a class="nav-link" id="home-tab-5" href="{{$data->department_id}}">
                                        <span class="nav-text">{{$data->department_name}}</span>
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card card-custom card-stretch" id="kt_page_stretched_card" style="height: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div id="department_label" class="col-12">
                            <h1>{{$department->department_name}}
                            <button id="department_edit" class="btn btn-warning">Edit name</button></h1>
                        </div>
                        <div class="col-4" id="department_text" style="display: none">
                            <input id="txt_department" department="{{$department->department_id}}" value="{{$department->department_name}}" class="form-control">
                            <button id="department_record" class="btn btn-success">Confirm</button>
                        </div>
                    </div>
                    @php
                    if(isset($_GET['type'])){
                        if($_GET['type']=="doctor")     {$tab_doctor    = true;}
                        if($_GET['type']=="anes")       {$tab_anes      = true;}
                        if($_GET['type']=="nurse")      {$tab_nurse     = true;}
                        if($_GET['type']=="register")   {$tab_register  = true;}
                        if($_GET['type']=="room")       {$tab_room      = true;}
                        if($_GET['type']=="scope")      {$tab_scope     = true;}
                        if($_GET['type']=="reprocess")  {$tab_repocess  = true;}
                    }else{
                        $tab_endo = true;
                    }

                    @endphp

                    <ul class="nav nav-tabs nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_endo) active @endisset" data-toggle="tab" href="#kt_tab_pane_0">Endo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_doctor) active @endisset" data-toggle="tab" href="#kt_tab_pane_1">Doctor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_anes) active @endisset" data-toggle="tab" href="#kt_tab_pane_11">Anes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_nurse) active @endisset" data-toggle="tab" href="#kt_tab_pane_2">Nurse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_register) active @endisset" data-toggle="tab" href="#kt_tab_pane_3">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Procedure</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @isset($tab_room) active @endisset" data-toggle="tab" href="#kt_tab_pane_5">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_scope) active @endisset" data-toggle="tab" href="#kt_tab_pane_6">Scope</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @isset($tab_repocess) active @endisset" data-toggle="tab" href="#tab_repocess">Reprocess</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade @isset($tab_endo) show active @endisset" id="kt_tab_pane_0" role="tabpanel" aria-labelledby="kt_tab_pane_0">
                            @component('admin.department.component.endo',$view)@endcomponent
                        </div>

                        <div class="tab-pane fade @isset($tab_doctor) show active @endisset" id="kt_tab_pane_1" role="tabpanel"
                            aria-labelledby="kt_tab_pane_1">
                            @component('admin.department.component.doctor',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade @isset($tab_anes) show active @endisset" id="kt_tab_pane_11" role="tabpanel"
                            aria-labelledby="kt_tab_pane_1">
                            @component('admin.department.component.anes',$view)@endcomponent
                        </div>


                        <div class="tab-pane fade @isset($tab_nurse) show active @endisset" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            @component('admin.department.component.nurse',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade @isset($tab_register) show active @endisset" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                            @component('admin.department.component.practical_nurse',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                            @component('admin.department.component.procedure',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade @isset($tab_room)show active @endisset" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                            @component('admin.department.component.room',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade @isset($tab_scope)show active @endisset" id="kt_tab_pane_6" role="tabpanel" aria-labelledby="kt_tab_pane_6">
                            @component('admin.department.component.scope',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade @isset($tab_repocess)show active @endisset" id="tab_repocess" role="tabpanel" aria-labelledby="tab_repocess">
                            @component('admin.department.component.repocess',$view)@endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{url("public/sample/assets/js/pages/crud/file-upload/dropzonejs.js")}}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#btn_department_add').click(function(){
        var name = $('#txt_department_add').val();
        if(name != ""){
            $.post('{{ url('department') }}', {
                event: 'department_add',
                name : name,
            }, function(data, status) {
                console.log(data);
                window.location.reload();
            });
        }else{
            alert('กรุณาระบุ แผนก');
        }
    });



    $('#department_edit').click(function(){
        $('#department_text').show();
        $('#department_label').hide();
    });

    $('#department_record').click(function(){
        $('#department_text').hide();
        $('#department_label').show();

        var txt_department  = $('#txt_department').val();
        var department      = $('#txt_department').attr('department');
        $.post('{{ url('department') }}', {
                event: 'department_edit',
                name : txt_department,
                id   : department,
            }, function(data, status) {
                console.log(data);
                window.location.reload();
        });

    });



    $("#btn_confirm_depart").hide();
    $("#text_depart").hide();
    $("#btn_edit_depart").click(function(){
        $("#text_depart").show();
        $("#list_depart").hide();
        $("#btn_confirm_depart").show();
        $(this).hide();
    });

    $("#btn_confirm_depart").click(function(){
        $("#text_depart").hide();
        $("#list_depart").show();
        $("#btn_edit_depart").show();
        $(this).hide();
    });
</script>
@endsection
