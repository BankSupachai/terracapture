
@php
    $countroom = (count($room_display));
@endphp
@if ($countroom >= 1 || 7< $countroom)
@include("EndoCAPTURE.nurse_monitor.display.roomMonitor.room$countroom")
@else
    {{-- Room dont match --}}
@endif




