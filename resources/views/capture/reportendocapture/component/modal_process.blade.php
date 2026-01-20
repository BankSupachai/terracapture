<style>
@keyframes set {
  from {font-size: 1px;}
  to {font-size: 17px}
}
@keyframes line {
  from {width: 0%;}
  to {width: 100%;}
}
#modal_process i{
    animation-name: set;
    animation-duration: 0.5s;
    animation-fill-mode: forwards;
}
.box-status{
    width: 48px;
    height: 48px;
    /* border: 2px double gainsboro; */
    border-radius: 50%;
    margin: auto;
    background: rgba(10, 179, 156, .18);
    color: #0ab39c;
}
.check .box-status{
    transition: 1s;
    border-color: #32dfd7;
    box-shadow: 0px 0px 2px #32dfd7;
}

.check span{
    animation-name: line;
    animation-duration: 0.3s;
    animation-fill-mode: forwards;
    background: #32dfd7;
    position: absolute;
    height: 4px;
    left: 0;
    margin: auto;
    bottom: -5px;
    box-shadow: 0px 0px 2px #32dfd7;

}
.delete span{
    animation-name: line;
    animation-duration: 0.3s;
    animation-fill-mode: forwards;
    background: #ef6574;
    position: absolute;
    height: 4px;
    left: 0;
    margin: auto;
    bottom: -5px;
    box-shadow: 0px 0px 2px #ef6574;
}
#modal_process .col-4{
    position: relative;
}
.flaticon2-check-mark,.flaticon2-delete{
    display: none;
}
.check .flaticon2-check-mark{display: block}
.delete .flaticon2-delete{display: block}
#process_btn{display: none;}
#process_btn.active{display: block;}
</style>
<div class="modal fade" id="modal_process" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row m-0">
                    <div class="col-3 text-center modal-process check">
                        <div class="box-status bg-green mb-2">
                            <i class="ri-check-double-fill  "></i>
                        </div>
                        Preparing File

                        <span class="mt-2"></span>
                    </div>
                    <div class="col-3 text-center modal-process check">
                        <div class="box-status mb-2"><i class="flaticon2-check-mark text-success "></i><i class="flaticon2-delete text-danger"></i></div>
                        DICOM Ready
                        <span class="mt-2"></span>
                    </div>
                    <div class="col-3 text-center modal-process check">
                        <div class="box-status mb-2"><i class="flaticon2-check-mark text-success "></i><i class="flaticon2-delete text-danger"></i></div>
                        PACs Sending
                        <span class="mt-2"></span>
                    </div>
                    <div class="col-3 text-center modal-process check">
                        <div class="box-status mb-2"><i class="flaticon2-check-mark text-success "></i><i class="flaticon2-delete text-danger"></i></div>
                        Finished
                        <span class="mt-2"></span>
                    </div>
                </div>
                <div class="row m-0 mt-5" id="process_btn">
                    <div class="col-12 text-center">
                        <button type="button" onclick="window.location.reload();" class="btn btn-success font-weight-bold" data-bs-dismiss="modal">&emsp; Done &emsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
