@if (isset($_GET['select']))
    <script>
        window.location.href = "#photocard";
    </script>
@endif
<style>
    .px-photo {
        padding-left: 0.3rem;
        padding-right: 0.3rem;
        cursor: pointer;
    }

    .btn-icon2 {
        background: #CED4DA;
        color: #495057;
        border-width: 0px;
        border-right: 1px solid #000;
        border-radius: 0;
    }

    .btn-icon2:hover {
        background: #CED4DA;
        color: #495057;
        border-right: 1px solid #000;
    }

    .bg-light2 {
        background: #CED4DA;
    }

    .nav-pills {
        --vz-nav-pills-link-active-bg: #245788;
    }

    .photoviewer-modal {
        background-color: transparent;
        border: none;
        border-radius: 0;
        box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
        min-width: 1200px !important;
        min-height: 800px !important;
        max-width: 1200px !important;
        max-height: 800px !important;
    }

    .photoviewer-header .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);

    }

    .photoviewer-header {
        min-height: 80px !important;
    }

    .photoviewer-stage {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .85);
        border: none;
    }

    .photoviewer-footer .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .photoviewer-header,
    .photoviewer-footer {
        border-radius: 0;
        pointer-events: none;
    }

    .photoviewer-title {
        color: #ccc;
    }

    .photoviewer-button {
        color: #ccc;
        pointer-events: auto;
        min-width: 100px;
        min-height: 80px;
    }

    .photoviewer-header .photoviewer-button:hover,
    .photoviewer-footer .photoviewer-button:hover {
        color: white;
    }

    .svg-inline-icon {
        width: 40px !important;
        height: 40px !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #ffffff;
        background-color: {{ @$project_name == 'capture' ? '#192D4B' : '#245788' }};
    }
</style>
@php
    $view['procedure'] = $procedure;
@endphp

