@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
    <link href="{{ url('public/extra/esign/colorpicker.css') }}" rel="stylesheet">
    <link href="{{ url('public/extra/esign/literally.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
        }
        .fs-container {
            width: 100%;
            height: 100%;
            margin: auto;
        }
        .literally {
            width: 2000px;
            height: 800px;
        }
        #canvas{
            width: 2000px;
            height: 800px;
        }
        .toolbar{
            display:none;
        }
    </style>
@endsection



@section('content')
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h1>Complete</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
