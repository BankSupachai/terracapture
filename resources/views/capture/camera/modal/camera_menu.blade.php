<div class="modal fade" id="camera_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document" style="top: 35%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <i class="fa fa-question-circle"></i><br><br>
                        <h2 class="text-center text-light mt-2">คุณทำหัตถการเคสนี้เสร็จสิ้นแล้วหรือไม่ ?</h2>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-4"><button class="btn btn-danger text-light btn-lg w-100 h1" data-dismiss="modal">ยังไม่เสร็จ</button></div>
                    <div class="col-4"><button class="btn btn-warning text-light btn-lg w-100 h1 select_newcase" data-dismiss="modal">เลือกเคสใหม่</button></div>

                    @if(isset($patient->hn))
                        <form action="{{url("camera")}}" method="post" class="col-4">
                            @csrf
                            <input type="hidden" name="event"   value="finishcamera">
                            <input type="hidden" name="case_hn" value="{{$case->case_hn}}">
                            <input type="hidden" name="case_id" value="{{$case->case_id}}">
                            <button class="btn btn-info info2 text-light btn-lg w-100 h1 make_report">ทำรีพอร์ด</button>
                        </form>
                    @else
                        <div class="col-4">
                            <form action="{{url("camera")}}" method="post">
                                @csrf
                                <input type="hidden" name="event" value="pictest_delete">
                                <button class="btn btn-primary btn-block">กลับหน้าหลัก</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
