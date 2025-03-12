<header class="bg-dark text-white sticky-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center">
                <a class="text-decoration-none text-muted" href="/">
                    <img src="https://storage.googleapis.com/a1aa/image/-HnYJoVd05OhVes1-Bh4IfjQifAVUsymcSu_tNBSn-U.jpg"
                        alt="Logo of the news website" width="50" height="50" class="me-3"></a>
                <h1 class="h4 mb-0">FactaBot</h1>
            </div>

            <!-- Form Pencarian Berita -->
            <form action="/search" method="GET" class="d-none d-md-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Search news..." required>
                <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
            </form>


            <nav id="category-menu" class="d-none d-md-flex align-items-center"></nav>
            <div class="d-none d-md-flex align-items-center">
                <a class="text-white text-decoration-none me-3" href="login">Login</a>
                <a class="text-white text-decoration-none" href="#">Subscribe</a>
            </div>
            {{-- <button class="navbar-toggler d-md-none text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobile-menu">
                <i class="fas fa-bars"></i>
            </button> --}}
            <button class="btn text-white d-md-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobile-menu">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
    </div>
    {{-- <div class="collapse d-md-none bg-dark" id="mobile-menu">
        <nav id="mobile-category-menu" class="d-flex flex-column p-3"></nav>
        <hr>
        <a class="text-white text-decoration-none py-2" href="login">Login</a>
        <a class="text-white text-decoration-none py-2" href="#">Subscribe</a>
    </div> --}}


    <!-- Offcanvas Sidebar Menu untuk Mobile -->
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

            <nav id="mobile-category-menu" class="d-flex flex-column"></nav>
            <hr>
            <nav class="d-flex flex-column">

                <a class="text-white text-decoration-none py-2" href="login">Login</a>
                <a class="text-white text-decoration-none py-2" href="#">Subscribe</a>
            </nav>

        </div>
    </div>
</header>

<marquee id="breaking-news" behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque
    blanditiis iure voluptatibus similique odio culpa, iste numquam vitae possimus nam ipsam exercitationem dicta minima
    accusamus totam delectus perferendis! Tempore, necessitatibus.
</marquee>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiUrl = "/api/getFullCategory?country_name=indonesia";

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const categories = data.categories;
                const categoryMenu = document.getElementById("category-menu");
                const mobileCategoryMenu = document.getElementById("mobile-category-menu");
                const breakingNews = document.getElementById("breaking-news");

                categoryMenu.innerHTML = "";
                mobileCategoryMenu.innerHTML = "";
                let breakingNewsText = "No breaking news available.";

                categories.forEach(category => {
                    const categoryLink =
                        `<a class="text-white text-decoration-none me-3" href="/newscategory/${category.name}">${category.name}</a>`;
                    categoryMenu.innerHTML += categoryLink;
                    mobileCategoryMenu.innerHTML +=
                        `<a class="text-white text-decoration-none py-2" href="/newscategory/${category.name}">${category.name}</a>`;

                    // Jika kategori adalah "Breaking News", tambahkan ke marquee
                    if (category.name.toLowerCase() === "breaking news") {
                        breakingNewsText = category.description;
                    }
                });

                // Update marquee dengan berita terkini
                breakingNews.innerHTML = breakingNewsText;
            })
            .catch(error => {
                console.error("Error fetching categories:", error);
                document.getElementById("category-menu").innerHTML =
                    "<span class='text-warning'>Failed to load categories</span>";
                document.getElementById("breaking-news").innerHTML = "Error loading breaking news.";
            });
    });
</script>
