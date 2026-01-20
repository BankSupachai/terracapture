@extends('layouts.app')
@section('title', 'User edit')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">
                User
            </h4>
            <ol class="breadcrumb float-right">
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
<!-- end row -->
@if(isset($_GET['mainproblem_id']))
                          {{ Form::open(['method'=>'put','url'=>'admin_mpproblemupdate', 'enctype'=>'multipart/form-data'] )}}
<input name="mainproblem_id" type="hidden" value="{{@$_GET['mainproblem_id']}}">
    @else
                          {{ Form::open(['method'=>'put','url'=>'admin_mpproblemadd', 'enctype'=>'multipart/form-data'] )}}
    <input name="mainpart_id" type="hidden" value="{{@$_GET['mainpart_id']}}">
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">
                        <b>
                            Main part problem
                        </b>
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control" name="mainproblem_name" type="text" value="{{@$mainproblem[0]->mainproblem_name}}">
                                            <input name="mainpart_id" type="hidden" value="{{$_GET['mainpart_id']}}">
                                            </input>
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
                <!-- end card-box -->
            </div>
            <!-- end col -->
        </div>
    </input>
</input>
<!-- container -->
{{ Form::close()}}
<footer class="footer text-right">
    © Medica Healthcare.
</footer>
@endsection
