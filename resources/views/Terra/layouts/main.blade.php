<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Terralink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="{{url('public/assets5/js/layout.js')}}"></script>
    <link href="{{url('public/images/Medica Health Care logo white.png')}}" rel="shortcut icon">
    <link href="{{url('public/assets5/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/css/layout_home.css')}}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    @yield('style')
<style>
.hforicon
{
    height: 100%;
}
</style>
</head>

<body>

    <div class="modal right fade" id="edit_study" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit_study_head">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="row h-100">
                        <div class="col bg-terralink text-center pt-3">
                            <a href="javascript:;" class="w-100" data-bs-dismiss="modal" aria-label="Close">
                                <i class="mdi mdi-chevron-right text-white h3"></i>
                            </a>
                        </div>
                        <div class="col-11">
                            <div class="row pt-3">
                                <div class="col-4">
                                    <h1 class="text-terralinkModal m-0 text-nowrap">Edit Study</h1>
                                </div>
                                <div class="col-8 text-right btn-hide">
                                    <button class="btn btn-terralinkCF px-5 mr-3">
                                        Cancel
                                    </button>
                                    <button class="btn btn-terralink px-5">
                                        Save
                                    </button>
                                </div>
                                <div class="col-8 ml-5 tera-MoBileicon text-right">
                                    <button class="btn btn-terralink md-3">
                                     <i class="mdi mdi-chevron-left-box text-light h1 "></i>
                                     </button>
                                    <button class="btn btn-terralink">
                                     <i class="mdi mdi-content-save text-light h1 "></i>
                                  </button>
                                 </div>
                                <div class="col-12">
                                    <b class="text-terralinkModal">Patient Detail</b>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Patient ID<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="HN">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Prefix</label>
                                    <input type="text" name="" class="form-control" placeholder="Mr., Mrs.">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">First Name<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Middle Name</label>
                                    <input type="text" name="" class="form-control" placeholder="Middle">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Last Name<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="Last">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Sex<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="Important Meeting">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">DOB<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="DD/MM/YYYY">
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Age</label>
                                    <input type="text" name="" class="form-control" placeholder="20">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="" class="form-control" placeholder="0912345678">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">E-mail</label>
                                    <input type="text" name="" class="form-control" placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-6 p-0">
                                    <div class="row cn">
                                        <div class="col-12">Allergy history</div>
                                        <div class="col-auto">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="Checkboxes15"/>
                                                <span></span>
                                                &nbsp; No
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="Checkboxes15"/>
                                                <span></span>
                                                &nbsp; Yes
                                            </label>
                                        </div>
                                        <div class="col-7"><input type="text" name="" class="form-control" placeholder="Detail"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-0">
                                    <div class="row cn">
                                        <div class="col-12">Congenital disease</div>
                                        <div class="col-auto">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="Checkboxes15"/>
                                                <span></span>
                                                &nbsp; No
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="Checkboxes15"/>
                                                <span></span>
                                                &nbsp; Yes
                                            </label>
                                        </div>
                                        <div class="col-7"><input type="text" name="" class="form-control" placeholder="Detail"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><h1 class="text-terralink">Study Detail</h1></div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Study Date</label>
                                    <input type="text" name="" class="form-control" placeholder="Date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Time</label>
                                    <input type="text" name="" class="form-control" placeholder="09:00">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Modality (Multiple)</label>
                                    <input type="text" name="" class="form-control" placeholder="Modality">
                                </div>
                                <div class="col-lg">
                                    <label for="">Procedure (Multiple)</label>
                                    <input type="text" name="" class="form-control" placeholder="Procedure">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <label for="">Pre-Diagnosis</label>
                                    <input type="text" name="" class="form-control" placeholder="Pre-Diagnosis">
                                </div>
                                <div class="col-lg">
                                    <label for="">Note</label>
                                    <input type="text" name="" class="form-control" placeholder="10">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal right fade" id="export" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="row HeightForRes h-100">
                        <div class="col bg-terralink text-center pt-3">
                            <a href="javascript:;" class="w-100" data-bs-dismiss="modal" aria-label="Close">
                                <i class="mdi mdi-chevron-right text-white h3"></i>
                            </a>
                        </div>
                        <div class="col-11">
                            <div class="row pt-3">
                                <div class="col-md-4">
                                    <h1 class="text-terralinkModal m-0">Export</h1>
                                </div>
                                <div class="col-md-8 text-right btn-hide">
                                    <button class="btn btn-terralinkCF px-5 mr-3">
                                        Cancel
                                    </button>
                                    <button class="btn btn-terralink px-5">
                                        Export
                                    </button>
                                </div>
                                <div class="col-8 ml-5 tera-MoBileicon text-right">
                                    <button class="btn btn-terralink md-3">
                                     <i class="mdi mdi-chevron-left-box text-light h1 "></i>
                                     </button>
                                    <button class="btn btn-terralink">
                                     <i class="mdi mdi-tray-arrow-up text-light h1 "></i>
                                  </button>
                                 </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg">
                                    <label for="">File name<b class="text-danger">*</b></label>
                                    <input type="text" name="" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="row cn">
                                <div class="col-12 mb-2">File Format<b class="text-danger">*</b></div>
                                <div class="col-auto">
                                    <label class="checkbox checkbox-outline checkbox-success">
                                        <input type="checkbox" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; ZIP
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="checkbox checkbox-outline checkbox-success">
                                        <input type="checkbox" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; ISO
                                    </label>
                                </div>
                                <div class="col-12 mt-2"><input type="text" name="" class="form-control" placeholder="Volumn lable"></div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="row cn">
                                <div class="col-12 mb-2">Export Format<b class="text-danger">*</b></div>
                                <div class="col-auto">
                                    <label class="radio">
                                        <input type="radio" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; DICOMDIR
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="radio">
                                        <input type="radio" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; Folder
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="radio">
                                        <input type="radio" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; File
                                    </label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12 mb-2">Option</div>
                                <div class="col-auto">
                                    <label class="checkbox checkbox-outline checkbox-success">
                                        <input type="checkbox" name="Checkboxes15"/>
                                        <span></span>
                                        &nbsp; Attach DICOM Viewer
                                    </label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12"><hr></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal right fade" data-backdrop="static" id="note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body p-0">
                    <div class="row HeightForRes h-100">
                        <div class="col bg-terralink text-center pt-3"><a href="javascript:;" class="w-100" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-chevron-right text-white h3"></i></a></div>
                        <div class="col-11">
                            <div class="row pt-3">
                                <div class="col-md-4">
                                    <h1 class="text-terralinkModal m-0">
                                        Note
                                    </h1>
                                </div>
                                <div class="col-md-8 text-right btn-hide">
                                    <button class="btn btn-terralinkCF px-5 mr-3">Cancel</button>
                                    <button class="btn btn-terralink px-5">Save</button>
                                </div>
                                <div class="col-md-8 ml-5 tera-MoBileicon text-right">
                                    <button class="btn btn-terralink md-3">
                                     <i class="mdi mdi-chevron-left-box text-light h1 "></i>
                                     </button>
                                    <button class="btn btn-terralink">
                                     <i class="mdi mdi-content-save text-light h1 "></i>
                                  </button>
                                 </div>
                            </div>

                            <div class="row pt-3">
                                <div class="col-12">
                                    <textarea name="" id="" class="form-control" rows="10" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal right fade" id="share" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body p-0">
                    <div class="row HeightForRes h-100">
                        <div class="col bg-terralink text-center pt-3"><a href="javascript:;" class="w-100" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-chevron-right text-white h3"></i></a></div>
                        <div class="col-11">
                            <div class="row pt-3">
                                <div class="col-4">
                                    <h1 class="text-terralinkModal m-0">Share</h1>
                                </div>
                                <div class="col-8 text-right btn-hide">
                                    <button class="btn btn-terralinkCF px-5 mr-3">Cancel</button>
                                    <button class="btn btn-terralink px-5">Share</button>
                                </div>
                                <div class="col-md-8 ml-5 tera-MoBileicon text-right">
                                    <button class="btn btn-terralink md-3">
                                     <i class="mdi mdi-chevron-left-box text-light h1 "></i>
                                     </button>
                                    <button class="btn btn-terralink">
                                     <i class="mdi mdi-content-save text-light h1 "></i>
                                  </button>
                                 </div>
                            </div>
                            <div class="row">
                                <ul class="nav nav-terralink nav-pills" id="myTab2" role="tablist">
                                    <li class="nav-item shared mr-4">
                                        <a class="nav-link active " id="home-tab-2" data-toggle="tab" href="#home-2">
                                            <span class="nav-text">Share</span>
                                        </a>
                                    </li>
                                    <li class="nav-item shared">
                                        <a class="nav-link " id="profile-tab-2" data-toggle="tab" href="#profile-2" aria-controls="profile">
                                            <span class="nav-text">Shared</span>
                                        </a>
                                    </li>

                                </ul>
                                <div class="tab-content mt-5 w-100" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
                                        <div class="row pt-3">
                                            <div class="col-lg-12">
                                                <label for="">Share with<b class="text-danger">*</b></label>
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; Institution / Role / Account
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row pl-4">
                                                    <div class="col-lg pt-3">
                                                        <label for="">Institution</label>
                                                        <input type="text" name="" class="form-control">
                                                    </div>
                                                    <div class="col-lg pt-3">
                                                        <label for="">Role</label>
                                                        <input type="text" name="" class="form-control">
                                                    </div>
                                                    <div class="col-lg pt-3">
                                                        <label for="">Account</label>
                                                        <input type="text" name="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; Guest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12"><hr></div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-lg-12">
                                                <label for="">Study / Patient<b class="text-danger">*</b></label>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; Selected Study
                                                </label>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; Selected Patient’s Study
                                                </label>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row pl-4">
                                                    <div class="col-lg pt-3">
                                                        <div class="col-lg">
                                                            <label for="">Modality (multiple choose)</label>
                                                            <input type="text" name="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12"><hr></div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12 pb-3">
                                                <label for="">Expire at<b class="text-danger">*</b></label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; 7 Days
                                                </label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; 14 Days
                                                </label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="radio">
                                                    <input type="radio" name="Checkboxes15"/>
                                                    <span></span>
                                                    &nbsp; 30 Days
                                                </label>
                                            </div>
                                            <div class="col-12 pt-3"><input type="text" name="" class="form-control"></div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12"><hr></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Guest</td>
                                                    <td>MD.Suratchanut Chitrat</td>
                                                    <td>2022/07/02</td>
                                                    <td>3453464-64</td>
                                                    <td>สดายุ  ลอยลอย</td>
                                                    <td>2022/06/08 08:00</td>
                                                    <td>ES</td>
                                                </tr>
                                                <tr>
                                                    <td>MD.Suvicha</td>
                                                    <td>MD.Suratchanut Chitrat</td>
                                                    <td>2022/07/04</td>
                                                    <td>262434-55</td>
                                                    <td>สุรัชณัฏฐ์  จิตรัตน์</td>
                                                    <td>2022/06/01 09:30</td>
                                                    <td>US, ES</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <nav class="nav-terralink">
        <div class="sub"></div>
        <div class="main">
            <div class="row m-0 cn">
                <div class="col-2 this-border-l"><img alt="Midone - HTML Admin Template" class="logo__image" src="{{url("public/images/Group 230.png")}}"></div>
                <div class="col-8">
                    @yield('tab')

                </div>
                <div class="col-2 this-border-r">
                    <div class="row m-0 float-end">
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="text-light h5 dropdown-toggle m-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{uget("name")}}
                                </label>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a href="{{url('profile')}}" class="dropdown-item text-navterralink text-navterralink">
                                            <i class="mdi mdi-account-details-outline "></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('dashboard')}}" class="dropdown-item text-navterralink ">
                                            <i class="bx bx-layout "></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('statistic')}}" class="dropdown-item text-navterralink ">
                                            <i class="las la-poll "></i>
                                            Statistic
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('shared')}}" class="dropdown-item text-navterralink">
                                            <i class="mdi mdi-share-variant-outline "></i>
                                            Shared
                                        </a>
                                    </li>
                                    <li class="logout">
                                        <a href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ">
                                            <i class="mdi mdi-logout"></i>
                                            Logout
                                        </a>
                                        </li>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{@uid()}}">
                                    </form>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-auto text-light h3 m-0">{{uget("name")}}</div>
                        <div class="col-auto pt-1">
                            <div class="dropdown">
                                <a href="javascript:;" class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list text-light"></i>
                                </a>
                                <div class="dropdown-menu bg-terralink" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item text-navterralink bg-terralink" href="{{url('profile')}}"><i class="far fa-user-circle text-light mr-2"></i> Profile</a>
                                    <a class="dropdown-item text-navterralink" href="{{url('dashboard')}}"><i class="fas fa-chart-pie text-light mr-2"></i>Dashboard</a>
                                    <a class="dropdown-item text-navterralink" href="{{url('statistic')}}"><i class="fas fa-sliders-h text-light mr-2"></i>Statistic</a>
                                    <a class="dropdown-item text-navterralink" href="{{url('shared')}}"><i class="fas fa-share-alt text-light mr-2"></i>Shared</a>
                                    <a class="dropdown-item text-navterralink border-top pt-3"  href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt text-light mr-2"></i>Logout</a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{@uid()}}">
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('modal')
    @yield('tab')
    <div class="content">
        @yield('menu-header')
    </div>
    @yield('content')
    <script src="{{url('public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('public/assets5/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{url('public/assets5/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{url('public/assets5/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{url('public/assets5/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    {{-- <script src="{{url('public/assets5/js/plugins.js')}}"></script> --}}
    @include('layouts.plugins')
    <script src="{{url('public/new/assets/libs/sortablejs/Sortable.min.js')}}"></script>
    <script src="{{url('public/new/assets/js/pages/nestable.init.js')}}"></script>
    <script src="{{url('public/js/jquery.min.js')}}"></script>

    @yield('script')
</body>

</html>
