
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-left: -12px;
        margin-top: 1px;
    }
    .select2-results__option img{display: none;}
    .text-wrap{
        width:12em; /* Give whatever width you want */
        word-wrap:break-word;
    }
    .parent {
        text-align:center;
    }
    .center {
        margin:auto;
    }
</style>
@endsection
@section('modal')
{{-- show array data --}}
<div id="show_array_data_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="array_head">Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
                {{-- <input type="hidden" name="event" value="update_array_data">
                <input type="hidden" name="field"> --}}
                <div class="modal-body" id="array_body">

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title-left')
    <h4 class="mb-sm-0">LOG DATA</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">{{strtoupper(@$log_type."")}} LOG</a></li>
        <li class="breadcrumb-item active">{{strtoupper(@$log_type."")}} LOG</li>
    </ol>
@endsection
@section('content')
<div class="card" >
    <div class="card-body">
        <form action="{{url('admin')}}/log" method="post" >
            @csrf
            <input type="hidden" name="event" value="search_data">
            <input type="hidden" name="tablename" value="{{$tablename}}">
            <div class="row m-0 mt-1">
                @foreach (isset($columnname)?$columnname:[] as $col)
                    @php
                        $arr = ['time', 'datetime'];
                        if(!in_array($col, $arr)){ continue; }
                        $col = ($col=='event') ? 'eventsearch' : $col;
                    @endphp
                    <div class="form-floating col-3 mt-2">
                        <input type="date" class="form-control form-control-sm" id="" name="{{@$col}}" placeholder="gastric_content_other"
                        value="@isset($searchkey[$col]){{@$searchkey[$col]}}@endisset">
                        @php
                            $col = ($col=='eventsearch') ? 'event' : $col;
                        @endphp
                        <label for="basiInput_gastric_content_other" class="form-label mb-1 ms-2">{{@$col}}</label>
                    </div>
                @endforeach
            </div>
            <div class="row m-0 my-3">
                <div class="col-10"></div>
                <div class="col-xl-1 mt-2">
                    <button type="submit" class="btn btn-success" style="width: 100%">Find</button>
                </div>
        </form>
            <div class="col-xl-1 mt-2">
                <a href="{{url('admin')}}/log/{{@$log_type}}?page=1" class="btn btn-danger" style="width: 100%">Reset</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div style="overflow-y: scroll; max-height: 600px;">
        @if (count($columnname) > 1)
        <div class="table-responsive table-card table-w m-1">
            <table class="table table-nowrap mb-0" id="table-search">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                            @foreach (isset($columnname)?$columnname:[] as $col)
                                <th scope="col" style="font-size: 14px">{{@$col}}</th>
                            @endforeach
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php $in = ($page == 1) ? 1 : 15 * (intval($page) - 1) + 1;  @endphp
                        @foreach(isset($data)?$data:[] as $index=>$d)
                            @php
                               $keys = $columnname;
                               $key_count = count($keys);
                            @endphp
                            <tr>
                                <td class="text-wrap" style="max-width: 100px"><a href="#" class="fw-semibold"  >{{@$in}}</a></td>
                                @for ($i = 0; $i < $key_count; $i++)
                                @if(isset($d->$keys[$i]))
                                    @php
                                        $type = gettype($d->$keys[$i]);
                                        if($keys[$i] == 'size'){
                                            $unit = '';
                                            switch(intval($d->$keys[$i])){
                                                case $d->$keys[$i] < 1048576:
                                                    $d->$keys[$i] = $d->$keys[$i] * 0.0009537;
                                                    $unit = 'kb';
                                                    break;
                                                case $d->$keys[$i] >= 1048576:
                                                    $d->$keys[$i] = $d->$keys[$i] * 0.0000009537;
                                                    $unit = 'mb';
                                                    break;
                                            }
                                            $d->$keys[$i] = number_format((float) $d->$keys[$i], 2, '.', '')." $unit";
                                        }
                                    @endphp

                                    @if ($type == 'array')
                                    @php
                                        $encode = isset($d->$keys[$i]) ? json_encode($d->$keys[$i]) : json_encode([]);
                                    @endphp
                                        <td>
                                            <button id="array_data_btn" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#show_array_data_modal" hidden>Center Modal</button>
                                            <span style="cursor: pointer" onclick="show_array_data('{{@$encode}}', '{{@$keys[$i]}}', '{{strval($d['_id'])}}')">[data]</span>
                                        </td>

                                @elseif($type != 'array' && isset($d->$keys[$i]))
                                        <td class="text-wrap" style="max-width: 100px">{{@trim($d->$keys[$i])}}</td>
                                @else
                                        <td class="text-wrap" style="max-width: 100px"></td>
                                    @endif
                                @else
                                        <td class="text-wrap" style="max-width: 100px"></td>
                                @endif
                            @endfor
                            </tr>
                            @php
                                $in = $in + 1;
                            @endphp
                        @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</div>
