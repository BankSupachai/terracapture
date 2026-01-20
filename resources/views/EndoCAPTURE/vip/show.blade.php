@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
    <style>
        .this_center{
            margin: auto;
        }
        .menu-vip{
            width: fit-content;
            text-align: center;
            margin-top: -14em;
        }
        .img-s{
            width: 7em;
        }
        body{
            background: #fff;
        }
        .form-control{
            background: rgb(243, 241, 241);
        }
    </style>
@endsection

@section('content')

<form action="{{url('vip')}}" method="post" class="this_center">
    @csrf
    <div class="menu-vip">
        {{-- <img src="{{url("public/images/vip-card.png")}}" alt="" srcset="" class="img-s"> --}}
        <label class="display-1">VIP</label>
        <br>
        <label class="display-5">กรุณาใส่รหัสผ่านเพิ่มเข้าใช้งาน</label>
        <br>
        <input type="hidden" name="event" value="decode">
        <input type="hidden" name="cid" value="{{$cid}}">
        <input type="text" name="code" class="form-control" autocomplete="off"><br>
        <button type="submit" class="btn btn-primary w-100">บันทึก</button>
    </div>
</form>

@endsection
