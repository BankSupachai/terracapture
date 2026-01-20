<!-- Default Modals -->
<style>
/* .img-modal{
    width: 300px;
} */
</style>

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
<div id="modal_lesion_picture" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content pt-4">
            <div class="row px-4">
                <div class="col-6">
                    <h5 class="modal-title text-primary" id="myModalLabel">Select Photo</h5>
                    <h5 style="color: #24578880;">Choose photo for this position and then click “Confirm”</h5>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-danger btn-label waves-effect right waves-light" data-bs-dismiss="modal"><i class=" ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Cancel</button>
                    <button type="button" class="btn btn-primary btn-label waves-effect right waves-light"><i class=" ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                </div>

            </div>
            <div class="modal-body">
                <div class="col-12 text-end">
                    <span class="text-primary h4 fw-bold">
                        Total Selected : 2
                    </span>

                </div>

                <div class="row" style="background: #F3F6F9">
                    @foreach ($photoall as $photo)
                    <div class="col-3 ">
                       <div class="text-center">{{ $photo['nu'] }}</div>
                       <img class="select_photo" id="imgall{{ $photo['nu'] }}"  photo_id="{{ $photo['nu'] }}"
                       src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                       data-title={{ @$photo['na'] }} width="100%" >
                       @php
                       if ($photo['ns'] != 0) {
                           $color = 'green';
                           $style = '';
                       } else {
                           $color = 'white';
                           $style = 'display: none';
                       }
                   @endphp
                    </div>
                    @endforeach
                </div>

            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(".select_photo").click(function(){
        var num = check_selected_photo()

    })
</script>
