@extends('layouts.app_unmenu')
@section('title', 'Ramaconnect')
@section('content')
<script src="{{url('public/camera/jquery.min.js')}}"></script>
<script src="{{url('public/camera/bootstrap.min.js')}}"></script>
<script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script>


    <div class="row" style="margin: 0;margin-top:0.5em;">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="padding: 1em;">
                            @php
                                // dd($user);
                                // +"personId": ""
                                // +"fullName_TH": ""
                                // +"fullName_EN": ""
                                // +"position": "พยาบาล"
                                // +"role": "N"
                                // +"departmentSid": ""
                                // +"departmentSub": "ศูนย์ส่องกล้องระบบทางเดินอาหารและห้องปฏิบัติการประสาททางเดินอาหารและการเคลื่อนไหวฯ"
                                // +"departmentMid": ""
                                // +"departmentMain": "ศูนย์ส่องกล้องระบบทางเดินอาหารและห้องปฏิบัติการประสาททางเดินอาหารและการเคลื่อนไหวฯ"
                                $exname = explode(" ",$user->fullName_TH);
                            @endphp

                            <form action="{{url("api/ramaconnect")}}" class="row" method="POST">
                                @csrf
                                <input type="hidden" name="event"       value="user_add">
                                <input type="hidden" name="email"       value="{{$user->personId}}">
                                <input type="hidden" name="password"    value="{{$user->pass}}">

                                <div class="col-lg-2" style="padding-bottom: 3px;">
                                    <label>คำนำหน้า</label>
                                    <input name="user_prefix" value="" class="form-control" placeholder="" required>
                                </div>

                                <div class="col-lg-5" style="padding-bottom: 3px;">
                                    <label>ชื่อ</label>
                                    <input name="user_firstname" value="{{@$exname[0]}}" class="form-control" placeholder="" required>
                                </div>
                                <div class="col-lg-5" style="padding-bottom: 3px;">
                                    <label>นามสกุล</label>
                                    <input name="user_lastname" value="{{@$exname[1]}}" class="form-control" placeholder="" required>
                                </div>

                                <div class="col-lg-12" style="padding-bottom: 3px;">
                                    <label>ตำแหน่งงาน</label>
                                    <select name="user_type" required class="form-control">
                                        <option value="">เลือกตำแหน่งงาน</option>
                                        <option value="doctor">แพทย์</option>
                                        <option value="nurse">พยาบาล</option>
                                        <option value="nurse">ผู้ช่วยพยาบาล</option>
                                    </select>
                                </div>

                                <div class="col-lg-12" style="padding-bottom: 3px;">
                                    <label>แผนก</label>
                                    <select name="department_id[]" class="form-control selectpicker" multiple required>
                                        <option value="1">ศูนย์ส่องกล้อง (อาคารศูนย์การแพทย์สมเด็จพระเทพรัตน์)</option>
                                        <option value="3">ห้องผ่าตัด</option>
                                        <option value="4">ศูนย์ส่องกล้อง (อาคารศูนย์การแพทย์สิริกิติ์)</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>


                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success" style="width: 100%;">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        </div>
    </div>
@endsection


@section('endscript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"> </script>
    <script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
@endsection
