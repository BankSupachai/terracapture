<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>500 Error | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ url('public/assets5/images/favicon.ico') }}">
    <script src="{{ url('public/assets5/js/layout.js') }}"></script>
    <link href="{{ url('public/assets5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 text-center">
                        <div class="error-500 position-relative">
                            <img src="{{ url('public/assets5/images/error500.png') }}" alt=""
                                class="img-fluid error-500-img error-img" />
                            <h1 class="title text-muted">500</h1>
                        </div>
                        <div>
                            <h4>Internal Server Error!</h4>
                            <p class="text-muted w-75 mx-auto">Server Error 500. We're not exactly sure what happened,
                                but our servers say something is wrong.</p>
                            <a href="{{ url('') }}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back
                                to home</a>
                        </div>
                    </div><!-- end col-->
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    setTimeout(() => {
        location.reload();
    }, 2000);
</script>
