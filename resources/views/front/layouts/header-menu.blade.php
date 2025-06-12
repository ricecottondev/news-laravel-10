<div class="header-menu">
    <div class="menu-top bg-secondary">
        <div class="container-lg px-1 px-lg-3">
            <div class="row g-0 py-1 align-items-center column-gap-2 align-items-md-stretch">
                <div class="col">
                    <div class="overflow-x-auto position-relative">
                        <div class="d-flex flex-nowrap text-capitalize column-gap-1 text-nowrap country-scroll" id="country-menu">
                            <!-- Country menu items will be populated via JS -->
                        </div>
                    </div>
                </div><!-- end col -->
                <div class="col col-md-auto">
                    <div class="row g-0 h-100 column-gap-1 nav-combine">
                        <div class="col">
                            <a href="/history" class="btn btn-sm lh-sm w-100 h-100 d-flex align-items-center justify-content-center text-center btn-primary rounded-1 active">
                                Why We Had to Build This?
                            </a>
                        </div><!-- end col -->
                        <div class="col">
                            <a href="/about" class="btn btn-sm lh-sm w-100 h-100 d-flex align-items-center justify-content-center text-center btn-primary rounded-1 active">
                                The Anti-News Manifesto
                            </a>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div><!-- end menu top -->
    <div class="menu-bottom bg-black" id="category-section" style="display: none;">
        <div class="container-lg px-1 px-lg-3">
            <div class="overflow-x-auto position-relative">

                <div class="d-flex flex-nowrap text-capitalize column-gap-1 text-nowrap py-1 category-scroll" id="category-menu">
                    <!-- Category menu items will be populated via JS -->
                </div>

            </div>
        </div>
    </div><!-- end menu bottom -->
