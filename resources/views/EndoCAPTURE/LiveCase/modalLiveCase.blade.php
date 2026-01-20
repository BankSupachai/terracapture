<!-- Default Modals -->
<style>
    .password::placeholder{text-align: center; font-size:20px; color: #9599AD; }
    .modal-custom-header{
        display: flex;
        justify-content: space-between;
        padding: 0.5em;
        margin: 0.5em 0 0.5em;
    }

</style>
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}
<div id="LiveCase_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-custom-header" style="border-bottom: 1px solid #E9EBEC;">
                <span class="h5" id="myModalLabel">Live Case</span>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <span class="fs-15  " style="color: #878A99">
                    Please enter password
                </span>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <input type="text" class="form-control bg-light mt-4 w-100 password" placeholder="Password">
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2"></div>
                <div class="col-8">
                    <a href="{{url("mockup/livecase_camera")}}" type="button" class="btn btn-primary w-100">Confirm</a>
                </div>
                <div class="col-2"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
