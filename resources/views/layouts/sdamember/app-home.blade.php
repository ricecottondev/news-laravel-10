@include('layouts.sdamember.header')

<x-navbar />

@yield('content')

@include('layouts.sdamember.navdown')
@include('layouts.sdamember.footer')

@stack('scripts')

<x-search />
<script>
    $('#keyword').keypress(function(e) {
        if (e.which === 13) {
            var keywordValue = $(this).val();
            if (keywordValue && keywordValue.trim() !== '') {
                var fullText = "{{ route('search.index') }}" + '/' + keywordValue;
                window.location.href = fullText;
            } else {
                Swal.fire({
                    title: 'Opps',
                    text: 'Kata kunci tidak boleh kosong',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        }
    });
</script>

</html>
