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
    <div class="category-container bg-dark text-white py-2" id="category-section" style="display: none;">
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
    <marquee id="breaking-news" class="bg-danger text-white py-2 fw-bold">
        Memuat berita terbaru...
    </marquee>
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

    .category-container {
        position: relative;
        overflow: hidden;
    }

    .category-scroll {
        display: flex;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        padding-bottom: 5px;
    }

    .category-scroll::-webkit-scrollbar {
        display: none;
    }

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
        // Fetch Countries
        fetch(countryApiUrl)
            .then(response => response.json())
            .then(data => {
                countryMenu.innerHTML = "";
                data.forEach(country => {
                    const countryLink = document.createElement("a");
                    countryLink.href = "#";
                    countryLink.textContent = country.country_name;
                    countryLink.dataset.countryName = country.country_name.toLowerCase();
                    countryLink.addEventListener("click", function(event) {
                        event.preventDefault();
                        loadCategories(country.country_name, country.id);
                    });
                    countryMenu.appendChild(countryLink);
                });
            })
            .catch(error => console.error("Error fetching countries:", error));
        // Fetch Categories
        // Function to fetch categories when country is clicked
        function loadCategories(countryName, countryId) {
            fetch(categoryApiUrl + countryId)
                .then(response => response.json())
                .then(categories => {
                    categoryMenu.innerHTML = "";
                    let breakingNewsText = "No breaking news available.";
                    console.log(countryId);
                    categories.forEach(category => {
                        const categoryLink =
                            `<a href="/${countryName}/newscategory/${category.name}">${category.name}</a>`;
                        categoryMenu.innerHTML += categoryLink;

                        if (category.name.toLowerCase() === "breaking news") {
                            breakingNewsText = category.description || "Breaking news update!";
                        }
                    });

                    breakingNews.innerHTML = breakingNewsText;
                    categorySection.style.display = "block"; // Munculkan category setelah klik country
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
