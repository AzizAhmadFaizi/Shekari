<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <title>سیستم جواز فعالیت تفنگ های شکاری</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('moi.png') }}">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors-rtl.min.css') }}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/themes/dark-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/themes/bordered-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/themes/semi-dark-layout.css') }}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-rtl.css') }}">
        <!-- END: Custom CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/css-rtl/plugins/extensions/ext-component-sweet-alerts.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('app-assets/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bahij-nassim/stylesheet.css') }}">
        <style>
            * {
                font-family: 'B Nazanin' !important;
            }

            .icon {
                font-family: FontAwesome !important;
            }

            .fa,
            .far,
            .fas {
                font-family: "Font Awesome 5 Free" !important;
            }

            .select2-selection__choice__remove {
                margin-right: 5px !important;
            }
        </style>
    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click"
        data-menu="vertical-menu-modern" data-col="">

        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-shadow">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                    data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <h3 class="fw-bolder">@yield('header')</h3>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                            id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name fw-bolder">{{ auth()->user()->name }}</span><span
                                    class="user-status">{{ auth()->user()->role_details->name }}</span></div><span
                                class="avatar"><img class="round" src="{{ asset('user_default.jpg') }}" alt="avatar"
                                    height="40" width="40"><span class="avatar-status-online"></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="{{ route('user-profile') }}"><i class="me-50"
                                    data-feather="user"></i> پروفایل من</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"
                                class="dropdown-item text-danger">
                                <i class="power me-50 text-danger" data-feather="power"></i> خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END: Header-->

        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <span class="brand-logo">
                                <img src="{{ asset('moi.png') }}" alt="">
                            </span>
                        </a>
                    </li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0"
                            data-bs-toggle="collapse"><i
                                class="d-block d-xl-none text-primary toggle-icon font-medium-4"
                                data-feather="x"></i><i
                                class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                                data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"><a
                            class="d-flex align-items-center"
                            href="{{ Route::currentRouteName() != 'home' ? route('home') : 'javascript:void(0)' }}"><i
                                data-feather="home"></i><span class="menu-title text-truncate">صفحه اصلی</span></a>
                    </li>
                    @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 4)
                        <li
                            class="nav-item {{ Route::currentRouteName() == 'organizations' ? 'active' : '' }} @if (Route::currentRouteName() == 'organization-general-form') {{ Session::get('menu') == 'company' ? 'active' : '' }} @endif">
                            <a class="d-flex align-items-center"
                                href="{{ Route::currentRouteName() != 'organizations' ? route('organizations') : 'javascript:void(0)' }}"><i
                                    data-feather="monitor"></i><span class="menu-title text-truncate">شرکت
                                    ها</span></a>
                        </li>
                    @endif
                    @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 4)
                        <li
                            class="nav-item {{ Route::currentRouteName() == 'shops' ? 'active' : '' }} @if (Route::currentRouteName() == 'organization-general-form') {{ Session::get('menu') == 'shop' ? 'active' : '' }} @endif">
                            <a class="d-flex align-items-center"
                                href="{{ Route::currentRouteName() != 'shops' ? route('shops') : 'javascript:void(0)' }}"><i
                                    data-feather="lock"></i><span class="menu-title text-truncate">دوکان ها</span></a>
                        </li>
                    @endif
                    @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 4)
                        <li
                            class="nav-item {{ Route::currentRouteName() == 'report' ? 'active' : '' }} @if (Route::currentRouteName() == 'report') {{ Session::get('menu') == 'report' ? 'active' : '' }} @endif">
                            <a class="d-flex align-items-center"
                                href="{{ Route::currentRouteName() != 'report' ? route('report') : 'javascript:void(0)' }}"><i
                                    data-feather="check-circle"></i><span
                                    class="menu-title text-truncate">گذارشات</span></a>
                        </li>
                    @endif
                    {{-- @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 2)
                    <li class="nav-item {{ Route::currentRouteName() == 'show-weapon-to-print' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ Route::currentRouteName() != 'show-weapon-to-print' ? route('show-weapon-to-print') : 'javascript:void(0)' }}"><i class="fa fa-print"></i><span class="menu-title text-truncate">چاپ کارت ها</span></a>
                    </li>
                @endif --}}
                    {{-- @if (auth()->user()->role_id == 1) --}}
                    {{-- <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                    <a class="d-flex align-items-center"
                        href="{{ Route::currentRouteName() != 'register' ? route('register') : 'javascript:void(0)' }}"><i
                            data-feather="users"></i><span class="menu-title text-truncate">کاربران</span></a>
                </li> --}}
                    {{-- @endif --}}
                </ul>
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper p-0">
                <div class="content-body">
                    <!-- Basic Horizontal form layout section start -->
                    <section id="basic-horizontal-layouts">
                        <div class="card">
                            @yield('content')
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light">
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
        <!-- END: Footer-->

        <!-- BEGIN: Vendor JS-->
        <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>

        <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
        <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <!-- END: Page JS-->

        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            });

            function success_msg(msg) {
                Swal.fire({
                    title: 'موفقانه',
                    text: msg,
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }

            function error_msg(msg) {
                Swal.fire({
                    title: 'ببخشید',
                    text: msg,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }

            var timeout = ({{ config('session.lifetime') }} * 60000) - 1000;
            setTimeout(function() {
                window.location.reload(1);
            }, timeout);
        </script>
        @yield('scripts')
    </body>
    <!-- END: Body-->

</html>
