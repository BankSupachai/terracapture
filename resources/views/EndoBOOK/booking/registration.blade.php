@extends('layouts.app')
@section('title', 'EndoCapture')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('') }}/public/css/patient/create.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/public/css/nurse/show.css" rel="stylesheet" type="text/css" />
    <style>
        .list-patient-detail{
            background: #FEF2DF;
            padding-bottom: 3em;
        }
        .book-regis{
            margin-top: -3em;
        }
        #kt_content{padding: 0;}
        .book-regis .row.m-0:first-child{display: none;}
        #imgnew{height: 5em;width: 5em;}
    </style>
@endsection
@section('content')
<div class="row m-0 list-patient-detail cn">
    <div class="col-lg-1 p-4 text-center">
        @if(@$patient->pic=="")
            <img  id="imgnew" src="{{asset('public/images/avatar.png')}}"/>
        @else
            <img  id="imgnew" src="{{url("pic_patient/$patient->pic")}}?a={{date("Y-m-dH:i:s")}}"/>
        @endif
    </div>
    <div class="col-lg">
        <h4>{{$hn}} &emsp; {{$name}} &emsp; {{$age}}</h4>
        <span class="text-gray-small">Gender : {{$gender}} &emsp;|&emsp; Date of birth : {{$dob}} &emsp;|&emsp; Tel : {{$phone}} &emsp;|&emsp; E-mail : {{$email}}</span>
    </div>
    <div class="col-lg-1">
        <a href="{{('')}}" class="btn btn-book">Edit Profile</a>
    </div>
</div>
<div class="col-12 book-regis">
    <div class="card">
        <div class="card-body">
            @component("endonote.nursenote.component.history1",$view) @endcomponent
        </div>
    </div>
</div>


@endsection


@section('script')
<script>
    var KTSelect2 = function() {
        var demos = function() {
            $('.select-nurse').select2({
                placeholder: "Nurse",
                allowClear: true
            });
            $('.select-physician').select2({
                placeholder: "Physician",
                allowClear: true
            });
        }
        return {
            init: function() {
                demos();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTSelect2.init();
    });
    $('.kt_timepicker_2').timepicker({
       minuteStep: 1,
       defaultTime: '',
       showSeconds: false,
       showMeridian: false,
       snapToStep: true
    });
    </script>


<script>
    $('.save-note').on('focusout change', function() {
            var this_id     = $(this).attr('id');
            var this_type   = $(this).attr('type');

            var value   = $(this).val()
            if(this_type=='checkbox'){
                if($(this).is(':checked')){

                }else{
                    value = 'false';
                }
            }
            $.post('{{ url('api/jquery') }}', {
                event   : 'save_note',
                idhtml  : this_id,
                value   : value,
                step    : "history1",
                id      : '{{$id}}',
            }, function(data, status) {
                console.log(data);
            });
        });
        $(".select-physician").change(function(){
            var this_id = $(this).attr('id');
            var value   = $(this).val()
            $.post('{{ url('api/jquery') }}', {
                event   : 'save_note',
                idhtml  : this_id,
                value   : value,
                step    : "history1",
                id      : '{{$id}}',
            }, function(data, status) {
                console.log(data);
            });
        })
        $('.save-note-radio').click(function(){
            var this_id     = $(this).attr('name');
            var value   = $(this).val()
            $.post('{{ url('api/jquery') }}', {
                event   : 'save_note',
                idhtml  : this_id,
                value   : value,
                step    : "history1",
                id      : '{{$id}}',
            }, function(data, status) {
                console.log(data);
            });
        })
</script>
@endsection
