<div class="row" wire:ignore>
    @php
        $num = 0;
    @endphp
    @foreach ($photoall as $key => $photo)
        @if ($photo['st'] == 0)
            <div class="col-2 mb-5 large-responsive" id="photo_display">
                <div class="row ms-3 ">
                    <div class="row left-menu" style="height: auto;">
                        <div class="col-12">
                            <span class="text-number-pic">{{ $photo['nu'] }}</span>
                        </div>
                        <div class="col-12 mt-4rem">
                            <a class        ="btn-left-menu zoomify_icon_all "
                                pic_number  ="{{ $photo['nu'] }}"
                                photo_id2   ="{{ $photo['nu'] }}"
                                photosrc    ="{{ mePHOTO($hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                photoname   ="{{ $photo['na'] }}"
                                case_id     ="{{ $cid }}"
                                data-toggle ="tooltip"
                                title       ="zoom">
                                <i class="ri-search-line me-3"></i>
                            </a>
                        </div>
                        <a class="btn-left-menu"
                            href="{{ request()->is('capture*') ? url('capture/crop') : url('crop') }}?cid={{$cid}}&hn={{$hn}}&folderdate={{$folderdate}}&photoname={{$photo['na']}}&caseuniq={{$caseuniq}}&photo_id={{$photo['nu']}}&type=crop"
                            data-toggle="tooltip" title="crop">
                            <i class="ri-crop-line"></i>
                        </a>
                        <div class="col-12 mt-1">
                            <a class="btn-left-menu clear-pic picrollbacknew"
                                id="clearpic{{ $photo['nu'] }}" hn="{{ $hn }}"
                                photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}"
                                photo_id="{{ $photo['nu'] }}" case_id="{{ $cid }}"
                                data-toggle="tooltip" title="Erase">
                                <i class="ri-eraser-line"></i>
                            </a>
                        </div>
                        <div class="col-12 mt-1">
                            <a onclick="rollbackPhoto('{{ $key }}', '{{ $hn }}', '{{ $photo['na'] }}', '{{ $photo['nu'] }}', '{{ $cid }}', '{{ $folderdate }}')"
                                class="btn-left-menu picrollbacknew" id="picrollbacknew2{{ $photo['nu'] }}"
                                type="imgall" hn="{{ $hn }}" photoname="{{ $photo['na'] }}"
                                status="{{ $photo['st'] }}" photo_id="{{ $photo['nu'] }}"
                                case_id="{{ $cid }}">
                                <i class="ri-refresh-line"></i>
                            </a>
                        </div>
                        {{-- <div class="col-12 mt-1">
                            <a wire:click="removePhoto('{{ $key }}')" class="btn-left-menu">
                                <i class="ri-close-fill ri-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                    <div class="col-12 "  >
                        <img class="photo-display" photo_id="{{ $photo['nu'] }}" id="img_photo_{{ $photo['nu'] }}" wire:click="selectedPhoto('{{ $key }}')"
                            src="{{ mePHOTO($hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}" width="100%">
                        @php
                            if ($photo['ns'] != 0) {
                                $color = 'green';
                                $style = '';
                            } else {
                                $color = 'white';
                                $style = 'display: none';
                            }
                        @endphp


                        @if ($photo['ns'] != 0)
                            <div align="center" class="bb" id="bb{{ $photo['nu'] }}" style="{{ $style }}">{{ $photo['ns'] }}</div>
                            @php
                                $num++;
                            @endphp
                        @else
                            <div align="center" class="bb" id="bb{{ $photo['nu'] }}" style="{{ $style }}">-</div>
                        @endif





                        <div id="picselect{{ $photo['nu'] }}" style="background-color:green;" class="picselect">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    @if (count($photoall) > 0)
        <div class="row">
            <div class="col"></div>
            <div class="col-3">

                <script>
                    function refreshdelay() {
                        setTimeout(function() {
                            window.location.href = "{{url("procedure/$cid?select=1") }}";
                        }, 2000);
                    }
                </script>



                <a onclick="refreshdelay();"
                    class="btn btn-success btn-xl btn-block btn-loading btn-shadow w-100">
                    <h5 class="text-white"> Confirm Select Photo    </h5>
                </a>
            </div>
        </div>
    @endif

    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
    <script wire:ignore>
        var basePhotoUrl = "{{ domainname('store') }}";

        function rollbackPhoto(key, hn, photoname, photo_id, case_id, folderdate) {
            $.post("{{ url('api/photomove') }}", {
                event: 'photorollback',
                folderdate: folderdate,
                photo_id: photo_id,
                hn: hn,
                caseid: case_id,
                photoname: photoname,
            }, function(data, status) {
                if (status === 'success') {
                    var d = new Date();
                    var timestamp = d.getTime();
                    var newSrc = basePhotoUrl + "/" + hn + "/" + folderdate + "/" + photoname + "?a=" + timestamp;
                    $('#img_photo_' + photo_id).attr("src", newSrc);
                }
            });
        }

        // Handler for eraser (clear-pic) button
        $('.picrollbacknew').click(function(e) {
            e.preventDefault();
            var folderdate = '{{ $folderdate }}';
            var photoname = $(this).attr('photoname');
            var hn = $(this).attr('hn');
            var photo_status = $(this).attr('status');
            var photo_id = $(this).attr('photo_id');
            var case_id = $(this).attr('case_id');
            var photo_num = photo_id;

            // ตรวจสอบว่ามี class clear-pic หรือไม่ (สำหรับ eraser)
            let classnames = document.getElementById($(this).attr('id')).className.split(/\s+/)
            if (classnames.includes('clear-pic')) {
                $.post("{{ url('api/photomove') }}", {
                    event: 'cropblacknew',
                    folderdate: folderdate,
                    photo_id: photo_id,
                    hn: hn,
                    caseid: case_id,
                    photoname: photoname,
                }, function(data, status) {
                    if (status === 'success') {
                        var d = new Date();
                        var timestamp = d.getTime();
                        var newSrc = basePhotoUrl + "/" + hn + "/" + folderdate + "/" + photoname + "?a=" + timestamp;
                        $('#img_photo_' + photo_num).attr("src", newSrc);
                    }
                });
                return false;
            }
        });

        $(document).ready(function() {
            num = {{ $num }};
            console.log(num);
            $('.photo-display').click(function() {
                var photo_id = $(this).attr('photo_id');
                var picnumall = $("#bb" + photo_id).html();
                if (picnumall != "" && picnumall != "-") {
                    num--;
                    $("#bb" + photo_id).attr("style", "display: none;");
                    $("#bb" + photo_id).html("-");
                    $('.bb').each(function() {
                        var currentNum = $(this).html();
                        if (currentNum != '-' && parseInt(currentNum) > parseInt(picnumall)) {
                            $(this).html(parseInt(currentNum) - 1);
                        }
                    });
                } else {
                    num++;
                    $("#bb" + photo_id).attr("style", "display: block;");
                    $("#bb" + photo_id).html(num);
                }
            });
        });
    </script>
    <script>
        $(".btn-loading").click(function(){
    if ($(this).closest('form')[0].checkValidity()) {
        $(this).addClass('disabled');
        $(this).html('<span class="loading-spinner"></span> &ensp; Loading...');
        setTimeout(() => {
            $(this).removeClass('disabled');
        }, 3000);
    }
});
    </script>
</div>
