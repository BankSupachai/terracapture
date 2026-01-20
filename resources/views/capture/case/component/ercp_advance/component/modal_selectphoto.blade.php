@php
    $xy = 0;
    $x = 0;
    $photoall = [];
    foreach ($case->photo as $data) {
        $data = (object) $data;
        if (isset($data->st)) {
            if ($data->st == 0 || $data->st == 1) {
                $photoall[$x]['nu'] = $data->nu;
                $photoall[$x]['ns'] = $data->ns;
                $photoall[$x]['na'] = $data->na;
                $photoall[$x]['sc'] = $data->sc;
                $photoall[$x]['st'] = $data->st;
                $photoall[$x]['tx'] = $data->tx;
                $x++;
            }
        }
    }
@endphp
<div id="modal_selectphoto" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 ">
                <div class="row">
                    <div class="col-6">
                        <span class="modal-title h5 text-primary" id="myModalLabel">Select Photo</span> <br>
                        <span class="text-soft-blue fs-14">Choose photo for this position and then click “Confirm”</span>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-danger btn-label waves-effect right waves-light w-lg"><i class="ri-arrow-go-back-line label-icon align-middle fs-16"></i> Cancel</button>
                        <button class="btn btn-primary btn-label waves-effect right waves-light w-lg ms-2"><i class="ri-check-double-line label-icon align-middle fs-16"></i> Confirm</button>

                    </div>
                </div>

            </div>
            <div class="modal-body">
                <div class="col-12 text-end">
                    <span class="text-primary fw-bold fs-16">Total Selected: 2</span>
                </div>
                <div class="card-custom p-2" style="border-radius: 4px;">
                    <div class="row">
                        <div class="col-3 text-center">
                            <span class="text-count-blue">1</span> <br>

                        </div>
                        <div class="col-3">
                            <img src="{{url("public/image/@fortest/1.jpg")}}" width="170px;" alt="">

                        </div>
                        <div class="col-3">
                            <img src="{{url("public/image/@fortest/1.jpg")}}" width="170px;" alt="">

                        </div>
                        <div class="col-3">
                            <img src="{{url("public/image/@fortest/1.jpg")}}" width="170px;" alt="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div>

        </div>
    </div>
</div>
