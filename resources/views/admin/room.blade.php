@extends('layouts.appindex')
@section('title', 'User')
@section('content')

<!-- end row -->

<div class="row" style="margin: 0;margin-top:1em">
    <div class="col-12">
        <a class="btn btn-success btn-rounded waves-light waves-effect w-md" href="{{url("admin_room/create")}}" style="width: 100%;border-radius:0;">
            Add
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-rep-plugin">
                    <table class="table table-striped" data-add-focus-btn="" id="tech-companies-1">
                        <thead>
                            <tr>
                                <th data-priority="1">
                                    Room
                                </th>
                                <th width="40">
                                    Edit
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($room as $r)
                            <tr>
                                <th>
                                    {{ $r->room_name}}
                                </th>
                                <td>
                                    <a class="btn btn-icon waves-effect waves-light btn-info" href="{{url("admin_room/{{$r->room_id}}/edit")}}">
                                        <i class="far fa-edit">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    {{ $room->links() }}
                </div>
            </div>
        <div>
    </div>
</div>
<!-- end row -->
<!-- container -->
<footer class="footer text-right">
    © Medica Healthcare.
</footer>
@endsection
