@php
    $pagemark = '';
    if (isset($title))
        $pagemark = $title;
@endphp
<footer class="text-center small d-none d-lg-block">
    <div class="border-top border-secondary">
        <div class="container py-5 d-none">
            <nav id="footerMenu" style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase justify-content-center mb-5 gap-3">
                    @if (!empty($pagemark))
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Home' ? 'active' : '' }}" href="{{ url('') }}" id="footerHome">
                                home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Coffee Beans' ? 'active' : '' }}"
                                href="{{ url('fproducts?form=1') }}" id="footerBeans">
                                beans
                            </a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Ground Coffee' ? 'active' : '' }}" href="{{ url('fproducts?form=2')}}"
                                id="footerGround">
                                ground
                            </a>
                        </li> --}}
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Drip Coffee' ? 'active' : '' }}"
                                href="{{ url('fproducts?form=3') }}" id="footerDrip">
                                drip
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Coffee Capsules' ? 'active' : '' }}"
                                href="{{ url('fproducts?form=4') }}" id="footerCapsules">
                                capsules
                            </a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Bundles' ? 'active' : '' }}" href="{{ url('fproducts')}}"
                             id="footerBundles">
                                bundles
                            </a>
                        </li> --}}
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Membership' ? 'active' : '' }}" href="{{ url('membership') }}"
                                id="footerMember">
                                membership
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'Contact' ? 'active' : '' }}" href="{{ url('contact') }}"
                                id="footerContact">
                                contact
                            </a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a href="#" target="_blank" id="footerBrochure">
                                brochure
                            </a>
                        </li> --}}
                        <li class="breadcrumb-item">
                            <a class="{{ $pagemark === 'News & Reviews' ? 'active' : '' }}" href="{{ url('fnews') }}"
                                id="footerNews">
                                news
                            </a>
                        </li>
                    @endif
                </ol>
            </nav>

            <div class="sosmed">
                <a href="https://twitter.com/supressocoffee" target="_blank" class="text-decoration-none">
                    <i class="icon-twitter"></i>
                </a>
                <a href="https://www.facebook.com/supresso.sg" target="_blank" class="text-decoration-none">
                    <i class="icon-facebook"></i>
                </a>
                <a href="https://www.instagram.com/supresso.sg/" target="_blank" class="text-decoration-none">
                    <i class="icon-instagram"></i>
                </a>
                <a href="https://www.youtube.com/c/SupressoCoffee" target="_blank" class="text-decoration-none">
                    <i class="icon-youtube"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="border-top border-secondary">
        <div class="container py-4">
            <div class="row align-items-xl-center">

                <div
                    class="col-xl d-flex justify-content-center align-items-center mb-3 mb-xl-0 justify-content-xl-start">
                    {{-- <select class="form-select form-select-sm w-auto rounded-0 border-secondary me-3"
                        aria-label="Default select example">
                        <option selected>Language</option>
                        <option value="1">English</option>
                        <option value="2">Bahasa</option>
                        <option value="3">Java</option>
                    </select> --}}

                    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
                        <ol class="breadcrumb text-capitalize mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('policy') }}" target="_blank"
                                    class="{{ $pagemark === 'Privacy Policy' ? 'active' : '' }}">
                                    privacy policy
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('terms') }}" target="_blank"
                                    class="{{ $pagemark === 'Terms of use' ? 'active' : '' }}">
                                    terms & conditions
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('protection') }}" target="_blank"
                                    class="{{ $pagemark === 'Information on Data Protection' ? 'active' : '' }}">
                                    information on data protection
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-auto">Copyright &copy; {{ date('Y') }} Indraco. All Rights Reserved.</div>
            </div>
        </div>
    </div>
</footer>
