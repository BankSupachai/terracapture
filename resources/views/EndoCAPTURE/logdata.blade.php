@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('lpage')
    Log Data
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Log Data
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
    $log = DB::table('tb_logindata')->join('users','tb_logindata.logindata_user_id','users.id')->paginate(15)
@endphp
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4>Log Login</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log as $l)
                        <tr>
                            <td>{{@$l->logindata_id}}</td>
                            <td>{{@$l->user_name}}{{@$l->user_prefix}} {{@$l->user_firstname}}&emsp;{{@$l->user_lastname}}</td>
                            <td>{{@$l->logindata_login_time}}</td>
                            <td>{{@$l->logindata_logout_time}}</td>
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
