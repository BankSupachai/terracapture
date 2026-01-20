
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
     */

</style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">CASE SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li id="top" class="breadcrumb-item"><a href="javascript: void(0);">Case Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection

@section('modal')
 <!-- Default Modals -->
<div id="confirm_delete_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Do you want to delete these cases?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button id="confirm_modal_btn" type="button" class="btn btn-primary ">Confirm</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row m-3">

        </div>
        <div class="row m-0">
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">

            <form action="{{url('admin/case')}}" method="put">
                @method('PUT')
                @csrf
                <input type="hidden" name="event" value="search_case">
                <input type="hidden" name="search" value="search">
                <div class="row">
                    <div class="col-4">
                        <div>
                            <input type="text" class="form-control bg-light"  id="search_name" name="search_name" placeholder="Search patient, hn, physician  …" value="{{@$filter}}" required>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">Search</button>
                        <a href="{{url('admin/case')}}" type="button" class="btn btn-primary bg-gradient waves-effect waves-light">Clear</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="card">
    <form action="{{url('admin/case')}}" method="post" id="delete_cases_form">
        @csrf
        <input type="hidden" name="event" value="delete_cases">
        <input type="hidden" name="caseuniq" id="caseuniq">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-3 my-2 ms-3 ">
                        <input id="filter_hn" type="text" class="form-control bg-light" placeholder="Filter hn..." oninput="function_search()">
                    </div>
                    <div class="col-3 my-2 ms-1">
                        <input id="filter_name" type="text" class="form-control bg-light" placeholder="Filter patient..." oninput="function_search()" >
                    </div>
                    <div class="col-3 my-2 ms-1">
                        <input id="filter_physician" type="text" class="form-control bg-light" placeholder="Filter physician..." oninput="function_search()" >
                    </div>
                    <div class="col-2 my-2 ms-1">
                        <input id="filter_procedure" type="text" class="form-control bg-light" placeholder="Filter procedure..." oninput="function_search()">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11 my-2">
                        <a class="btn btn-success" href="{{url('admin/case/rollback')}}" >Rollback</a>
                        <button class="btn btn-primary ms-2" type="button" id="toggle_btn" onclick="toggle_check('ck-case')">Check all</button>
                        <button class="btn btn-danger ms-2" id="call_modal_btn" type="button" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive table-card table-w m-1" >
            <table class="table table-nowrap mb-0" id="table-search">
                <thead class="">
                    <tr>
                        <th></th>
                        <th scope="col">HN</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Physician</th>
                        <th scope="col">Procedure</th>
                        <th scope="col">Appointment</th>
                    </tr>
                </thead>
                <tbody id="tbody_case">
                    @isset($cases)
                        @foreach ($cases as $index=>$c)
                            @php
                                $c = (object) $c;
                            @endphp
                            <tr class="tr-row" data-caseuniq="{{@$c->caseuniq}}" style="cursor: pointer">
                                <td>
                                    <input type="checkbox" class="form-check-input ck-case" name="delete_ck[]" id="ck{{@$c->caseuniq}}" value="{{$c->caseuniq}}" data-caseuniq="{{$c->caseuniq}}">
                                </td>
                                <td data-caseuniq="{{@$c->caseuniq}}" data-text="{{@$c->case_hn}}" class="sort-hn tr-ck">{{@$c->case_hn}}</td>
                                <td data-caseuniq="{{@$c->caseuniq}}" data-text="{{@$c->patientname}}" class="sort-name tr-ck">{{@$c->patientname}}</td>
                                <td data-caseuniq="{{@$c->caseuniq}}" data-text="{{@$c->doctorname}}" class="sort-doctor tr-ck">{{@$c->doctorname}}</td>
                                <td data-caseuniq="{{@$c->caseuniq}}" data-text="{{@$c->procedurename}}" class="sort-proc tr-ck">{{@$c->procedurename}}</td>
                                <td data-caseuniq="{{@$c->caseuniq}}" data-text="{{@$c->appointment}}" class="sort-app tr-ck">{{@$c->appointment}}</td>
                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>

        </div>
    </form>

    <div class="row my-2">
        <div class="col-lg-9"></div>
        <div class="col-lg-2" >
            <button type="button" style="float: right"  class="btn btn-primary btn-label waves-effect waves-light" onclick="to_top()">
                <i class="ri-arrow-up-line label-icon align-middle fs-16 me-2"></i>
                Back to top
            </button>
        </div>
    </div>
