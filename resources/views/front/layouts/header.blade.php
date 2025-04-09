<header class="bg-dark text-white sticky-top shadow">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <!-- Logo dan Judul -->
            <div class="d-flex align-items-center">
                <a href="/" class="text-decoration-none text-muted">
                    <img src="https://storage.googleapis.com/a1aa/image/-HnYJoVd05OhVes1-Bh4IfjQifAVUsymcSu_tNBSn-U.jpg"
                        alt="Logo" width="50" height="50" class="me-3">
                </a>
                <h1 class="h4 mb-0">FactaBot</h1>
            </div>

            <div class="d-none d-md-flex align-items-center gap-3">
                <form action="/search" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control me-2" placeholder="Search news..."
                        required>
                    <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                </form>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @else
                    <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                @endauth

                <a class="btn btn-warning text-dark" href="/subscribes">Subscribe</a>
            </div>

            <!-- Tombol Menu Mobile -->
            <button class="btn text-white d-md-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobile-menu">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
    </div>

    <!-- Scrollable Country -->
    <div class="country-container bg-secondary text-white py-2">
        <div class="container position-relative">
            <!-- Tombol Navigasi Kiri -->
            <button class="scroll-btn left-country d-none d-md-flex">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Country -->
            <div class="country-scroll d-flex align-items-center gap-3" id="country-menu">
                <!-- Country dimasukkan lewat JavaScript -->
            </div>

            <!-- Tombol Navigasi Kanan -->
            <button class="scroll-btn right-country d-none d-md-flex">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Scrollable Category (Awalnya disembunyikan) -->
    <div class="category-container bg-dark text-white py-2" id="category-section" style="display: none">
        <div class="container position-relative">
            <button class="scroll-btn left-category d-none d-md-flex">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="category-scroll d-flex align-items-center gap-3" id="category-menu"></div>

            <button class="scroll-btn right-category d-none d-md-flex">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Breaking News Marquee -->
    @php
        $defaultCountry = session('default_country');
        $bgColor = match ($defaultCountry) {
            'Australia' => '#19b5ee',
            'Asia' => '#ef0810',
            'Europe' => '#fea500',
            'Africa' => '#ab2bb4',
            'America' => '#0eaec4',
            default => '#19b5ee', // default warna jika negara tidak terdefinisi
        };

    @endphp

    @isset($topnews)
    <div class="breaking-news-wrapper overflow-auto">
        <marquee id="breaking-news"
                 style="background-color: {{ $bgColor }};"
                 class="text-white py-2 fw-bold"
                 scrollamount="4">
            @foreach ($topnews as $tnews)
                <a href="{{ route('front.news.show', $tnews->slug) }}"
                   class="text-white text-decoration-none me-4 d-inline-block">
                    {{ $tnews->title }}
                </a>
            @endforeach
        </marquee>
    </div>
    @endisset


</header>

