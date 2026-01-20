@php
// dd(1);
$server = getCONFIG('server');
$admin  = getCONFIG('admin');
if($admin->com_type == 'server'){
    $adfsurl = $server->urlbase."/endoindex/api/adfs/server";
}else{
    $adfsurl = $server->urlbase."/endoindex/api/adfs/local";
}
@endphp
{{-- @dd(1); --}}

<iframe src="{{@$server->adfsurl}}&wa=wsignout1.0" title="description" style="display: none"></iframe>

<script>
    setTimeout(()=>{window.location.replace("{{$adfsurl}}")},1000);
</script>
