<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SDA Global &bull; @yield('title')</title>
    <!-- head links -->
    <link rel="icon" href="{{ asset('sdamember-template/img/logogram.ico') }}">
    <link rel="stylesheet"
        href="{{ asset('sdamember-template/assets/bootstrap-5.3.0-dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('sdamember-template/assets/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/fonts/HelveticaNeue/HelveticaNeue.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/css/navtop_belanja.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/css/sidebar_belanja.css') }}">
    <link rel="stylesheet" href="{{ asset('sdamember-template/css/navdown.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            /* outline: solid 1px green; */
            outline: solid 1px transparent;
        }

        .text-justify {
            text-align: justify
        }
    </style>
</head>
