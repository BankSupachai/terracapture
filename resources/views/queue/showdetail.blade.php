<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        @php
        $w[] = array('queue_hn',$_GET['hn']);
        $w[] = array('queue_datetime','like',date("Y-m-d")."%");
        $queue = DB::table('tb_demoqueue')->where($w)->get();
        @endphp

        <div class="row">
            <div class="col-12" align="center">
                <br>
                <img width="200" src="public/images/avatar.png"><br><br>
                <h2>{{ $queue[0]->queue_fullname }}</h2>
                <h2>{{ $queue[0]->queue_hn }}</h2>
            </div>

            @forelse($queue as $q)
                <div class="col-12">
                    {{ $q->queue_procedure }}<br>
                    <div class="progress">
                        @if ($q->queue_status == 'รอคิว')
                            <div class="progress-bar" style="width:33%"></div>
                        @endif
                        @if ($q->queue_status == 'กำลังส่องกล้อง')
                            <div class="progress-bar" style="width:66%"></div>
                        @endif
                        @if ($q->queue_status == 'รอพักฟื้น')
                            <div class="progress-bar" style="width:100%"></div>
                        @endif
                    </div>
                </div>
                <div class="col-4" align="center">รอคิว</div>
                <div class="col-4" align="center">กำลังส่องกล้อง</div>
                <div class="col-4" align="center">พักฟื้น</div>
                <br>
            @empty
                <h2>ไม่พบข้อมูล</h2>
            @endforelse
        </div>
    </div>

</body>

</html>
