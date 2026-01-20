<!-- Grids in modals -->
<button id="selected_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selected_modal" hidden>
    Launch Demo Modal
</button>
<div class="modal fade" id="selected_modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true" data-bs-backdrop="static" data-bs-keyboard="false" >
    <div class="modal-dialog modal-xl" style="min-width: 1300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-sort-blue" id="exampleModalgridLabel">Select Photo</h5>
                <button type="button" id="select_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="row g-3" style="min-width: 1250px; max-width:1300px">
                        @foreach (isset($allphoto)?$allphoto:[] as $index=>$photo)
                            @php
                                $rand = rand(10000, 99999);
                            @endphp
                            <div class="col-xxl-3 p-1 other-img  @if($photo == $photoname) selected-div self-div @endif" id="select_div{{$index}}" onclick="select_div('{{$index}}', '@if($photo == $photoname) self  @endif')" data-index="{{$index}}" data-photoname="{{@$photo}}">
                                {{-- <input type="checkbox" id="select_ck{{$index}}"  name="select_photo[]" value="{{@$photo}}" hidden> --}}
                                <img style="width:100%" src="{{picurl('')}}/{{@$hn}}/{{@$folderdate}}/backup/{{@$photo}}">
                            </div>

                            {{-- <img class=" p-0 m-0 @if($photo == $photoname) self-img @else select-img  @endif" src="{{picurl("$hn/$folderdate/backup/$photo")}}?{{$rand}}" style="width:1235px;height:800px; display:block" id="imagesel{{$index}}"  alt="" > --}}

                            {{-- <input class="@if($photo == $photoname) self-txt @else select-txt  @endif" type="text" id="photoname{{$index}}"> --}}
                        @endforeach
                    </div>

                    {{-- <div class="row g-3"  >
                        @foreach (isset($allphoto)?$allphoto:[] as $index=>$photo)
                            @php
                                $rand = rand(10000, 99999);
                            @endphp
                            <img class="otherimg p-0 m-0 @if($photo == $photoname) self-img @else select-img  @endif" src="{{picurl("$hn/$folderdate/backup/$photo")}}?{{$rand}}" style="display:block" id="imagesel{{$index}}"  alt="" style="width:100%">
                        @endforeach
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button id="confirm_select_btn" type="button" class="btn btn-promary">Confirm</button> --}}
                <button type="button" class="btn btn-dark-primary btn-label waves-effect right w-lg waves-light" id="confirm_select_btn">
                    <i class="ri-check-double-line  label-icon align-middle fs-16 ms-2"></i> Confirm
                </button>
                <div class="spinner-border text-success" id="confirm_select_sp" role="status" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                  </div>
            </div>
        </div>
    </div>
</div>







