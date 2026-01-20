@extends('layouts.layouts_index.main')

@section('title', 'EndoINDEX')
@section('style')
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard-all/ckeditor.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/superadmin/index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


    @php
        $admin['controllername'] = 'endocapture/SuperadminController';
        $admin['viewname'] = 'superdamin';
        cardADMIN($admin);
    @endphp

    <div class="row m-0">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach ($files as $file)
                            <div class="col-12">
                                <h1>{{ $file['date'] }} [ {{ $file['name'] }} ]</h1>
                                <p>{!! $file['text'] !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <form action="{{ url('git') }}" method="post">
                        @csrf
                        <input type="hidden" name="event" value="update_git">
                        <div class="row">
                            <div class="col-12">
                                User :
                                <select name="user" class="form-control" required>
                                    <option value="">เลือกผู้ อัพเดท</option>
                                    <option value="master">พี่มอส</option>
                                    <option value="JuniorDev">แบงค์ถล่มโลก</option>
                                    <option value="bright">ไบร์ท</option>
                                </select>
                                Message :
                                {{-- <textarea name="message" class="form-control" rows="8" required></textarea> --}}
                                <textarea id="editor1" class="form-control" name="message" rows="8"></textarea>

                                {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                            </div>
                            <div class="col-12">&nbsp;</div>

                            <div class="col-9"></div>
                            <div class="col-3" style="display: flex; justify-content: flex-end">
                                <button type="submit" class="btn btn-primary btn-block">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection

<script>
    CKEDITOR.replace('editor1', {
        height: 260,
        width: 700,
        removeButtons: 'PasteFromWord'
    });
</script>
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>





@endsection
