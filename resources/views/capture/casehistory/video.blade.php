<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>HN:</strong> {{ $hn }}
        </div>
        <div class="col-md-6">
            <strong>วันที่:</strong> {{ $date }}
        </div>
    </div>

    <div class="row">
    @php
        $videos = [];
        if (isset($tb_case->video) && is_array($tb_case->video)) {
            foreach ($tb_case->video as $video) {
                if (is_string($video)) {
                    $videos[] = $video;
                } elseif (is_array($video) && isset($video['na'])) {
                    $videos[] = $video['na'];
                } elseif (is_object($video) && isset($video->na)) {
                    $videos[] = $video->na;
                }
            }
        }
    @endphp

    @forelse ($videos as $video)
        <div class="col-12 mt-2">
            <video width="550" height="240" controls>
                <source src="{{ "$store/$hn/$date/vdo/".$video }}" type="video/mp4">
            </video>
        </div>
    @empty
        <div class="col-12">
            <h4 class="mt-3">ไม่มีวิดีโอสำหรับเคสนี้</h4>
        </div>
    @endforelse
    </div>
</div>
</body>
</html>
