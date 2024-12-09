<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Text Torrent : Your Perfect Communication Partner</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/app/images/header/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/aos/aos.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/modal-video.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/app/sass/landing-page/marketing-landing.css') }}" />
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/46885071.js"></script> <!-- End of HubSpot Embed Code -->
</head>

<style>
    .spinner-border-sm {
        width: 13px;
        height: 13px;
        border-width: 1px;
        margin-right: 5px;
        margin-top: -5px;
    }

    .spinner-border-xs {
        width: 10px;
        height: 10px;
        border-width: 1px;
    }
</style>

<body>
    @livewire('web.layouts.inc.header')

    <div class="overlay" id="mobileMenuOverlayArea"></div>

    {{ $slot }}

    @livewire('web.layouts.inc.footer')

    <!-- JS Here -->
    <script src="{{ asset('assets/app/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/swiper-bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/app/plugins/js/jquery-modal-video.min.js') }}"></script> --}}
    <script src="{{ asset('assets/app/plugins/js/aos.js') }}"></script>
    <script src="https://kit.fontawesome.com/64f2c0e60c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/app/js/landing.js') }}"></script>

    <script>
        var swiper = new Swiper(".testimonial_slider_area .swiper", {
            speed: 1150,
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 10,
            freeMode: true,
            // Responsive breakpoints
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 30,
                },
            },
            pagination: {
                el: ".testimonial_slider_area .swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
        });
    </script>
    @stack('scripts')
</body>

</html>
