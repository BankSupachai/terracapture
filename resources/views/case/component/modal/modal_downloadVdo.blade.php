<!-- Default Modals -->

<style>
    .btn-download-icon{
        background: transparent;
        border: 1px solid #00000080;
        color: #000000;
    }
</style>

@php
use App\Models\Mongo;

            $tb_case = Mongo::table("tb_case")->where("id" , $cid)->first();
            // dd($vdo)
            $count_video    =   count($vdo);
            $count_photo    =   count($tb_case->photo);

@endphp
<div id="modal_download" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " style="max-width: 40%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Download</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 m-0 p-0"><hr></div>
            <div class="modal-body p-1">
                <span class="fs-15 ms-2 text-muted">
                    Select file to Download
                </span>

                <div class="row p-4 mt-2">

                    <div class="col-12 align-self-center" >
                        <h5>Photo ({{$count_photo}})</h5>

                        <div class="d-flex justify-content-between p-2">
                             <span>All Photo</span>

                            <a href="{{domainname("temp\photo_".$case->procedurename."_$case->case_hn"."_"."$case->appointment_date.zip")}}" download>
                                  <i class="ri-download-2-line ri-lg" id="download_photo"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-12"><hr></div>



                    <div class="col-12 align-self-center ">

                        <h5>Video ({{$count_video}})</h5>
                        <div class="d-flex justify-content-between p-2">
                            @forelse ($vdo as $video_data)
                                <span>{{$video_data}}</span>
                                <a href="{{domainname("store/$case->case_hn/$case->appointment_date/vdo/$video_data")}}" download>
                                    <i class="ri-download-2-line ri-lg" id="download_photo"></i>
                                </a>

                            @empty
                                ยังไม่มีการถ่ายวีดีโอ
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
