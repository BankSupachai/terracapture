<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Sign In | EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{ asset('public/images/favicon.png') }}" rel="shortcut icon">
    <script src="{{url("public/assets5/js/layout.js")}}"></script>
    <link href="{{url("public/assets5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"> --}}

    <style>
        .card-login{
            z-index: 2;
            position: absolute;
            width: fit-content;
            border-radius: 0 !important;
            margin-top: 7em;
            margin-left: 0.5em;
            box-shadow: 0 5px 15px;
        }
        .card-login .card-body{
            padding: 0.5em 10.5em 0.5em 0.4em;
        }
        .card-login img{
            height: 5em;
        }
        .auth-one-bg{
            background-image:url("{{url("public/image/Group14.png")}}");
        }
        .auth-bg-cover {
            background: linear-gradient(-45deg,#325684 50%,#1EA399);
        }
        .btn-success {
            color: #fff;
            background-color: #0AB39C !important;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #018d7a !important;
        }
        .text-welcome{
            font-weight: 600;
            color: #405189;
        }
        .logo-res{
            display: none;
        }
        .Singup{
            color: #405189;
            text-decoration: underline !important;
            font-weight: bold;
        }
        @media only screen and (max-width: 992px) {
            .card-body{
                display: none;
            }
            .logo-res{
                display: block;
            }
            .img-res{
                margin-top: 5px;
                width: 50% !important;
            }
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
                    <div class="card card-login">
                        <div class="card-body"><img src="{{url("public/image/logo_index.png")}}" alt=""></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">

                                    <div class="p-lg-5 p-4 auth-one-bg h-100">

                                        {{-- <div class="bg-overlay"></div> --}}
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="logo-res"style="text-align-last: center; ">
                                                <img src="{{url("public/crop_logo/White/EndoINDEX_white.png")}}" alt="" class="img-res" width="25%">
                                            </div>
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="w-100 text-center text-white m-auto opacity-50">Respect Standard Beyond Future</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">

                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-welcome">Welcome to EndoINDEX</h5>
                                            <p class="text-muted">Sign in to continue</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login.custom') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" name="email" class="form-control" id="username" placeholder="Enter username">
                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input ">
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                                </div>

                                                <div class="mt-5 pt-5 text-center">
                                                    Don't have an account ?
                                                    <a href="" class="Singup">SignUp</a>
                                                </div>

                                            </form>
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
                                <script>document.write(new Date().getFullYear())</script>  EndoINDEX 6.0 by Medica Healthcare Co.,Ltd
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{url("public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/feather-icons/feather.min.js")}}"></script>
    <script src="{{url("public/assets5/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
    {{-- <script src="{{url("public/assets5/js/plugins.js")}}"></script> --}}
    <script src="{{url("public/assets5/js/pages/password-addon.init.js")}}"></script>
</body>

</html>
