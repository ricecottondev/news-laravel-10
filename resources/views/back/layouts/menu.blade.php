<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="{{ route('dashboard') }}" class="navbar-brand d-none d-lg-flex">
                    <img src="{{ asset('assets/logo/logo-sda-global-24.svg') }}" alt="Logo" height="30">
                </a>

                <!-- Logo-mini for small screen devices (mobile/tablet) -->
                {{-- <div class="logo-mini-wrapper">
                    <img src="../assets/images/logo-mini-light.png" class="logo-mini logo-mini-light" alt="logo">
                    <img src="../assets/images/logo-mini-dark.png" class="logo-mini logo-mini-dark" alt="logo">
                </div> --}}

                {{-- <form class="search-form">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i data-feather="search"></i>
                        </div>
                        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                    </div>
                </form> --}}

                <ul class="navbar-nav">
                    <li class="theme-switcher-wrapper nav-item">
                        <input type="checkbox" value="" id="theme-switcher">
                        <label for="theme-switcher">
                            <div class="box">
                                <div class="ball"></div>
                                <div class="icons">
                                     {{-- <i data-feather="icon-sun"></i> --}}
                                     <i class='bx bxs-sun'></i>
                                     <i class='bx bxs-moon' ></i>
                                     {{-- <i data-feather="icon-moon"></i> --}}
                                </div>
                            </div>
                        </label>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../assets/images/flags/us.svg" class="w-20px" title="us" alt="flag">
                            <span class="ms-2 d-none d-md-inline-block">English</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                            <a href="javascript:;" class="dropdown-item py-2 d-flex"><img
                                    src="../assets/images/flags/us.svg" class="w-20px" title="us" alt="us">
                                <span class="ms-2"> English </span></a>
                            <a href="javascript:;" class="dropdown-item py-2 d-flex"><img
                                    src="../assets/images/flags/fr.svg" class="w-20px" title="fr" alt="fr">
                                <span class="ms-2"> French </span></a>
                            <a href="javascript:;" class="dropdown-item py-2 d-flex"><img
                                    src="../assets/images/flags/de.svg" class="w-20px" title="de" alt="de">
                                <span class="ms-2"> German </span></a>
                            <a href="javascript:;" class="dropdown-item py-2 d-flex"><img
                                    src="../assets/images/flags/pt.svg" class="w-20px" title="pt" alt="pt">
                                <span class="ms-2"> Portuguese </span></a>
                            <a href="javascript:;" class="dropdown-item py-2 d-flex"><img
                                    src="../assets/images/flags/es.svg" class="w-20px" title="es" alt="es">
                                <span class="ms-2"> Spanish </span></a>
                        </div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="grid"></i>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p class="mb-0 fw-bold">Web Apps</p>
                                <a href="javascript:;" class="text-secondary">Edit</a>
                            </div>
                            <div class="row g-0 p-1">
                                <div class="col-3 text-center">
                                    <a href="pages/apps/chat.html"
                                        class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i
                                            data-feather="message-square" class="icon-lg mb-1"></i>
                                        <p class="fs-12px">Chat</p>
                                    </a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="pages/apps/calendar.html"
                                        class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i
                                            data-feather="calendar" class="icon-lg mb-1"></i>
                                        <p class="fs-12px">Calendar</p>
                                    </a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href=""
                                        class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i
                                            data-feather="mail" class="icon-lg mb-1"></i>
                                        <p class="fs-12px">Email</p>
                                    </a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="pages/general/profile.html"
                                        class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i
                                            data-feather="instagram" class="icon-lg mb-1"></i>
                                        <p class="fs-12px">Profile</p>
                                    </a>
                                </div>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="mail"></i>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>9 New Messages</p>
                                <a href="javascript:;" class="text-secondary">Clear all</a>
                            </div>
                            <div class="p-1">
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face2.jpg" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Leonardo Payne</p>
                                            <p class="fs-12px text-secondary">Project status</p>
                                        </div>
                                        <p class="fs-12px text-secondary">2 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face3.jpg" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Carl Henson</p>
                                            <p class="fs-12px text-secondary">Client meeting</p>
                                        </div>
                                        <p class="fs-12px text-secondary">30 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face4.jpg" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Jensen Combs</p>
                                            <p class="fs-12px text-secondary">Project updates</p>
                                        </div>
                                        <p class="fs-12px text-secondary">1 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face5.jpg" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Amiah Burton</p>
                                            <p class="fs-12px text-secondary">Project deatline</p>
                                        </div>
                                        <p class="fs-12px text-secondary">2 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face6.jpg" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Yaretzi Mayo</p>
                                            <p class="fs-12px text-secondary">New record</p>
                                        </div>
                                        <p class="fs-12px text-secondary">5 hrs ago</p>
                                    </div>
                                </a>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            <div class="indicator">
                                <div class="circle"></div>
                            </div>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>6 New Notifications</p>
                                <a href="javascript:;" class="text-secondary">Clear all</a>
                            </div>
                            <div class="p-1">
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="gift"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>New Order Recieved</p>
                                        <p class="fs-12px text-secondary">30 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Server Limit Reached!</p>
                                        <p class="fs-12px text-secondary">1 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <img class="w-30px h-30px rounded-circle"
                                            src="../assets/images/faces/face6.jpg" alt="userr">
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>New customer registered</p>
                                        <p class="fs-12px text-secondary">2 sec ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="layers"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Apps are ready for update</p>
                                        <p class="fs-12px text-secondary">5 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="download"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Download completed</p>
                                        <p class="fs-12px text-secondary">6 hrs ago</p>
                                    </div>
                                </a>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="w-30px h-30px ms-1 rounded-circle" src="./assets/faces/face1.webp"
                                alt="profile">
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                <div class="mb-3">
                                    <img class="w-80px h-80px rounded-circle" src="./assets/faces/face1.webp"
                                        alt="">
                                </div>
                                <div class="text-center">
                                    <p class="fs-16px fw-bolder">Amiah Burton</p>
                                    <p class="fs-12px text-secondary">amiahburton@gmail.com</p>
                                </div>
                            </div>
                            <ul class="list-unstyled p-1">
                                <li class="dropdown-item py-2">
                                    <a href="pages/general/profile.html" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="javascript:;" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="edit"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="javascript:;" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="repeat"></i>
                                        <span>Switch User</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="javascript:;" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="log-out"></i>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <!-- navbar toggler for small devices -->
                <div data-toggle="horizontal-menu-toggle"
                    class="navbar-toggler navbar-toggler-right d-lg-none align-self-center">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="menu-title">User Management</span>
                        {{-- <i class="link-arrow"></i> --}}
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="category-heading">Setting User</li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/back/users') }}">User</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="">Roles</a></li> --}}
                            {{-- <li class="nav-item"><a class="nav-link" href="">Permission</a></li> --}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="pie-chart"></i>
                        <span class="menu-title">Data</span>
                        {{-- <i class="link-arrow"></i> --}}
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            {{-- <li class="nav-item"><a class="nav-link" href="pages/forms/basic-elements.html">Pricelist</a></li> --}}
                            {{-- <li class="nav-item"><a class="nav-link" --}}
                                    {{-- href="pages/forms/advanced-elements.html">Quotation</a></li> --}}
                            {{-- <li class="nav-item"><a class="nav-link" href="pages/forms/editors.html">Proforma Invoice</a></li> --}}
                            {{-- <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Tax Invoice</a></li> --}}
                            <li class="nav-item"><a class="nav-link" href="{{ url('/back/country') }}">Country</a></li>
                            <li class="nav-item"><a class="menu-link" href="{{ url('/back/categories') }}">Categories</a></li>
                            <li class="menu-item"><a class="menu-link" href="{{ url('back/news-master') }}">News</a></li>

                            <li class="menu-item"><a class="menu-link" href="{{ url('back/news-visits') }}">News Visits
                                        <span class="badge bg-danger text-white ms-2">New
                                </a>

                            </li>


                            <li class="menu-item">

                                <a class="menu-link" href="{{ url('/back/subscribe') }}">

                                    <span class="menu-title">Subscribe</span>
                                </a>
                                <!--end:Menu link-->
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item d-none">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="inbox"></i>
                        <span class="menu-title">Forms</span>
                        {{-- <i class="link-arrow"></i> --}}
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="">Pricelist</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="pages/forms/advanced-elements.html">Quotation</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/forms/editors.html">Proforma Invoice</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Tax Invoice</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="hard-drive"></i>
                        <span class="menu-title">Report</span>
                        {{-- <i class="link-arrow"></i> --}}
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="pages/icons/feather-icons.html">Brand
                                    </a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/icons/flag-icons.html">Product
                                    </a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/icons/mdi-icons.html">Customer</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
