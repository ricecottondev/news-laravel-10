@include('layouts.sdamember.header')

<body class="text-center justify-content-evenly">

    @yield('content')

    @include('layouts.sdamember.footer')

    @stack('scripts')

</body>

</html>
