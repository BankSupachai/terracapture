{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')


@endsection

@section('modal')


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">Create collection</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Mongo</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol> --}}
@endsection


@section('content')
    <form action="{{url('createcollection')}}" enctype="multipart/form-data" method="post" class="card">
        @method('POST')
        @csrf
        <div class="card-body">
            <div class="row m-0">
                <div class="col-lg-12">
                    <input type="file" accept='text/plain/.json' multiple  id="jsoninp" class="form-control" name="files[]" required>
                </div>
            </div>
            <div class="row m-0 mt-2" id="list_collection"></div>
            <div class="row m-0 mt-2">
                <div class="col-lg">
                </div>
                <div class="col-lg-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>

@endsection


@section('script')
<script>

</script>
@endsection
