@include('layouts.sdamember.header')

<x-navbar />

@yield('content')

@include('layouts.sdamember.navdown')
@include('layouts.sdamember.footer')

@stack('scripts')

<x-search />
<script>

</script>

</html>
