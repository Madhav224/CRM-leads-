
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/pages/authentication.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-menu="vertical-menu-modern" data-col="blank-page">
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="auth-wrapper auth-cover">
                <div class="auth-inner row m-0">

                    <!-- Brand Logo -->
                    <a class="brand-logo" href="/">
                        <h2 class="brand-text text-primary ms-1">YourBrand</h2>
                    </a>

                    <!-- Left Image -->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                            <img class="img-fluid" src="{{ asset('app-assets/images/pages/forgot-password-v2.svg') }}" alt="Forgot password" />
                        </div>
                    </div>

                    <!-- Forgot Password Form -->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
                            <div class="mb-2 text-sm text-muted">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Password Reset Form -->
                            <form method="POST" action="{{ route('password.email') }}" class="auth-forgot-password-form mt-2">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-1">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <x-primary-button class="btn btn-primary w-100 mt-1">
                                    {{ __('Send reset link') }}
                                </x-primary-button>
                            </form>

                            <!-- Back to Login Link -->
                            <p class="text-center mt-2">
                                <a href="{{ route('login') }}">
                                    <i data-feather="chevron-left"></i> {{ __('Back to login') }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Forgot Password Form -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/auth-forgot-password.js') }}"></script>

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    });
</script>
</body>
</html>

