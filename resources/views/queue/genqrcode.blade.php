@php
header("Content-Type: image/png");
echo QRCode::text(@$_GET['gen'])->png();
@endphp
