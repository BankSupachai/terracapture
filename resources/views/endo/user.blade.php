@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('content')
    <link href="{{url("css/users/user.css")}}" rel="stylesheet" type="text/css"/>

 <div class="row" style="margin: 0;">
    <div class="cardcode col-12" style="padding: 0;display:none">
        <div class="card-box">
           <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
            <div class="row">
              <div class="col-12">
                Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=MemberController">MemberController</a>
              </div>
              <div class="col-12">
                View : <a href="autoit?run=visualcode_open\\endo.exe&path=user">user</a>
              </div>
           </div>
        </div>
    </div>

                            </div>
                        </div>



                        <div class="row" style="margin: 0;">
                            <div class="col-12 text-center">
                                <br>
                                <a href="{{url("user/create")}}" class="btn btn-success btn-rounded waves-light waves-effect w-md" style="width: 100%;border-radius:0;">Add</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">User Name</th>
                                                        <th data-priority="3">Department</th>
                                                        <th data-priority="3">Email</th>
                                            <th width="40">Edit  </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @forelse ($users as $u)
                                                    <tr>
                                                        <th>{{ $u->name}}</th>
                                                        <td>{{ $u->user_type }}</td>
                                                        <td>{{ $u->email }}</td>

                                                        <td><a href="{{url("useredit/{{ $u->id }}")}}" class="btn btn-icon waves-effect waves-light btn-info"> <i class="far fa-edit"></i> </a></td>
                                                    </tr>
                                                    @empty

                                                    @endforelse



                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="row text-center">
                                        {{ $users->links() }}
                                        </div>

                                    </div>
                                <div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                <footer class="footer text-right">
                    © Medica Healthcare.
                </footer>

@endsection
