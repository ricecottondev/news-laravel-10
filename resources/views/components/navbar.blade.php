 <nav id="topbar" class="bg-body">
     <div class="container">
         <ul class="nav align-items-center justify-content-between py-2"
             style="margin-left: -.5rem; margin-right: -.5rem;">
             <li class="nav-item">
                <a class="nav-link text-reset position-relative p-0 d-flex" href="/">
                    <img src="{{ asset('sdamember-template/img/logo/sda-member-logo.png') }}" width="auto"
                        height="40" alt="">
                    <h1 class="position-absolute top-50 start-50 translate-middle text-nowrap fs-reset opacity-0">
                        SDA Member Poin</h1>
                </a>
            </li>
            <li class="nav-item d-none">
                <a class="nav-link text-reset" href="{{ route('profil.index') }}">
                    <i class="icon-akun"></i>
                </a>
            </li>
             <li class="nav-item d-flex align-items-center justify-content-end">
                 <a class="nav-link text-reset" data-bs-toggle="modal" href="#modalSearching">
                     <i class="icon-search"></i>
                 </a>
                 {{-- @if(isset($totalNotif))
                 <a class="nav-link text-reset position-relative" href="{{ route('notifikasi.index') }}">
                     <i class="icon-notifikasi"></i>
                     <span class="badge rounded-pill position-absolute translate-middle fw-medium"
                         style="top: 25%; left: 75%; font-size: .5em; background-color: red;">{{ $totalNotif }}</span>
                 </a>
                 @endif --}}
                 <a class="nav-link text-reset" href="/detail-voucher">
                    <i class="bi bi-question-circle"></i>

                </a>
             </li>
         </ul>
     </div>
     <hr class="opacity-50 m-0">
 </nav>
