@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('content')
<style>
    #iframepdf{
        border:none !important;
    }
</style>
<iframe id="iframepdf"
src="http://{{getCONFIG('admin')->server_name}}:{{$portnumber}}/endocapture5.0/expdf/view" width="100%" height="100%">
</iframe>
@endsection
