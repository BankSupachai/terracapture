<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>QR Code Generator</h4>
                    </div>
                    <div class="card-body text-center">
                        @if(isset($qrcode))
                            <div class="mb-3">
                                <h5>QR Code สำหรับข้อมูล:</h5>
                                <p>{{ $data }}</p>
                            </div>
                            <div class="mb-3">
                                {!! $qrcode !!}
                            </div>
                            <a href="{{ route('qrcode.download', ['data' => $data]) }}" class="btn btn-primary">ดาวน์โหลด QR Code</a>
                        @endif

                        <hr>

                        <form action="{{ route('qrcode.generate') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-3">
                                <label for="data" class="form-label">ข้อความที่ต้องการแปลงเป็น QR Code</label>
                                <textarea name="data" id="data" class="form-control" rows="3">40053810|671018000378|MED|OPDCARD|47661|2024-10-18</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">สร้าง QR Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