<div class="col-12 p-0 relative">
    <div id="photocard" style="position: absolute;top: -80px;">
    </div>
    {!! editcard('photo', 'photo.blade.php') !!}
    <div class="card card-custom gutter-b" id="photo_card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            @php
                                $photos = isset($case->photo) ? $case->photo : [];
                                $is_selected = 0;
                                if (is_array($photos)) {
                                    foreach ($photos as $key => $p) {
                                        $p = (object) $p;
                                        if (isset($p->ns) ? $p->ns : 0 > 0) {
                                            $is_selected += 1;
                                        }
                                    }
                                }
                                $is_active = $is_selected > 0 ? 'active' : '';
                            @endphp
                            @if (@$department_user == 'ENT')
                                @if ($count_photo == 0)
                                    <ul class="nav nav-pills nav-primary-capture mb-3" role="tablist" id="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link  " id="divmenu1">All Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link " id="divmenu2">Selected Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" id="divmenu3">
                                                Video
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" id="divmenu4">
                                                Operation Detail
                                            </a>
                                        </li>
                                    </ul>
                                @elseif (count($photoselect) > 0)
                                    <ul class="nav nav-pills nav-primary-capture mb-3" role="tablist" id="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link  " id="divmenu1">All Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" id="divmenu2">Selected Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link " id="divmenu3">
                                                Video
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" id="divmenu4">
                                                Operation Detail
                                            </a>
                                        </li>
                                    </ul>
                                    @else
                                    <ul class="nav nav-pills nav-primary-capture mb-3" role="tablist" id="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active " id="divmenu1">All Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link " id="divmenu2">Selected Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link " id="divmenu3">
                                                Video
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" id="divmenu4">
                                                Operation Detail
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            @else
                                <ul class="nav nav-pills nav-primary-capture mb-3" role="tablist" id="tablist">
                                    @if (count($photoselect) > 0)
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link  " id="divmenu1">All Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" id="divmenu2">Selected Photo</a>
                                        </li>
                                    @else
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active " id="divmenu1">All Photo</a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link  " id="divmenu2">Selected Photo</a>
                                        </li>
                                    @endif
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" id="divmenu3">
                                            Video
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" id="divmenu4">
                                            Operation Detail
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        <div class="col-6 text-end">
                            @isset($have_pacs)
                                @if ($have_pacs)
                                    <button type="button"
                                        class="btn btn-primary waves-effect waves-light hide-btn-function"
                                        onclick="download_pac_pics()"><i
                                            class="ri-image-line ri-lg me-2  align-middle "></i>Upload Pacs
                                        Image</button>
                                @endif
                            @endisset

                            @if (@$project_name == 'capture')
                            @else
                                @if (@$admin->com_type != 'server')
                                    <button type="button"
                                        class="btn btn-primary btn-icon waves-effect waves-light hide-btn-function"
                                        onclick="action_all('load')"><i class="ri-refresh-line ri-lg"></i></button>
                                @endif
                            @endif


                            <a type="button" id="btn_select_all" class="btn btn-primary waves-effect waves-light hide-btn-function"
                                onclick="toggle_select_all()"><i
                                    class=" ri-checkbox-multiple-line ri-lg me-2  align-middle "></i><span id="btn_select_all_text">Select All</span></a>
                            @if (@$project_name == 'capture')
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Manage Photo
                                        </button>
                                        <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                            <li>
                                                <a href="{{ url("upload/?hn=$case->hn&case_id=$cid") }}"
                                                    class="dropdown-item"> Upload </a>
                                            </li>
                                            <li>
                                                <a href="{{ url("imagesort/$cid/?hn=$case->hn&case_id=$cid") }}"
                                                    class="dropdown-item"> Sort</a>
                                            </li>
                                            <li>
                                                <a href="{{ url("photomove/$cid") }}" class="dropdown-item">Move</a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item" id="btn_callmodaldownload"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal_download">Download</button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    onclick="action_all('rollback')">Rollback All Photo</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Manage Photo
                                        </button>

                                        <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                            <li>
                                                <a href="{{ url("selfupload/?hn=$case->hn&case_id=$cid") }}"
                                                    class="dropdown-item"> Upload </a>
                                            </li>
                                            <li>
                                                <a href="{{ url("imagesort/$cid/?hn=$case->hn&case_id=$cid") }}"
                                                    class="dropdown-item"> Sort</a>
                                            </li>
                                            <li>
                                                <a href="{{ url("api/photomove/$cid") }}"
                                                    class="dropdown-item">Move</a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    id="btn_callmodaldownload" data-bs-toggle="modal"
                                                    data-bs-target="#modal_download">Download</button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    onclick="action_all('rollback')">Rollback All Photo</button>
                                            </li>
                                            {{-- <li>
                                                <a href="{{ url("/$cid") }}" class="dropdown-item">Manual Crop</a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto p-0">
                        <span id="img_reload" class="float-right" data-container="body" data-toggle="tooltip"
                            data-placement="top" title="Reload Images"><i class="fas fa-sync-alt mt-3"></i></span>
                    </div>
                    <div class="col-12" style="margin-top: 0em;">
                        <div class="row">
                            <div class="col-12" id="div-allphoto">
                                @livewire('Writereport.Photo.All', ['case' => $case])
                                {{-- @include('case.component.photo.photoshowall') --}}
                            </div>
                            @if (@$feature->fidingsidephoto)
                                <div class="col-5" id="div-selectphoto">
                                    @include('case.component.photo.photoselect')
                                </div>
                                <div class="col-5" id="div-selectvideo">
                                    @include('case.component.photo.vdo')
                                </div>
                                <div class="col-7" id="div-fiding">
                                    @if (count($photoselect) != 0)
                                        @include('case.component.findingincard')
                                    @endif
                                </div>
                            @else
                                <div class="col-12" id="div-selectphoto">
                                    @include('case.component.photo.photoselect')
                                </div>
                                <div class="col-12" id="div-selectvideo">
                                    @include('case.component.photo.vdo')
                                </div>
                            @endif
                            <div class="col-12" id="div-operation">
                                @include('case.component.photo.Opdetail')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#custom-picture').on('change', function() {
        let data_photo = $(this).val();
        if (data_photo == '6') {
            $("#photo_display").removeClass()
        }
    });
