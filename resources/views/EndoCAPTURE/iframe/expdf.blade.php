@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('content')
    @php
        $portnumber = portnumber();
        $serverconnect = @fsockopen(getCONFIG('admin')->server_name, portnumber(), $errno, $errstr, 1);
    @endphp
    @if($serverconnect)
        <iframe
        id="iframepdf"
        src="http://endocapture:{{$portnumber}}/{{app_name()}}/expdf/view"
        width="100%"
        height="1200"
        frameBorder="0"
        scrolling="no"
        >
        </iframe>
    @else
        <div class="col-12">
            <h3 class="card-label">
                <center>
                <img src="{{url("public/images/Connection_lost.jpg")}}" width="60%" >
                </center>
            </h3>
        </div>
    @endif
@endsection
