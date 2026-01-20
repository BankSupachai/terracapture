<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
        <link href="{{asset('plugins/responsive-table/css/rwd-table.min.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/metismenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/bootstrap.min.css')}}" type="text/css">
        <script src="{{asset('js/modernizr.min.js')}}"></script>

         <style type="text/css">
            #sidebar-menu ul > li:hover > a {width: 70px;background: #0072b3}
            #sidebar-menu ul li a i
            {
               display: inline-block;
               font-size: 18px;
               line-height: 17px;
               margin: 0 0px 0 3px;
               text-align: center;
               vertical-align: middle;
               width: 20px;
            }
         </style>



    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left" style="background-color:lightblue">
                    <a href="{{url("")}}" class="logo">
                        <span>
                            <img src="{{asset('images/endologo2.png')}}" alt="" width="200">
                        </span>
                        <i>
                            <img src="{{asset('images/endologo2.png')}}" alt="" width="200">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">


                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect" id="openpage">
                            </button>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->






            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page" style="margin-left: 0px;">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container -->
                </div> <!-- content -->
                <footer class="footer text-right" style="left: 0px;">
                    © Medica Healthcare.
                </footer>
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"> </script>
        <script src="{{asset('js/bootstrap.min.js')}}"> </script>
        {{--<script src="{{asset('js/metisMenu.min.js')}}"></script>--}}
        <script src="{{asset('js/waves.js')}}"></script>
        <script src="{{asset('js/jquery.slimscroll.js')}}"></script>

        <!-- responsive-table-->
        <script src="{{asset('plugins/responsive-table/js/rwd-table.min.js')}}" type="text/javascript"></script>
        <!-- App js -->
        <script src="{{asset('js/jquery.core.js')}}"></script>
        <script src="{{asset('js/jquery.app.js')}}"></script>
        <!-- Jquery-Ui -->
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

        <!-- SCRIPTS -->
        <script src="{{asset('plugins/moment/moment.js')}}"></script>
        <script src="{{asset('plugins/fullcalendar/js/fullcalendar.min.js')}}"></script>
        <!--<script src="{{asset('pages/jquery.calendar.js')}}"></script>-->


        <link href="{{asset('css/shards-dashboards.1.0.0.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('js/shards.min.js')}}"></script>

        <script>
            $(function() {
                $('.table-responsive').responsiveTable({
                    addDisplayAllBtn: 'btn btn-secondary'
                });
            });
        </script>


        @yield('endscript')
    </body>
</html>
