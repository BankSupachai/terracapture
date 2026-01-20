@extends('layouts.appindex')
@section('title', 'EndoINDEX')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{url('public/css/superadmin/index.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@php

@endphp

@php
$admin['controllername'] = "endocapture/SuperadminController";
$admin['viewname']       = "superdamin";
cardADMIN($admin);
@endphp

<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h1>Create</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
@endsection
