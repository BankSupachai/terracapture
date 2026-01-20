<div class="modal fade" id="modalvip">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header p-0" style="border:none;height:1em;">
                <h5 class="modal-title">&emsp;</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('vip')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="encode">
                    <input type="hidden" name="cid" value="{{$cid}}">
                    ใส่รหัส <font color="red">*ถ้าจำรหัสไม่ได้ทางบริษัทไม่สามารถกู้ข้อมูลให้ได้</font>
                    <br>
                    <input type="text" name="code" class="form-control" autocomplete="off">
                    <br>
                    <button class="btn btn-success">Save</button>
                    <a class="btn btn-info close" data-dismiss="modal" aria-label="Close">Close</a>

                </form>
            </div>
        </div>
    </div>
</div>
