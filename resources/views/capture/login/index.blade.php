<meta charset="utf-8" />
<title>EndoCAPTURE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<link href="{{ asset('public/images/favicon.png') }}" rel="shortcut icon">
<script src="{{ url('public/assets5/js/layout.js') }}"></script>
<link href="{{ url('public/assets5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets5/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets5/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets5/css/custom.min.css') }}" rel="stylesheet" type="text/css" />



<style>
    .auth-one-bg {
        background-image: none !important;
    }
    .bold{
        font-weight: bold;
    }
    .bg-overlay{
        background: #245788 !important;
    }
    .text-primary{
        color: #192D4B !important;
    }
</style>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-4 text-white-50">
                            <div>
                                <a class="d-inline-block auth-logo">
                                    <img src="{{ url('public/image/endocapwi.png.') }}" alt="" width="140">
                                </a>
                            </div>
                            <p class=" pt-3 fs-17 fw-medium">Documentation System</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5 pt-3">
                        <div class="card mt-1">

                            <div class="card-body p-4">
                                <div class="text-center mt-1">
                                    <h5 class="bold text-primary">Welcome Back !</h5>
                                    <p class="bold text-muted">Sign in to continue to EndoCAPTURE.</p>
                                </div>
                                <div class="ps-1 mt-4">
                                    <form action="{{ url('login') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="event" value="login" />
                                        <div class="mb-3">
                                            <label for="username" class="form-label bold">Username</label>
                                            <input type="text" name="email" class="form-control" id="username"
                                                placeholder="Enter username"
                                                oninvalid="this.setCustomValidity('คุณยังไม่ได้กรอก User Name')"
                                                oninput="setCustomValidity('')" onkeyup="check_inp_text('username')"
                                                onpaste="return false" required autocomplete="off">
                                        </div>


                                        <div class="mb-3 pb-2 pt-2">
                                            {{-- <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot
                                                    password?</a>
                                            </div> --}}
                                            <label class="form-label bold" for="password-input">Password </label>
                                            <div class="position-relative auth-pass-inputgroup mb-3 form-icon right">
                                                <input type="password" name="password"
                                                    class="form-control pe-5 form-control-icon"
                                                    placeholder="Enter password" id="password-input"
                                                    oninput="setCustomValidity('')"
                                                    oninvalid="this.setCustomValidity('คุณยังไม่ได้กรอก Password')"
                                                    onkeyup="check_inp_text('password-input')" onpaste="return false"
                                                    required autocomplete="off">
                                                <i class="ri-eye-off-fill" id="open_pw" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                        @isset($notsuccess)
                                                    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show mt-1" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i>
                                                        กรุณาตรวจสอบ Username หรือ Password ของคุณ
                                                        <button type="button" id="close_error" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif

                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div> --}}

                                        <div class="mt-5 pt-4 mb-5">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>

                                        </div>

                                        {{-- <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                        class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                        class="ri-google-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                        class="ri-github-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-info btn-icon waves-effect waves-light"><i
                                                        class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->



                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> EndoCAPTURE 6.0 by Medica Healthcare Co.,Ltd.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
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

</body>
