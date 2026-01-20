@extends('layouts.layouts_index.empty')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .card-data{
        height: 80vh;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')
<br>
<div class="row m-0">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body card-data">
                <div class="list-group">
                    {{-- @foreach($alltable as $data)
                        <a href="{{url("mongodb/browse/$data")}}" class="list-group-item list-group-item-action">{{$data}}</a>

                    @endforeach --}}

                        <form>
                        <div class="mb-3 mt-3">
                          <label for="email" class="form-label">User:</label>
                          <input type="text" class="form-control" id="email" placeholder="Enter User" name="email">
                        </div>
                        <div class="mb-3">
                          <label for="pwd" class="form-label">Password:</label>
                          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        </div>
                        <a id="btn_submit" class="btn btn-primary">Submit</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

$("#btn_submit").click(function(){
    var user = $("#email").val();
    var password = $("#pwd").val();

    //mockup
    if(user=="endo" && password=="Endo123456"){
        window.location.replace("{{url("mongodb/browse/autotext")}}");
    }else{
        alert("username หรือ password ไม่ถูกต้อง");
    }


});



</script>


@endsection
