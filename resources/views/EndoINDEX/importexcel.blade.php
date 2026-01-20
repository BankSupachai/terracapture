<!DOCTYPE html>
<html lang="en">
    <head><base href="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta charset="utf-8" />
		<title>EndoQUEUE</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
        <link href="{{asset('public/image/favicon_queue.png')}}"                                rel="shortcut icon"/>
		{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> --}}
		<link href="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/global/plugins.bundle.css" )}}"rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/themes/layout/brand/light.css")}}" rel="stylesheet" type="text/css" id="set_brand" />
        <link href="{{url("public/sample/assets/css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" id="set_aside" />
        <style>
            body{background: #fff;}
            .file-input {
                display: inline-block;
                text-align: left;
                background: #fff;
                padding: 16px;
                width: 450px;
                position: relative;
                border-radius: 3px;
            }

            .file-input > [type='file'] {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                z-index: 10;
                cursor: pointer;
            }

            .file-input > .button {
                display: inline-block;
                cursor: pointer;
                background: #eee;
                padding: 8px 16px;
                border-radius: 2px;
                margin-right: 8px;
            }

            .file-input:hover > .button {
                background: dodgerblue;
                color: white;
            }

            .file-input > .label {
                color: #333;
                white-space: nowrap;
                opacity: .3;
                display: contents;
            }

            .file-input.-chosen > .label {
                opacity: 1;
            }
            .tab-pane button[type="submit"]{
                width: 90%;
            }
            .head-text{
                color: rgb(55, 55, 228);
                text-shadow: 0px 2px 2px steelblue;
            }
        </style>
	</head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed body_light aside-minimize body_light" id="body_set">

<div class="card m-auto">
    <div class="card-body">
        <div class="text-center mb-3">
            <span class="svg-icon svg-icon-primary svg-icon-6x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Wallet3.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                    <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                    <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                </g>
            </svg><!--end::Svg Icon--></span>
        </div>
        <h1 class="text-center mb-5 pb-5 head-text">Import Excel</h1>
        <div class="example-preview">
            <ul class="nav nav-tabs row" id="myTab" role="tablist">
                <li class="nav-item col">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">
                        <span class="nav-icon">
                            <i class="fab fa-studiovinari"></i>
                        </span>
                        <span class="nav-text">ICD-9</span>
                    </a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="fab fa-suse"></i>
                        </span>
                        <span class="nav-text">ICD-10</span>
                    </a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" aria-controls="contact">
                        <span class="nav-icon">
                            <i class="fab fa-sticker-mule"></i>
                        </span>
                        <span class="nav-text">Accessory</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active text-center" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <a href="{{url("public/billing/icd9.xlsx")}}" class="btn btn-success btn-sm">ตัวอย่าง ICD-9</a>
                    <form action="{{url('importexcel')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                        @method('POST')
                        @csrf
                        <div class='file-input w-100'>
                            <input type='file' name="fileicd9">
                            <span class='button'>ICD-9 Excel</span>
                            <span class='label' data-js-label>No file selected</label>
                        </div>
                        <button class="btn btn-primary rounded-0" name="icd9" value="1" type="submit">Start Import</button>
                    </form>
                </div>
                <div class="tab-pane fade text-center" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <a href="{{url("public/billing/icd10.xlsx")}}" class="btn btn-success btn-sm">ตัวอย่าง ICD-10</a>
                    <form action="{{url('importexcel')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                        @method('POST')
                        @csrf
                        <div class='file-input w-100'>
                            <input type='file' name="fileicd10">
                            <span class='button'>ICD-10 Excel</span>
                            <span class='label' data-js-label>No file selected</label>
                        </div>
                        <button class="btn btn-primary rounded-0" name="icd10" value="1"  type="submit">Start Import</button>
                    </form>
                </div>
                <div class="tab-pane fade text-center" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <a href="{{url("public/billing/accessery.xlsx")}}" class="btn btn-success btn-sm">ตัวอย่าง Accessory</a>
                    <form action="{{url('importexcel')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                        @method('POST')
                        @csrf
                        <div class='file-input w-100'>
                            <input type='file' name="filebilling">
                            <span class='button'>Accessory Excel</span>
                            <span class='label' data-js-label>No file selected</label>
                        </div>
                        <button class="btn btn-primary rounded-0" name="billing" value="1" type="submit">Start Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>













		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<script src="{{url("public/sample/assets/plugins/global/plugins.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/js/scripts.bundle.js")}}"></script>
        <script src="{{url("public/js/jquery-ui.js")}}"></script>
        <script>
            var inputs = document.querySelectorAll('.file-input')

            for (var i = 0, len = inputs.length; i < len; i++) {
            customInput(inputs[i])
            }

            function customInput (el) {
            const fileInput = el.querySelector('[type="file"]')
            const label = el.querySelector('[data-js-label]')

            fileInput.onchange =
            fileInput.onmouseout = function () {
                if (!fileInput.value) return

                var value = fileInput.value.replace(/^.*[\\\/]/, '')
                el.className += ' -chosen'
                label.innerText = value
            }
            }
        </script>
	</body>
</html>
