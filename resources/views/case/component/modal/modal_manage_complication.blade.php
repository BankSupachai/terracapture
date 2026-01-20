<!-- Default Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}
<div id="modal_ercp_manageCompli"  class="modal fade"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
        <div class="modal-content">
            <input type="hidden" id="managewith_index" value="">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Management of Complication</h5>
                <button  type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 p-0 m-0" ><hr></div>
            <div class="modal-body">
               <div class="row px-3">
                <div class="col-5">
                    <div class="form-check mb-2">

                        <input  class="form-check-input manage-complication" type="checkbox" subgroup="Adrenalin injection" subgroup="Adrenalin injection" id="{{md5('Adrenalin injection')}}" text="Adrenalin injection" unit="ml.">
                        <label class="form-check-label" for="{{md5('Adrenalin injection')}}">
                          &ensp; &ensp;  Adrenalin injection
                        </label>
                    </div>
                </div>
                <div class="col-5">
                   <input type="number" class="form-control manage-complication-input" subgroup="Adrenalin injection" unit="ml."  min="0" oninput="validity.valid||(value='');">
                </div>
                <div class="col-2 align-self-center">ml.</div>
               </div>
               <div class="row px-3 mt-1">
                <div class="col-5">
                    <div class="form-check mb-2">
                        <input class="form-check-input manage-complication" type="checkbox" id="{{md5('Hemostatic clips apply')}}" subgroup="Hemostatic clips apply" text="Hemostatic clips apply" unit="piece.">
                        <label class="form-check-label" for="{{md5('Hemostatic clips apply')}}">
                          &ensp; &ensp;  Hemostatic clips apply
                        </label>
                    </div>
                </div>
                <div class="col-5">
                   <input type="number" class="form-control manage-complication-input" unit="piece." subgroup="Hemostatic clips apply" min="0" oninput="validity.valid||(value='');">
                </div>
                <div class="col-2 align-self-center">piece.</div>
               </div>
               <div class="row px-3 mt-1">
                <div class="col-5">
                    <div class="form-check mb-2">
                        <input class="form-check-input manage-complication" type="checkbox" id="{{md5('OTSC')}}" text="OTSC" subgroup="OTSC" unit="mm.">
                        <label class="form-check-label" for="{{md5('OTSC')}}">
                          &ensp; &ensp;  OTSC
                        </label>
                    </div>
                </div>
                <div class="col-5">
                   <input type="number" class="form-control manage-complication-input" placeholder="Size" unit="mm." subgroup="OTSC" min="0" oninput="validity.valid||(value='');">
                </div>
                <div class="col-2 align-self-center">mm.</div>
               </div>
               <div class="row px-3 mt-1">
                <div class="col-5">
                    <div class="form-check mb-2">
                        <input class="form-check-input manage-complication" type="checkbox" id="{{md5('Stent')}}" text="Stent" subgroup="Stent" unit="ml.">
                        <label class="form-check-label" for="{{md5('Stent')}}">
                          &ensp; &ensp;  Stent
                        </label>
                    </div>
                </div>
                <div class="col-5">
                   <input type="number" class="form-control manage-complication-input" subgroup="Stent" unit="ml." min="0" oninput="validity.valid||(value='');">
                </div>
                <div class="col-2 align-self-center">ml.</div>
               </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-danger w-75 manage-complication-btn">Confirm to report</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

