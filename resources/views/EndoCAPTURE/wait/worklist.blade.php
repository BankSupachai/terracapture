@extends('layouts.small-scale')

@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<div class="row pt-4 cn pb-3 px-5 bg-black">
    <div class="col text-white f-14 px-4">SERVER : </div>
    <div class="col text-end">
        <button class="btn btn-primary">+ Create Case</button>
    </div>
</div>
<div class="row bg-menu px-4">
    <div class="col-12 text-white f-15 border-bottom mb-3 pb-3 pt-3 px-5">
        Worklist
    </div>
    <div class="col-3 mb-3 px-4">
        <div class="form-icon">
            <input type="text" class="form-control form-control-icon input-dark" onkeyup="search_data()" id="iconInput" placeholder="Patient ID, Name…">
            <i class="ri-search-line"></i>
        </div>
    </div>
    <div class="col-12 px-4 mh-menu">
        <table class="table align-middle table-nowrap mb-0" id="tasksTable">
            <thead class="active-url text-muted">
                <tr>
                    <th class="sort text-white" data-sort="id">Patient ID</th>
                    <th class="sort text-white" data-sort="project_name">Name (Age)</th>
                    <th class="sort text-white" data-sort="tasks_name">Gender</th>
                    <th class="sort text-white" data-sort="client_name">Modality</th>
                    <th class="sort text-white" data-sort="assignedto">Date</th>
                    <th class="sort text-white" data-sort="due_date">Time</th>
                    <th class="sort text-white" data-sort="status">Description</th>
                    <th class="sort text-white" data-sort="priority">Actions</th>
                </tr>
            </thead>
            <tbody class="list form-check-all">
                @for($i=0;$i<5;$i++)
                <tr>
                    <td class="id">{{rand(1111,999999)}}</td>
                    <td class="project_name">Jona Orlando ({{rand(20,70)}})</td>
                    <td>M</td>
                    <td class="client_name">OR</td>
                    <td class="assignedto">{{date('d M, Y')}}</td>
                    <td class="due_date">{{date('H:i')}}</td>
                    <td class="status"></td>
                    <td class="priority"><a href="javascript:;" class="btn btn-primary">Select</a></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script>
function search_data() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("iconInput");
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
