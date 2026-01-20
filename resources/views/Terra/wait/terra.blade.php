
@php
    function change_status($status){
        if($status=='Schedule'){
            echo "<span class='badge badge-soft-warning text-uppercase'>$status</span>";
        }elseif($status=='Complete'){
            echo "<span class='badge badge-soft-success text-uppercase'>$status</span>";
        }
    }
@endphp


@isset($tb_case)
    @foreach($tb_case as $data)

    @php
        $data = (object) $data;

        $status = 'Holding';
        if(isset($data->statusjob)){
            if ($data->statusjob == 'operation'){
                $status = 'Operation';
            } else if ($data->statusjob == 'recovery'){
                $status = 'Recovery';
            } else if ($data->statusjob == 'discharged'){
                $status = 'Discharged';
            }
        }
        $studydate = isset($data->studydate) && $data->studydate != 0 ? date('d M, Y H:i', $data->studydate) : '';
        $appointment = isset($data->appointment) ? date('d M, Y H:i', strtotime($data->appointment)) : '';
        $_id         = isset($data->id) ? (array) $data->id : null;
        $proc_count  = isset($data->procedure) ? count($data->procedure) : 0;

    @endphp
    <div class="row m-0 ai-c tb_case" oid="{{$_id['oid']}}" hn="{{@$data->hn}}" appointment="{{@$data->appointment}}" count="{{$proc_count}}">
        <div class="col accession_n"></div>
        <div class="col modality">{{@$data->modality}}</div>

        <div class="col operation">
            @isset($data->procedure)
                @foreach ($data->procedure as $p)
                    {{@$p}}
                    <br>
                @endforeach
            @endisset
        </div>

        <div class="col report">{{change_status(@$data->report)}}</div>
        
        <div class="col status">
            @isset($data->statusjob)
                @foreach ($data->statusjob as $s)
                    {{@$s}}
                    <br>
                @endforeach
            @endisset
        </div>


        <div class="col instances"></div>
        <div class="col complete"></div>
        <div class="col study">{{@$studydate}}</div>
        <div class="col appointment" date={{@$data->appointment}}>{{@$appointment}}</div>
        <div class="col-3 description">{{@$data->remark}}</div>
    </div>
    @endforeach
@endisset


<script>
        $(".tb_case").dblclick(function(){
            var cid = $(this).attr("oid");
            var count = $(this).attr('count')
            var hn = $(this).attr('hn')
            var appointment = $(this).attr('appointment')
            appointment = appointment.split(' ')
            appointment = appointment[0] != undefined && appointment[0] != '' ? appointment[0] : ''

            if(count > 1){
                window.location.href = `{{url("terra/viewer")}}/`+cid+`?type=view&hn=${hn}&appointment=${appointment}`;
            } else {
                window.location.href = '{{url("terra/viewer")}}/'+cid+'?type=view';
            }
        });

        $(".tb_case").click(function(){
            var oid = $(this).attr('oid')
            var hn = $(this).attr('hn')
            var appointment = $(this).attr('appointment')

            $(".menu-data-list div").removeClass('active')
            $(this).addClass('active');
            $.post("{{url('convert')}}",{
                event       : 'get_terra_image',
                oid         : oid,
                hn          : hn,
                appointment : appointment
            },function(data, status) {
                $(".menu-img-list").html(data);
                $('.menu-img-list').show()
            })
        });
</script>
