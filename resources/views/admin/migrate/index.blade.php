{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
    <style>
        .table-w tr td:nth-child(1) {
            width: 20%;
        }

        .table-w tr td:nth-child(2) {
            width: 15%;
        }

        .table-w tr td:nth-child(3) {
            width: 20%;
        }

        .table-w tr td:nth-child(4) {
            width: 15%;
        }

        .table-w tr td:nth-child(5) {
            width: 10%;
        }

        .table-w tr td:nth-child(6) {
            width: 10%;
        }

        ::-webkit-scrollbar {
            width: 3px !important;
            height: 3px !important;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }

        ::-webkit-scrollbar-thumb {
            background: #888 !important;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555 !important;
        }
    </style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">MIGRATE SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Migrate Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('modal')

@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row m-3">

            </div>

        </div>
    </div>
    </div>
    <div hidden>
        <form class="form" action="{{url('admin/migrate')}}" method="post">
            @csrf
            <input class="event-inp" type="hidden" name="event">
            <button class="submit-btn"></button>
        </form>
    </div>
    <div class="card" >
        <div style="overflow-y: scroll; max-height: 590px; margin-left:50px">
            <div class="table-responsive table-card table-w m-1">

                <table class="table table-nowrap mb-0" id="table-search" style="max-width: 500px;">
                    <thead class="table-light">
                        <tr>
                            <th width="30%">Name</th>
                            <th  >Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >Move Medication Data</td>
                            <td>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <button data-name="move_medication" class="btn btn-primary action-btn">Move</button>
                                    </div>
                                    <div class="col-3">
                                        <div data-name="move_medication" class="spinner-border text-dark" role="status" style="display: none">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>


                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection




@section('script')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.action-btn').on('click', function(){
        let name = $(this).data('name')
        $('.event-inp').val(name)
        $('.submit-btn').click()
    })

    $('.form').on('submit', function () {
        let name = $('.event-inp').val()
        $(`.spinner-border[data-name="${name}"]`).css('display', 'block')
    })
</script>

@endsection
