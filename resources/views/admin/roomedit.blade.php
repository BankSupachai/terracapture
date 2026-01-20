@extends('layouts.appinddex')
@section('title', 'User edit')
@section('content')
<div class="row" style="margin: 0;">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <h4 class="page-title float-left" style="margin: 0;margin-top:0.5em;">
                    User
                </h4>
                <ol class="breadcrumb float-right" style="margin: 0;">
                    <li class="breadcrumb-item">
                        <a href="#">
                            Administrator
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            User
                        </a>
                    </li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end row -->
@if(isset($_GET['id']))
    <form action="{{url("admin_room/{{@$_GET['id']}}")}}" method="post"  enctype="multipart/form-data"  autocomplete="off">
    <input name="room_id" type="hidden" value="{{@$_GET['id']}}">
    @method('PUT')
@else
    <form action="{{url("admin_room")}}" method="post"  enctype="multipart/form-data"  autocomplete="off">
        @method('POST')
@endif
@csrf
    <div class="row" style="margin: 0;margin-top:1em;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-t-0 header-title">
                        <b>
                            Room
                        </b>
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control" name="room_name" type="text" value="{{@$room[0]->room_name}}">
                                        </input>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end card-box -->
        </div>
        <!-- end col -->
    </div>
</input>
<!-- container -->
{{ Form::close()}}
<footer class="footer text-right">
    © Medica Healthcare.
</footer>
@endsection
