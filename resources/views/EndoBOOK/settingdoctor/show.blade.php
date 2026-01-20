@extends('layouts.app')
@section('title', 'EndoBook')
@section('style')
<style>
    .bg-calendar{
        background: #F2F2F2;
    }
    .d-content{
        display: contents;
    }
    .table th,.table td{
        vertical-align: middle;
    }
    .list-holiday{
        width: 100%;
        height: 9em;
        overflow-y: auto;
    }
</style>
@endsection

@section('modal')



@endsection

@section('content')
<div class="row m-0">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="row cn">
                    <div class="col-3 h5">A.M.</div>
                    <div class="col-9">
                        <input id="am"  type="text" value="{{@$config->am}}" class="form-control period_config" placeholder="am">
                    </div>
                </div>
                <div class="row cn mt-2">
                    <div class="col-3 h5">P.M.</div>
                    <div class="col-9">
                        <input id="pm"  type="text" value="{{@$config->pm}}" class="form-control period_config" placeholder="pm">
                    </div>
                </div>
                <div class="row cn mt-2">
                    <div class="col-3 h5">นอกเวลา</div>
                    <div class="col-9">
                        <input id="ot" type="text" value="{{@$config->ot}}" class="form-control period_config" placeholder="ot">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">





                <h3>Dairy work</h3>
                @foreach ($day as $item)
                <div class="row m-0">
                    <div class="col-2 border-right pt-2">
                        <div class="checkbox-list">
                            <label class="checkbox mt-3 jc checkbox-info">
                                <input  type="checkbox"
                                        class="change_config"
                                        sub="{{$i++}}"
                                        day="{{$item}}"
                                        datatype="work"
                                        @if(@$config->$item->work=="true") checked @endif
                                />
                                <span></span>
                                {{$item}}
                            </label>
                        </div>
                    </div>

                    <div class="col-4 pt-2">
                        <select class="form-control form-control-sm change_config" day="{{$item}}" datatype="period">
                            <option value="ampmot"  @if(@$config->$item->period=="ampmot")      selected @endif>ทั้งวัน</option>
                            <option value="ampm"    @if(@$config->$item->period=="ampm")        selected @endif>ในเวลา (เช้าบ่าย)</option>
                            <option value="am"      @if(@$config->$item->period=="am")          selected @endif>ในเวลา (เช้า)</option>
                            <option value="pm"      @if(@$config->$item->period=="pm")          selected @endif>ในเวลา (บ่าย)</option>
                            <option value="ot"      @if(@$config->$item->period=="ot")          selected @endif>นอกเวลา</option>
                        </select>
                    </div>

                    <div class="col-6 pt-2">
                        <select class="form-control selectpicker change_config" day="{{$item}}" datatype="procedure" multiple>
                            @foreach($procedure as $data)
                                @isset($config->$item->procedure)
                                    @if(array_search($data->procedure_code,$config->$item->procedure)>-1)
                                        <option value="{{$data->procedure_code}}" selected>{{$data->procedure_name}}</option>
                                    @else
                                        <option value="{{$data->procedure_code}}">{{$data->procedure_name}}</option>
                                    @endif
                                @else
                                    <option value="{{$data->procedure_code}}">{{$data->procedure_name}}</option>
                                @endisset
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-body">
                @php
                function get_procedure($data){
                    $p = '';
                    if(isset($data)){
                        if(gettype($data)==="array"){return $p;}
                        $da = jsonDecode($data);
                        if(count($da)>0){
                            for ($i=0;$i<count($da);$i++) {
                                $procedure = DB::table('tb_procedure')
                                ->where('procedure_code',$da[$i])
                                ->select('procedure_code','procedure_name')
                                ->first();
                                $p.= $procedure->procedure_name." ,";
                            }
                        }

                    }
                    echo $p;
                }

                $date = array();
                foreach($tb_bookset_calendar_department as $data){
                    $data = (object) $data;
                    $date[$data->calendar_date]['in']   = @$data->calendar_roomin;
                    $date[$data->calendar_date]['out']  = @$data->calendar_roomout;
                }
                $year_fix   = date("Y");
                $month_fix  = date("m");
                $dates      = getDates($year_fix);
                $weekdays   = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                $date=date_create("$year_fix-$month_fix-01");
                @endphp
                @foreach($dates as $month => $weeks)
                @if($month==$month_fix)
                <div class="row m-0 h-100">
                    <div class="col-12 m-auto bg-calendar p-0 h-100 d-content">

                        <table class="table table-bordered ">
                            <tr class="bg-light h1">
                                <th class="text-center">{!!implode('</th><th class="text-center">', $weekdays)!!}</th>
                            </tr>
                            @foreach($weeks as $week => $days)
                            <tr>
                                @foreach($weekdays as $day)
                                    @isset($days[$day])
                                        @php
                                            $fixdate="$year_fix-$month-$days[$day]";
                                        @endphp

                                        @isset($config->$day->work)
                                            @if($config->$day->work=="true")
                                                <td class="cell_date" date="{{$fixdate}}">
                                                    <h3 class="text-center">{{$days[$day]}}</h3>
                                                </td>
                                            @else
                                                <td class="cell_date bg-danger" date="{{$fixdate}}"><h3 class="text-center">{{$days[$day]}}</h3></td>
                                            @endif
                                        @else
                                            <td class="cell_date bg-danger" date="{{$fixdate}}"><h3 class="text-center">{{$days[$day]}}</h3></td>
                                        @endisset

                                    @else
                                        <td class="bg-white"></td>
                                    @endisset
                                @endforeach
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>


    </div>
