
<div id="modal_auth" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="col-12 text-center px-2 pt-4">
                <span class="modal-title  h5" id="myModalLabel" style="color: #245788">Authentication
                </span> <br>
                <span style="color: #878a99">Enter your password for verifly to make this report.</span>

            </div>
            <div class="modal-body px-4">
                <div class="col-12 text-center">
                    <img src="{{url("public/image/auth.png")}}" alt="">
                </div>
                <div class="col-12 mt-3">
                    <h6 class="fw-bold">Username</h6>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="col-12 mt-3">
                    <h6 class="fw-bold">Password</h6>
                    <input type="text" class="form-control" placeholder="Password">
                </div>
                <div class="col-12 mt-4 mb-4">
                    
                    <button class="btn btn-success w-100">Unlock</button>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div> --}}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
