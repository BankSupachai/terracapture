@extends('layouts.appindex')
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
@if(isset($_GET['procedure_code']))
      {{ Form::open(['method'=>'put','url'=>'admin_mainpartadd', 'enctype'=>'multipart/form-data'] )}}
<input name="procedure_code" type="hidden" value="{{@$_GET['procedure_code']}}">
    @else
      {{ Form::open(['method'=>'put','url'=>'admin_mainpartupdate', 'enctype'=>'multipart/form-data'] )}}
    <input name="mainpart_id" type="hidden" value="{{@$_GET['mainpart_id']}}">
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">
                        <b>
                            Main Part
                        </b>
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control" name="mainpart_name" type="text" value="{{@$mainpart[0]->mainpart_name}}">
                                            <input name="procedure_code" type="hidden" value="{{$_GET['procedure_code']}}">
                                            </input>
                                        </input>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close()}}


        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-rep-plugin">
                        <a class="btn btn-success" href="{{url("admin_mainpartsubedit/?mainpart_id={{@$_GET['mainpart_id']}}")}}">
                            Add
                        </a>
                        <table class="table table-striped" id="tech-companies-1">
                            <thead>
                                <tr>
                                    <th data-priority="1">
                                        Sub-main part
                                    </th>
                                    <th width="40">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$mainpartsub as $p)
                                <tr>
                                    <th>
                                        {{ $p->mainpartsub_name}}
                                    </th>
                                    <td>
                                        <a class="btn btn-icon waves-effect waves-light btn-info" href="{{url("admin_mainpartsubedit/?mainpartsub_id={{ $p->mainpartsub_id }}&mainpart_id={{$_GET['mainpart_id']}}&procedure_code={{$_GET['procedure_code']}}")}}">
                                            <i class="fa dripicons-document-edit">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-rep-plugin">
                        <a class="btn btn-success" href="{{url("admin_smgledit/?mainpart_id={{@$_GET['mainpart_id']}}")}}">
                            Add
                        </a>
                        <table class="table table-striped" id="tech-companies-1">
                            <thead>
                                <tr>
                                    <th data-priority="1">
                                        Sub main Lesion
                                    </th>
                                    <th width="40">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$mainsubgl as $p)
                                <tr>
                                    <th>
                                        {{ $p->mainsubgl_name}}
                                    </th>
                                    <td>
                                        <a class="btn btn-icon waves-effect waves-light btn-info" href="{{url("admin_smgledit/?mainsubgl_id={{ $p->mainsubgl_id }}&mainpart_id={{$_GET['mainpart_id']}}&procedure_code={{$_GET['procedure_code']}}")}}">
                                            <i class="fa dripicons-document-edit">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </input>
</input>
<!-- container -->
<footer class="footer text-right">
    © Medica Healthcare.
</footer>
@endsection
