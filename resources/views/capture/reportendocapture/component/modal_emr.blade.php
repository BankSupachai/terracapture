<div id="modal_emr" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          {{-- <h4 class="modal-title">ใส่รหัสเพื่อสร้างลายเซ็นต์</h4> --}}
        </div>
        <div class="modal-body row">
            <div class="col-12">
                <h1>{{@$doctorname}}</h1>
            </div>
            <div class="col-3">Code : </div>
            <div class="col-9">

                <input id="doctor_id"   type="text" value="{{@$casedata->case_physicians01}}" class="form-control">
                <input id="doctor_code" type="text" class="form-control" autocomplete="off">
            </div>
            <div id="password_incorrect1" class="col-3" style="display: none"></div>
            <div id="password_incorrect2" class="col-9" style="display: none">
                {{-- <input id="doctor_id"   type="text" value="{{$casedata->case_physicians01}}" class="form-control"> --}}
                <font color="red">รหัสผ่านไม่ถูกต้อง</font>
            </div>
        </div>
        <div class="modal-footer">
          <a id="create_sign" type="button" class="btn btn-primary">Confirm</a>
        </div>
      </div>
    </div>
</div>