</script>

<script>
    $("#btn_callmodaldownload").click(function() {
        $.post('{{ url('api/procedure') }}', {
            event: 'photozip',
            cid: '{{ $cid }}'
        })
    })
</script>

<script src="{{ url('public/js/photoviewer/photoviewer.min.js') }}"></script>
<script>
    var photos = []
    var photo_ids = []
    var items = []
    var min_pvWidth = 1200
    var min_pvHeight = 800

    function pageLoad() {

        hideall_tapphoto();
        $('#div-allphoto').show();
    }
    pageLoad()

    function hideall_activephoto() {
        $('#divmenu1, #divmenu2 , #divmenu3 , #divmenu4').removeClass('active');
    }

    function hideall_tapphoto() {
        $('#div-selectphoto , #div-selectvideo , #div-fiding , #div-operation , #div-fidingvideo , #div-allphoto')
            .hide();
    }


    $('#divmenu1').click(function() {
        hideall_activephoto();
        hideall_tapphoto();
        $('#div-allphoto').fadeIn(500);
        $('#divmenu1').addClass('active')
    });

    @if (count($photoselect) > 0)
        hideall_tapphoto();
        $('#div-selectphoto').fadeIn(500);
        $('#div-fiding').fadeIn(500);
    @else
        hideall_tapphoto();
        $('#div-allphoto').fadeIn(500);
    @endif

    @if ($department_user == 'ENT' && $count_photo == 0)
        $('#div-selectvideo').fadeIn(500);
    @endif

    $('#divmenu2').click(function() {
        hideall_activephoto();
        hideall_tapphoto();
        $('#div-selectphoto').fadeIn(500);
        $('#div-fiding').fadeIn(500);
        $('#divmenu2').addClass('active');
    });

    $('#divmenu3').click(function() {
        hideall_activephoto();
        hideall_tapphoto();
        $('#div-selectvideo').fadeIn(500);
        $('#div-fiding').fadeIn(500);
        $(this).addClass('active');
        $('#divmenu3').addClass('active');
    });

    $('#divmenu4').click(function() {
        hideall_activephoto();
        hideall_tapphoto();
        $('#div-operation').fadeIn(500);
        $('#divmenu4').addClass('active');
    });

    $('#tabmenu0').click(function() {
        $('.hide-btn-function').show();
    })

    $('#tabmenu1').click(function() {
        $('.hide-btn-function').hide();
    })

    $('#tabmenu2').click(function() {
        $('.hide-btn-function').hide();
    })

    $('#tabmenu3').click(function() {
        $('.hide-btn-function').hide();
    })

    $("#img_reload").click(function() {
        $("#reload").modal('show')
        $.post("{{ url('api/image') }}", {
            event: 'img_reload',
            cid: '{{ $cid }}',
        }, function(d, s) {
            setTimeout(() => {
                location.reload();
            }, 800);
        });
    });

    function action_all(action) {
        var btn_id = `all_action_btn`
        $(`#event_inp`).val(`${action}allphoto`)
        setTimeout(() => {
            $(`#all_action_btn`).click()
        }, 1000);
    }

    function check_all_photos_selected() {
        let total_photos = 0;
        let selected_photos = 0;

        $('.photo-display').each(function() {
            let photo_container = $(this).closest('.large-responsive');
            if (photo_container.length > 0) {
                total_photos++;
                let photo_id = $(this).attr('photo_id');
                let bb_element = $(`#bb${photo_id}`);

                if (bb_element.length > 0) {
                    let bb_value = bb_element.html();
                    let bb_display = bb_element.css('display');

                    if (bb_value && bb_value.trim() != '-' && bb_value.trim() != '0' && bb_value.trim() != '' && bb_display != 'none') {
                        selected_photos++;
                    }
                }
            }
        });

        return total_photos > 0 && total_photos === selected_photos;
    }

    function update_select_all_button() {
        let all_selected = check_all_photos_selected();
        let btn = $('#btn_select_all');
        let btn_text = $('#btn_select_all_text');
        let btn_icon = btn.find('i');

        if (all_selected) {
            btn_text.text('Unselect All');
            btn_icon.removeClass('ri-checkbox-multiple-line').addClass('ri-checkbox-multiple-blank-line');
        } else {
            btn_text.text('Select All');
            btn_icon.removeClass('ri-checkbox-multiple-blank-line').addClass('ri-checkbox-multiple-line');
        }
    }

    function toggle_select_all() {
        let all_selected = check_all_photos_selected();
        if (all_selected) {
            action_all('unselect');
        } else {
            action_all('select');
        }
    }

    $(document).ready(function() {
        setTimeout(function() {
            update_select_all_button();
        }, 500);

        setInterval(function() {
            update_select_all_button();
        }, 500);

        $(document).on('click', '.photo-display', function() {
            setTimeout(function() {
                update_select_all_button();
            }, 300);
        });

        window.addEventListener('livewire:load', function() {
            update_select_all_button();
        });

        document.addEventListener('livewire:update', function() {
            setTimeout(function() {
                update_select_all_button();
            }, 100);
        });
    });

    $('.text-time').on('input', function() {
        var this_index = $(this).attr('time')
        var this_time = $(this).val()
        var field = 'case_time'
        console.log(this_index, this_time);
        $.post('{{ url('api') }}/jquery', {
            event: 'update_time',
            time: this_time,
            cid: "{{ $case->id }}",
            index: this_index
        }, function(data, status) {

        });
    })

    $('.zoomify_icon_all').click(function(e) {


        e.preventDefault()
        let picnumber = $(this).attr('pic_number')
        let title_elem = $(this).attr('title')
        let pic_index;

        // ตรวจสอบ selector ที่มีอยู่จริง: .img-thumbnail-all หรือ .photo-display
        let imgSelector = $('.img-thumbnail-all').length > 0 ? '.img-thumbnail-all' : '.photo-display';

        if (title_elem == 'Drawing') {
            title_elem
            photos = []
            items = []
            photo_ids = []
            let all_images = $(imgSelector).length
            let photoname = $(this).attr('photoname')
            let index = 0

            for (let i = 0; i < all_images; i++) {
                if (i == 0) {
                    continue;
                }

                let imgElement = $($(imgSelector)[i])
                // หา photo_id: ถ้า element มี class photo-display อยู่แล้วให้อ่านจาก attribute โดยตรง มิฉะนั้นหาใน parent
                let photo_id = imgElement.hasClass('photo-display')
                    ? imgElement.attr('photo_id')
                    : (imgElement.closest('.photo-display').attr('photo_id') || imgElement.attr('photo_id'))
                photo_id = photo_id || (i + 1)

                items.push({
                    src: imgElement.attr('src'),
                    title: imgElement.attr('data-title') || imgElement.data('title') || imgElement.attr('photoname'),
                    photo_id: photo_id
                })

                photos.push(imgElement.data('title') || imgElement.attr('data-title') || imgElement.attr('photoname'))
                photo_ids.push(photo_id)
            }

            for (let j = 0; j < photos.length; j++) {
                if (photos[j] == photoname) {
                    index = j
                }
            }
            pic_index = index
        } else {
            // alert(2)
            items = []
            photos = []
            photo_ids = []
            let all_images = $(imgSelector).length
            for (let i = 0; i < all_images; i++) {
                let imgElement = $($(imgSelector)[i])
                // หา photo_id: ถ้า element มี class photo-display อยู่แล้วให้อ่านจาก attribute โดยตรง มิฉะนั้นหาใน parent
                let photo_id = imgElement.hasClass('photo-display')
                    ? imgElement.attr('photo_id')
                    : (imgElement.closest('.photo-display').attr('photo_id') || imgElement.attr('photo_id'))
                photo_id = photo_id || (i + 1)

                items.push({
                    src: imgElement.attr('src'),
                    title: imgElement.attr('data-title') || imgElement.data('title') || imgElement.attr('photoname'),
                    photo_id: photo_id
                })
                photos.push(imgElement.data('title') || imgElement.attr('data-title') || imgElement.attr('photoname'))
                photo_ids.push(photo_id)
            }
            pic_index = parseInt(picnumber) - 1
        }

        let options = {
            index: pic_index,
            modalWidth: min_pvWidth,
            modalHeight: min_pvHeight,
        }
        // Debug information

        let viewer = new PhotoViewer(items, options)
        $('.photoviewer-footer').css('position', 'relative')
        if (title_elem != 'Drawing') {




            setTimeout(() => {
                let current_src = $('.photoviewer-image').attr('src')
                if (current_src && items.length > 0) {

                    for (let i = 0; i < items.length; i++) {
                        if (items[i] && (items[i].src || items[i].title)) {
                            if ((items[i].src && current_src.includes(items[i].src)) || (items[i].title && current_src.includes(items[i].title))) {
                                let photo_id = items[i].photo_id || photo_ids[i] || picnumber
                                check_selected_photo_photoviewer(photo_id)
                                break
                            }
                        }
                    }
                }
            }, 100)
        }
        let btn_lg = $('.photoviewer-button').length
        for (let i = 0; i < btn_lg; i++) {
            let title = $($('.photoviewer-button')[i]).attr('title')
            if (title.includes('Prev') || title.includes('Next')) {
                $($('.photoviewer-button')[i]).bind('click', click_arrow_btn)
            } else if (title.includes('Close')) {
                $($('.photoviewer-button')[i]).bind('click', click_close_btn)
            } else if (title.includes('Fullscreen')) {
                $($('.photoviewer-button')[i]).remove()
                $(`<button class="photoviewer-button photoviewer-button-tocrop" title="Select Photo" onclick="click_fullscreen_btn()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="600" height="600" fill="currentColor" class="bi bi-image svg-inline-icon" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                    </svg>
                    </button>`).insertAfter('.photoviewer-button-prev')
                $('.photoviewer-button-tocrop').bind('click', click_fullscreen_btn)
            } else if (title.includes('Maximize')) {
                $($('.photoviewer-button')[i]).remove()
            } else if (title.includes('Actual')) {
                $($('.photoviewer-button')[i]).remove()
            }
        }
    });




    $('.zoomify_icon_select').click(function(e) {
        e.preventDefault()
        let picnumber = $(this).attr('pic_number')
        let photo_id2 = $(this).attr('photo_id2')
        let title_elem = $(this).attr('title')
        let pic_index;
        let all_images = $('.img-thumbnail-select').length

        if (title_elem == 'Drawing') {
            photos = []
            items = []
            photo_ids = []
            let photoname = $(this).attr('photoname')
            let index = 0

            for (let i = 0; i < all_images; i++) {
                let imgElement = $($('.img-thumbnail-select')[i])
                let src = imgElement.attr('src')
                let title = imgElement.attr('data-title')
                let photo_id = imgElement.attr('photo_id') || imgElement.attr('pic_number') || (i + 1)

                if (src && title) {
                    items.push({
                        src: src,
                        title: title,
                        photo_id: photo_id
                    })
                    photos.push(title)
                    photo_ids.push(photo_id)
                }
            }

            for (let j = 0; j < photos.length; j++) {
                if (photos[j] == photoname) {
                    index = j
                    break
                }
            }
            pic_index = index
        } else {
            items = []
            photos = []
            photo_ids = []

            for (let i = 0; i < all_images; i++) {
                let imgElement = $($('.img-thumbnail-select')[i])
                let src = imgElement.attr('src')
                let title = imgElement.attr('data-title')
                let photo_id = imgElement.attr('photo_id') || imgElement.attr('pic_number') || (i + 1)

                if (src && title) {
                    items.push({
                        src: src,
                        title: title,
                        photo_id: photo_id
                    })
                    photos.push(title)
                    photo_ids.push(photo_id)
                }
            }

            // หา index ใน items array โดยใช้ photo_id หรือ pic_number
            let targetPhotoId = photo_id2 || picnumber
            pic_index = 0 // default index

            for (let i = 0; i < items.length; i++) {
                let itemPhotoId = String(items[i].photo_id)
                let targetId = String(targetPhotoId)
                if (itemPhotoId === targetId) {
                    pic_index = i
                    break
                }
            }

            // ถ้ายังหาไม่เจอ ให้ลองใช้ pic_number
            if (pic_index === 0 && items.length > 0 && String(items[0].photo_id) !== String(targetPhotoId)) {
                let targetPicNumber = parseInt(picnumber)
                for (let i = 0; i < items.length; i++) {
                    let itemPhotoId = parseInt(items[i].photo_id)
                    if (itemPhotoId === targetPicNumber) {
                        pic_index = i
                        break
                    }
                }
            }
        }

        let options = {
            index: pic_index,
            modalWidth: min_pvWidth,
            modalHeight: min_pvHeight,
        }
        console.log('Selected pic_number:', picnumber);
        console.log('Calculated pic_index:', pic_index);
        console.log('Total images:', all_images);
        console.log('Items array:', items);
        console.log('Photos array:', photos);
        let viewer = new PhotoViewer(items, options)
        $('.photoviewer-footer').css('position', 'relative')
        if (title_elem != 'Drawing') {

            setTimeout(() => {
                let current_src = $('.photoviewer-image').attr('src')
                if (current_src) {

                    for (let i = 0; i < items.length; i++) {
                        if (current_src.includes(items[i].src) || current_src.includes(items[i].title)) {
                            let photo_id = items[i].photo_id || photo_ids[i] || picnumber
                            check_selected_photo_photoviewer(photo_id)
                            break
                        }
                    }
                }
            }, 100)
        }
        let btn_lg = $('.photoviewer-button').length
        for (let i = 0; i < btn_lg; i++) {
            let title = $($('.photoviewer-button')[i]).attr('title')
            if (title.includes('Prev') || title.includes('Next')) {
                $($('.photoviewer-button')[i]).bind('click', click_arrow_btn)
            } else if (title.includes('Close')) {
                $($('.photoviewer-button')[i]).bind('click', click_close_btn)
            } else if (title.includes('Fullscreen')) {
                $($('.photoviewer-button')[i]).remove()
                $(`<button class="photoviewer-button photoviewer-button-tocrop" title="Select Photo" onclick="click_fullscreen_btn()">
            <svg xmlns="http://www.w3.org/2000/svg" width="600" height="600" fill="currentColor" class="bi bi-image svg-inline-icon" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
            </svg>
            </button>`).insertAfter('.photoviewer-button-prev')
                $('.photoviewer-button-tocrop').bind('click', click_fullscreen_btn)
            } else if (title.includes('Maximize')) {
                $($('.photoviewer-button')[i]).remove()
            } else if (title.includes('Actual')) {
                $($('.photoviewer-button')[i]).remove()
            }
        }
    });










    function click_arrow_btn(e) {
        let this_src = $('.photoviewer-image').attr('src')

        for (let i = 0; i < items.length; i++) {
            if (this_src.includes(items[i].src) || this_src.includes(items[i].title)) {
                let photo_id = items[i].photo_id || photo_ids[i] || (i + 1)
                check_selected_photo_photoviewer(photo_id)
                break
            }
        }
    }

    function click_close_btn(e) {
        console.log('close');
    }

    function click_fullscreen_btn() {
        let this_src = $('.photoviewer-image').attr('src')

        for (let i = 0; i < items.length; i++) {
            if (this_src.includes(items[i].src) || this_src.includes(items[i].title)) {
                let photo_id = items[i].photo_id || photo_ids[i] || (i + 1)
                let photoname = items[i].title
                let url =
                    `{{ url('crop') }}?cid={{ @$cid }}&hn={{ @$case->hn }}&folderdate={{ @$folderdate }}&photoname=${photoname}&caseuniq={{ @$case->caseuniq }}&ppic={{ @$procedure->img }}&photo_id=${photo_id}`
                location.href = url
                break
            }
        }
    }

    function check_selected_photo_photoviewer(photo_id) {
        let is_selected = $(`#bb${photo_id}`).css('display') != 'none'
        if (is_selected) {
            $('.photoviewer-button-selected').css('background-color', '#0071bb')
        } else {
            $('.photoviewer-button-selected').css('background-color', 'rgba(0, 0, 0, .5)')
        }
    }

    function selected_photo() {
        let this_color = $('.photoviewer-button-selected').css('background-color')
        let is_selected = (this_color == 'rgb(0, 113, 187)')

        let this_src = $('.photoviewer-image').attr('src')

        let current_photo_id = null
        for (let i = 0; i < items.length; i++) {
            if (this_src.includes(items[i].src) || this_src.includes(items[i].title)) {
                current_photo_id = items[i].photo_id || photo_ids[i]
                break
            }
        }

        if (current_photo_id) {

            let selectnum = $("#bb" + current_photo_id).html() || '0'
            selectnum = (selectnum == '-' || selectnum == '' || selectnum == '0') ? '0' : selectnum
            let is_currently_selected = (selectnum != '0' && selectnum != 0 && $("#bb" + current_photo_id).css('display') != 'none')


            let num = 0
            $('.bb').each(function() {
                let numVal = $(this).html()
                if (numVal && numVal != '-' && numVal != '0' && numVal != '' && $(this).css('display') != 'none') {
                    num++
                }
            })


            let innum = is_currently_selected ? 0 : (num + 1)


            $.post("{{ url('api/photomove') }}", {
                event: 'picselect',
                case_id: '{{ $cid }}',
                photo_id: current_photo_id,
                selectnum: selectnum,
                innum: innum
            }, function(data, status) {
                if (status === 'success') {

                    if (is_currently_selected) {

                        $('.photoviewer-button-selected').css('background-color', 'rgba(0, 0, 0, 0.5)')
                        $("#bb" + current_photo_id).css('display', 'none')
                        $("#bb" + current_photo_id).html('0')
                        $('#picselect' + current_photo_id).css('background-color', 'white')
                    } else {

                        $('.photoviewer-button-selected').css('background-color', '#0071bb')
                        $("#bb" + current_photo_id).css('display', 'block')
                        $("#bb" + current_photo_id).html(innum)
                        $('#picselect' + current_photo_id).css('background-color', 'green')
                    }
                }
            })
        }
    }

    function refresh_page() {
        let url = "{{ url('') }}/procedure/{{ $case->id }}?select=1"
        location.href = url
    }

    function download_pac_pics() {
        $('#photopacs').click()
        for (let i = 0; i < $('.ck-pacimg').length; i++) {
            $($('.ck-pacimg')[i]).prop('checked', false)
        }
        pacs_ck = false
    }
</script>

<script>
$(function(){
    if(window.location.hash === "#tablist"){
        setTimeout(function(){
            var $target = $('#tablist');
            if($target.length){
                $('html, body').animate({
                    scrollTop: $target.offset().top - 170 // ปรับ offset เป็น 100px
                }, 800); // ปรับความเร็วเป็น 800ms
            }
        }, 300);
    }
});
</script>
