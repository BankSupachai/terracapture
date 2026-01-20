@extends('layouts.appindex')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .h5{color: rgb(132, 182, 248);}
    .card-body{
        background: rgb(34, 33, 33);
    }
    .text-yellow{
        color: rgb(224, 224, 101);
    }
</style>
@endsection
@section('content')
@php
        $z = 0;
        $test = scandir($_SERVER['DOCUMENT_ROOT']."/endocapture5.0/app/Helpers");
        for($i=2;$i<count($test);$i++){
            $data = file_get_contents("D:/laragon/htdocs/endocapture5.0/app/Helpers/$test[$i]");
            $functions = explode("function ", $data);
            for($x=1;$x<count($functions);$x++){
                $fn = explode(")", $functions[$x]);
                $val[$z] = $fn[0].")";
                $z++;
            }
        }
        function color_r($name){
            $fn = explode("(", $name);
            $data = "<span class='text-yellow'>$fn[0]</span>.($fn[1]";
            $data = str_replace(')','<span class="text-white">)</span>',$data);
            $data = str_replace('(','<span class="text-white">(</span>',$data);
            $data = str_replace(',','<span class="text-white">, </span>',$data);
            $data = str_replace(';','<span class="text-white">;</span>',$data);
            echo $data;
        }
@endphp
<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    @for($y=0;$y<count($val);$y++)
                    <div class="col-4 h5 mt-2">{{color_r($val[$y].';')}}</div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')


@endsection
