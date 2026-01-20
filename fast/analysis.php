
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed"
    data-layout-style="default">

<head>
    <meta name="csrf-token" content="VyA002AcomMjMUK57FwZHKEhPJKntrw9ADXGG88X" />
    <meta charset="utf-8" />
    <title>EndoCapture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="http://localhost/endocapture/public/recorder/favicon.png" rel="shortcut icon">
    <script src="http://localhost/lumina/assets/js/layout.js"></script>
    <link href="http://localhost/lumina/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/public/recorder/small-scale.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://localhost/lumina/assets/css/sweetalert2.min.css">


</head>

<body id="body">
    <?php include("head.php"); ?>

<style>

</style>
    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>

    <!-- <?php include("capture.camera.obs.js_hotkey.blade.php"); ?> -->
<!-- @include('capture.camera.obs.js_hotkey') -->
<div class="row">
    <?php include("dashboard/05_fillter.php"); ?>
</div>
<div class="row m-0 fs-12" style="">
    <div class="col-lg-auto w-16">
        <div class="row ">
            <?php include("dashboard/01_totalcase.php"); ?>
        </div>
    </div>
    <div class="col-lg-9 p-0" >
        <div class="row mb-2">
        <?php include("dashboard/06_procedure.php"); ?>
        <?php include("dashboard/07_treatment.php"); ?>
        <?php include("dashboard/08_agegender.php"); ?>
        <?php include("dashboard/09_diagnosis.php"); ?>
        <?php include("dashboard/10_intervention.php"); ?>
        <?php include("dashboard/12_physician.php"); ?>
        </div>
    </div>
</div>
</body>
<footer>
    <?php include("footer.php"); ?>
</footer>
</html>



