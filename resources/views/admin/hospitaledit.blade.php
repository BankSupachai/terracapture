{{-- @extends('layouts.layouts_index.main') --}}
{{-- @extends('layouts.appindex') --}}
@extends('layouts.app')

@section('title', 'User edit')
@section('style')
<div class="modal fade" id="righttotreatment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="{{url('admin_hospital/1')}}" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true">&times;</span> --}}
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="rt_id" id="rt_id">
                    <input type="text" name="rt_name" class="form-control" id="rt_name">
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-lg-6"><button type="submit" class="btn btn-warning w-100" name="edit" value="1">แก้ไข</button></div>
                        <div class="col-lg-6"><button type="submit" class="btn btn-danger w-100" name="del" value="1">ลบ</button></div>
                    </div>
                </div>
            </form>
            </div>
        </div>
</div>



<div class="modal fade" id="add_righttotreatment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{url('admin_hospital')}}" method="POST">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่ม สิทธิ์การรักษา</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary w-100">เพิ่ม</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('lpage')
hospital
@endsection
@section('rpage')
<a href="{{url('/')}}">
    Administrator
</a>
@endsection
@section('rppage')
    Hospital
@endsection
@section('content')

<!-- end row -->

        <form action="{{ url('admin_hospital/'.$id) }}" method="post"  enctype="multipart/form-data"  autocomplete="off">
        <input name="hospital_id" type="hidden" value="{{$id}}">
        @method('put')
        @csrf

    <div class="row" style="margin: 0;margin-top:1em;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Main</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Treatment Coverage</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="row tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-12">
                                <div class="p-20" style="padding-top: 5px !important;">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label" for="inputEmail4">
                                                Hospital Name
                                            </label>
                                            <input class="form-control" name="hospital_name" type="text" value="{{@$hospital->hospital_name}}">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label" for="inputEmail4">
                                                Hospital Address
                                            </label>
                                            <input class="form-control" name="hospital_address" type="text" value="{{@$hospital->hospital_address}}">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label" for="inputEmail4">
                                                Hospital Phone
                                            </label>
                                            <input class="form-control" name="hospital_tel" type="text" value="{{@$hospital->hospital_tel}}">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label" for="inputEmail4">
                                                Hospital Email
                                            </label>
                                            <input class="form-control" name="hospital_email" type="text" value="{{@$hospital->hospital_email}}">
                                            </input>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label" for="inputEmail4">
                                                เลือกแสดงสี Calendar
                                            </label>
                                            <select name='config_calendarcolor'  class="form-control">
                                                <option value="doctor">แสดงสีตามหมอ</option>
                                                <option value="procedure">แสดงสีตาม procedure</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 text-center">
                                            @if(@$hospital->hospital_pic!="")
                                            <img id="imgnew" src="{{hostname("config/$hospital->hospital_pic")}}" width="200px" style="border: 1px solid gray;border-radius:15px;"><br>
                                            @endif
                                            <br>
                                                <input name="file" type="file" style="width: 200px;">
                                                </input>
                                            </br>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin: 1em 0em;">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" style="width: 90%;">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-12 mt-5 text-center">
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_righttotreatment">Add Treatment Coverage</a></div>
                            <table class="table table-hover">
                                <thead>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Select
                                    </th>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($righttotreatment as $r)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$r->name}}</td>
                                            <td><a href="#" class="btn btn-info btn_edit" this_id="{{$r->id}}" this_name="{{$r->name}}" data-toggle="modal" data-target="#righttotreatment"><i class="far fa-edit"></i></button></a>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@section('script')

    <script>
        $(".btn_edit").click(function(){
            var tr_id = $(this).attr('this_id');
            var tr_name = $(this).attr('this_name');
            $('#rt_id').val(tr_id);
            $('#rt_name').val(tr_name);
        });
    </script>

@endsection
