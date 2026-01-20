
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-left: -12px;
        margin-top: 1px;
    }
    .select2-results__option img{display: none;}
</style>
@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">PROCEDURE SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">PROCEDURE SETTING</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('modal')

@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="border-bottom pb-3 mb-3">Procedure List</h3>
            <div class="row mt-2">
                <div class="col-lg-3">
                    <select class="js-example-basic-single" id="search_procedure"  placeholder="Procedure" onchange="function_search()">
                        <option value="">Procedure</option>
                        @foreach ($procedure as $data)
                            <option value="{{@$data->name}}">{{@$data->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="js-example-basic-single" id="search_modality"  placeholder="Procedure" onchange="function_search()">
                        <option value="">Modality</option>
                        <option value="ES">ES</option>
                    </select>
                </div>
                <div class="col-lg"></div>
                <div class="col-lg-auto">
                    <button class="btn btn-info"><i class="ri-add-line"></i> Cloud</button>
                </div>
                <div class="col-auto">
                    <button id="server_btn" type="button" class="btn btn-primary waves-effect waves-light"> <i class="ri ri-download-line"></i> Server</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td>Procedure ID</td>
                        <td>Procedure Name</td>
                        <td>Modality</td>
                        <td>Last Modifed</td>
                        <td class="text-center">Action</td>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($procedure as $data)
                    <tr>
                        <td>{{@$data->code}}</td>
                        <td>{{@$data->name}}</td>
                        <td>ES</td>
                        <td>{{date('D d F, Y')}}</td>
                        <td class="text-center"><a href="{{url('admin/procedure')}}/{{@$data->code}}" class="btn btn-success btn-sm">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{url('admin')}}/procedure" method="post" id="submit_form" hidden>
    @csrf
    <input type="hidden" name="event" value="get_masterdata">
    <input type="hidden" name="tb_name" value="tb_procedure">
</form>
@endsection




@section('script')

{{-- <script src="{{url("public/assets5/js/pages/select2.init.js")}}"></script> --}}
<script>
    $("select").select2({})
</script>

<script>
    function function_search() {
        let procedure   = $(`#search_procedure`).val().toLowerCase()
        let modality    = $('#search_modality').val().toLowerCase()

        console.log(procedure, modality);

        var tbody_id = `tbody`
        var rows = $(`#${tbody_id} tr`);
        $(`#${tbody_id} tr`).show()

        $(`#${tbody_id} tr`).each(function (index, element) {
            var tds = $( this ).find( 'td' );
            var procedure_td = $(tds[1]).text().toLowerCase()
            var modality_td  = $(tds[2]).text().toLowerCase()

            if(procedure != '' && procedure != undefined){
                if((procedure_td.includes(procedure) || procedure_td.includes(procedure)) ){
                } else {
                    $(this).hide()
                }
            }

            if(modality != '' && modality != undefined){
                if((modality_td.includes(modality) || modality_td.includes(modality)) ){
                } else {
                    $(this).hide()
                }
            }

        });
    }

    $('#server_btn').on('click', function () {
        $('#submit_form').submit()
    })

    @if(Session::has('status'))
        setTimeout(() => {
            $('#alert_btn').trigger('click')
        }, 3 * 1000);
    @endif
</script>
@endsection
