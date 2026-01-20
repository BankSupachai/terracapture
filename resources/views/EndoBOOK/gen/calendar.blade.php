    @php
        $date = array();
        foreach($tb_bookset_calendar_department as $data){
            $data = (object) $data;
            $date[$data->calendar_date]['in']   = @$data->calendar_roomin;
            $date[$data->calendar_date]['out']  = @$data->calendar_roomout;
        }
        $year_fix = $year;
        $month_fix = $month;
        $dates = getDates($year_fix);
        $weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $date=date_create("$year_fix-$month_fix-01");
    @endphp
    @foreach($dates as $month => $weeks)
    @if($month==$month_fix)
    <div class="bg-fff">

        <div class="bg-endo text-dark row m-0 py-2 list-month">
            <div class="col-2 h4 mb-0"><i class="fas fa-angle-left text-white" onclick='change_month("back","{{date_format($date,"m")}}","{{$year_fix}}")'></i></div>
            <div class="col text-center h4 text-white mb-0">
                {{date_format($date,"F")}}
            </div>
            <div class="col-2 text-right h4 mb-0"><i class="fas fa-angle-right text-white" onclick='change_month("next","{{date_format($date,"m")}}","{{$year_fix}}")'></i></div>
        </div>
        <table class="table table-bordered">
            <tr class="">
                <th class="text-center">{!!implode('</th><th class="text-center">', $weekdays)!!}</th>
            </tr>
            @foreach($weeks as $week => $days)
            <tr>
                @foreach($weekdays as $day)
                    @isset($days[$day])
                        @php
                            $fixdate="$year_fix-$month-$days[$day]";
                        @endphp
                        <td  class="@if((intval($days[$day])==intval($s_day))&&(intval($month_fix)==intval($s_month))&&($year_fix==$s_year)) ) bg-primary text-white @else list-date @endif" onclick='select_day("{{$days[$day]}}","{{$month}}","{{$year_fix}}")'>
                            <span>{{$days[$day]}}</span>
                        </td>
                    @else
                        <td></td>
                    @endisset
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
    @endif
    @endforeach
