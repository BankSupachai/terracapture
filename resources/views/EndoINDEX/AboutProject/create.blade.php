@extends('layouts.layouts_index.main')

    <script src="{{ url("assets/extra/ckeditor/ckeditor.js") }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script> --}}

@section('style')


<style>

</style>
@endsection



@section('modal')

@endsection



@section('title-left')
    <h4 class="mb-sm-0">ABOUT</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">About</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<div class="card p-3">
    <div class="card-body">
        <form action="{{url("about")}}" method="post">
            @csrf
            <input type="hidden" name="event" value="create_about">
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="version" placeholder="Version">
                        <label for="floatingInput">Version</label>
                      </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="date" placeholder="Release Date">
                        <label for="floatingInput">Release Date</label>
                      </div>
                </div>
            </div>

                <textarea id="editor" class="form-control" name="about" rows="8"></textarea>
            <div class="col-12 text-end mt-2">
                <button class="btn btn-primary" type="submit">Confirm</button>
            </div>
        </form>
    </div>
</div>




@endsection










@section('script')
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection


