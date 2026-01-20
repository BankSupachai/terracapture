<style>
    .permanent {
        overflow-y: auto;
    }

    .permanent::-webkit-scrollbar {
        width: 20px;
    }

    /* Track */
    .permanent::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 0px;

    }

    /* Handle */
    .permanent::-webkit-scrollbar-thumb {
        background: #878a99;
        border-radius: 0px;
    }

    /* Handle on hover */
    .permanent::-webkit-scrollbar-thumb:hover {
        background: #055386;
    }

    .permanent::-webkit-scrollbar-button:single-button {
        background-color: #bbbbbb;
        display: block;
        border-style: solid;
        height: 13px;
        width: 16px;
    }

    /* Up */
    .permanent::-webkit-scrollbar-button:single-button:vertical:decrement {
        border-width: 0 10px 10px 10px;
        border-color: transparent transparent #555555 transparent;
        background: #c7c8c9;
    }

    .permanent::-webkit-scrollbar-button:single-button:vertical:decrement:hover {
        border-color: transparent transparent #777777 transparent;
    }

    /* Down */
    .permanent::-webkit-scrollbar-button:single-button:vertical:increment {
        border-width: 10px 10px 0 10px;
        border-color: #555555 transparent transparent transparent;
        background: #c7c8c9;
    }

    .permanent::-webkit-scrollbar-button:vertical:single-button:increment:hover {
        border-color: #777777 transparent transparent transparent;
    }

    .left-menu {
        /* border: 0.5px solid #245788; */
        background: #f3f6f9;
        color: #245788;
        border-radius: 4px 0px 0px 4px;
        width: 20px;
        height: 24vh;
        /* z-index: 999; */
    }

    .btn-left-menu-2 {
        color: #495057;
        margin-left: -19px;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0.3px 0.3px #495057;
        z-index: 999;
    }

    .btn-left-menu-2:hover {
        color: #19cf50 !important;

    }

    .btn-left-menu {
        color: #495057;
        margin-left: -17px;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0.3px 0.3px #495057;
        z-index: 999;
        /* font-size: 16px; */
    }

    .btn-left-menu:hover {
        color: #19cf50;
    }

    .img-thumbnail {
        border: 0px;
    }

    .h-80 {
        height: 80%;
    }

    .text-number-pic {
        white-space: nowrap;
        margin-left: -18px !important;
        color: #495057;
    }

    .middle-screen {
        top: 17em;
    }

    .video-scroll {
        height: 64vh;
        overflow: auto;
    }



    .video-scroll-bar::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    .video-scroll-bar::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    .video-scroll-bar::-webkit-scrollbar-thumb {
        background: #0071bb;
        border-radius: 10px;
    }

    /* Handle on hover */
    .video-scroll-bar::-webkit-scrollbar-thumb:hover {
        background: #055386;
    }

    .width-select {
        width: 100%;
        border-radius: 0;
    }

    .width-select2 {
        width: 100%;
        border-radius: 0 0 0.25rem 0.25rem;
    }

    .width-select-fiding {
        width: 100%;
        /* margin-left: -23.5px; */
        border-radius: 0;
    }

    .width-select2-fiding {
        width: 100%;
        /* margin-left: -23.5px; */
        border-radius: 0 0 0.25rem 0.25rem;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="scrollbar-rail">
                @php
                    $count_pt = 0;
                    foreach ($case->photo as $photo) {
                        if ($photo['ns'] != 0) {
                            $count_pt++;
                        }
                    }
                @endphp

                <div class="row permanent" style="@if ($count_pt >= 5 && @$feature->fidingsidephoto) height:800px; @endif padding: 10px;">
                    @php
                        try {
                            $image_info = getimagesize(mePHOTO($case->case_hn, $case->caseuniq . '.jpg', $folderdate));
                        } catch (\Exception $e) {
                            $image_info = [0, 0];
                        }
                    @endphp
                    <div class=" @if (@$feature->fidingsidephoto) col-6 @else col-2 @endif  ">
                        <a class="btn btn-success btn-sm rounded-0 p-1" style="position: absolute;" data-toggle="modal"
                            data-target="#moda    l_photo_re"><i class="ri ri-folder-open-line"></i></a>
                        <a
                            href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $case->caseuniq . '.jpg' . "&caseuniq=$case->caseuniq&ppic=$procedure->img&photo_id=" . $case->caseuniq . '.jpg&procedure_pic=true' . '') }}">
                            <img src="{{ mePHOTO($case->case_hn, $case->caseuniq . '.jpg', $folderdate) }}?a={{ RandomString() }}"
                                img_height="{{ $image_info[1] }}px" img_width="{{ $image_info[0] }}px"
                                photoname="{{ $case->caseuniq . '.jpg' }}" procedureimg="true" width="100%"
                                height="24vh" class="img-thumbnail">
                        </a>
                    </div>
                    @foreach ($photoselect as $photo)
                        @if ($photo['ns'] != 0)
                            <div id="divselect{{ $photo['nu'] }}"
                                class="@if (@$feature->fidingsidephoto) col-6 @else col-2 @endif ">
                                @php
                                    try {
                                        $image_info = getimagesize(mePHOTO($case->hn, $photo['na'], $folderdate));
                                    } catch (\Exception $e) {
                                        $image_info = [0, 0];
                                    }
                                @endphp
                                <div class="row ps-2 ">
                                    <div class="row left-menu">
                                        <div class="col-12">
                                            <span class="text-number-pic">{{ $photo['nu'] }}</span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <a class="btn-left-menu zoomify_icon " pic_number="{{ $photo['nu'] }}"
                                                photo_id2="{{ $photo['nu'] }}"
                                                photosrc="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                                photoname="{{ $photo['na'] }}" case_id="{{ $cid }}"
                                                data-toggle="tooltip" title="zoom">
                                                <i class="ri-search-line me-3"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <a class="btn-left-menu" pic_number="{{ $photo['nu'] }}"
                                                photo_id2="{{ $photo['nu'] }}"
                                                photosrc="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                                photoname="{{ $photo['na'] }}" case_id="{{ $cid }}"
                                                href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $photo['na'] . "&caseuniq=$case->caseuniq&ppic=$procedure->img&photo_id=" . $photo['nu'] . '&type=drawing&procedure_pic=false') }}"
                                                data-toggle="tooltip" title="draw">
                                                <i class="ri-markup-line"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <a class="btn-left-menu"
                                                href="{{ url("crop?cid=$cid&hn=$case->hn&folderdate=$folderdate&photoname=" . $photo['na'] . "&caseuniq=$case->caseuniq&ppic=$procedure->img&photo_id=" . $photo['nu'] . '&type=crop') }}"
                                                data-toggle="tooltip" title="crop">
                                                <i class="ri-crop-line"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <a class="btn-left-menu clear-pic picrollbacknew"
                                                id="clearpic{{ $photo['nu'] }}" hn="{{ $case->hn }}"
                                                photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}"
                                                photo_id="{{ $photo['nu'] }}" case_id="{{ $cid }}"
                                                data-toggle="tooltip" title="Erase">
                                                <i class="ri-eraser-line"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 mt-1">
                                            <a class="btn-left-menu picrollbacknew" type="imgselect"
                                                id="picrollbacknew2{{ $photo['nu'] }}" hn="{{ $case->hn }}"
                                                photoname="{{ $photo['na'] }}" status="{{ $photo['st'] }}"
                                                photo_id="{{ $photo['nu'] }}"
                                                case_id="{{ $cid }}
                                                "data-toggle="tooltip"
                                                title="Roll Back">
                                                <i class="ri-refresh-line"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 ">
                                            <a class="btn-left-menu-2 imgselect_new" style="color: #495057"
                                                pic_number="{{ $photo['nu'] }}" photo_id="{{ $photo['nu'] }}"
                                                onclick="location.reload()" data-toggle="tooltip" title="Unselect">
                                                <i class="ri-close-fill ri-lg"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        {{-- !!! ห้ามลบ class img-thumbnail เนื่องจากมีผลกับการ preview ภาพ !!! --}}
                                        <img id="imgselect{{ $photo['nu'] }}" class="img-thumbnail"
                                            pic_number="{{ $photo['nu'] }}" photo_id2="{{ $photo['nu'] }}"
                                            photosrc="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                            case_id="{{ $cid }}" photo_id="{{ $photo['nu'] }}"
                                            photoname="{{ $photo['na'] }}"
                                            src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}"
                                            data-title={{ @$photo['na'] }} width="100%">
                                        @php
                                            if ($photo['ns'] != 0) {
                                                $color = 'green';
                                                $style = '';
                                            } else {
                                                $color = 'white';
                                                $style = 'display: none';
                                            }
                                        @endphp
                                        <div id="picselect{{ $photo['nu'] }}"
                                            style="background-color:{{ $color }} ;display: none"
                                            class="picselect">
                                        </div>

                                    </div>
                                </div>
                                <select id="{{ md5($photo['na']) }}"
                                    class="form-select selectmainsub @if (@$feature->fidingsidephoto) width-select @else width-select-fiding @endif"
                                    photo_id="{{ $photo['nu'] }}">
                                    <option value="">Select</option>
                                    @foreach ($mainpart as $data)
                                        @if ($data == $photo['sc'])
                                            <option value="{{ $data }}" selected>{{ $data }}
                                            </option>
                                        @else
                                            <option value="{{ $data }}">{{ $data }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input id          = "phototext_select{{ $photo['nu'] }}" type        = "text"
                                    group       = 'mainsub' mainsub     = "{{ md5($photo['na']) }}"
                                    photoid     = "{{ $photo['nu'] }}" autocomplete= "off"
                                    placeholder = "Free text"
                                    class       = "form-control photo_savetxt photo_autotext mb-2 @if (@$feature->fidingsidephoto) width-select2 @else width-select2-fiding @endif"
                                    value       = "{{ @$photo['tx'] }}">
                            </div>
                        @endif
                    @endforeach
                    <input type="hidden" name="" value="{{ count($case->photo) }}" id="count_img">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalbigpic" id="modalbigpic_btn" hidden>
                        open bigpic modal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".selectmainsub").change(function() {
        let sub = []
        for (let i = 0; i < $('.selectmainsub').length; i++) {
            let sel_val = $($('.selectmainsub')[i]).val()
            sel_val = sel_val != undefined && sel_val != '' ? sel_val : ''
            sub.push(sel_val)
        }
        save_localstorage('select_mainpart', sub)
        $.post("{{ url('api/photo') }}", {
            event: 'selectmainsub',
            cid: '{{ $cid }}',
            photo_id: $(this).attr('photo_id'),
            value: $(this).children("option:selected").val()
        }, function(data, status) {});
    });


    $('.photo_savetxt').focusout(function() {
        var case_id = "{{ $cid }}";
        let md5photo = $(this).attr("mainsub");
        var photo_id = $(this).attr('photo_id');
        let photoid = $(this).attr('photoid');
        let selectmainsub = $('#' + md5photo).val();
        let sub = [];
        for (let i = 0; i < $('.photo_savetxt').length; i++) {
            let inp_val = $($('.photo_savetxt')[i]).val()
            inp_val = inp_val != undefined && inp_val != '' ? inp_val : ''
            sub.push(inp_val)
        }
        save_localstorage('text_mainpart', sub)

        $.post("{{ url('api/photo') }}", {
            event: 'phototxt',
            case_id: case_id,
            procedure: "{{ @$case->case_procedurecode }}",
            idhtml: 'mainsub' + selectmainsub,
            value: $(this).val(),
            photo_id: photo_id,
            id: $(this).attr('photoid'),
        }, function(data, status) {});
    });

    function save_localstorage(key, value) {
        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}
        if (retString != null) {
            obj = JSON.parse(retString)
        }
        obj[key] = value
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);
    }
</script>



@if (@$admin->system_autotext == 'true')
    <script>
        $('.photo_autotext').on('click keyup', function() {
            let photoid = $(this).attr('photoid');
            var this_id = $(this).attr('id');
            let md5photo = $(this).attr('md5photo');
            var this_value = $(this).val();
            let selectmainsub = $('#' + md5photo).val() ?? '';
            if (this_id == autotexttempid) {
                autotextcountpress++;
            } else {
                autotexttempid = this_id;
                autotextcountpress = 0;
            }
            textid = 'mainsub' + $(`select[photo_id="${photoid}"]`).val() ?? ""
            if (autotextcountpress < 10 && autotextsystem == "true") {
                $.post("{{ url('api/photo') }}", {
                    event: 'jqinputdropdown',
                    textid: textid,
                    value: this_value,
                    procedure: "{{ $procode }}",
                }, function(data, status) {
                    dataList = [];
                    dataList = JSON.parse(data);
                    $('#' + this_id).inputDropdown(dataList, {
                        formatter: data => {
                            return `<li language="${data.value}">` + data.name + '</li>'
                        },
                        valueKey: 'language'
                    });
                    var wi = $('#' + this_id).css('width');
                    $('.jq-input-dropdown').css({
                        'min-width': wi
                    });
                    $('#jq-input-dropdown_' + this_id).show();
                    var html_li = "";
                    dataList.forEach(obj => {
                        html_li += '<li language="' + obj['value'] + '">' + obj['value'] + '</li>';
                    });
                    $('#jq-input-dropdown_' + this_id).html(html_li);
                    $('li').on('click', function() {
                        $('#' + this_id).focus();
                    });
                });
            } else {
                // คุณพิมพ์เกิน 15 ตัวอักษร
            }
        });
    </script>
@endif



<script>
    $('.img-thumbnail').mousedown(function(e) {
        if (e.which == 3) {
            var photoname = $(this).attr('photoname');
            var htmlid = $(this).attr('id');
            var hn = '{{ $case->case_hn }}';
            $.post("{{ url('api/photomove') }}", {
                event: 'drawarrow',
                hn: hn,
                caseid: '{{ $cid }}',
                folderdate: '{{ $folderdate }}',
                photoname: photoname,
                offsetX: e.originalEvent['offsetX'],
                offsetY: e.originalEvent['offsetY'],
                clientHeight: e.target['clientHeight'],
                clientWidth: e.target['clientWidth']
            }, function(data, status) {
                d = new Date();
                picturepath = "{{ picurl('') }}" + hn + "/{{ $folderdate }}/" + photoname + "?" +
                    d.getTime();
                console.log(picturepath, htmlid);
                $('#' + htmlid).attr("src", picturepath);
            });
        }
    });

    $('.bigpic-modal').on('click', function() {
        var imgselect_new = $(this).attr('photoname');
        $('#lc_text').val(imgselect_new);
        var img_width = $(this).attr("img_width");
        var img_height = $(this).attr("img_height");
        var proc = $(this).attr('procedureimg')
        $.post("{{ url('api/photomove') }}", {
            event: 'pictemp',
            hn: '{{ $case->case_hn }}',
            folderdate: '{{ $folderdate }}',
            picname: imgselect_new,
        }, function(data, status) {
            console.log(data);
            d = Math.random();
            var bigpic = '{{ picurl("$case->case_hn/$folderdate/temp.jpg") }}?a=' + d;
            var backgroundImage = new Image();
            var picsize = JSON.parse(data);
            var widthpic = picsize.width + 65;
            backgroundImage.src = bigpic;
            $('#modalbigpic').modal('show');
            setTimeout(function() {
                $("#lc").attr("style", "border-style: solid;width:" + widthpic + "px;height:" +
                    picsize.height + "px;");
                var lc = LC.init(document.getElementById("lc"), {
                    backgroundShapes: [
                        LC.createShape(
                            'Image', {
                                x: 0,
                                y: 0,
                                image: backgroundImage,
                                width: '100px',
                            }
                        ),
                    ],
                    imageSize: {
                        width: picsize.width,
                        height: picsize.height
                    },
                    imageURLPrefix: '../public/images/drawicon',
                    toolbarPosition: 'bottom',
                    defaultStrokeWidth: 10,
                    strokeWidths: [10, 20, 30, 40, 50]
                });
                gen_pen();

                var have_class = proc != '' && proc != undefined ? 'procedureimage' : ''
                if (have_class != '') {
                    $('#lc').addClass('procedureimage')
                } else {
                    $('#lc').removeClass('procedureimage')
                }
            }, 500);
        });
    })

    function close_bigpic_modal(id) {
        $(`#${id}`).click()
    }

    $('img').bind("contextmenu", function(e) {
        return false;
    });

    $('.picrollback').click(function() {
        var photoname = $(this).attr('photoname');
        var hn = $(this).attr('hn');
        var photo_status = $(this).attr('status');
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        var photo_num = $(this).attr('photo_num');
        if (photo_status == 10) {
            if (confirm("ภาพนี้มีการวาด ต้องการคืนรูปหรือไม่")) {
                $.post("{{ url('api/photomove') }}", {
                    event: 'rollback',
                    photo_id: photo_id,
                    hn: hn,
                    caseid: '{{ $cid }}',
                    photoname: photoname,
                }, function(data, status) {
                    d = new Date();
                    $('#imgselect' + photo_num).attr("src", "{{ picurl('') }}" + hn + "/" +
                        photoname + "?" + d.getTime());
                    $('#picrollback' + photo_num).attr('status', '0');
                });
            } else {
                return false;
            }
        } else {
            $.post("{{ url('api/photomove') }}", {
                event: 'rollback',
                photo_id: photo_id,
                hn: hn,
                caseid: '{{ $cid }}',
                photoname: photoname,
            }, function(data, status) {
                d = new Date();
                $('#imgselect' + photo_num).attr("src", "{{ picurl('') }}" + hn + "/" + photoname +
                    "?" + d.getTime());
            });
        }
    });

    $('.piccropblacknew').click(function() {
        var photoname = $(this).attr('photoname');
        var folderdate = '{{ $folderdate }}';
        var hn = $(this).attr('hn');
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        var photo_num = $(this).attr('photo_num');
        $.post("{{ url('api/photomove') }}", {
            event: 'cropblacknew',
            folderdate: folderdate,
            photo_id: photo_id,
            hn: hn,
            caseid: '{{ $cid }}',
            photoname: photoname,
        }, function(data, status) {
            d = new Date();
            $('#imgselect' + photo_num).attr("src", "{{ picurl('') }}" + hn + "/" + folderdate +
                "/" + photoname + "?" + d.getTime());
        });
    });


    $('.picmark').click(function() {
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        $.post("{{ url('api/photomove') }}", {
            event: 'change_status',
            photo_id: photo_id,
        }, function(data, status) {
            if (data == 1) {
                $('#' + this_id).css({
                    "background-color": "green"
                });
            }
            if (data == 0) {
                $('#' + this_id).css({
                    "background-color": "white"
                });
            }
        });
    });

    $('.piccropblack').click(function() {
        var photoname = $(this).attr('photoname');
        var hn = $(this).attr('hn');
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        var photo_num = $(this).attr('photo_num');
        $.post('{{ url('api/photomove') }}', {
            event: 'cropblack',
            photo_id: photo_id,
            hn: hn,
            caseid: '{{ $cid }}',
            photoname: photoname,
        }, function(data, status) {
            d = new Date();
            $('#imgselect' + photo_num).attr("src", "{{ picurl('') }}" + hn + "/" + photoname +
                "?" + d.getTime());
        });
    });

    $('.picrollbacknew').click(function() {
        var folderdate = '{{ $folderdate }}';
        var photoname = $(this).attr('photoname');
        var hn = $(this).attr('hn');
        var photo_status = $(this).attr('status');
        var photo_id = $(this).attr('photo_id');
        var case_id = $(this).attr('case_id');
        var photo_num = photo_id
        var photo_type = $(this).attr('type');
        if (photo_status == 10) {
            if (confirm("ภาพนี้มีการวาด ต้องการคืนรูปหรือไม่")) {
                $.post("{{ url('api/photomove') }}", {
                    event: 'photorollback',
                    folderdate: '{{ $folderdate }}',
                    photo_id: photo_id,
                    hn: hn,
                    caseid: case_id,
                    photoname: photoname,
                }, function(data, status) {
                    d = new Date();
                    $('#imgselectnew' + photo_id).attr("src", "{{ picurl('') }}" + hn + "/" +
                        folderdate + "/" + photoname + "?" + d.getTime());
                });
            } else {
                return false;
            }
        } else {
            $.post("{{ url('api/photomove') }}", {
                event: 'photorollback',
                folderdate: '{{ $folderdate }}',
                photo_id: photo_id,
                hn: hn,
                caseid: case_id,
                photoname: photoname,
            }, function(data, status) {
                d = Math.random();
                $(`#${photo_type}` + photo_id).attr("src", "{{ picurl('') }}" + hn + "/" +
                    folderdate +
                    "/" + photoname + "?" + d);
                if (photo_type == 'imgselect') {
                    $(`#imgall` + photo_id).attr("src", "{{ picurl('') }}" + hn + "/" +
                        folderdate +
                        "/" + photoname + "?" + d);
                }
            });
        }

        let classnames = document.getElementById($(this).attr('id')).className.split(/\s+/)
        if (classnames.includes('clear-pic')) {
            $.post("{{ url('api/photomove') }}", {
                event: 'cropblacknew',
                folderdate: folderdate,
                photo_id: photo_id,
                hn: hn,
                caseid: '{{ $cid }}',
                photoname: photoname,
            }, function(data, status) {
                d = new Date();
                $('#imgselect' + photo_num).attr("src", "{{ picurl('') }}" + hn + "/" +
                    folderdate +
                    "/" + photoname + "?" + d.getTime());
            });
        }
    });

    $(".picdel").click(function() {
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        $.post("{{ url('api/photomove') }}", {
            event: 'change_status_del',
            photo_id: photo_id,
        }, function(data, status) {
            alert(data)
            if (data == 3) {
                $('#' + this_id).css({
                    "background-color": "#495057"
                });
            }
            if (data == 0) {
                $('#' + this_id).css({
                    "background-color": "red"
                });
            }
        });
    });

    function check_selected_photo() {
        var num = 0
        var img_all = $('.imgselect_new').length
        for (let i = 0; i < img_all; i++) {
            var pic_color = $(`#picselect${i+1}`).css('background-color')
            if (pic_color == "rgb(0, 128, 0)") {
                num = num + 1
            }
        }
        return num
    }

    // New select
    $('.imgselect_new').click(function() {
        console.log('click');
        var num = check_selected_photo()
        var photo_id = $(this).attr('photo_id');
        var this_id = $(this).attr('id');
        var selectnum = $("#bb" + photo_id).html();
        var innum = num + 1;
        $.post("{{ url('api/photomove') }}", {
            event: 'picselect',
            case_id: '{{ $cid }}',
            photo_id: photo_id,
            selectnum: selectnum,
            innum: innum
        }, function(data, status) {});
        if (selectnum == 0) {
            $('#picselect' + photo_id).css({
                "background-color": "green"
            });
            num++;
            $("#bb" + photo_id).html(innum);
        } else {
            $('#picselect' + photo_id).css({
                "background-color": "white"
            });
            $('#imgselect' + photo_id).css({
                "border": "0px"
            });
            num--;
            renumber(new Number($("#bb" + photo_id).html()));
            $("#bb" + photo_id).html('0');
        }
        $("#bb" + photo_id).toggle();
    });

    $('.deselect').click(function() {
        $photo_number = $(this).attr('photo_number');
        $('#divselect' + $photo_number).hide();
        $('#imgselect' + $photo_number).trigger('click');
    });
</script>
