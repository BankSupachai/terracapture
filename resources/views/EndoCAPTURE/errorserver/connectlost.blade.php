@extends('capture.layoutv6')
@section('style')
<style>
    .fiximage{
    width: 600px;
    }

    .containner{
                padding-top: 50px;
                padding-bottom: 50px;
                padding-left:220px;

            }
     .boxwhite{
    width: 1300px;
    height: 650px;
     background: white;
       }
    .fs-20{
        font-size: 18px;
        color: #495057;
        /* font-weight: bold; */
    }

</style>
@endsection

@section('content')
<div class="containner">

         <div class="boxwhite text-center">
            <img class="" style="width: 120px; margin-top: 140px;" src="{{url("public/image/arrow.png")}}" alt="">
            <div class="col-12 text-center mt-4 fs-20 ">
            WE CAN’T CONNECT TO SERVER.
            </div>
            <div class="col-12 text-center mt-2 fs-12" style="color: #878A99">
                Report function is available although disconnect server with Semi-Decentralize
            </div>
            <div class="col-12 text-center mt-4">
                <button type="button" class="btn btn-success waves-effect waves-light" style="width: 30%;">Back to Case List (Normal Use)</button>
            </div>
        </div>


</div>


@endsection
