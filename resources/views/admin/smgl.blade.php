    @extends('layouts.appindex')
    @section('title', 'User edit')
    @section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">User</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="#">Administrator</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- end row -->


    @if(isset($_GET['mainsubgl_id']))
        {{ Form::open(['method'=>'put','url'=>'admin_smglupdate', 'enctype'=>'multipart/form-data'] )}}
        <input type="hidden" name="mainsubgl_id" value="{{@$_GET['mainsubgl_id']}}">
    @else
        {{ Form::open(['method'=>'put','url'=>'admin_smgladd', 'enctype'=>'multipart/form-data'] )}}
        <input type="hidden" name="mainpart_id" value="{{@$_GET['mainpart_id']}}">
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Main part problem</b></h4>
                <div class="row">
                    <div class="col-12">
                        <div class="p-20">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input name="mainsubgl_name" type="text" class="form-control" value="{{@$mainsubgl[0]->mainsubgl_name}}">
                                    <input name="mainpart_id" type="hidden" value="{{$_GET['mainpart_id']}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div><!-- end col -->
    </div>

    </div> <!-- container -->

    {{ Form::close()}}
    <footer class="footer text-right">
        © Medica Healthcare.
    </footer>

@endsection
