<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text Torrent</title>

    <link rel="shortcut icon" href="{{ asset('assets/app/images/header/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/modal-video.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/daterangepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/app/sass/style.css') }}" />


</head>

<style>
    .spinner-border-sm {
        width: 13px;
        height: 13px;
        border-width: 1px;
    }

    .spinner-border-xs {
        width: 10px;
        height: 10px;
        border-width: 1px;
    }
</style>

<body>
    <!-- Scroll To Top -->
    <div class="scrolltop" id="scrollTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    {{-- @livewire('app.layouts.inc.header') --}}

    {{ $slot }}

    @livewire('app.layouts.inc.sidebar')
    {{-- @livewire('app.layouts.inc.footer') --}}

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/app/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery.rcounter.js') }}"></script>
    {{-- <script src="{{ asset('assets/app/plugins/js/jquery-modal-video.min.js') }}"></script> --}}
    <script src="{{ asset('assets/app/plugins/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/otpdesigner.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/index.global.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/app/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
