<style>
    .menu-right-track{
                transition: 0.3s;
                padding-top: 65px;
                position: fixed;
                height: 100%;
                width: 50vh;
                right: -60vh;
                z-index: 2;
                background: radial-gradient(circle, rgba(48,129,153,1) 0%, rgba(37,113,135,1) 100%);
            }
            .menu-right-track.active{
                right: 0;
            }

            .menu-right-track .logo-right{
                height: 3.8em;
            }
            .cn{
                align-items: center;
            }
            .user-img{
                width: 10em;
                height: 10em;
            }

            .menu-right-scroll{
                height: 30vh;
                overflow-y: scroll;
            }
            .menu-right-scroll::-webkit-scrollbar {
                width: 5px;
            }

            .menu-right-scroll::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px rgb(68, 119, 139);
                border-radius: 2px;
            }

            .menu-right-scroll::-webkit-scrollbar-thumb {
                background: #308199;
                border-radius: 2px;
            }
            .menu-right-scroll th{
                padding-top: 1em;
                font-size: large;
                font-weight: 900;
                color: #308199;
            }
</style>
<div class="menu-right-track">
    <div class="p-5 w-100 h-100">
        {{-- <form action="http://endocapture/endocapture5.0/api/track" method="post"> --}}
        <form action="http://{{configTYPE("admin","server_name")}}/endocapture5.0/api/track" method="post">
            @csrf
            <input type="hidden" name="event"       value="track_right">
            <input type="hidden" name="url_return"  value="{{url()->full()}}">
            <input type="hidden" name="user_id"     value=""    id="user_id" >
            {{-- <input type="hidden" name="station_id"  value="{{configTYPE("track","room")}}"> --}}

            <div class="row m-0 cn">
                <div class="col-6"><img src="{{url('public/crop_logo/White/EndoTRACK_white.png')}}/" class="logo-right"></div>
                <div class="col-6"><div class="h2 text-light text-right mb-0 font-weight-bold">
                </div></div>
            </div>
            <div class="row m-0">
                <div class="col-12 text-center">
                    <img src="{{configTYPE('admin','store_url')}}user/avatar.png" class="user-img rounded-circle" id="user_pic">
                </div>
                <div class="col-12 text-center mt-5 text-light h2 pt-5"><font id="user_prefix"></font>&nbsp;<font id="user_firstname"></font>&emsp;<font id="user_lastname"></font></div>
                <div class="col-12 text-center mt-2 text-light" id="position">Position : Reprocessor</div>

                <div class="col-12">
                    @php
                    try {
                        $track_room = Mongo::table('tb_room')
                        ->whereIn('room_type',["storage","leaktest","aer"])
                        ->get();
                    } catch(\Throwable $e) {
                        // Do something exceptional
                    }

                    @endphp
                    <p class="text-light">Station :</p>
                    <select class="form-control" name="station_id">
                        @if(isset($track_room))
                        @foreach($track_room as $data)
                            @if(configTYPE("track","room")==@$data->room_id)
                                <option value="{{@$data->room_id}}" selected>{{@$data->room_name}}</option>
                            @else
                                <option value="{{@$data->room_id}}">{{@$data->room_name}}</option>
                            @endif
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-12 mt-5">
                    <p class="text-light">Scope :</p>
                    <div class="card">
                        <div class="card-body menu-right-scroll">
                            <table id="cameralist" class="table table-borderless">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0 mt-5 pt-4">
                <div class="col-6">
                    <a class="btn_cancel btn btn-lg w-100 btn-light-danger text-center h3 ">
                        <i class="fas fa-ban icon-4x pr-0"></i>
                        <br>
                        Cancel
                    </a>
                </div>
                <div class="col-6">
                    <button id="confirm" class="btn btn-lg w-100 btn-light-success text-center h3">
                        <i class="far fa-check-circle icon-4x pr-0"></i>
                        <br>
                        Confirm
                    </button>
                </div>
            </div>
        </form>


    </div>
</div>





<script>
    function call_right(){

        $('.menu-right-track').addClass('active')
        // if($('.menu-right-track').hasClass('active')){
        //     $('.menu-right-track').removeClass('active')
        // }else{
        //     $('.menu-right-track').addClass('active')
        // }

    }

    $(".btn_cancel").click(function(){
        location.reload();
    })



</script>
