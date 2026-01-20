@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>

</style>

@endsection

@section('modal')


@endsection
@section('title-left')
    <h4 class="mb-sm-0">EXPORT DATA</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li id="top" class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Export</li>
    </ol>
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

            <form action="{{url('api/endosmartdata')}}" method="PUT">
                @method('PUT')
                @csrf
                <input type="hidden" name="event" value="get_folder">
                <input type="hidden" name="search" value="search">
                <div class="row">
                    <div class="col-4">
                        <div>
                            <input type="text" class="form-control bg-light"  id="search_path" name="search_path" placeholder="Endosmart data path" value="@if(isset($path)) {{@$path}} @else {{'D:\laragon\htdocs\endosmart_data'}} @endif" required>
                        </div>
                    </div>
                    @if(isset($folders))
                        <input type="hidden" name="search" value="select_folder">
                        <div class="col-2">
                            <select name="date_folder" class="form-select mb-3" aria-label="Default select example" required>
                                @foreach (isset($folders)?$folders:[] as $fol)
                                    <option value="{{@$fol}}" @isset($date->date_folder) @if($date->date_folder == $fol) selected  @endif   @endisset>{{@$fol}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">Search</button>
                        <a href="{{url('api/endosmartdata')}}" type="button" class="btn btn-primary bg-gradient waves-effect waves-light">Clear</a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<div class="card">
    <form action="{{url('')}}" method="post" id="delete_cases_form">
        @csrf
        <input type="hidden" name="event" value="delete_cases">
        <input type="hidden" name="caseuniq" id="caseuniq">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-3 my-2 ms-3 ">
                        <input id="filter_hn" type="text" class="form-control bg-light" placeholder="Filter hn..." oninput="function_search()">
                    </div>
                    {{-- <div class="col-3 my-2 ms-1">
                        <input id="filter_name" type="text" class="form-control bg-light" placeholder="Filter patient..." oninput="function_search()" >
                    </div>
                    <div class="col-3 my-2 ms-1">
                        <input id="filter_physician" type="text" class="form-control bg-light" placeholder="Filter physician..." oninput="function_search()" >
                    </div> --}}
                    {{-- <div class="col-2 my-2 ms-1">
                        <input id="filter_procedure" type="text" class="form-control bg-light" placeholder="Filter procedure..." oninput="function_search()">
                    </div> --}}
                </div>  
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11 my-2">
                        {{-- <a class="btn btn-success" href="{{url('admin/case/rollback')}}" >Rollback</a> --}}
                        {{-- <button class="btn btn-primary ms-2" type="button" id="toggle_btn" onclick="toggle_check('ck-case')">Check all</button> --}}
                        {{-- <button class="btn btn-danger ms-2" id="call_modal_btn" type="button" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">Delete</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive table-card table-w m-1" >
            <table class="table table-nowrap mb-0" id="table-search">
                <thead class="">
                    <tr>
                        <th>#</th>
                        @foreach (isset($tb_head)?$tb_head:[] as $head)
                            <th>{{@$head}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody id="tbody_case">
                    @isset($rows)
                    @php
                        $i = 0;
                    @endphp
                        @foreach ($rows as $index=>$r)
                            @php
                                $count_img = 0;
                                if(isset($r['IMAGE'])){
                                    if(is_array($r['IMAGE'])){
                                        $count_img = count($r['IMAGE']);
                                    }
                                }
                                $r['IMAGE'] = $count_img;
                                
                                $count_pdf = 0;
                                if(isset($r['PDF'])){
                                    if(is_array($r['PDF'])){
                                        $count_pdf = count($r['PDF']);
                                    }
                                }
                                $r['PDF'] = $count_pdf;

                                if($r['IMAGE'] == 0 && (@$r['DATA_FOLDER']."" == '' || @$r['CASE_APPOINT_TIME'].'' == '' )){
                                    continue;
                                }
                                $i += 1;
                                
                            @endphp
                            <tr class="tr-row"  style="cursor: pointer">
                                <td>{{@$i}}</td>
                                @foreach (isset($tb_head)?$tb_head:[] as $head)
                                @if(!isset($r[$head]))
                                    @php
                                        continue;
                                    @endphp
                                @endif
                                @php
                                    $data = isset($r[$head]) && @$r[$head] != '' ? $r[$head] : '';
                                    if(isset($r[$head])){
                                        if(gettype($r[$head]) != 'string'){
                                            $data = json_encode($r[$head]);
                                        }
                                    }
                                @endphp
                                @php
                                    $data = isset($data) ? json_encode($data) : '';
                                @endphp
                                    <th data-{{$head}}="{{@$data}}" class="sort-hn">{{@$data}}</th>
                                @endforeach
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

function function_search(){
        var hn = $('#filter_HN_ID').val()

        $('#tbody_case .tr-row').show()

        $('#tbody_case .tr-row').each((index, element) => {
            // console.log(element, $(element).find('.sort-name').eq(0));
            var hn_col      = $(element).find('.filter_HN_ID-hn').eq(0).html() != undefined ? $(element).find('.sort-hn').eq(0).html().trim().toLowerCase() : ''
            // var name_col    = $(element).find('.sort-name').eq(0).html() != undefined ? $(element).find('.sort-name').eq(0).html().trim().toLowerCase() : ''
            // var proc_col    = $(element).find('.sort-proc').eq(0).html() != undefined ? $(element).find('.sort-proc').eq(0).html().trim().toLowerCase() : ''
            // var doctor_col  = $(element).find('.sort-doctor').eq(0).html() != undefined ? $(element).find('.sort-doctor').eq(0).html().trim().toLowerCase() : ''

            // if(procedure != '' && procedure != undefined){
            //     if((proc_col.includes(procedure) || proc_col.includes(procedure)) ){} else {
            //         $(element).hide()
            //     }
            // }

            // if(physician != '' && physician != undefined){
            //     if((doctor_col.includes(physician) || doctor_col.includes(physician)) ){} else {
            //         $(element).hide()
            //     }
            // }

            // if(name != '' && name != undefined){
            //     if((name_col.includes(name) || name_col.includes(name)) ){} else {
            //         $(element).hide()
            //     }
            // }

            if(hn != '' && hn != undefined){
                if((hn_col.includes(hn) || hn_col.includes(hn)) ){} else {
                    $(element).hide()
                }
            }

        })

    }
</script>

@endsection
