<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/loadtopic/index.css')}}" rel="stylesheet" type="text/css" />

{{-- <div align="center" style="margin-top: 15%;">
<div class="col-12">
            <h1 style="color:gray;">Loading...</h1>
            </div>
</div> --}}







<script>
    var repage = '{{url("procedure/$cid")}}';
    window.location.replace(repage);
</script>
