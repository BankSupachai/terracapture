@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">
    <style>
        body{
            background: #F7F7F7;
        }
        .bg-gray{
            background: #EBEBEB;
            width: 100%;
        }
        .bg-head-book{
            background: #D6D6D6;
        }
        .bg-head-book .col-8,.bg-head-book .col-4{
            font-weight: 600;
            font-size: 1.4em;
        }
        .table-bordered td{
            text-align: center;
            background: #F2F2F2;
        }
        .btn-book{
            font-size: 1.3em;
            padding: 0.8em;
        }
        .table-dark th{
            border: none !important;
        }
        .box{
            width: 1.2em;
            height: 1.2em;
        }
        .w-2{
            width: 2em;
        }
        .w-f{
            width: 15em;
        }
        .border-gray td{
            border-color: #c2c0c0;
        }
        .btn-book-mini{
            font-size: 1.2em;
            background: #9DA8CB;
            width: 100%;
            color: #fff !important;
            box-shadow: 0 5px 7px #d6d0d0;
        }
        .btn-book:hover,.btn-book-mini:hover{
            background: #7f89aa;
        }
        #kt_header{
            background: #6D7DB1;
        }
        .btn-book-edit{
            width: 100%;
            background: #FDBB2D;
            border-radius: 0;
            font-weight: 700;
        }
        .btn-book-edit:hover{
            background: #c28d1c;
        }
        .radio.radio-outline.radio-info > span {
            background-color: #fff;
        }
    </style>
@endsection

@section('modal')

@endsection

@section('content')

<div class="row m-0 px-5">
    <div class="col-3">
        <div class="bg-gray">
            <table class="table table-borderless m-0">
                <tr>
                    <td colspan="2"><b>Booking Detail</b></td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td>03/01/2022</td>
                </tr>
                <tr>
                    <td>Time :</td>
                    <td>09:00 - 12:00</td>
                </tr>
                <tr>
                    <td>Procedure :</td>
                    <td>EGD &emsp; Colonoscopy</td>
                </tr>
                <tr>
                    <td>Additional :</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Physician :</td>
                    <td>นพ.สุรัชณัฏฐ์ จิตรัตน์</td>
                </tr>
                <tr>
                    <td>หน่วย :</td>
                    <td>Sur (General 1)</td>
                </tr>
            </table>
        </div>
        <a href="" class="btn btn-book-edit">Edit booking</a>
    </div>
    <div class="col-9">
        <div class="bg-gray py-5">
            <div class="col-12 mb-5">
                <b>Patient Detail</b>
            </div>
            <div class="row m-0">
                <div class="col-4">
                    <label for="">HN(MRN) <b class="text-danger">*</b></label>
                    <input type="text" name="" id="" class="form-control form-control-sm" required>
                </div>
                <div class="col-4">
                    <label for="">เลขประจำตัวประชาชน</label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-2">
                    <label for="">คำนำหน้า</label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="">ชื่อ <b class="text-danger">*</b></label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="">ชื่อกลาง</label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="">ชื่อสกุล <b class="text-danger">*</b></label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-4">
                    <label for="">
                        วัน/เดือน/ปี เกิด <b class="text-danger">*</b>
                        <div class="row m-0">
                            <div class="col pl-0"><select name="" id="" class="form-control form-control-sm"></select></div>
                            <div class="col pl-0"><select name="" id="" class="form-control form-control-sm"></select></div>
                            <div class="col pl-0"><select name="" id="" class="form-control form-control-sm"></select></div>
                            <div class="col pl-0"><input type="text" name="" id="" class="form-control form-control-sm"></div>
                        </div>
                    </label>
                </div>
                <div class="col-4">
                    <label>เพศ <b class="text-danger">*</b></label>
                    <div class="radio-inline">
                        <label class="radio radio-outline radio-info">
                            <input type="radio" name="radios2"/>
                            <span></span>
                            ชาย
                        </label>
                        <label class="radio radio-outline radio-info">
                            <input type="radio" name="radios2"/>
                            <span></span>
                            หญิง
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="">โทรศัพท์</label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row m-0">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-4">
                    <label for="">ประเภท</label>
                    <select name="" id="" class="form-control form-control-sm"></select>
                </div>
                <div class="col-4">
                    <label for="">ความเร่งด่วน</label>
                    <select name="" id="" class="form-control form-control-sm"></select>
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-8">
                    <label for="">Pre-Diagnosis</label>
                    <input type="text" name="" id="" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-8">
                    <label for="">Pre-Diagnosis</label>
                    <textarea name="" id=""  rows="4" class="form-control form-control-sm"></textarea>
                </div>
            </div>
            <div class="row m-0 mt-4">
                <div class="col-8"></div>
                <div class="col-4"><a href="{{url('home')}}" class="btn btn-book-mini">Confirm Book</a></div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
@endsection