<div class="card parent">
    @if (is_array($data) == false)
        @if( $data->hasPages() )
            <div class="mt-2 center">
                @php
                    $this_page = isset($data) ? count($data) : 0;
                    $start     = (isset($page)) ? ((intval($page) - 1) * $paginate) + 1 : 1;
                    $end       = ($start + intval($this_page)) - 1;
                @endphp
                <p class="text-center">{{@$start}} - {{@$end}} row(s)</p>
                @if (isset($search))
                    @php
                        $arr['search']  = 'true';
                    @endphp
                    {!! $data->appends($arr)->links() !!}
                @else
                    {{$data->links()}}
                @endif
            </div>
        @endif
    @endif

</div>
@endsection




@section('script')

<script>

    function show_array_data(array_data, head, _id) {
        console.log(array_data, head, _id);
        $('#array_body').empty()

        $('#array_data_btn').click()
        $('#array_head').html(head)
        $('#field').val(head)

        var decode_data = JSON.parse(array_data)
        var keys = Object.keys(decode_data)

        try {
            decode_data.forEach((data, i) => {
                create_data_div(data, i, keys, 'array_body', head, _id)
            });
        } catch {
            var key_lg   = keys.length
            for (let j = 0; j < key_lg; j++) {
                create_data_div(decode_data[keys[j]], j, keys, 'array_body', head, _id)
            }
        }

        $('#array_body').append(`
            <div id="more_field_modal"></div>
        `)

    }

    function create_data_div(data, i, keys, append_div_id, head, _id, main_key=""){
        var data_type    = (data != null) && (data != undefined) ? typeof(data) : 'null'
        var is_show      = 'none'
        var is_data_show = 'block'
        if(data_type == 'object'){
            is_show      = 'block'
            is_data_show = 'none'
        }
        i = parseInt(i)
        var key       = keys[i]
        var line_vertical = append_div_id == 'array_body' ? '<hr>' : ''
        $(`#${append_div_id}`).append(`
            <div class="row mt-2 mb-3" id="${head}_${i}">
                <div class="col-1">
                    <i id="${head}-${key}" class="las la-caret-right" style="font-size: 14px; display: ${is_show}; cursor: pointer" onclick="array_data('${head}_${i}', '${head}-${key}', '${_id}')"></i>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-3" style="word-wrap: break-word;">${key}: </div>

                        <div class="col-9" style="word-wrap: break-word;">
                            <span style="display: ${is_data_show}">
                                <input type="hidden" name="key_${main_key}_${key}" class="form form-control" value="${key}">
                                <input type="text" name="value_${main_key}_${key}" id="value_${main_key}_${key}" class="form form-control" value="${data}" readonly>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    ${data_type}
                </div>
                <div class="col-2">
                    <div class="row">

                    </div>
                </div>
            </div>
            ${line_vertical}
        `)
    }
</script>

@endsection
