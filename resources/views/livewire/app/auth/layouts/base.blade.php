<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>TextTorrent - Login</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/images/header/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/modal-video.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/sass/style.css') }}" />
</head>

<body>
    {{ $slot }}

    <!-- JS Here -->
    <script src="{{ asset('assets/app/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery.rcounter.js') }}"></script>
    {{-- <script src="{{ asset('assets/app/plugins/js/jquery-modal-video.min.js') }}"></script> --}}
    <script src="{{ asset('assets/app/plugins/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/otpdesigner.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery-searchbox.js') }}"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/app/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