</div>



<div class="row m-0 mt-2">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body row">
                <div class="col-12">
                    <form action="{{url("book/setting_doctor")}}" method="POST">
                        @csrf

                        <div class="row m-0">
                            <div class="col-12">
                                <h4>ระบุวันลา</h4>
                            </div>
                            <div class="col-12">
                                <input type="text" id="datefix" name="date" class="form-control" value="" placeholder="ระบุวันที่" required oninvalid="this.setCustomValidity('กรุณา ระบุ กำหนดการเฉพาะ')"  readonly required>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="text"      name="reason" value="" class="form-control" placeholder="ระบุเหตุผล">
                            </div>
                        </div>
                        <input type="hidden" name="event" value="datefix">
                        <input type="hidden" name="userID" value="{{$userID}}">
                        <input type="hidden"    name="extra" value="vacation">
                        {{-- <select name="extra" class="form-control my-2" required @stack('name')> --}}
                            {{-- <option value="">เลือกเหตุการณ์</option> --}}
                            {{-- <option value="work">ทำงาน</option> --}}
                            {{-- <option value="vacation">วันหยุด</option> --}}
                        {{-- </select> --}}


                        {{-- <select name="procedure[]" class="form-control selectpicker" multiple>
                            @foreach($procedure as $data)
                                <option value="{{$data->procedure_code}}">{{$data->procedure_name}}</option>
                            @endforeach
                        </select> --}}
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-light-primary font-weight-bold w-100">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-7">
        <div class="card mt-2">
            <div class="card-body">
                <div class="col-12">
                    <h3>วันหยุด</h3>
                </div>
                <div class="list-holiday">
                    <table class="table table-striped">
                        <tbody>
                            @foreach ($tb_bookset_calendar_doctor as $data)
                                <tr>
                                @php
                                    $data = (object) $data;
                                @endphp
                                <td>
                                    {{@$data->calendardoctor_date}}
                                </td>
                                <td>
                                    {{@$data->calendardoctor_event}}
                                </td>
                                <td>
                                    {{@$data->calendardoctor_reason}}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <h3>กำหนดการเฉพาะ</h3>

            </div>
        </div>
    </div> --}}


</div>

@endsection

@section('script')
    <script src="{{url('')}}public/sample/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


        $(".period_config").change(function () {
            var val     = $(this).val();
            var period  = $(this).attr("id");
            $.post("{{url("book/setting_doctor")}}",{
                event   : "period_config",
                userID  : "{{$userID}}",
                val     : val,
                period  : period
            },function(data,status){});
        });


        $(".change_config").change(function(){
            var value   = $(this).val();
            var datatype= $(this).attr("datatype");
            var day     = $(this).attr("day");
            if(datatype=="work"){value = $(this).prop('checked');}
            $.post("{{url("book/setting_doctor")}}",{
                event       : "change_config",
                userID      : "{{$userID}}",
                value       : value,
                datatype    : datatype,
                day         : day
            },function(data,status){});
        });

        $(".cell_date").click(function(){
            var date = $(this).attr("date");
            $("#datefix").val(date);
            console.log(date);
        })

        $(".change_config").on('click',function(){
            var i = $(this).attr('sub');
            if($(this).is(':checked')){
                $(`.table-bordered tr td:nth-child(${i}).bg-danger`).removeClass('bg-danger')
            }else{
                $(`.table-bordered tr td:nth-child(${i})`).addClass('bg-danger')
            }
        })

    </script>



<script>
// setTimeout(() => {

    var KTBootstrapDatepicker = function () {
            var arrows;
            if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
            } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
            }

            var demos = function () {
            $('#datefix').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows
            });
            }

            return {
                init: function() {
                    demos();
                }
            };
    }();

    jQuery(document).ready(function() {
        KTBootstrapDatepicker.init();
    });
// }, 700);
</script>
{{-- <script src="{{url('public/js/jquery-ui.js')}}"></script> --}}

@endsection
