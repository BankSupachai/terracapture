@extends('layouts.layout_capture')
@section('title', 'EndoINDEX')

@section('style')
<style>
     .text-procedure{
        color: #FF0000;
        font-weight: bold;
    }


    .border-secondary{
        border-right-color: #BEBEBE !important;
    }
    .form-control-sm{
        text-align: center;
    }
    .cardpre{
        padding-right: 2em;
        padding-left: 2em;
    }

    .mt-09{
        margin-top: 0.9em;
    }
    @media screen (max-width: 991px){

    }
</style>
@endsection

@section('modal')

@endsection


@section('content')

@include('endocapture.home6.components.case.patients')
@include('endocapture.home6.components.case.pre_procedure')



@endsection






@section('lpage')
@endsection
@section('rpage')
@endsection
@section('rppage')
@endsection


@section('script')

@endsection
