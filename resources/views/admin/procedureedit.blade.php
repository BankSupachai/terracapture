{{-- @extends('layouts.layouts_index.main') --}}
@extends('layouts.app')

@section('title', 'User edit')


@section('style')
<style>
    .btn-tap{
        background: #f5f7fa;
        width: 100%;
    }
    .btn-tap:hover{
        background:  #32ccff;
        color: #ffff;
    }
    .nav-customs.nav .nav-link.active, .nav-customs.nav .nav-link.active:after, .nav-customs.nav .nav-link.active:before {
        background: #32ccff !important;
        color: #fff;
    }
    .fc-field.ui-sortable-handle{
        padding: 0.3em;
    }
.fc-field.ui-sortable-handle:active{background: steelblue;color: white;}
</style>

@endsection

@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{url("public/fieldchooser/stylesheets/style1.css")}}" /> --}}
<link rel="stylesheet" type="text/css" href="{{url("public/fieldchooser/stylesheets/jquery-ui.css")}}" />
<link rel="stylesheet" type="text/css" href="{{url("public/css/admin/procedureedit.css")}}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- <link rel="stylesheet" href="{{url('public/css/procedure/procedure_edit.css')}}" rel="stylesheet" type="text/css"> --}}
<br>
<div class="modal fade" id="adsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/procedure')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameprocedure">ชื่อ Procedure</label>
                    <input type="text" class="form-control" id="nameprocedure" name="sp_name" required>
                    <small id="nameprocedure" class="form-text text-muted">ชื่อ Procedure ต้องการเพิ่ม</small>
                </div>
                <div class="form-group">
                    <label for="procedureblade">ชื่อไฟล์</label>
                    <input type="text" class="form-control" id="procedureblade" name="sp_file" required>
                    <small id="procedureblade" class="form-text text-muted">ชื่อไฟล์ Procedure .Blade</small>
                </div>
                <button type="submit" class="btn btn-primary" name="add_sp" value="1" style="width: 100%;">เพิ่ม</button>
            </form>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="edsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/procedure')}}/1" method="POST" enctype="multipart/form-data">
                @method('DELETE')
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name_procedure">เลือก Procedure</label>
                    <select class="form-control" id="name_procedure_edit" name="sp_id">
                        <option value="">เลือก</option>
                        @foreach ($all_procedure as $ap)
                            <option value="{{$ap->sp_id}}" class="pcd{{$ap->sp_id}}" this_name="{{$ap->sp_name}}" this_file="{{$ap->sp_file}}">{{$ap->sp_name}}</option>
                        @endforeach
                    </select>
                    <small id="name_procedure" class="form-text text-muted">ชื่อ Procedure ที่ต้องการแก้ไข</small>
                </div>

                <div class="form-group mt-2">
                    <label for="nameprocedure">ชื่อ Procedure</label>
                    <input type="text" class="form-control" id="sp_name_edit" name="sp_name">
                    <small id="nameprocedure" class="form-text text-muted">ชื่อ Procedure</small>
                </div>
                <div class="form-group">
                    <label for="procedureblade">ชื่อไฟล์</label>
                    <input type="text" class="form-control" id="sp_file_edit" name="sp_file">
                    <small id="procedureblade" class="form-text text-muted">ชื่อไฟล์ Procedure .Blade</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning" name="btn_edit" value="1" style="width: 100%;">แก้ไข</button>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-danger" name="btn_del" value="1" style="width: 100%;">ลบ</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- <script src="{{url('public/js/procedure/procedure_edit.js')}}"></script> --}}

<div class="modal fade" id="pdfadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/procedure')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="pdfnameprocedure">ชื่อ PDF Procedure</label>
                    <input type="text" class="form-control" id="pdfnameprocedure" name="pdf_name">
                    <small id="pdfnameprocedure" class="form-text text-muted">ชื่อ PDF Procedure ต้องการเพิ่ม</small>
                </div>
                <div class="form-group">
                    <label for="pdfprocedureblade">ชื่อไฟล์ PDF</label>
                    <input type="text" class="form-control" id="pdfprocedureblade" name="pdf_file">
                    <small id="pdfprocedureblade" class="form-text text-muted">ชื่อไฟล์ PDF Procedure .Blade</small>
                </div>
                <button type="submit" class="btn btn-primary" name="addpdf" value="1" style="width: 100%;">เพิ่ม</button>
            </form>
        </div>
      </div>
    </div>
