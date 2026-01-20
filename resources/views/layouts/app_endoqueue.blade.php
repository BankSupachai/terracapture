<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
        <link href="{{asset('public/plugins/responsive-table/css/rwd-table.min.css')}}"    rel="stylesheet" type="text/css" media="screen">
        <link href="{{asset('public/css/icons.css')}}"                                     rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/metismenu.min.css')}}"                             rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/style.css')}}"                                     rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/bootstrap.min.css')}}"                             rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/font-awesome.min.css')}}"                          rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/js/chart.js/js/css/adminlte.min.css')}}"               rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/ionicons.min.css')}}"                              rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/js/chart.js/js/fontawesome-free/css/all.min.css')}}"   rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">

        @yield('style')

        <style type="text/css">
            #sidebar-menu ul > li:hover > a {width: 70px;background: #197d6e}
            #sidebar-menu ul li a i{
               display: inline-block;
               font-size: 18px;
               line-height: 17px;
               margin: 0 0px 0 3px;
               text-align: center;
               vertical-align: middle;
               width: 20px;
            }
        </style>

        <script src="{{asset('public/js/modernizr.min.js')}}"></script>

    </head>

    <body>


        <div id="wrapper">
            <div class="topbar" >
                <div class="topbar" style= "background-color : #197d6e">
                    <a href="{{url("")}}" class="logo">
                        <i>
                            <img src="{{asset('public/images/endoqueue(bw).png')}}" alt="" width="200">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                               @if(!empty(uget("name")))
                                <img src="{{asset('public/images/users/avatar-1.jpg')}}" alt="user" class="rounded-circle"> <span class="ml-1">{{uget("name")}}<i class="mdi mdi-chevron-down"></i> </span>
                               @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-head"></i> <span>My Account</span>
                                </a>
                                <a  class="dropdown-item notify-item"
                                    href="{{ route('logout') }}"
								    onclick="   event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                >
								<i class="fi-power"></i>
									{{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
									@csrf
								</form>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect" id="openpage">

                                <img src="{{url("images/nav_icon.png")}}" width="30px">

                            </button>
                        </li>
                    </ul>

                </nav>

            </div>
            <div class="left side-menu" style="width: 70px;background: #58595b;" id="remove-scroll">
                <div class="slimscroll-menu" id="remove-scroll">

                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li style="height: 50px"><a href="{{url("note_index")}}"                  data-toggle="tooltip" title="EndoQueue">             <font color="#ffffff"><i class="dripicons-bookmark"></i></font></a></li>
                        @if(@uget("user_type")=="admin")
                            <li><a href="{{url("user")}}"                                  data-toggle="tooltip" title="User">             <font color="#ffffff"><i class="dripicons-user-group"></i></font></a></li>
                            <li><a href="{{url("admin/procedure")}}"                       data-toggle="tooltip" title="Procedure">        <font color="#ffffff"><i class="dripicons-toggles"></i></font></a></li>
                            <li><a href="{{url("admin/room")}}"                            data-toggle="tooltip" title="Room">             <font color="#ffffff"><i class="dripicons-view-thumb"></i></font></a></li>
                            <li><a href="{{url("admin/scope")}}"                           data-toggle="tooltip" title="Scope">            <font color="#ffffff"><i class="dripicons-camera"></i></font></a></li>
                            <li><a href="{{url("admin/hospitaledit/?hospital_id=1")}}"     data-toggle="tooltip" title="Hospital">         <font color="#ffffff"><i class="dripicons-folder-open"></i></font></a></li>
                        @endif
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="content-page" style="margin-left: 70px;">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container -->
                </div> <!-- content -->
                <footer class="footer text-right" style="left: 70px;">
                    © Medica Healthcare.
                </footer>
            </div>

        </div>
        <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/popper.min.js')}}"></script>
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/js/waves.js')}}"></script>
        <script src="{{asset('public/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('public/plugins/responsive-table/js/rwd-table.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/jquery.core.js')}}"></script>
        <script src="{{asset('public/js/jquery.app.js')}}"></script>
        <script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('public/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('public/plugins/fullcalendar/js/fullcalendar.min.js')}}"></script>
        <link href="{{asset('public/css/shards-dashboards.1.0.0.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('public/js/shards.min.js')}}"></script>

        <script>
            $(function() {
                $('.table-responsive').responsiveTable({
                    addDisplayAllBtn: 'btn btn-secondary'
                });
            });


            var wi = $(window).width();
            if(wi<500){
                $('#remove-scroll').hide();
            }else{
                $('.list-inline').hide();
            }

            $("#openpage").click(function(){
                $("#remove-scroll").toggle();
            });





        </script>


        @yield('endscript')
    </body>
</html>
