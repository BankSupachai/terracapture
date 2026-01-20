<style>
    #modal_track .modal-body{
        background: radial-gradient(circle, rgba(48,129,153,1) 0%, rgba(37,113,135,1) 100%);
    }
    #modal_track .modal-dialog-centered{
        min-height: calc(80% - (1.75rem * 2));
        margin: 1.75rem auto
        -webkit-transform: translate(0,0) !important;
        transform: translate(0,0) !important;
        align-items: center !important;
        display: flex;
        -webkit-box-align: center;
    }
    #modal_track .modal-content{
        min-width: 100%;
    }
    .menu-right-scroll{
        height: 27vh;
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
    .user-img{width: 75%;}
    .btn.btn-light-danger {
        color: #F64E60;
        background-color: #FFE2E5;
        width: 10em;
        padding: 15px 10px;
    }
    .logo-right{
        width: 10em;
    }
    .btn.btn-light-success {
        color: #1BC5BD;
        background-color: #C9F7F5;
        width: 10em;
        padding: 15px 10px;
    }

    .btn.btn-light-danger > i,.btn.btn-light-danger > b{color: red;}
    .btn.btn-light-success > i,.btn.btn-light-success > b{color: #1BC5BD;}
    .btn.btn-light-danger:hover > i,.btn.btn-light-danger:hover > b{color: white;}
    .btn.btn-light-success:hover > i,.btn.btn-light-success:hover > b{color: white;}
    .btn.btn-light-danger:hover:not(.btn-text):not(:disabled):not(.disabled), .btn.btn-light-danger:focus:not(.btn-text), .btn.btn-light-danger.focus:not(.btn-text) {
        background-color: #F64E60;
        border-color: transparent;
    }
    .btn.btn-light-success:hover:not(.btn-text):not(:disabled):not(.disabled), .btn.btn-light-success:focus:not(.btn-text), .btn.btn-light-success.focus:not(.btn-text) {
        background-color: #1BC5BD;
        border-color: transparent;
    }
</style>
<div class="modal fade" id="modal_track" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content rounded-0" style="box-shadow: none; border: none;">
            <div class="modal-body rounded-0 p-5">
                <div class="row m-0 cn">
                    <div class="col-auto text-center">
                        <img src="{{configTYPE('admin','store_url')}}user/avatar.png" class="user-img rounded-circle" id="user_pic">
                        <div class="w-100 text-white mt-3" id="position">Position : Reprocessor</div>
                        @php
                            $track_room = DB::table('tb_room')
                            ->whereIn('room_type',["storage","leaktest","aer"])
                            ->get();
                        @endphp
                        <p class="text-light w-100 text-left mt-4">Station :</p>
                        <select class="form-control" name="station_id">
                            @foreach($track_room as $data)
                                @if(configTYPE("track","room")==$data->room_id)
                                    <option value="{{$data->room_id}}" selected>{{$data->room_name}}</option>
                                @else
                                    <option value="{{$data->room_id}}">{{$data->room_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p class="text-light">Scope :</p>
                        <div class="card">
                            <div class="card-body menu-right-scroll">
                                <table id="cameralist" class="table table-borderless">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-center">
                            <img src="{{url('public/crop_logo/White/EndoTRACK_white.png')}}/" class="logo-right mb-2">
                            <a class="btn_cancel btn btn-lg w-100 btn-light-danger text-center h3 ">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                <br>
                                <b>Cancel</b>

                            </a>
                            <button id="confirm" class="btn btn-lg w-100 btn-light-success text-center h3">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                <br>
                                <b>Confirm</b>

                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
