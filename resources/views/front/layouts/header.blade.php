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
                    <input type="text" name="q" class="form-control me-2" placeholder="Search news..." required>
                    <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                </form>
                <a class="btn btn-outline-light" href="login">Login</a>
                <a class="btn btn-warning text-dark" href="subscribes">Subscribe</a>
            </div>

            <!-- Tombol Menu Mobile -->
            <button class="btn text-white d-md-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobile-menu">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
    </div>

    <!-- Kategori dengan Scroll Horizontal -->
    <div class="category-container bg-dark text-white py-2">
        <div class="container position-relative">
            <!-- Tombol Navigasi Kiri -->
            <button class="scroll-btn left d-none d-md-flex">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Kategori -->
            <div class="category-scroll d-flex align-items-center gap-3" id="category-menu">
                <!-- Kategori dimasukkan lewat JavaScript -->
            </div>

            <!-- Tombol Navigasi Kanan -->
            <button class="scroll-btn right d-none d-md-flex">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Breaking News Marquee -->
    <marquee id="breaking-news" class="bg-danger text-white py-2 fw-bold">
        Memuat berita terbaru...
    </marquee>

    <!-- Kategori di Mobile (Scrollable List) -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobile-menu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Form Pencarian Berita untuk Mobile -->
            <form action="/search" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search news..." required>
                    <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Daftar Kategori di Mobile -->
            <div class="overflow-auto" style="max-height: 300px;">
                <nav id="mobile-category-menu" class="d-flex flex-column"></nav>
            </div>

            <hr>
            <nav class="d-flex flex-column">
                <a class="text-white text-decoration-none py-2" href="login">Login</a>
                <a class="text-white text-decoration-none py-2" href="subscribes">Subscribe</a>
            </nav>
        </div>
    </div>
</header>

<!-- CSS -->
<style>
    /* Kategori dengan Scroll */
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

    .category-scroll a {
        flex: 0 0 auto;
        padding: 8px 12px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        text-decoration: none;
        color: white;
        white-space: nowrap;
    }

    .category-scroll a:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    /* Tombol Navigasi Kategori */
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

    .scroll-btn.left {
        left: 0;
    }

    .scroll-btn.right {
        right: 0;
    }

    .scroll-btn:hover {
        background: rgba(0, 0, 0, 0.8);
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiUrl = "/api/getFullCategory?country_name=indonesia";
        const categoryMenu = document.getElementById("category-menu");
        const mobileCategoryMenu = document.getElementById("mobile-category-menu");
        const breakingNews = document.getElementById("breaking-news");

        // Tombol navigasi kategori
        const scrollLeftBtn = document.querySelector(".scroll-btn.left");
        const scrollRightBtn = document.querySelector(".scroll-btn.right");

        // Fetch kategori dari API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const categories = data.categories;
                categoryMenu.innerHTML = "";
                mobileCategoryMenu.innerHTML = "";
                let breakingNewsText = "No breaking news available.";

                categories.forEach(category => {
                    const categoryLink =
                        `<a href="/newscategory/${category.name}">${category.name}</a>`;
                    categoryMenu.innerHTML += categoryLink;
                    mobileCategoryMenu.innerHTML +=
                        `<a class="text-white text-decoration-none py-2" href="/newscategory/${category.name}">${category.name}</a>`;

                    if (category.name.toLowerCase() === "breaking news") {
                        breakingNewsText = category.description;
                    }
                });

                breakingNews.innerHTML = breakingNewsText;
            })
            .catch(error => {
                console.error("Error fetching categories:", error);
                breakingNews.innerHTML = "Error loading breaking news.";
            });

        // Event scroll horizontal dengan tombol
        scrollLeftBtn.addEventListener("click", () => {
            categoryMenu.scrollBy({
                left: -200,
                behavior: "smooth"
            });
        });

        scrollRightBtn.addEventListener("click", () => {
            categoryMenu.scrollBy({
                left: 200,
                behavior: "smooth"
            });
        });

        // Event scroll dengan mouse wheel (horizontal scroll)
        categoryMenu.addEventListener("wheel", (event) => {
            event.preventDefault();
            categoryMenu.scrollBy({
                left: event.deltaY * 2,
                behavior: "smooth"
            });
        });
    });
</script>
