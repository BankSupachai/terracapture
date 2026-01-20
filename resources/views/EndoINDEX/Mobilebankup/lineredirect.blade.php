@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')

<style>
    body{
        background: #245788 !important;
    }
    .card-img{
        display: flex;
        justify-content: center;
        margin-top: 40%;

    }
    .loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: rgba(207, 207, 207, 0.4);
    /* border: 5px solid rgba(207, 207, 207, 0.4);
    border-bottom-color: #ffffff; */
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
</style>
@endsection
@section('modal')
@endsection


@section('content')

<div class="card-img">
        <img src="{{url("public/image/EndoINDEX white logo.png")}}" width="200" alt="">
</div>
<div class="col-12 text-center mt-5">
    <span class="loader"></span>
</div>
<div class="col-12 text-center mt-4">
    <span class="text-white">
        Authentication
        </span>
</div>

@endsection






@section('script')
<script src="{{asset('public/js/linesdk.js')}}"></script>
{{-- <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script> --}}
<script>
    function formatUnixTimeToHHMM(unixTime) {
        const date = new Date(unixTime * 1000);
        const hours = date.getHours();
        const minutes = date.getMinutes();
        const formattedHours = hours.toString().padStart(2, '0');
        const formattedMinutes = minutes.toString().padStart(2, '0');
        const timeInHHMM = `${formattedHours}:${formattedMinutes}`;
        return timeInHHMM;
    }

    async function getUserToken() {
        const decode = await liff.getDecodedIDToken();
        const token = await liff.getAccessToken()

        // $('.token').html(token)
        // $('.url').html(decode.iss)
        // $('.userid').html(decode.sub)
        // $('.channelid').html(decode.aud)
        // $('.authtime').html(decode.auth_time)
        // $('.exp').html(formatUnixTimeToHHMM(decode.exp))
        // $('.name').html(decode.name)
        // $('.email').html(decode.email)

        return decode.email

    }


    async function main(){
        await liff.init({ liffId: '1656429675-KQdyep98'})

        if (liff.isLoggedIn()) {
            let email = await getUserToken()
            let urlParams = new URLSearchParams(window.location.search);
            let page = urlParams.get('page');

            let pageToSubpath = {
                'export': '/exportindex',
                'viewer': '/terra/w-viewer',
                'home': '/home',
            };
            let subpath = pageToSubpath[page] || '';

            if(subpath){
                $.post("{{url('api/home')}}", {
                    event: "line_login",
                    email:email,
                    page:subpath
                }, function (data, status) {
                    console.log(data);
                    if(data && data != ""){
                        window.location.href = "{{url('')}}"+subpath
                    }
                })
            }
        }
    }
    main()
</script>
@endsection
