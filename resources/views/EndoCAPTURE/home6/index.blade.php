@php
if(uget("user_type")!='admin'){
$layouts = 'layouts.layout_capture';
}else{
    $layouts = 'layouts.layout_index';
}

@endphp
    @extends($layouts)


@section('title', 'EndoINDEX')

@section('style')

<style>
    .table-card{
        height: 40vh;
    }
    .table-card tr td:nth-child(5){
        width: 35%;
    }
    #tasksTable tr td:last-child,#tasksTable tr th:last-child{
        width: 1%;
        white-space: nowrap;
    }
    .btn-primary{
        background: #3577F1 !important;
        border-color: #3577F1;
    }
    .btn-primary:hover{
        background: #0856e9 !important;
        border-color: #0856e9 !important;
    }
    .btn-primary2 {
        color: #ffff;
        background: #435085 !important;
        border-color: #435085;
    }
    .btn-primary2:hover{
        color: #ffff;
        background: #313b61 !important;
        border-color: #435085 !important;
    }
    .btn-filters{
        background: #405189;
        color: #fff;
    }
    .btn-filters:hover{
        background: #303d66;
        color: #fff;
    }
    .btn-success2{
        background: #0AB39C;
        color: #fff;
    }
    .btn-success2:hover{
        background: #088474;
        color: #fff;
    }
    .btn-danger2{
        background: #F06548;
        color: #fff;
    }
    .btn-danger2:hover{
        background: #ee4827;
        color: #fff;
    }

</style>

@endsection

@section('modal')
@include('endocapture.home6.components.modal_post_update')

@endsection


@section('content')

@include('endocapture.home6.components.list_head')
@include('endocapture.home6.components.list_main')


@endsection


@section('lpage')
    TODAY LIST
@endsection

@section('rpage')
    Cases List
@endsection

@section('rppage')
    Today List
@endsection


@section('script')
<script>
    function function_search() {
      var input, filter, table, tr, td_hn, td_name, i, txtValue;
      input = document.getElementById("text_search");
      filter = input.value.toUpperCase();
      table = document.getElementById("tasksTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td_hn   = tr[i].getElementsByTagName("td")[0];
        td_name = tr[i].getElementsByTagName("td")[1];
        if (td_hn || td_name) {
          txtValue1 = td_hn.textContent || td_hn.innerText
          txtValue2 = td_name.textContent || td_name.innerText;
          if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection
