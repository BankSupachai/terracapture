<style>
    .img-procedure{
        border: 3px solid #E8E8E8;
    }

    .img-procedure:hover{
        border: 3px solid #245788;
    }
    .text-blue{
        color: #33416E;
    }
</style>

<!-- Default Modals -->
<div id="multicase" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="multicase_header">
            <div class="modal-header pb-2" >
                <span class="text-blue fs-16" id="myModalLabel">HN : 1243534 &ensp;  Suratchanut Chitrat</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>

            </div>
            <div class="modal-body" style="border-top: 1px solid #E9EBEC;">
                <p class="text-muted">Select your operation </p>
                <div class="row mt-3 p-3">
                    <div class="col-2"></div>
                    <div class="col-4 m-0" >
                        <a href="">
                            <img src="{{url('public/image/egd.png')}}" width="200" height="200" class="img-procedure" alt="">
                            <span class="d-block text-center me-3 mt-2">EGD</span>
                        </a>
                    </div>
                    <div class="col-4 m-0">
                        <a href="">
                            <img src="{{url('public/image/colonoscopy.png')}}" width="200" height="200" class="img-procedure ms-3" alt="">
                            <span class="d-block text-center ms-2 mt-2">Colonoscopy</span>

                        </a>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
