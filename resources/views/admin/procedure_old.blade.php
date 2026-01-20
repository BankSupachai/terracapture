{{-- @extends('layouts.layouts_index.main') --}}
{{-- @extends('layouts.appindex') --}}
@extends('layouts.app')

@section('title', 'User')
@section('content')
<link rel="stylesheet" href="{{url('public/css/procedure/procedure.css')}}" rel="stylesheet" type="text/css">

<div class="clearfix">
</div>
<br/>
<div class="row" style="margin: 0;">
    <div class="col-12">
        <a class="btn btn-success btn-rounded waves-light waves-effect w-md" href="{{url("admin/procedure/create")}}" style="width: 100%;border-radius:0;">
            Add
        </a>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-rep-plugin">
                    <table class="table table-striped" data-add-focus-btn="" id="tech-companies-1">
                        <thead>
                            <tr>
                                <th data-priority="1">
                                    Procedure
                                </th>
                                <th width="40">
                                    Edit
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($procedure as $p)
                            <tr>
                                <th>
                                    {{ $p->procedure_name}}
                                </th>
                                <td>
                                    <a class="btn btn-icon waves-effect waves-light btn-info" href="{{url("admin/procedure/{{$p->procedure_id}}/?procedure_code={{ $p->procedure_code }}")}}">
                                        <i class="fas fa-edit h4 text-light mt-2">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $procedure->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="footer text-right">
    © Medica Healthcare.
</footer>
@endsection
@section('lpage')
    Procedure
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Procedure
@endsection
@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>

</script>
@endsection
