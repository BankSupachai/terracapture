@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('lpage')
    Log Case
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Log Case
@endsection
@section('style')
<style>
    div.justify-between{
        position: absolute;
        overflow: hidden;
        opacity: 0;
    }
    .w-5 ,.h-5{
        width: 15px;
    }
    p{opacity: 0;}
    .card-body{
        min-height: 85vh;
        padding-bottom: 2em;
        position: relative;
    }
    .set-footer{
        position: absolute;
        bottom: 2em;
    }
</style>
@endsection

@section('content')
@php
    $log = DB::table('tb_logedit')->join('users','tb_logedit.edit_userid','users.id')->paginate(15)
@endphp
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Event</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log as $l)
                        @php
                            $json = json_decode($l->edit_json);
                        @endphp
                        <tr>
                            <td>{{@$l->logindata_id}}</td>
                            <td>{{@$l->user_prefix}} {{@$l->user_firstname}}&emsp;{{@$l->user_lastname}}</td>
                            <td>{{@$l->edit_event}}</td>
                            <td>{{@$json->case_time_do}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="set-footer">
                    {{ $log->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