<!-- CSS -->
<style>
    /* Scrollable Country */
    .country-container {
        position: relative;
        overflow: hidden;
    }

    .country-scroll {
        display: flex;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        padding-bottom: 5px;
    }

    .country-scroll::-webkit-scrollbar {
        display: none;
    }

    .country-scroll a {
        flex: 0 0 auto;
        padding: 8px 12px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        text-decoration: none;
        color: white;
        white-space: nowrap;
    }

    .country-scroll a.active {
        background-color: rgba(109, 0, 0, 0.719);
        font-weight: bold;
    }

    .category-container {
        position: relative;
        overflow: hidden;
    }

    .category-scroll {
        display: flex;
        overflow-x: auto;

        /* Memastikan kategori bisa di-scroll */
        scrollbar-width: none;
        /* Memunculkan scrollbar */
        -ms-overflow-style: auto;
        scroll-behavior: smooth;
        white-space: nowrap;
        /* Mencegah kategori turun ke baris berikutnya */
        padding-bottom: 5px;
    }

    .category-scroll::-webkit-scrollbar {
        /* height: 5px; */
        display: none;
        /* Menampilkan scrollbar untuk Chrome */
    }

    /* .category-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.4);

        border-radius: 5px;
    } */

    /* Style untuk Kategori */
    .category-scroll a {
        flex: 0 0 auto;
        padding: 8px 12px;
        background-color: rgba(255, 255, 255, 0.2);
        /* Background tetap */
        border-radius: 5px;
        text-decoration: none;
        color: white;
        white-space: nowrap;
        transition: background 0.3s ease;
    }

    /* Kategori yang dipilih */
    .category-scroll a.active {
        background-color: rgba(241, 0, 0, 0.5);
        font-weight: bold;
    }

    /* .category-scroll a:hover {
        background-color: rgba(255, 255, 255, 0.4);
    } */

    /* Tombol Navigasi */
    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
        transition: 0.3s;
    }

    .left-category {
        left: 0;
    }

    .right-category {
        right: 0;
    }

    /* .category-scroll a { */
    /* display: flex;
        overflow-x: auto; */
    /* scrollbar-width: none; */
    /* -ms-overflow-style: none;
        scroll-behavior: smooth; */
    /* padding-bottom: 5px; */

    /* flex: 0 0 auto; */
    /* padding: 8px 12px; */
    /* background-color: rgba(255, 255, 255, 0.2); */
    /*  */
    /* border-radius: 5px; */
    /* text-decoration: none; */
    /* color: white; */
    /* white-space: nowrap; */
    /* transition: background 0.3s ease; */

    /* } */

    /* .category-scroll a:hover {
        background-color: rgba(255, 255, 255, 0.4);
    } */

    /* .category-scroll::-webkit-scrollbar {
        display: none;
    } */

    /* Tombol Navigasi */
    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
        transition: 0.3s;
    }

    .left-country {
        left: 0;
    }

    .right-country {
        right: 0;
    }

    .left-category {
        left: 0;
    }

    .right-category {
        right: 0;
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const countryApiUrl = "/api/getAllCountry";
        const categoryApiUrl = "/api/get-categories/"; // Menggunakan endpoint baru

        const countryMenu = document.getElementById("country-menu");
        const categoryMenu = document.getElementById("category-menu");
        const breakingNews = document.getElementById("breaking-news");
        const categorySection = document.getElementById("category-section");

        let selectedCountry = null;
        let selectedCategory = null;

        // Ambil country dan category dari URL
        const urlParts = window.location.pathname.split("/");
        if (urlParts.length >= 3 && urlParts[2] === "newscategory") {
            selectedCountry = urlParts[1]; // Ambil country dari URL
            selectedCategory = urlParts[3]; // Ambil category dari URL
        }

        // Fetch Countries
        fetch(countryApiUrl)
            .then(response => response.json())
            .then(data => {
                countryMenu.innerHTML = "";
                data.forEach(country => {
                    const countryName = country.country_name.toLowerCase();
                    const countryLink = document.createElement("a");
                    countryLink.href = `/${countryName}/newscategory/`;
                    countryLink.textContent = country.country_name;
                    countryLink.dataset.countryId = country.id;

                    // Jika country dari URL sama dengan country dari API, tandai sebagai aktif
                    if (selectedCountry && countryName === selectedCountry.toLowerCase()) {
                        document.querySelectorAll(".country-scroll a").forEach(a => a.classList
                            .remove("active"));
                        countryLink.classList.add("active");
                        loadCategories(countryName, country.id, selectedCategory);
                    }

                    countryLink.addEventListener("click", function(event) {
                        event.preventDefault();
                        const countryId = this.dataset.countryId;
                        selectedCountry = countryName;
                        document.querySelectorAll(".country-scroll a").forEach(a => a
                            .classList.remove("active"));
                        this.classList.add("active");
                        loadCategories(countryName, countryId, null);
                    });

                    countryMenu.appendChild(countryLink);
                });
            })
            .catch(error => console.error("Error fetching countries:", error));

        // Function untuk memuat kategori berdasarkan country_id
        function loadCategories(countryName, countryId, preselectedCategory) {
            fetch(categoryApiUrl + countryId)
                .then(response => response.json())
                .then(categories => {
                    categoryMenu.innerHTML = "";
                    let breakingNewsText = "No breaking news available.";

                    categories.forEach(category => {
                        const categoryLink = document.createElement("a");
                        categoryLink.href = `/${countryName}/newscategory/${category.name}`;
                        categoryLink.textContent = category.name;

                        // Jika kategori dari URL sama dengan kategori dari API, tandai sebagai aktif
                        // if (preselectedCategory && category.name.toLowerCase() ===
                        //     preselectedCategory.toLowerCase()) {
                        //     categoryLink.classList.add("active");
                        // }

                        if (preselectedCategory && category.name.toLowerCase() ===
                            preselectedCategory.toLowerCase()) {
                            document.querySelectorAll(".category-scroll a").forEach(a => a.classList
                                .remove("active"));
                            categoryLink.classList.add("active");
                        }

                        categoryMenu.appendChild(categoryLink);

                        if (category.name.toLowerCase() === "breaking news") {
                            breakingNewsText = category.description || "Breaking news update!";
                        }
                    });

                    breakingNews.innerHTML = breakingNewsText;
                    categorySection.style.display = "block"; // Pastikan kategori tetap ditampilkan
                })
                .catch(error => console.error("Error fetching categories:", error));
        }

        // Scroll Buttons
        document.querySelector(".left-country").addEventListener("click", () => countryMenu.scrollBy({
            left: -200,
            behavior: "smooth"
        }));
        document.querySelector(".right-country").addEventListener("click", () => countryMenu.scrollBy({
            left: 200,
            behavior: "smooth"
        }));
        document.querySelector(".left-category").addEventListener("click", () => categoryMenu.scrollBy({
            left: -200,
            behavior: "smooth"
        }));
        document.querySelector(".right-category").addEventListener("click", () => categoryMenu.scrollBy({
            left: 200,
            behavior: "smooth"
        }));
    });
</script>
