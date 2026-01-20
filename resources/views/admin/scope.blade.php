@extends('layouts.appindex')
@section('title', 'User')
@section('content')


                        <!-- end row -->



    <div class="row" style="margin: 0;margin-top:1em;">
        <div class="col-12">
            <a href="{{url("admin_scope/create")}}" class="btn btn-success btn-rounded waves-light waves-effect w-md" style="width: 100%;border-radius:0;">Add</a>
            <div class="clearfix"></div>
        </div>
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <div class="table-rep-plugin">
                        <table id="tech-companies-1" class="table table-striped" data-add-focus-btn="">
                            <thead>
                            <tr>
                                <th data-priority="1">Scope</th>
                                <th width="40">Edit  </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($scope as $s)
                                <tr>
                                    <th>{{ $s->scope_name}}</th>
                                    <td>
                                    <a href="{{url("admin_scope/{{$s->scope_id}}/edit")}}" class="btn btn-icon waves-effect waves-light btn-info">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                </div>
                <div class="row">
                    {{ $scope->links() }}
                </div>

            </div>
            </div>
        </div>
    </div>
                        <!-- end row -->

                    </div> <!-- container -->

                <footer class="footer text-right">
                    © Medica Healthcare.
                </footer>

@endsection
