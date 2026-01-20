@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    #list_tables{
        height: 70vh;
        overflow-y: auto;
        overflow-x: clip;
    }
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background:  var(--vz-body-bg);
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--vz-vertical-menu-title-color-dark);;
    }
</style>

@endsection

@section('modal')


@endsection
@section('title-left')
    <h4 class="mb-sm-0">Mongo</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Mongo</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
@endsection


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-auto" id="list_tables">
                <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills" role="tablist" aria-orientation="vertical">
                    @for ($i=0;$i<count($mongo);$i++)
                    <a class="nav-link @if($i===0) active show @endif" id="tab_{{$i}}" data-bs-toggle="pill" href="#show_{{$i}}" role="tab" aria-controls="custom-v-pills-home" aria-selected="true">
                        {{$mongo[$i]}}
                    </a>
                    @endfor
                </div>
            </div> <!-- end col-->
            <div class="col-lg">
                <div class="tab-content text-muted mt-3 mt-lg-0">
                    {{-- @dd($body[26]); --}}
                    @for ($i=0;$i<count($mongo);$i++)
                    <div class="tab-pane fade  @if($i===0) active show @endif" id="show_{{$i}}" role="tabpanel" aria-labelledby="tab_{{$i}}">
                        <div class="d-flex mb-4 table-responsive">

                            @if(isset($data[$i]))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        @php
                                            $z = 0;
                                        @endphp
                                        @foreach ($data[$i][0] as $key => $v)
                                        @if($z!==0)
                                            <td>{{$key}}</td>
                                        @endif
                                        @php
                                            $z++;
                                        @endphp
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data[$i] as $key => $v)
                                    @php
                                        $z = 0;
                                    @endphp
                                    <tr>
                                        {{-- @dd($data[$i]) --}}
                                        @forelse($v as $k => $d)
                                            @if($z!==0)
                                                @if($z<10)
                                                <td>{{@$d}}</td>
                                                @else
                                                <td></td>
                                                @endif
                                            @endif
                                            @php
                                                $z++;
                                            @endphp
                                        @empty
                                        <td></td>

                                        @endforelse
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="w-100 bg-gray text-center p-3">No Data ! {{$i}}</div>
                            @endif
                        </div>
                    </div>
                    @endfor


                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>

</script>
@endsection
