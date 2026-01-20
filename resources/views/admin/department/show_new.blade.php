@extends('layouts.layouts_index.main')
@section('style')
<style>.container-fluid{padding: 0;}</style>
@endsection
@section('modal')

@endsection
@section('lpage')
<a href="{{url('department')}}" class="text-dark">Department</a>

@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Department <i class=" ri-arrow-right-s-line"></i> {{ucfirst($type)}} <i class=" ri-arrow-right-s-line pt-1"></i> Create
@endsection
@section('content')


<form action="{{url('department')}}/{{$id}}" method="POST" class="w-100" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="event" value="edit_detail">
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="type" value="{{$type}}">
    <input type="hidden" name="department2" value="{{$department}}">
    @if($type=='endo')
        @component('admin.department.component.form.endo',$view)@endcomponent
    @elseif($type=='doctor')
        @component('admin.department.component.form.doctor',$view)@endcomponent
    @elseif($type=='anesthesia')
        @component('admin.department.component.form.anes',$view)@endcomponent
    @elseif($type=='nurse'||$type=='nurse_anes')
        @component('admin.department.component.form.nurse',$view)@endcomponent
    @elseif($type=='register')
        @component('admin.department.component.form.practical_nurse',$view)@endcomponent
    @elseif($type=='procedure')
        @component('admin.department.component.form.procedure',$view)@endcomponent
    @elseif($type=='room')
        @component('admin.department.component.form.room',$view)@endcomponent
    @elseif($type=='scope')
        @component('admin.department.component.form.scope',$view)@endcomponent
    @elseif($type=='reprocess')
        @component('admin.department.component.form.repocess',$view)@endcomponent
    @endif
</form>


@endsection


@section('script')
<script>

imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
    // $("input[type='file']").onchange(function(evt){
    //     console.log($(this).html());
    // })
</script>
@endsection
