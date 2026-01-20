<style>
    .img-procedure{
        border: 3px solid #E8E8E8;
    }

    .img-procedure:hover{
        border: 3px solid #BBBBBB;
    }
    .text-blue{
        color: #BBBBBB;
    }
</style>

<!-- Default Modals -->
<div id="ureasetest" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-2" >
                <div class="row">
                    <div class="col-12">
                        <span class="text-blue fs-16">
                            HN : <span id="span_ureahn"></span>
                             &ensp;  <span id="span_patientname"></span>

                            </span>

                    </div>
                    <div class="col-12">
                        <span class="text-blue fs-16" id="myModalLabel">Contact : <span id="span_contact"></span></span>
                    </div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            {{-- <form action=""> --}}
            <form action="{{url('home')}}" method="post">
                @method('POST')
                @csrf
                <div class="modal-body p-3" style="border-top: 1px solid #31363b;">
                    <p class="text-muted"><span style="color: #BBBBBB;">Rapid Urease Test</span></p>
                    <div class="row p-3">
                        <input type="hidden" name="event" value="edit_urease">
                        <input type="hidden" name="case_id" id="case_id">
                        <div class="col-4">
                            <div class="form-check form-radio-primary mb-3">
                                <input class="form-check-input" type="radio" name="urease" value="Positive (+)" id="urease_positive" onchange="change_urease_text(this.id)">
                                <label class="form-check-label" for="urease_positive" style="color: #BBBBBB;">
                                &ensp; Positive (+)
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-radio-primary mb-3">
                                <input class="form-check-input" type="radio" name="urease" value="Negative (-)" id="urease_negative" onchange="change_urease_text(this.id)">
                                <label class="form-check-label" for="urease_negative" style="color: #BBBBBB;">
                                    &ensp;  Negative (-)
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-radio-primary mb-3">
                                <input class="form-check-input" type="radio" name="urease" value=" Positive [   ]         Negative [   ]" id="urease_pending" onchange="change_urease_text(this.id)">
                                <label class="form-check-label" for="urease_pending" style="color: #BBBBBB;">
                                    &ensp;  Pending
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input id="urease_text" name="urease_text" type="text" placeholder="Freetext" class="form-control w-100" style="color: #BBBBBB;">
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-soft-info w-md waves-effect waves-light"> Confirm</button>
                        </div>
                    </div>
                </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
