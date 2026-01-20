<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .card-body {
            padding: 1.5rem;
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }
        .table td {
            vertical-align: middle;
        }
        .download-video, .download-case {
            color: #007bff;
            text-decoration: none;
            font-size: 1.2rem;
        }
        .download-video:hover, .download-case:hover {
            color: #0056b3;
            text-decoration: none;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>

    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-body" style="min-height: 300px; max-height: 80vh; overflow-y: auto;">
            <div class="col-12 mb-3">
                <h5>
                    Select file to Download
                </h5>
                {{-- <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>HN:</strong> {{ $hn }}
                    </div>
                    <div class="col-md-6">
                        <strong>วันที่:</strong> {{ $date }}
                    </div>
                </div> --}}
            </div>
            <!-- Hoverable Rows -->
            <div class="table-responsive">
                @php
                    $photo_count = 0;
                    $pdf_count = 0;
                    $total_photo_size = 0;
                    $total_pdf_size = 0;

                    // นับรูปภาพและขนาด
                    $photo = $tb_case->photo ?? [];
                    if (!empty($photo) && is_array($photo)) {
                        foreach ($photo as $value) {
                            if (is_array($value) && isset($value['na'])) {
                                $photo_file = $store_htdocs . '/' . $hn . '/' . $date . '/' . $value['na'];
                                if (file_exists($photo_file)) {
                                    $photo_count++;
                                    $total_photo_size += filesize($photo_file);
                                }
                            } elseif (is_string($value)) {
                                $photo_file = $store_htdocs . '/' . $hn . '/' . $date . '/' . $value;
                                if (file_exists($photo_file)) {
                                    $photo_count++;
                                    $total_photo_size += filesize($photo_file);
                                }
                            }
                        }
                    }

                    // นับ PDF และขนาด
                    $pdflastversion = $tb_case->case_pdfversion ?? [];
                    if (!empty($pdflastversion) && is_array($pdflastversion)) {
                        $pdf_end = end($pdflastversion);
                        if (is_array($pdf_end) && isset($pdf_end['pdf'])) {
                            $pdf_file = $store_htdocs . '/' . $hn . '/' . $date . '/pdf/' . $pdf_end['pdf'];
                            if (file_exists($pdf_file)) {
                                $pdf_count = 1;
                                $total_pdf_size += filesize($pdf_file);
                            }
                        }
                    }

                    $total_files = $photo_count + $pdf_count;
                    $total_size = $total_photo_size + $total_pdf_size;

                    // แปลงขนาดไฟล์รวมให้อ่านง่าย
                    if ($total_size >= 1073741824) { // 1 GB
                        $display_size = round($total_size / 1073741824, 2);
                        $size_unit = 'GB';
                    } elseif ($total_size >= 1048576) { // 1 MB
                        $display_size = round($total_size / 1048576, 2);
                        $size_unit = 'MB';
                    } elseif ($total_size >= 1024) { // 1 KB
                        $display_size = round($total_size / 1024, 2);
                        $size_unit = 'KB';
                    } else {
                        $display_size = $total_size;
                        $size_unit = 'B';
                    }
                @endphp

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Photo & Report ({{ $total_files }} files)</h6>
                    <small class="text-muted">
                        รูปภาพ: {{ $photo_count }} | PDF: {{ $pdf_count }} | Total: {{ $display_size }} {{ $size_unit }}
                    </small>
                </div>
                <table class="table table-hover table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40%">Photo</th>
                            <th style="width: 40%"></th>
                            <th class="text-center">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Photo and Report</td>
                            <td>
                                @if($total_files > 0)
                                    <small class="text-success">{{ $total_files }} files available</small>
                                @else
                                    <small class="text-warning">No files available</small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($total_files > 0)
                                    <a class="download-case"><i class="ri-download-2-line"></i></a>
                                @else
                                    <i class="ri-download-2-line text-muted"></i>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @php
                $i = 0;
                $valid_videos = [];
                foreach ($vdo_name ?? [] as $video) {
                    $file_path = $store_htdocs . '/' . $hn . '/' . $date . '/';
                    $vdo_name = $file_path . '/' . 'vdo' . '/' . $video;

                    // ตรวจสอบว่าไฟล์มีอยู่จริง
                    if (file_exists($vdo_name)) {
                        $valid_videos[] = [
                            'name' => $video,
                            'path' => $vdo_name
                        ];
                    }
                }
            @endphp

            @if (!empty($valid_videos))
                <!-- Hoverable Rows -->
                <div class="table-responsive mt-3">
                    @php
                        $total_video_size = 0;
                        foreach ($valid_videos as $video_data) {
                            $total_video_size += filesize($video_data['path']);
                        }

                        // แปลงขนาดไฟล์รวมให้อ่านง่าย
                        if ($total_video_size >= 1073741824) { // 1 GB
                            $total_size = round($total_video_size / 1073741824, 2);
                            $total_unit = 'GB';
                        } elseif ($total_video_size >= 1048576) { // 1 MB
                            $total_size = round($total_video_size / 1048576, 2);
                            $total_unit = 'MB';
                        } elseif ($total_video_size >= 1024) { // 1 KB
                            $total_size = round($total_video_size / 1024, 2);
                            $total_unit = 'KB';
                        } else {
                            $total_size = $total_video_size;
                            $total_unit = 'B';
                        }
                    @endphp

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Videos ({{ count($valid_videos) }})</h6>
                        <small class="text-muted">
                            Total size: {{ $total_size }} {{ $total_unit }}
                        </small>
                    </div>
                    <table class="table table-hover table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40%">Video</th>
                                <th style="width: 40%">Size</th>
                                <th class="text-center">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($valid_videos as $video_data)
                                @php
                                    $file_size = filesize($video_data['path']);

                                    // แปลงขนาดไฟล์ให้อ่านง่าย
                                    if ($file_size >= 1073741824) { // 1 GB
                                        $vdo_size = round($file_size / 1073741824, 2);
                                        $size_unit = 'GB';
                                    } elseif ($file_size >= 1048576) { // 1 MB
                                        $vdo_size = round($file_size / 1048576, 2);
                                        $size_unit = 'MB';
                                    } elseif ($file_size >= 1024) { // 1 KB
                                        $vdo_size = round($file_size / 1024, 2);
                                        $size_unit = 'KB';
                                    } else {
                                        $vdo_size = $file_size;
                                        $size_unit = 'B';
                                    }
                                @endphp

                                <tr>
                                    <td>Video {{ ++$i }}</td>
                                    <td>{{ $vdo_size }} {{ $size_unit }}</td>
                                    <td class="text-center">
                                        <a class="download-video" video_name="{{ $video_data['name'] }}">
                                            <i class="ri-download-2-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center mt-4">
                    <p class="text-muted">ไม่มีวิดีโอสำหรับเคสนี้</p>
                </div>
            @endif

        </div>
    </div>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(".download-video").click(function() {
            var cid = "{{ $cid }}";
            var video_name = $(this).attr('video_name');
            var $btn = $(this);

            // แสดง loading
            $btn.html('<i class="ri-loader-4-line fa-spin"></i>');
            $btn.prop('disabled', true);

            $.post("{{ url('casehistory') }}", {
                event: 'download_video',
                cid: cid,
                video_name: video_name
            }, function(data, status) {
                let obj = JSON.parse(data);
                if (obj.status) {
                    download(obj.url);
                } else {
                    // แสดงข้อความผิดพลาด
                    alert(obj.message || 'เกิดข้อผิดพลาดในการดาวน์โหลดวิดีโอ');
                }
            }).fail(function() {
                alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
            }).always(function() {
                // คืนค่าปุ่มเดิม
                $btn.html('<i class="ri-download-2-line"></i>');
                $btn.prop('disabled', false);
            });
        })





        $(".download-case").click(function() {
            var cid = "{{ $cid }}";
            var $btn = $(this);

            // แสดง loading
            $btn.html('<i class="ri-loader-4-line fa-spin"></i>');
            $btn.prop('disabled', true);

            $.post("{{ url('casehistory') }}", {
                event: 'download_file',
                cid: cid,
            }, function(data, status) {
                let obj = JSON.parse(data);
                if (obj.status) {
                    download(obj.url);
                } else {
                    // แสดงข้อความผิดพลาด
                    alert(obj.message || 'เกิดข้อผิดพลาดในการดาวน์โหลด');
                }
            }).fail(function() {
                alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
            }).always(function() {
                // คืนค่าปุ่มเดิม
                $btn.html('<i class="ri-download-2-line"></i>');
                $btn.prop('disabled', false);
            });
        })

        function download(url) {
            var a = document.createElement('a');
            a.href = url;
            a.download = url.split('/').pop();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
</body>

</html>