</div>

    <input name="procedure_code" type="hidden" value="{{@$_GET['procedure_code']}}">

    <div class="row" style="margin:0;">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <div class="row ">
                            <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab"  role="tab" id="tab5"><b>Procedure Setting</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"  role="tab" id="tab6"><b>PDF procedure Setting</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"  role="tab" id="tab7"><b>PDF NEW</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"  role="tab" id="tab1"><b>Information</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"  role="tab" id="tab2"><b>Procedure (ICD-9)</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" role="tab" id="tab3"><b>Diagnostic (ICD-10)</b></a>
                                </li>
                            </ul>
                            <br><br>
                        </div>
                    </div>
                    <div class="col-2 " style="text-align: right;">
                        <h5>{{@$procedure->procedure_name}}</h5>
                    </div>
                </div>
                <div id="showtab5" class="col-lg-12 mt-5 pt-3">
                    <h4>ตั้งค่า Procedure</h4>
                    <div class="row" style="">
                        <div class="col-6" style="text-align: right;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adsp">
                                เพิ่ม Procedure Detail
                            </button>
                        </div>
                        <div class="col-6">
                            &emsp;
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edsp">
                                จัดการ Procedure Detail
                            </button>
                        </div>


                    </div>
                    <div class="row" style="margin-top: 2em;">
                        <div id="fieldChooser" tabIndex="1" style="height: 100%;width: 100%;" class="row">
                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-primary" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">ยังไม่ได้ใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="sourceFields" class="procedure_out">
                                            @foreach ($setting as $st)
                                                <div name="{{$st->sp_file}}">{{$st->sp_name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-success" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">เปิดใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="destinationFields" class="procedure_in">
                                            @for($j=0;$j<count($json);$j++)
                                            @php
                                                $name_pro = DB::table('tb_procedure_set')->where('sp_file',$json[$j])->first();
                                            @endphp
                                            @if(@$name_pro->sp_file!=""||@$name_pro->sp_file!=null)<div name="{{@$name_pro->sp_file}}">{{@$name_pro->sp_name}}</div>@endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div id="showtab6">
                    <h4 class="mt-5 pt-5">ตั้งค่า PDF Procedure</h4>
                    <div class="row" style="justify-content: center;">
                        <button type="button" class="btn btn-primary w-25" data-toggle="modal" data-target="#pdfadd">
                            เพิ่ม PDF Procedure Detail
                        </button>
                    </div>
                    <div class="row" style="margin-top: 2em;">
                        <div id="fieldChooser2" tabIndex="1" style="height: 100%;width: 100%;" class="row">
                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-primary" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">ยังไม่ได้ใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="sourceFields2" class="pdf_procedure_out">

                                            @foreach ($settingpdf as $st)
                                                <div name="{{@$st->pdf_file}}">{{@$st->pdf_name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-success" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">เปิดใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="destinationFields2" class="pdf_procedure_in">
                                            @for($j=0;$j<count($json2);$j++)
                                            @php
                                                $name_pro = DB::table('tb_procedure_pdf')->where('pdf_file',$json2[$j])->first();
                                            @endphp

                                            @if(@$name_pro->pdf_file!=""||@$name_pro->pdf_file!=null)<div name="{{@$name_pro->pdf_file}}">{{@$name_pro->pdf_name}}</div>@endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="showtab7" class="pt-5 mt-5 col-lg-12">
                    <h4 class="mt-5">ตั้งค่า PDF NEW</h4>
                    {{-- <div class="row pb-5">
                        <button type="button" class="btn btn-primary m-auto" data-toggle="modal" data-target="#pdfadd">
                            เพิ่ม PDF NEW
                        </button>
                    </div> --}}

                    <div class="row m-auto" style="margin-top: 2em;">
                        <div id="fieldChooser3" tabIndex="1" style="height: 100%;width: 100%;" class="row">
                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-primary" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">ยังไม่ได้ใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="sourceFields3" class="pdf_procedure_out3 w-100">
                                            <div name="table_s">table_s</div>
                                            <div name="table_e">table_e</div>
                                            <div name="tr_s">tr_s</div>
                                            <div name="tr_e">tr_e</div>
                                            <div name="td_s">td_s</div>
                                            <div name="td_s2">td_s2</div>
                                            <div name="td_e">td_e</div>
                                            @foreach ($settingpdf as $st)
                                                <div name="{{@$st->pdf_file}}">{{@$st->pdf_name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card" style="border-radius: 0;border:none;">
                                    <div class="card-header text-white bg-success" style="padding: 5px;border-radius: 15px 15px 0px 0px;">
                                        <h3 style="text-align-last: center;color:#fff;margin: 0;">เปิดใช้งาน</h3>
                                    </div>
                                    <div class="card-body" style="padding: 0;">
                                        <div id="destinationFields3" class="pdf_procedure_in3 w-100">
                                            @for($j=0;$j<count($json2);$j++)

                                                @php
                                                    $name_pro = DB::table('tb_procedure_pdf')->where('pdf_file',$json2[$j])->first();
                                                @endphp

                                                @if(@$name_pro->pdf_file!=""||@$name_pro->pdf_file!=null)
                                                    <div name="{{@$name_pro->pdf_file}}">{{@$name_pro->pdf_name}}</div>
                                                @endif

                                                @if($name_pro==null)
                                                    <div name="{{@$json2[$j]}}">{{@$json2[$j]}}</div>
                                                @endif


                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="showtab1">
                    <h4 class="m-t-0 header-title">

                    @if(Request::segment(2)!="create")

                        <form action="{{url('admin/procedure')}}/{{Request::segment(2)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                    @else
                        <form action="{{url('AdminProcedure')}}" method="POST" enctype="multipart/form-data">

                        {{csrf_field()}}
                    @endif


                    </h4>
                    <div class="row">
                        <div class="col-12">

                                <div class="row">
                                    <div class="col-6 h-100 d-inline-block">
                                        {{-- <div class="card-box"> --}}
                                            <div class="row p-3">
                                                <div class="col-12">
                                                    <br>
                                                    @if(@$procedure->procedure_pic!="" || @$procedure->procedure_pic!=null)
                                                        <img id="imgnew" src="{{url("public/images/{{@$procedure->procedure_pic}}")}}" width="400px"/>
                                                    @endif
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input name="file" type="file" class="custom-file-input" id="inputGroupFile02">
                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    </div>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Procedure Scope</span>
                                                    </div>
                                                    <input name="procedure_scope" type="text" value="{{@$procedure->procedure_scope}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    </div>
                                                    <input name="procedure_color" type="text" value="{{@$procedure->procedure_color}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Procedure Name</span>
                                                    </div>
                                                    <input name="procedure_name" type="text" value="{{@$procedure->procedure_name}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                </div>


                                            </div>
                                        {{-- </div> --}}
                                    </div>

                                        @php
                                        $json = jsonDecode(@$procedure->procedure_json);
                                        $price_charge           = @$json->price_charge;
                                        $price_procedure        = @$json->price_procedure;
                                        $rtt_government         = @$json->rtt_government;
                                        $rtt_insurance_health   = @$json->rtt_insurance_health;
                                        $rtt_insurance_social   = @$json->rtt_insurance_social;
                                        $rtt_insurance_foreign  = @$json->rtt_insurance_foreign;
                                        $rtt_insurance_life     = @$json->rtt_insurance_life;
                                        @endphp



                                    <div class="col-6">
                                        <div class="card-box">
                                                <div class="row p-3">
                                                    <div class="form-group col-md-12">
                                                        <label class="col-form-label" for="inputEmail4">งบประมาณ</label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text" id="basic-addon3">ราคาหัตถการ (Charge คนไข้)</span>
                                                        </div>
                                                        <input name="price_charge" value="{{$price_charge}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text" id="basic-addon3">ราคาหัตถการ (ราคาต้นทุน)&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        </div>
                                                        <input name="price_procedure" value="{{$price_procedure}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="col-form-label" for="inputEmail4">สิทธิเบิก</label>
                                                    </div>
                                                    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">ข้าราชการ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>           <input  name="rtt_government"           value="{{$rtt_government}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3"></div>
                                                    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">บัตรประกันสุขภาพ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>                                                                              <input name="rtt_insurance_health"      value="{{$rtt_insurance_health}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3"></div>
                                                    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">ประกันสังคม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>                            <input name="rtt_insurance_social"      value="{{$rtt_insurance_social}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3"></div>
                                                    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">กองทุนผู้ประกันตนคนต่างด้าว</span></div>                                                                                                                                                                      <input name="rtt_insurance_foreign"     value="{{$rtt_insurance_foreign}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3"></div>
                                                    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">ประกันชีวิต&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>                 <input name="rtt_insurance_life"        value="{{$rtt_insurance_life}}" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="card-box">
                                            <button class="btn btn-primary waves-effect waves-light btn-block w-100 " type="submit">
                                                Save
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    {{ Form::close()}}


                <div id="showtab2">






                    <form action="{{url('addicd9')}}/{{Request::segment(2)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <input name='pid' type="hidden" value="{{Request::segment(2)}}">
                        <table class="table table-borderless">
                            <tr>
                                <td width="400">Procedure group</td>
                                <td>ICD-9</td>
                                <td>เงินสด</td>
                                <td>ข้าราชการ</td>
                                <td>บัตรประกันสุขภาพ</td>
                                <td>ประกันสังคม</td>
                                <td>กองทุนผู้ประกันตนคนต่างด้าว</td>
                                <td>ประกันชีวิต</td>
                            </tr>
                            @if(isset($tb_proicd9))
                            @foreach($tb_proicd9 as $di)
                            <tr>
                                <td><input name="nameicd9[{{$di->proicd9_id}}]"     value="{{$di->proicd9_name}}" class="form-control"></td>
                                <td><input name="valueicd9[{{$di->proicd9_id}}]"    class="bbb form-control" type="text" value="{{$di->icd9}}"></td>

                                @php
                                    $json = jsonDecode($di->icd9_json);
                                    $price_charge           = @$json->price_charge;
                                    $rtt_government         = @$json->rtt_government;
                                    $rtt_insurance_health   = @$json->rtt_insurance_health;
                                    $rtt_insurance_social   = @$json->rtt_insurance_social;
                                    $rtt_insurance_foreign  = @$json->rtt_insurance_foreign;
                                    $rtt_insurance_life     = @$json->rtt_insurance_life;
                                @endphp

                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][price_charge]"             value="{{$price_charge}}" class="form-control"></td>
                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][rtt_government]"           value="{{$rtt_government}}" class="form-control"></td>
                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][rtt_insurance_health]"     value="{{$rtt_insurance_health}}" class="form-control"></td>
                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][rtt_insurance_social]"     value="{{$rtt_insurance_social}}" class="form-control"></td>
                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][rtt_insurance_foreign]"    value="{{$rtt_insurance_foreign}}" class="form-control"></td>
                                <td><input type="number" name="price_type[{{$di->proicd9_id}}][rtt_insurance_life]"       value="{{$rtt_insurance_life}}" class="form-control"></td>
                            </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td align="right" colspan="9">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="right" colspan="9">
                                    <button type="submit" class="btn btn-success btn-block w-100"> Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>


                                    <br>
                                    <br>
                    <form action="{{url('addicd9')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input name='pid' type="hidden" value="{{Request::segment(2)}}">
                        <div class="row">
                            <div class="col-5">
                                <label>Procedure group</label>
                                <input name="icd9name" class="form-control">
                            </div>
                            <div class="col-5">
                                <label>ICD-9</label>
                                <input name="icd9value" class="form-control">
                            </div>

                            <div class="col-2">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block form-control"> Add </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="showtab3">

                    <form action="{{url('addicd10')}}/{{Request::segment(2)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <input name='pid' type="hidden" value="{{Request::segment(2)}}">

                        <table  class="table table-borderless">
                            <tr>
                                <td width="400">Diagnostic</td>
                                <td>ICD-10</td>
                            </tr>
                            @if(isset($diagnostic))
                            @foreach($diagnostic as $di)
                                <tr>
                                    <td><input name="nameicd10[{{$di->diagnostic_id}}]" value="{{$di->diagnostic_name}}" class="form-control"></td>
                                    <td><input name="valueicd10[{{$di->diagnostic_id}}]" class="aaa form-control" type="text" value="{{$di->icd10}}"></td>
                                </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td></td><td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-block form-control w-100"> Save </button>
                                </td>
                            </tr>

                        </table>
                    </form>


                    <br><br>
                    <form action="{{url('addicd10')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <input name='pid' type="hidden" value="{{Request::segment(2)}}">

                            <div class="row">
                                <div class="col-5">
                                    <label>Diagnostic</label>
                                    <input name="icd10name" class="form-control">
                                </div>
                                <div class="col-5">
                                    <label>ICD-10</label>
                                    <input name="icd10value" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block form-control"> Add </button>
                                </div>
                            </div>
                    </form>


                </div>


                <div id="showtab4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="table-rep-plugin">
                                    <a class="btn btn-success" href="{{url("admin_mainpartedit/?procedure_code={{@$_GET['procedure_code']}}")}}">
                                        Add
                                    </a>
                                    <table class="table table-striped" id="tech-companies-1">
                                        <thead>
                                            <tr>
                                                <th data-priority="1">
                                                    Main Part
                                                </th>
                                                <th width="40">
                                                    Edit
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($main_part))
                                @foreach ($main_part as $p)
                                            <tr>
                                                <th>
                                                    {{ $p->mainpart_name}}
                                                </th>
                                                <td>
                                                    <a class="btn btn-icon waves-effect waves-light btn-primary" href="{{url("admin_mainpartedit/?mainpart_id={{ $p->mainpart_id }}&procedure_code={{@$_GET['procedure_code']}}")}}">
                                                        <i class="far fa-edit">
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection





@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
{{-- <script src="{{url('public/js/procedure/procedure_edit2.js')}}"></script> --}}
{{-- <script src="{{asset('public/js/jquery.min.js')}}"></script> --}}
<script>
</script>
      <link rel="stylesheet" href="{{url("public/css/jquery-ui.css")}}">
      <script src="{{url("public/fieldchooser/scripts/fieldChooser.js")}}"></script>
      <script>
        $(document).ready(function () {
            var $sourceFields = $("#sourceFields");
            var $destinationFields = $("#destinationFields");
            var $chooser = $("#fieldChooser").fieldChooser(sourceFields, destinationFields);

            var $sourceFields2 = $("#sourceFields2");
            var $destinationFields2 = $("#destinationFields2");
            var $chooser2 = $("#fieldChooser2").fieldChooser(sourceFields2, destinationFields2);

            var $sourceFields3 = $("#sourceFields3");
            var $destinationFields3 = $("#destinationFields3");
            var $chooser3 = $("#fieldChooser3").fieldChooser(sourceFields3, destinationFields3);


        });
    </script>

@php
if(isset($procedure->procedure_code)){
    $procedureid = $procedure->procedure_code;
}else{
    $procedureid = "";
}
@endphp

<script type="text/javascript">

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $(".procedure_in,procedure_out").mouseout(function(){
    var countries = [];
    $.each($(".procedure_in div"), function(){
            countries.push('"'+$(this).attr('name')+'"');
    });

        var value = "[" + countries.join(",")+']';
        var id = "{{$procedureid}}";
            $.post("{{url("jquery")}}",
            {
                event   : "proceduresw",
                id      : id,
                value   : value,
            },
            function(data, status)
            {
                console.log(data);
        });
    });

    $(".pdf_procedure_in,pdf_procedure_out").mouseout(function(){
    var countries = [];
    $.each($(".pdf_procedure_in div"), function(){
            countries.push('"'+$(this).attr('name')+'"');
    });
        var value = "[" + countries.join(",")+']';
        var id = "{{$procedureid}}";
            $.post("{{url("jquery")}}",
            {
                event   : "procedurepdf",
                id      : id,
                value   : value,
            },
            function(data, status){console.log(data);});
    });


    $(".pdf_procedure_in3,pdf_procedure_out3").mouseout(function(){
    var countries = [];
    $.each($(".pdf_procedure_in3 div"), function(){
            countries.push('"'+$(this).attr('name')+'"');
    });
        var value = "[" + countries.join(",")+']';
        var id = "{{$procedureid}}";
            $.post("{{url('jquery')}}",
            {
                event   : "procedurepdf3",
                id      : id,
                value   : value,
            },
            function(data, status){console.log(data);});
    });
</script>





<script>
    $(function() {
    $('.table-responsive').responsiveTable({
        addDisplayAllBtn: 'btn btn-secondary'
    });
});
var wi = $(window).width();
if(wi<500){
    $('#remove-scroll').hide();
}else{
    $('.list-inline').hide();
}

$("#openpage").click(function(){
    $("#remove-scroll").toggle();
});
$("button").click(function(){
    $("button").removeClass("active");
    $(this).addClass("active");
});


$("#tab5").trigger( "click" );
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();

$("#tab5").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
    $("#showtab5").show();
});

$("#tab6").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab7").hide();
    $("#showtab6").show();
});

$("#tab7").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").show();
});

$("#tab1").click(function(){
    $("#showtab1").show();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab2").click(function(){
    $("#showtab1").hide();
    $("#showtab2").show();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab3").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").show();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab4").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").show();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

</script>

@endsection




