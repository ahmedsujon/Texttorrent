<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text Torrent</title>

    <link rel="shortcut icon" href="{{ asset('assets/app/images/header/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/css/daterangepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" />

    <!-- Toast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />
    <link href="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

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


    .spinner-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        background: rgba(255, 255, 255, 0.7);
        height: 40%;
        width: 40%;
        border-radius: 50%;
        backdrop-filter: blur(3px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 1.2em;
        color: #000;
        outline: none;
    }

    .fa-spinner {
        font-size: 1em;
        color: #5a5a5a;
    }

    .active_list_btn {
        background-color: #E7EAEB;
    }
</style>

<body>
    <!-- Scroll To Top -->
    <div class="scrolltop" id="scrollTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    {{-- @livewire('app.layouts.inc.header') --}}

    {{ $slot }}

    @if (request()->is(
            'settings/my-account',
            'settings/change-password',
            'settings/sub-account',
            'settings/get-number',
            'settings/active-numbers',
            'settings/logs',
            'settings/apis',
            'settings/dlc-registration',
            'settings/trigger-notification'))
        @livewire('app.layouts.inc.settings-sidebar')
    @else
        @livewire('app.layouts.inc.sidebar')
    @endif

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/app/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/otpdesigner.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/index.global.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/js/jquery-searchbox.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>

    <!-- Toast -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>
    <script src="{{ asset('assets/admin/js/custom-toast.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/app/js/main.js') }}"></script>

    <script>
        window.addEventListener('success', event => {
            successMsg(event.detail[0].message);
        });
        window.addEventListener('warning', event => {
            warningMsg(event.detail[0].message);
        });
        window.addEventListener('error', event => {
            errorMsg(event.detail[0].message);
        });
        window.addEventListener('info', event => {
            infoMsg(event.detail.message);
        });
        @if (Session::has('success'))
            successMsg("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            errorMsg("{{ Session::get('error') }}");
        @endif
        @if (Session::has('info'))
            infoMsg("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            warningMsg("{{ Session::get('warning') }}");
        @endif

        //login
        @if (Session::has('login_success'))
            successMsg("{{ Session::get('login_success') }}");
            '<?php echo session()->forget('login_success'); ?>'
        @endif

        //Delete conf.
        window.addEventListener('show_delete_confirmation', event => {
            $('#deleteDataModal').modal('show');
        });
        window.addEventListener('action_btn_click_error', event => {
            $('.delete_btn').html('<i class="bx bx-trash font-size-13 align-middle"></i>');
            $('#deleteDataModal').modal('hide');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: 'Something went wrong! <br> Please try again.'
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
