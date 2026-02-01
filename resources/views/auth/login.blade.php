<!DOCTYPE html>
<html class="loading">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>وزارت امور داخله | مدیریت دایاک</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-rtl.css') }}">
    <!-- END: Custom CSS-->
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

<body class="blank-page navbar-floating">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('moi.png') }}" width="150" alt="MOI LOGO">
                                </div>
                                <h2 class="brand-text text-primary text-center">د ډایاک عمومی مدیریت</h2>
                                <h4 class="card-title mb-1 text-center">سیستم ثبت جواز تفنګ های شکاری</h4>
                                <form class="auth-login-form" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="mb-1" for="login-email">ایمیل</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="mb-1" for="login-password">رمز عبور</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="4">داخل شدن به سیستم</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/auth-login.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        var timeout = ({{ config('session.lifetime') }} * 60000) - 1000;
        setTimeout(function() {
            window.location.reload(1);
        }, timeout);
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
