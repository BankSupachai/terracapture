@extends('layouts.small-scale')

@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<br>
<div class="row p-5 cn">
    <div class="col-12 mb-2">
        <div class="f-15 text-white">
            VIDEO SETTING
        </div>
    </div>
    <div class="col-10 mt-3">
        <table class="table table-borderless" id="vdo_setting">
            <tr>
                <td>Input</td>
                <td class="text-center">Off/On</td>
                <td>Source</td>
                <td>Name</td>
            </tr>
            @for ($i=1;$i<=5;$i++)

            <tr>
                <td>Input {{$i}}</td>
                <td class="text-center">
                    <div class="col-2 m-auto">
                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                            <input type="checkbox" class="form-check-input" id="customSwitchsizelg" checked="">
                        </div>
                    </div>
                </td>
                <td><select name="" id="" class="form-control input-dark text-white"><option value="">Source A</option></select></td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="Endoscope"></td>
            </tr>
            @endfor
        </table>
    </div>
</div>
@endsection
@section('script')

@endsection
