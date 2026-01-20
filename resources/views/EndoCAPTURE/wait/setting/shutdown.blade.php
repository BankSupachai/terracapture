@extends('layouts.small-scale')

@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<div class="row p-5 h-full cn">
    <div class="col-1"></div>
    <div class="col">
        <div class="menu-shutdown">
            <i class=" bx bx-power-off"></i>
        </div>
    </div>
    <div class="col-2"></div>
    <div class="col">
        <div class="menu-restart">
            <i class="bx bx-reset"></i>
        </div>
    </div>
    <div class="col-1"></div>

</div>
@endsection
@section('script')

<script>
     var mouseTimer;
    function mouseDown() {
      mouseUp();
      mouseTimer = window.setTimeout(execMouseDown,2000); //set timeout to fire in 2 seconds when the user presses mouse button down
  }
</script>
@endsection
