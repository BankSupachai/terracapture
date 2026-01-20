@php
    $view['tb_department']  = $tb_department;
    $view['endo']           = $endo;
    $view['doctor']         = $doctor;
    $view['nurse']          = $nurse;
    $view['register']       = $register;
    $view['tb_procedure']   = $tb_procedure;
    $view['tb_room']        = $tb_room;
    $view['tb_scope']       = $tb_scope;
@endphp

@extends('layouts.layouts_index.main')
{{-- @extends('layouts.appindex') --}}

@section('style')

@endsection
@section('lpage')
    Department
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Department
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
                        <div class="col-lg-4 text-right">
                            {{-- <button class="btn btn-warning w-100" id="btn_edit_depart">Edit</button>
                            <button class="btn btn-success w-100" id="btn_confirm_depart">Confirm</button> --}}
                        </div>
                    </div>

                    {{-- <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="input-icon input-icon-right">
                                <input type="text" class="form-control form-control-sm" id="doctor_search" placeholder="Search..."/>
                                <span><i class="flaticon2-search-1 icon-md"></i></span>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mb-2">
                        <div class="col-lg-7">
                            <input id="txt_department_add" type="text" name="" class="form-control form-control-sm" placeholder="department">
                        </div>
                        <div class="col-lg-5 text-right">
                            <button id="btn_department_add" class="btn btn-primary text-nowrap">+ Department</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav flex-column nav-pills" id="list_depart">
                            @foreach($tb_department as $data)
                                <li class="nav-item mb-2">
                                    <a class="nav-link" id="home-tab-5" href="department/{{$data->department_id}}">
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

        <div class="col-lg-9" style="display: none">
            <div class="card card-custom card-stretch" id="kt_page_stretched_card" style="height: 100%;">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_0">Endo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Doctor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Nurse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Procedure</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_6">Scope</a>
                        </li>
                    </ul>




                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_0" role="tabpanel" aria-labelledby="kt_tab_pane_0">
                            @component('admin.department.component.endo',$view)@endcomponent</div>

                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel"
                            aria-labelledby="kt_tab_pane_1">
                            @component('admin.department.component.doctor',$view)@endcomponent
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            @component('admin.department.component.nurse',$view)@endcomponent</div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                            @component('admin.department.component.practical_nurse',$view)@endcomponent</div>
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                            @component('admin.department.component.procedure',$view)@endcomponent</div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                            @component('admin.department.component.room',$view)@endcomponent</div>
                        <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                            @component('admin.department.component.scope',$view)@endcomponent</div>
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