</div>

@endsection




@section('script')

<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function to_top(){
        document.getElementById("top").scrollIntoView()
    }

    function toggle_check(classname){
        let ck_lg = $(`.${classname}`).length
        let btn_txt = $('#toggle_btn').html().split(' ')[0].toLowerCase()
        let need_check = true
        for (let i = 0; i < ck_lg; i++) {
            if(btn_txt.includes('un')){
                need_check = false
            }
            let is_show = $($(`.${classname}`)[i]).is(':visible')
            if(is_show){
                $($(`.${classname}`)[i]).prop('checked', need_check)
            }
        }

        if(ck_lg > 0){
            if(need_check){
                $('#toggle_btn').html('Uncheck all')
            } else {
                $('#toggle_btn').html('Check all')
            }
        }
    }

    function function_search(){
        var hn = $('#filter_hn').val()
        var name = $('#filter_name').val()
        var procedure = $('#filter_procedure').val()
        var physician   = $('#filter_physician').val()

        $('#tbody_case .tr-row').show()

        $('#tbody_case .tr-row').each((index, element) => {
            // console.log(element, $(element).find('.sort-name').eq(0));
            var hn_col      = $(element).find('.sort-hn').eq(0).html() != undefined ? $(element).find('.sort-hn').eq(0).html().trim().toLowerCase() : ''
            var name_col    = $(element).find('.sort-name').eq(0).html() != undefined ? $(element).find('.sort-name').eq(0).html().trim().toLowerCase() : ''
            var proc_col    = $(element).find('.sort-proc').eq(0).html() != undefined ? $(element).find('.sort-proc').eq(0).html().trim().toLowerCase() : ''
            var doctor_col  = $(element).find('.sort-doctor').eq(0).html() != undefined ? $(element).find('.sort-doctor').eq(0).html().trim().toLowerCase() : ''

            if(procedure != '' && procedure != undefined){
                if((proc_col.includes(procedure) || proc_col.includes(procedure)) ){} else {
                    $(element).hide()
                }
            }

            if(physician != '' && physician != undefined){
                if((doctor_col.includes(physician) || doctor_col.includes(physician)) ){} else {
                    $(element).hide()
                }
            }

            if(name != '' && name != undefined){
                if((name_col.includes(name) || name_col.includes(name)) ){} else {
                    $(element).hide()
                }
            }

            if(hn != '' && hn != undefined){
                if((hn_col.includes(hn) || hn_col.includes(hn)) ){} else {
                    $(element).hide()
                }
            }

        })

    }

    $('.tr-ck').on('click', function () {
        let caseuniq = $(this).data('caseuniq')
        if(caseuniq != '' && caseuniq != undefined){
            let status = true
            if($(`#ck${caseuniq}`).is(':checked')){
                status = false
            }
            $(`#ck${caseuniq}`).prop('checked', status)
        }
    })

    $('#confirm_modal_btn').on('click', function () {
        $('#delete_cases_form').submit()
    })

    $('#call_modal_btn').on('click', function () {
        let lg = $('.ck-case').length
        let main = []
        for (let i = 0; i < lg; i++) {
            let is_checked = $($('.ck-case')[i]).is(':checked')
            if(is_checked){
                let this_caseuniq = $($('.ck-case')[i]).data('caseuniq')
                if(this_caseuniq != '' && this_caseuniq  != undefined){
                    main.push(this_caseuniq)
                }
            }
        }
        $('#caseuniq').val(main)
    })

</script>

@endsection
