@extends('layouts.layoutsManagePhoto')


@section('title', 'EndoINDEX')
@section('style')
<style>
    .cn{
        align-items: center;
    }
    .w-12per{
        width: 12%;
    }
</style>
@endsection
@section('modal')
<div class="modal fade" id="setting_esign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row m-0 cn">
              <div class="col-auto">
                  <h3>Doctor Code</h3>
              </div>
              <div class="col">
                  <input type="text" name="" id="" class="form-control">
              </div>
          </div>
          <div class="row m-0">
              <div class="col-12">
                  <img src=""  class="img-fluid">
              </div>
          </div>
          <div class="row m-0">
              <div class="col">
                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
              </div>
              <div class="col">
                  <button type="submit" class="btn btn-success w-100">Save</button>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('content')
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2">Setting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                        @php
                            $data = (object) $data;
                        @endphp
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->user_prefix}}{{$data->user_firstname}} &nbsp;&nbsp;{{$data->user_lastname}}</td>
                            <td class="w-12per">

                                @php
                                    $base64 = "";
                                    if(@$data->user_code.""!=""){
                                        if(file_exists(htdocs("config/doctor/$data->user_code.txt"))){
                                            $base64 = file_get_contents(htdocs("config/doctor/$data->user_code.txt"));
                                        }
                                    }


                                @endphp
                                <img src="{{$base64}}" width="200">



                                {{-- <button type="button" class="btn btn-primary btn-sm call_esign" data-toggle="modal" data-target="#setting_esign" data-id="{{$data->id}}">
                                    Show Esign
                                </button> --}}
                            </td>
                            <td class="w-12per">
                                <a href="{{url('esign')}}/{{$data->id}}" class="btn btn-success btn-sm">Setting Esign</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#call_esign").click(function(){
        var user_id = $(this).attr('data-id')
        alert(user_id)
    })
</script>
@endsection
