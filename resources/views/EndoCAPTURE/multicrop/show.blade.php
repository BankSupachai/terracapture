<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{url("public/cropnew/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{url("public/cropnew/cropper.css")}}" rel="stylesheet"/>
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

        .b-example-divider {
          width: 100%;
          height: 3rem;
          background-color: rgba(0, 0, 0, .1);
          border: solid rgba(0, 0, 0, .15);
          border-width: 1px 0;
          box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
          flex-shrink: 0;
          width: 1.5rem;
          height: 100vh;
        }

        .bi {
          vertical-align: -.125em;
          fill: currentColor;
        }

        .nav-scroller {
          position: relative;
          z-index: 2;
          height: 2.75rem;
          overflow-y: hidden;
        }

        .nav-scroller .nav {
          display: flex;
          flex-wrap: nowrap;
          padding-bottom: 1rem;
          margin-top: -1px;
          overflow-x: auto;
          text-align: center;
          white-space: nowrap;
          -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
          --bd-violet-bg: #712cf9;
          --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

          --bs-btn-font-weight: 600;
          --bs-btn-color: var(--bs-white);
          --bs-btn-bg: var(--bd-violet-bg);
          --bs-btn-border-color: var(--bd-violet-bg);
          --bs-btn-hover-color: var(--bs-white);
          --bs-btn-hover-bg: #6528e0;
          --bs-btn-hover-border-color: #6528e0;
          --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
          --bs-btn-active-color: var(--bs-btn-hover-color);
          --bs-btn-active-bg: #5a23c8;
          --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
          z-index: 1500;
        }

        .outer-div {
            width: 100%;
            text-align: center;
            position: relative;
        }

        .inner-div {
            display: inline-block;
            margin: 0 auto;
            padding: 3px;
        }

        .bottom-div {
            display: absolute;
            bottom: 0;
        }

        .cropper-container{
            width: 100% !important;
            max-width: 410px !important;
            min-height: 370px !important;
            max-height: 370px !important;
        }

        .cropper-drag-box{
            max-height: 370px !important;
            min-height: 370px !important;
        }

        .cropper-wrap-box{
            min-width: 410px !important;
            max-width: 410px !important;
            min-height: 370px !important;
            max-height: 370px !important;
        }

        .cropper-canvas{
            /* width: 427px !important;
            height: 240px !important; */
            /* transform: translate(-20px, 49px) !important; */
            /* margin-top: 10px; */
        }

        .cropper-crop-box {
            background-color: white;
        }

        .select-move {
            outline: 2px solid #000000;
            border-radius: 25px;
        }

        .select-crop {
            border: 2px solid #41729F;
            border-radius: 25px;
        }
    </style>
</head>

<body>

    <!-- Button trigger modal -->
    <button type="button" id="waiting_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#waiting_modal" hidden></button>

    <div class="modal fade" id="waiting_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Please wait...</div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="text-center">
                    Cropping progress <span id="curr_crop">0</span>/<span id="max_crop">0</span>
                </div>
                <button hidden  id="close_btn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check2" viewBox="0 0 16 16">
          <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
          <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
        </symbol>
      </svg>

      <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
          <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
              Light
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
              Dark
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
              Auto
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
        </ul>
      </div>


  <main>
    @php
        $only_img = isset($photos) ? count($photos) : 0;
    @endphp
    <div class="container  @if($only_img == 1) py-0 @else py-4 @endif">
        <div class="row align-items-md-stretch @if($only_img == 1) vh-100 @endif">
            @php
                    $img_url = url('')."/public/images/white.png";
                    if(isset($photos[0]['na'])){
                        $img_name   = $photos[0]['na'];
                        $path       = "$hn/$folderdate/$img_name";
                        $img_url    = picurl($path);
                    }
                    $rand = rand(100000,999999);
                @endphp
            <div class="col-md-8 text-bg-light crop-box" id="box0" data-photoname="{{@$photos[0]['na']}}" data-index="0">
                <div class="h-100 p-2 text-bg-light rounded-3 text-center "   style="width: 50%; margin-left:150px">
                    {{-- <img id="image0" src="{{$img_url}}?rand={{@$rand}}" alt=""> --}}
                    <img class="crop-img" id="image0" style="width: @if($only_img == 1) 70% @else 100% @endif; height:100%;max-height: 310px;max-width:100%;" data-box="box0" src="{{$img_url}}?rand={{@$rand}}" alt="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3 outer-div" style="min-height: 340px">
                    <div class="btn-toolbar inner-div" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <button id="move_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-mov text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/>
                                </svg>
                            </button>
                            <button id="show_crop_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-crop text-white" viewBox="0 0 16 16">
                                    <path d="M3.5.5A.5.5 0 0 1 4 1v13h13a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2H3.5a.5.5 0 0 1-.5-.5V4H1a.5.5 0 0 1 0-1h2V1a.5.5 0 0 1 .5-.5zm2.5 3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4H6.5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                            </button>
                            <button id="zoomin_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                    <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>
                            <button id="zoomout_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-out text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                    <path fill-rule="evenodd" d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="btn-toolbar mt-2 inner-div" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <button id="rc_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                </svg>
                            </button>
                            <button id="rcc_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                </svg>
                            </button>
                            <button id="flip_vertical_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>
                            <button id="flip_horizontal_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                    </svg>
                            </button>
                        </div>
                    </div>
                    <div class="btn-toolbar mt-2 inner-div" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <button id="clear_btn" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                  </svg>
                            </button>
                            <button id="" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg style="visibility: hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                </svg>
                            </button>
                            <button id="" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg style="visibility: hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>
                            <button id="" type="button" class="btn btn-dark waves-effect waves-light">
                                <svg style="visibility: hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                    </svg>
                            </button>
                        </div>
                    </div>
                    <div class="btn-toolbar mt-2 inner-div" style="width:100%; max-width: 170px" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" style="width:100%" role="group" aria-label="First group">
                            <button id="moveall_btn" style="background-color: #5885AF; color: white"  type="button" class="btn btn-light waves-effect waves-light">
                                Move All
                            </button>
                        </div>
                        <div class="btn-group me-2 mt-2" style="width:100%" role="group" aria-label="First group">
                            <button id="selectall_btn" style="background-color: #5885AF; border-color: #5885AF; color: white"  type="button" class="btn btn-dark waves-effect waves-light">
                                Select All
                            </button>
                        </div>
                        <div class="btn-group me-2 mt-2" style="width:100%" role="group" aria-label="First group">
                            <button id="confirm_btn"  type="button" class="btn btn-dark waves-effect waves-light">
                                Confirm
                            </button>
                        </div>
                        <div class="btn-group me-2 mt-2" style="width:100%" role="group" aria-label="First group">
                            <a  href="{{url('procedure')}}/{{@$cid}}" class="btn btn-dark waves-effect waves-light">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-md-stretch mt-3" >
            @foreach (isset($photos)?$photos:[] as $index=>$photo)
                @php
                    if(isset($photos[0]) && $index == 0){
                        continue;
                    }

                    $is_newline =  ($index > 3) ? 'mt-2' : '';
                    if(isset($photos[$index]['na'])){
                        $img_name   = $photos[$index]['na'];
                        $path       = "$hn/$folderdate/$img_name";
                        $img_url    = picurl($path);
                    }
                    $rand = rand(100000,999999);
                @endphp
                <div class="col-md-4 {{$is_newline}}">
                    <div class="h-100 p-2 text-bg-light rounded-3 crop-box" id="box{{$index}}" data-index="{{$index}}" data-photoname="{{@$photos[$index]['na']}}" style="position: relative">
                        <img class="crop-img" style="width: 100%; max-height: 330px;min-height:310px; max-width:100%;z-index:9999" src="{{@$img_url}}?rand={{@$rand}}" data-box="box{{$index}}" alt="">
                        {{-- <img src="{{@$img_url}}?rand={{@$rand}}" alt=""> --}}
                    </div>
                </div>
            @endforeach
        </div>

        <div hidden>
            <input type="text" id="hn" name="hn" value="{{@$hn}}">
            <input type="text" id="cid" name="cid" value="{{@$cid}}">
            <input type="text" id="folderdate" name="folderdate" value="{{@$folderdate}}">
        </div>

    </div>
  </main>

    <script src="{{url("public/cropnew/jquery.min.js")}}"></script>
    <script src="{{url("public/cropnew/cropper.min.js")}}"></script>
    <script src="{{url("public/cropnew/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("public/js/color-mode.js")}}"></script>
    <script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
    <script>
        var images = document.querySelectorAll('img');
        var minAspectRatio = 0.5;
        var maxAspectRatio = 1.5;
        var is_flip_vertical = false
        var is_flip_horizontal = false
        var length = images.length;
        var cropbox_position;
        var init_top;
        var croppers = [];
        var finish_upload = 0
        var photos = []
        var cropper;
        var track_select;
        var i;

        for (i = 0; i < length; i++) {
            croppers.push(generate_cropper(images[i], i))
        }

        for (i = 0; i < length; i++) {
            $($('.crop-box')[i]).addClass('select-crop')
        }

        $($('.crop-box')[0]).addClass('select-move')
        track_select = 0
        cropper   = $(croppers[0])


        function generate_cropper(image, index){
            var cropper = new Cropper(image, {
            dragMode: 'move',
            autocrop: false,
            background: false,
            viewMode: 1,
            zoomOnWheel: false,
            restore: true,
            minContainerHeight: 370,
            minContainerWidth: 410,
            ready: function () {
                var cropper = this.cropper;
                var containerData = cropper.getContainerData();
                var cropBoxData = cropper.getCropBoxData();
                var canvasBoxData = cropper.getCanvasData();
                var imageData        = cropper.getImageData();
                var aspectRatio = cropBoxData.width / cropBoxData.height;
                var newCropBoxWidth;

                if(index == 0){
                    init_top = cropBoxData.top
                }

                if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                    newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);
                    cropper.setCropBoxData({
                        left: (containerData.width - newCropBoxWidth) / 2,
                        width: newCropBoxWidth,
                        top: init_top
                    });
                }

                if(index == 0){
                    image.addEventListener('cropmove', (event) => {
                        var color = $('#moveall_btn').css('background-color')
                        if(color == 'rgb(88, 133, 175)'){
                            cropbox_position = cropper.getCropBoxData()
                            cropbox_position.left = cropbox_position.left - 5
                            for (i = 0; i < length; i++) {
                                if(i != 0){
                                    croppers[i].setCropBoxData(cropbox_position)
                                }
                            }
                        }
                    });
                }

                canvasBoxData.top = 1.6
                canvasBoxData.height = 240
                var newcanvas = offset_cropbox(canvasBoxData)
                this.cropper.setCanvasData(newcanvas)
            },
            });
            return cropper
        }

        function offset_cropbox(data){
            data['height'] = data['height']
            data['left'] = data['left'] - 20
            data['top'] = data['top'] + 5
            data['width'] = data['width']
            return data
        }

        function clear_border(index){
            var box_lg = $('.crop-box').length
            for (let i = 0; i < box_lg; i++) {
                // $($('.crop-box')[i]).css('border', 'white')
                $($('.crop-box')[i]).removeClass('select-move')
                cropper   = $(croppers[i])
                cropper[0].setDragMode('none')
            }
        }

        function set_cropbox_position(cropper, position){
            cropper.setCropBoxData(position)
        }

        function select_box(id){
            var border_color = $(`#${id}`).css('border-color')
            if(border_color == 'rgb(65, 114, 159)'){
                $(`#${id}`).removeClass('select-crop')
            } else {
                $(`#${id}`).addClass('select-crop')
            }
        }

        function get_select_box() {
            var arr = []
            for (let i = 0; i < length; i++) {
                var border_color = $(`#box${i}`).css('border-color')
                if(border_color == 'rgb(65, 114, 159)'){
                    arr.push(i)
                }
            }
            return arr
        }

        $('#moveall_btn').on('click', function () {
            var selected_index = 0
            for (let i = 0; i < length; i++) {
                var is_crop_select = $($('.crop-box')[i]).hasClass('crop-select')
                if(is_crop_select){
                    selected_index = i
                }
            }

            var color = $(this).css('background-color')
            if(color == 'rgb(88, 133, 175)'){
                $(this).css('background-color', '#212529')
                $(images[track_select]).off('cropmove')
            } else {
                $(this).css('background-color', 'rgb(88, 133, 175)')
                images[selected_index].addEventListener('cropmove', (event) => {
                    var color = $('#moveall_btn').css('background-color')
                    if(color == 'rgb(88, 133, 175)'){
                        cropbox_position = croppers[selected_index].getCropBoxData()
                        cropbox_position.left = cropbox_position.left - 5
                        for (i = 0; i < length; i++) {
                            if(i != selected_index){
                                croppers[i].setCropBoxData(cropbox_position)
                            }
                        }
                    }
                });
            }

        })


        $('#selectall_btn').on('click', function () {
            var color = $(this).css('background-color')
            if(color == 'rgb(88, 133, 175)'){
                $(this).css('background-color', '#212529')
                $('.crop-box').removeClass('select-crop')
            } else {
                $(this).css('background-color', 'rgb(88, 133, 175)')
                $('.crop-box').addClass('select-crop')
            }
        })

        $('.crop-box').click(function() {
            var id    = this.id
            clear_border()
            $(this).addClass('select-move')
            var index = id.replace('box', '')
            cropper   = $(croppers[index])
            cropper[0].setDragMode('move')

            is_flip_horizontal = false
            is_flip_vertical   = false


            if(track_select != index){
                $(images[track_select]).unbind('cropmove')
                images[index].addEventListener('cropmove', (event) => {
                    var color = $('#moveall_btn').css('background-color')
                    if(color == 'rgb(88, 133, 175)'){
                        cropbox_position = croppers[index].getCropBoxData()
                        cropbox_position.left = cropbox_position.left - 5
                        for (i = 0; i < length; i++) {
                            if(i != index){
                                croppers[i].setCropBoxData(cropbox_position)
                            }
                        }
                    }
                });
            }

            track_select = index
        })


        $('.crop-box').dblclick(function() {
            var id    = this.id
            select_box(id)
        })


        $('#move_btn').on('click', function () {
            cropper[0].setDragMode('move')
        })

        $('#zoomin_btn').on('click', function(){
            cropper[0].zoom(0.1);
        })

        $('#zoomout_btn').on('click', function(){
            cropper[0].zoom(-0.1);
        })

        $('#rc_btn').on('click', function () {
            cropper[0].rotate(90)
        })

        $('#rcc_btn').on('click', function () {
            cropper[0].rotate(-90)
        })

        $('#flip_horizontal_btn').on('click', function(){
            var horizital_status = ''
            if(!is_flip_horizontal){
                cropper[0].scale(-1, 1)
                horizital_status = true
            } else {
                cropper[0].scale(1, 1)
                horizital_status = false
            }
            is_flip_horizontal = horizital_status
        })

        $('#flip_vertical_btn').on('click', function (){
            var vertical_status = ''
            if(!is_flip_vertical){
                cropper[0].scale(1, -1)
                vertical_status = true
            } else {
                cropper[0].scale(1, 1)
                vertical_status = false
            }
            is_flip_vertical = vertical_status
        })

        $('#clear_btn').on('click', function () {
            cropper[0].reset()
        })


        $('#confirm_btn').on('click', function () {
            var select_arr = get_select_box()
            if(select_arr.length > 0){
                $('#waiting_btn').click()
                $('#max_crop').html(select_arr.length)

                for (let i = 0; i < select_arr.length; i++) {
                    var photoname = $($('.crop-box')[i]).data('photoname')
                    photos.push(photoname)
                }

                setTimeout(() => {
                    post_data(photos[finish_upload], finish_upload, select_arr.length)
                }, 1 * 500);
            } else {
                call_alert('no_select', 'กรุณาเลือกรูปภาพที่ต้องการ crop')

            }

        })

        function post_data(photoname, index, num){
            var formdata = new FormData()
            formdata.append('event', 'multiple_crop')
            formdata.append('photoname', photoname)
            formdata.append('cid', $('#cid').val())
            formdata.append('hn', $('#hn').val())
            formdata.append('folderdate', $('#folderdate').val())

            croppers[index].getCroppedCanvas().toBlob((blob) => {
                formdata.append('imagedata', blob)
                $.ajax('{{url("api")}}/photo', {
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                success() {
                    finish_upload += 1
                    console.log('Upload success', 'crop', finish_upload);
                    $('#curr_crop').html(finish_upload)
                    if(finish_upload == num){
                        location.href = `{{url('procedure')}}/` + $('#cid').val()
                    } else {
                        post_data(photos[finish_upload], finish_upload, num)
                    }
                },
                error() {
                    console.log('Upload error');
                    finish_upload += 1
                    if(finish_upload == num){
                        location.href = `{{url('procedure')}}/` + $('#cid').val()
                    } else {
                        post_data(photos[finish_upload], finish_upload)
                    }
                },
            });
            })
        }

        function call_alert(type, text) {
            options = {}
            if(type == 'no_select'){
                options['icon'] = 'warning'
                options['showCloseButton']  = false
                options['showCancelButton'] = false
                options['showConfirmButton'] = false
            }

            options['text'] = text
            Swal.fire(options)
        }

    </script>
</body>
</html>
