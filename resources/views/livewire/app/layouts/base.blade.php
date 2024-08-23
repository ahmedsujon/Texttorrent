<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text Torrent</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Styles Css -->


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

<body class="bg-white">

    @livewire('app.layouts.inc.header')

    <div class="container main_cont">
        {{ $slot }}
    </div>

    @livewire('app.layouts.inc.footer')

    <!-- JAVASCRIPT -->


    @stack('scripts')
</body>

</html>
