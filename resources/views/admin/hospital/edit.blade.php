
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>


</style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">ADD HOSPITAL</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Procedure Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <h4>Hospital</h4>
        {{-- <table class="table table-borderless">
              <tr>
                <td>Hospital Name</td>
                <td colspan="4"><input type="text" class="form-control" name="exampleInputEmail1" value=""></td>
              </tr>
              <tr >
                <td>Hospital Name</td>
                <td><input type="text" class="form-control" name="exampleInputEmail1" value=""></td>
              </tr>
          </table> --}}
        <form action="{{url('')}}/admin/hospital" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="event" value="edit_hospital_data">
            <input type="hidden" name="id" value="{{@$id}}">

            <div class="row">
                <div class="col-8">
                    <div class="row m-0 p-3 ">
                        <div class="col-2 " style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Name</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="hospital_name" value="{{@$config->hospital_name}}">
                        </div>
                    </div>
                    <div class="row m-0 p-3 ">
                        <div class="col-2 " style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Name (ENG)</label>
                        </div>
                        <div class="col-10">
                            {{-- @dd($config); --}}
                            <input type="text" class="form-control" name="hospital_name_eng" value="{{@$config->hospital_name_eng}}">
                        </div>
                    </div>

                    <div class="row m-0 p-3 ">
                        <div class="col-2" style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Address</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="hospital_address" value="{{@$config->hospital_address}}">
                        </div>
                    </div>
                    <div class="row m-0 p-3 ">
                        <div class="col-2" style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Address (ENG)</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="hospital_address_eng" value="{{@$config->hospital_address_eng}}">
                        </div>
                    </div>
                    <div class="row m-0 p-3 ">
                        <div class="col-2" style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Code</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="hospital_code" value="{{@$config->hospital_code}}">
                        </div>
                    </div>
                    <div class="row m-0 p-3 ">
                        <div class="col-2 " style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Phone</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" name="hospital_tel" value="{{@$config->hospital_tel}}">
                        </div>
                        <div class="col-2" style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label ">Hospital Email</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" name="hospital_email" value="{{@$config->hospital_email}}">
                        </div>
                    </div>
                    <div class="row m-0 p-3 ">
                        <div class="col-2" style="align-self: center;">
                            <label for="exampleInputEmail1" class="form-label text-nowrap">เลือกแสดงสี Calendar</label>
                        </div>
                        <div class="col-10">
                            <select name="hospital_color" class="form-control">
                                <option value="doctor" @isset($config->hospital_color) @if($config->hospital_color=='doctor') selected  @endif  @endisset>แสดงสีตามหมอ</option>
                                <option value="procedure" @isset($config->hospital_color)  @if($config->hospital_color=='procedure') selected  @endif @endisset>แสดงสีตาม procedure</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row p-3">
                        <div class="col-12 border " style="padding: 100px;">
                            {{-- @dd($img_path); --}}
                            @php
                                $ran = random_int(100000, 999999);
                            @endphp
                            <img src="{{@$img_path}}?random={{$ran}}" alt="" id="output"
                            style="margin: auto; max-width: 300px; max-height:300px">
                            <input name="file" type="file" class="form-control mt-2" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                </div>
            </div>




            <div class="col text-end">
                <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light "><i class=" ri-arrow-right-s-line label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </form>
    </div>
</div>
@endsection




@section('script')
<script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

@endsection