</div><!-- end header menu -->

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countryApiUrl = "/api/getAllCountry";
            const categoryApiUrl = "/api/get-categories/";

            const countryMenu = document.getElementById("country-menu");
            const categoryMenu = document.getElementById("category-menu");
            const categorySection = document.getElementById("category-section");

            let selectedCountry = null;
            let selectedCategory = null;

            const urlParts = window.location.pathname.split("/");

            if (urlParts.length >= 3 && urlParts[2] === "newscategory") {
                selectedCountry = urlParts[1];
                selectedCategory = urlParts[3];
            } else if (urlParts.length >= 2 && urlParts[2] !== "newscategory") {
                selectedCountry = urlParts[1];
            }

            if (!selectedCountry) selectedCountry = "australia";
            if (!selectedCategory) selectedCategory = "breaking news";

            fetch(countryApiUrl)
                .then(res => res.json())
                .then(data => {
                    countryMenu.innerHTML = "";

                    data.forEach(country => {
                        const countryName = country.country_name.toLowerCase();
                        const countryLink = document.createElement("a");
                        const countryImg = document.createElement("img");

                        countryLink.href = `/${countryName}/news`;
                        // countryLink.textContent = country.country_name;
                        // countryLink.className = "btn btn-sm border-0 fw-medium shadow-none text-white";
                        countryLink.className = "btn btn-sm border-0 shadow-none p-1";
                        // countryLink.style.width = "40px";
                        // countryLink.style.height = "40px";

                        countryImg.src = `/assets/template3/asset/country/${countryName}.png`;
                        countryImg.alt = country.country_name;
                        // countryImg.className = "img-fluid object-fit-cover w-100 h-100";
                        countryLink.dataset.countryId = country.id;

                        countryImg.src = `/assets/template3/asset/country/${countryName}.png`;
                        countryImg.alt = country.country_name;
                        // countryImg.className = "img-fluid object-fit-cover w-100 h-100";

                        if (selectedCountry && countryName === selectedCountry.toLowerCase()) {
                            countryLink.classList.remove("text-white");
                            countryLink.classList.add("active", "text-dark");
                            loadCategories(countryName, country.id, selectedCategory);
                        }

                        countryLink.appendChild(countryImg);

                        countryLink.addEventListener("click", function(event) {
                            event.preventDefault();
                            const countryId = this.dataset.countryId;
                            selectedCountry = countryName;

                            document.querySelectorAll(".country-scroll a").forEach(a => a
                                .classList.remove("active", "text-white"));
                            this.classList.add("active", "text-dark");

                            loadCategories(countryName, countryId, null)
                                .then(() => {
                                    setTimeout(() => {
                                        window.location.href =
                                            `/${countryName}/news`;
                                    }, 500);
                                });
                        });

                        countryMenu.appendChild(countryLink);
                    });
                })
                .catch(err => console.error("Error fetching countries:", err));

            function loadCategories(countryName, countryId, preselectedCategory) {
                return fetch(categoryApiUrl + countryId)
                    .then(response => response.json())
                    .then(categories => {
                        categoryMenu.innerHTML = "";
                        const preferredOrder = ['Breaking News', 'Politics', 'World', 'Business', 'Finance',
                            'Sports', 'Health', 'Opinions', 'Technology', 'Travel & Lifestyle',
                            'Entertainment'
                        ];
                        const miscCategories = [];

                        const sortedCategories = preferredOrder.map(name => {
                            return categories.find(cat => cat?.name?.toLowerCase() === name
                                .toLowerCase());
                        }).filter(cat => cat && cat.name);

                        categories.forEach(category => {
                            if (!category?.name) return;
                            if (!preferredOrder.some(name => name.toLowerCase() === category.name
                                    .toLowerCase())) {
                                miscCategories.push(category);
                            }
                        });

                        sortedCategories.forEach(category => {
                            const catName = category.name.toLowerCase().replace(/\s|&/g, '_');
                            const categoryLink = document.createElement("a");
                            const categoryImg = document.createElement("img");
                            categoryLink.href =
                                `/${countryName}/newscategory/${encodeURIComponent(category.name)}`;
                            // categoryLink.textContent = category.name;
                            // categoryLink.className = "btn btn-sm border-0 fw-medium shadow-none text-white";
                            categoryLink.className = "btn btn-sm border-0 shadow-none p-1";
                            // categoryLink.style.width = "50px";
                            // categoryLink.style.height = "40px";

                            categoryImg.src = `/assets/template3/asset/category/${catName}.png`;
                            categoryImg.alt = category.name;
                            // categoryImg.className = "img-fluid object-fit-cover w-100";

                            if (preselectedCategory && decodeURIComponent(preselectedCategory)
                                .toLowerCase() === category.name.toLowerCase()) {
                                document.querySelectorAll(".category-scroll a").forEach(a => a.classList
                                    .remove("active", "text-white"));
                                // categoryLink.classList.remove("text-white");
                                // categoryLink.classList.add("active", "text-dark");
                            }
                            categoryLink.appendChild(categoryImg);
                            categoryMenu.appendChild(categoryLink);
                        });

                        if (miscCategories.length > 0) {
                            const miscLink = document.createElement("a");
                            const miscImg = document.createElement("img");
                            miscLink.href = `/${countryName}/newscategory/MISC`;
                            // miscLink.textContent = "MISC";
                            // miscLink.className = "btn btn-sm border-0 shadow-none text-white";
                            miscLink.className = "btn btn-sm border-0 shadow-none p-1";
                            // miscLink.style.width = "50px";
                            // miscLink.style.height = "80px";

                            miscImg.src = `/assets/template3/asset/category/misc.png`;
                            miscImg.alt = 'misc';
                            // miscImg.className = "img-fluid object-fit-cover w-100";


                            if (preselectedCategory && preselectedCategory.toLowerCase() === 'misc') {
                                document.querySelectorAll(".category-scroll a").forEach(a => a.classList.remove(
                                    "active", "text-white"));
                                // miscLink.classList.add("active", "text-dark");
                            }
                            miscLink.appendChild(miscImg);
                            categoryMenu.appendChild(miscLink);
                        }

                        categorySection.style.display = "block";
                    })
                    .catch(err => console.error("Error loading categories:", err));
            }

            document.querySelector(".left-country")?.addEventListener("click", () => countryMenu.scrollBy({
                left: -200,
                behavior: "smooth"
            }));
            document.querySelector(".right-country")?.addEventListener("click", () => countryMenu.scrollBy({
                left: 200,
                behavior: "smooth"
            }));
            document.querySelector(".left-category")?.addEventListener("click", () => categoryMenu.scrollBy({
                left: -200,
                behavior: "smooth"
            }));
            document.querySelector(".right-category")?.addEventListener("click", () => categoryMenu.scrollBy({
                left: 200,
                behavior: "smooth"
            }));
        });
    </script>
@endpush
