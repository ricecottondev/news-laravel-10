  <!-- Navigation -->
  <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation">
    <div class="container">

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="{{url('/')}}">
            {{-- <img src="../ioniq/images/logo.svg" alt="alternative"> --}}
            <div style="color: orangered">SPMI</div>
            
        </a> 

        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text" href="index.html">Ioniq</a> -->

        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto navbar-nav-scroll">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Tentang Kami</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="{{url('sejarah')}}">Sejarah</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('visimisi')}}">Visi Dan Misi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('fungsitugas')}}">Fungsi Dan Tugas</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('modelmutu')}}">Model Penjaminan Mutu</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('strukturorganisasi')}}">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('berita')}}">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Dokumen Mutu</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="{{url('dokumenmutu')}}">Dokumen Mutu</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('dokumenspmi')}}">Dokumen SPMI</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Evaluasi SPMI</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="{{url('instrumenmutuinternal')}}">Instrumen Audit Mutu Internal</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('lemips')}}">Laporan Evaluasi Mutu Internal Program Studi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('lhpvm')}}">Laporan Hasil Pemahaman Visi Misi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('pkpj')}}">Penilaian Kepuasan Pengguna Jasa Terhadap Layanan UG</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('lhamips')}}">Laporan Hasil Audit Mutu Internal Program Studi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('lbenchmark')}}">Laporan terkait Benchmarking SPMI</a></li>
                        <li><div class="dropdown-divider"></div></li>
                       
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">POB</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Akreditasi</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="{{url('')}}">Akreditasi Program Studi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Instrumen BAN PT</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Hasil Akreditasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Instrumen Pengukuran</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Kepuasan Mahasiswa</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Pemahaman Visi Misi</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Survei Kepuasan Dosen & TenDik</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Dosen</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Alumni</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Perusahaan</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Pelatihan</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Kursus</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item" href="{{url('')}}">Kuisioner Workshop</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Serdos</a>
                </li>
               
               
            </ul>
            <span class="nav-item">
                <a class="btn-outline-sm" href="{{ url('login') }}">Log in</a>
            </span>
        </div> <!-- end of navbar-collapse -->
    </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->