    <nav id="navdown" class="bg-dark">
    <hr class="opacity-50 m-0">
    <ul class="nav nav-justified pt-1">
        <li class="nav-item">
            <a class="nav-link text-reset" href="{{ route('home') }}">
                <i class="icon-Beranda_icon"></i>
                <br>Beranda
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-reset" href="{{ route('pesan.index') }}">
                <i class="icon-Pesan_icon"></i>
                <br>Pesan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-reset posistion-relative" href="https://tokosda.com/" style="padding:14px 12px 0px 12px">
                <div class="card bg-primary qr-button p-3">
                    <i class="icon-qr_icon"></i>
                </div>
                <br>Pindai QR

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-reset" href="{{ route('riwayat.index') }}">
                <i class="icon-Riwayat_icon"></i>
                <br>Riwayat
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-reset" href="{{  route('profil.index') }}">
                <i class="icon-Profil_icon"></i>
                <br>Profil
            </a>
        </li>
    </ul>
</nav>
