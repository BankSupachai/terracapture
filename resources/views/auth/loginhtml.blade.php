<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark"
    data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Sign In | EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{ asset('public/images/favicon.png') }}" rel="shortcut icon">
    <script src="{{ url('public/assets5/js/layout.js') }}"></script>
    <link href="{{ url('public/assets5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"> --}}
    <style>
        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

        * {
            font-family: 'kanit', sans-serif !important;
        }

        .card-login {
            z-index: 2;
            position: absolute;
            width: fit-content;
            border-radius: 0 !important;
            margin-top: 7em;
            margin-left: 0.5em;
            box-shadow: 0 5px 15px;
        }

        .card-login .card-body {
            padding: 0.5em 10.5em 0.5em 0.4em;
        }

        .card-login img {
            height: 5em;
        }

        .auth-one-bg {
            background-image: none;
            background-color: #245788 !important;
        }

        .auth-bg-cover {
            background: none;
        }

        .btn-success {
            color: #fff;
            background-color: #0AB39C !important;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #018d7a !important;
        }

        .text-welcome {
            font-weight: 600;
            color: #405189;
        }

        .logo-res {
            display: none;
        }

        .Singup {
            color: #405189;
            text-decoration: underline !important;
            font-weight: bold;
        }

        @media only screen and (max-width: 992px) {
            .card-body {
                display: none;
            }

            .logo-res {
                display: block;
            }

            .img-res {
                margin-top: 5px;
                width: 50% !important;
            }
        }

        body {
            background: linear-gradient(-90deg, #193D61, #326172, #388397, #3B899B, #388397, #326172, #193D61);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .logo-login {
            width: 60%;
            margin: auto;
        }

        .mb--1 {
            margin-top: -3em;
        }

        .box-login {
            background: #fff;
            position: absolute;
            width: 30em;
            padding: 0em 2em;
            top: 7em;
            left: 0;
            z-index: 2;
        }

        .text-title {
            position: absolute;
            z-index: 2;
            bottom: 3em;
            left: 2em;
        }
    </style>
</head>

<body>


    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="box-login">
                            <img src="{{ url('public/image/logo_index.png') }}" class="logo-login">
                        </div>
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class=" text-white m-auto  text-title">
                                    <span class="">Respect</span>
                                    <span class="text-white">Standard Beyond Future</span>
                                </div>
                                <div class="col-lg-6">
                                    {{-- @dd(Session::has('key')) --}}

                                    <div class="p-lg-5 p-4 auth-one-bg h-100 align-items-center row">
                                        {{-- <div class="bg-overlay"></div> --}}
                                        <img src="{{ url('public/image/Group14.png') }}" alt="" srcset=""
                                            class="opacity-50">
                                        <div class="col-12">
                                            <div class="mt-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">

                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-welcome fw-normal">Welcome to EndoINDEX </h5>
                                            <p class="text-muted">Sign in to continue</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ url('authnew') }}">
                                                @csrf
                                                <input type="hidden" name="event" value="login" />
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" name="email" class="form-control"
                                                        id="username" placeholder="Enter username"
                                                        oninvalid="this.setCustomValidity('คุณยังไม่ได้กรอก User Name')"
                                                        oninput="setCustomValidity('')"
                                                        onkeyup="check_inp_text('username')" onpaste="return false"
                                                        required autocomplete="off">
                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div
                                                        class="position-relative auth-pass-inputgroup mb-3 form-icon right">
                                                        <input type="password" name="password"
                                                            class="form-control pe-5 form-control-icon"
                                                            placeholder="Enter password" id="password-input"
                                                            oninput="setCustomValidity('')"
                                                            oninvalid="this.setCustomValidity('คุณยังไม่ได้กรอก Password')"
                                                            onkeyup="check_inp_text('password-input')"
                                                            onpaste="return false" required autocomplete="off">
                                                        <i class="ri-eye-off-fill" id="open_pw"
                                                            style="cursor: pointer"></i>
                                                    </div>
                                                </div>
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show mt-1"
                                                        role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i>

                                                        กรุณาตรวจสอบ username หรือ password ของคุณอีกครั้ง
                                                        <button type="button" id="close_error"
                                                            class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <div class="form-check">
                                                </div>

                                                <div class="mt-2">
                                                    <button class="btn btn-success w-100" type="submit">Sign
                                                        In</button>
                                                </div>

                                                <div class="mt-2 pt-5 text-center">
                                                    &emsp;
                                                </div>
                                                {{-- @dd($request) --}}

                                            </form>

                                            <form action="{{ url('auth/google') }}" method="post" hidden>
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="event" value="redirect_to_google">
                                                <button class="btn btn-light w-100" type="submit">Continue with
                                                    Google</button>
                                            </form>
                                            @if (Session::has('google-error'))
                                                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show mt-2"
                                                    role="alert">
                                                    <i class="ri-error-warning-line label-icon"></i>

                                                    การล็อคอินไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่
                                                    <button type="button" id="close_error"
                                                        class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ url('public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets5/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('public/assets5/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('public/assets5/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('public/assets5/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('public/assets5/js/pages/password-addon.init.js') }}"></script>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        var pw_input = document.getElementById("password-input")
        $('#open_pw').on('mousedown', function(e) {
            if (pw_input.type === "password") {
                pw_input.type = "text";
                $(this).removeClass('ri-eye-off-fill').addClass('ri-eye-fill')
            }
        })

        $('#open_pw').on('mouseup', function(e) {
            if (pw_input.type == 'text') {
                pw_input.type = "password";
                $(this).removeClass('ri-eye-fill').addClass('ri-eye-off-fill')
            }
        })

        function check_inp_text(id) {
            var input = document.getElementById(id)
            var text = input.value
            if (text.length > 0) {
                // document.getElementById('close_error').click()
                $('#close_error').click()
            }
        }
    </script>

    @if (@$feature->adfs)
        <script>
            window.location.replace("{{ url('api/adfs/logout/edit') }}");
        </script>
    @endif



</body>

</html>


@include('admin.pagedetail')
