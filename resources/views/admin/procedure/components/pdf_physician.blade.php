<style>
#sortable {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 60%;
}

.item {
  background-color: #f3f6f9;
  border: 1px solid #ddd;
  color: #444;
  font-size: 14px;
  margin: 5px;
  padding: 10px;
}
</style>
<div class="accordion" id="pdf_physician_setting">
    {{-- <div class="accordion-item mt-2">
        <h2 class="accordion-header" id="physician_data">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_physician_data" aria-expanded="true" aria-controls="collapse_physician_data">
                Physician Data
            </button>
        </h2>
        <div id="collapse_physician_data" class="accordion-collapse collapse show" aria-labelledby="physician_data" data-bs-parent="#pdf_physician_setting">
            <div class="accordion-body">
                <div class="row" style="">
                    <div class="col-6" style="text-align: right;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adsp">
                            เพิ่ม Procedure Detail
                        </button>
                    </div>
                    <div class="col-6">
                        &emsp;
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edsp">
                            จัดการ Procedure Detail
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col text-center h6">ยังไม่ได้ใช้งาน</div>
                    <div class="col text-center h6">เปิดใช้งาน</div>
                </div>
                @php
                    $selected = isset($select_procedure) ? $select_procedure : [];
                @endphp
                <select required multiple="multiple" name="favorite_fruits" id="multiselect-basic" onchange="select_pdset(this.value, this.id)">
                    @isset($data)
                        @foreach($data as $in=>$ap)
                        @php
                            $is_selected = in_array($ap,$selected) ? 'selected'  : '';
                        @endphp
                            <option value="{{$ap}}" class="oppcd{{$in}}" data-this-name="{{$ap}}" data-this-file="{{$ap}}" {{$is_selected}} >{{convert_only_name($ap)}}</option>
                        @endforeach
                    @endisset
                </select>

            </div>
        </div>
    </div> --}}
    {{-- @dd($procedure) --}}
    <form action="{{url("admin/procedure")}}" method="POST">
        @csrf
            <input type="hidden" name="event" value="add_procedurename">
            <input type="hidden" name="code" value="{{@$procedure->code}}">
            <div id="add_procedureshow" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Add Procedureshow</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <div class="modal-body">
                            {{-- <input type="text" class="form-control" name="pdf_show"> --}}
                            <select class="form-select" name="pdf_show" id="">
                                @foreach (@$files as $file)
                                @php
                                    $file = basename($file);
                                @endphp
                                <option value="{{$file}}">{{$file}}</option>

                                @endforeach
                            </select>
                            {{-- @dd($file) --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ">Save Changes</button>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
    </form>
    <div class="card">

        <div class="card-body">
            <h5>Header Template11</h5>
            <div class="row">

                <div class="col-2  align-self-center">
                  <span> DepartmentTH</span>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="Department" value="{{@$procedure_head['departmentTH']}}">
                </div>
                <div class="col-2  align-self-center">
                    <span> departmentEN</span>
                  </div>
                  <div class="col-4">
                      <input type="text" class="form-control" name="Department" value="{{@$procedure_head['departmentEN']}}">
                  </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_procedureshow">Add + </button>
                </div>

                    <div id="sortable">

                        @foreach (@$procedure_show as $data)


                                <div class="item">
                                    <div class="row">
                                        <div class="col-10">
                                            {{$data}}
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-danger text-end btn-delete-proc" procname="{{$data}}">-</button>
                                        </div>
                                    </div>
                                </div>



                        @endforeach
                    </div>

            </div>
        </div>
    </div>

</div>
{{-- <script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script> --}}
<script>

    $(".btn-delete-proc").click(function(){
        var procname = $(this).attr("procname");
            var proccode = "{{$procedure->code}}"
        // alert(proccode)
        $.post("{{url("admin/procedure")}}",{
            event : "del_proc_show",
            procname : procname,
            proccode : proccode,
        },
        function(data,status){

        }
        )
    })
</script>
<script>

    jQuery(function($){

      $("#sortable").sortable({
        revert: true
      });
      $("#draggable").draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        revert: "invalid"
      });
      $("ul, li").disableSelection();

    });
    </script>
