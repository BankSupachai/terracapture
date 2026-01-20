@extends('layouts.appindex')
@section('title', 'User edit')
@section('content')

  <script src="{{asset('js/jquery-1.12.4.js')}}"></script>
  <script>

  $(function() {
    $("#datepicker").datepicker({format: 'dd-mm-yyyy'});
    $("#datepicker").on("change", function(){var fromdate = $(this).val();});
  });

  </script>



                        <!-- end row -->


                        @if(isset($_GET['id']))
                          <form action="{{url("admin_scope/{{@$_GET['id']}}")}}" method="post"  enctype="multipart/form-data"  autocomplete="off">
                          <input type="hidden" name="scope_id" value="{{@$_GET['id']}}">
                          @method('PUT')
                        @else
                          <form action="{{url("admin_scope")}}" method="post"  enctype="multipart/form-data"  autocomplete="off">
                            @method('POST')
                        @endif

                        @csrf
                        <div class="row" style="margin: 0;margin-top:1em;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-card-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-20" style="padding-top: 0 !important;">


                                                    <div class="form-row">

                                                    <div class="col-md-12">
                                                        <label for="inputEmail4" class="col-form-label">Scope Name </label>
                                                        <input name="scope_name" type="text" class="form-control" value="{{@$scope[0]->scope_name}}" required>
                                                    </div>
                                                    </div>

                                                    <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label">Scope Brand </label>
                                                        <input name="scope_band" type="text" class="form-control" value="{{@$scope[0]->scope_band}}" required>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label">Scope Model </label>
                                                        <input name="scope_model" type="text" class="form-control" value="{{@$scope[0]->scope_model}}" required>
                                                    </div>
                                                    </div>

                                                    <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label">Serial Number </label>
                                                        <input name="scope_serial" type="text" class="form-control" value="{{@$scope[0]->scope_serial}}" required>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label">Installation Date </label>

                                                        <input name="scope_installdate" type="text" class="form-control" id="datepicker" placeholder="วันที่นำเข้า" value="{{@$scope[0]->scope_installdate}}"   autocomplete="off" required>

                                                    </div>
                                                    </div>



                                                    <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4" class="col-form-label">Top </label>
                                                        <input name="scope_top" type="number" class="form-control" value="{{@$scope[0]->scope_top}}" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4" class="col-form-label">Bottom </label>
                                                        <input name="scope_bottom" type="number" class="form-control" value="{{@$scope[0]->scope_bottom}}" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4" class="col-form-label">Left </label>
                                                        <input name="scope_left" type="number" class="form-control" value="{{@$scope[0]->scope_left}}" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4" class="col-form-label">Right </label>
                                                        <input name="scope_rigth" type="number" class="form-control" value="{{@$scope[0]->scope_rigth}}" required>
                                                    </div>

                                                    </div>

                                                    <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Manual Crop</label>
                                                        <input name="scope_autocrop" type="checkbox" class="form-control" value="0" @if(@$scope[0]->scope_autocrop!=0 && $scope[0]->scope_autocrop!="") checked @endif>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Comment </label>
                                                        <input name="scope_comment" type="text" class="form-control" value="{{@$scope[0]->scope_comment}}">
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
                                        <!-- end row -->

                                    </div> <!-- end card-box -->
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div> <!-- container -->
{{ Form::close()}}

                <footer class="footer text-right">
                    © Medica Healthcare.
                </footer>




@endsection
