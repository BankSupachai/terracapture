@php
    use App\Models\Server;
@endphp
<style>
    .bg-dark-tv:nth-child(even){
        background-color: #2B2F34;
    }
    .bg-dark-tv:nth-child(odd){
        background-color: #25292D;
    }
</style>
<div class="col-12 mt-2 ">
    <div class="bg-darkness height-right">
        <div class="col-12 p-3 text-end">
            <span class="fs-18">Officer</h4>
        </div>
        <div class="col-12  px-3 fs-18">
            <div class=" text-nowrap">
                @foreach ($room_location ?? [] as $room)
                    <div class="row bg-dark-tv p-2">
                        <div class="col-4">
                            <span class="">{{ $room-> room_name }}</span>
                        </div>
                        <div class="col-8">


                            <div class="row">
                                @foreach ($room->room_user ?? [] as $user)
                                    @php
                                        $user = Server::table('users')->where('uid', $user)->first();
                                    @endphp
                                    <div class="col-6">
                                        <span class="">{{ fullname($user) }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
