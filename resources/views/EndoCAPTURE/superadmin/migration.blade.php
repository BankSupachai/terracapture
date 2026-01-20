@extends('layouts.appindex')
@section('title', 'EndoINDEX')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{url('public/css/superadmin/index.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="modal fade" id="migratdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ยืนยันการ Migration ข้อมูล</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <a href="{{url('migratdata/1')}}"  class="btn btn-success"><i class="fas fa-check"></i> ยืนยัน</a>
        </div>
      </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <a href="{{ url()->previous() }}"><i class="fas fa-angle-double-left text-warning"></i></a>
            </div>
            <h1 class="text-center my-4">ปรับการใช้ procedureID เป็น procedureCODE</h1>
            <div class="col-lg-12 text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#migratdata">
                    <i class="fab fa-staylinked icon-5x"></i><br>
                    Migration Data
                </button>
            </div>

            <div class="col-12">
                <form action="migratdata" method="POST">
                    @csrf
                    tb_case
                    <input name="event" value="tb_case" type="hidden">
                    <button type="submit" class="btn btn-info">ตกลง</button>
                </form>
            </div>
            <br><br>
            <div class="col-12">
                <form action="migratdata" method="POST">
                    @csrf
                    tb_mainpart
                    <input name="event" value="tb_mainpart" type="hidden">
                    <button type="submit" class="btn btn-info">ตกลง</button>
                </form>
            </div>

            <br><br>


            <div class="col-12">
                <form action="migratdata" method="POST">
                    @csrf
                    Table
                    <input name="event" value="change_id2code" type="hidden">
                    <input name="table" class="form-control">
                    <button type="submit" class="btn btn-info">ตกลง</button>
                </form>
            </div>




        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
