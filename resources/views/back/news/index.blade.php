@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                {{-- header-start --}}
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                News List</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Master</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">News</li>
                            </ul>
                        </div>
                        {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="{{ route('news-master.create') }}" class="btn btn-sm btn-primary"><i
                                    class="ki-duotone ki-plus "></i>Add News</a>
                        </div> --}}

                        <div class="d-flex align-items-center gap-2 gap-lg-3">

                            <a href="{{ route('news-master.bulk-form') }}" class="btn btn-sm btn-dark"><i
                                    class="ki-duotone ki-plus "></i>add bulk News</a>

                            <a href="{{ url('assets/template-excel/master_data_excel_v2.xlsx') }}"
                                class="btn btn-sm btn-info "></i>Template Excel</a>
                            <a href="{{ route('news-master.import.form') }}" class="btn btn-sm btn-primary"><i
                                    class="ki-duotone ki-plus "></i>Import News</a>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                                <i class="ki-duotone ki-plus"></i> Add News
                            </button>
                        </div>

                    </div>
                </div>
                {{-- header-end --}}

                {{-- body-start --}}
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Products-->
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1 d-none">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-ecommerce-order-filter="search"
                                            class="form-control form-control-solid w-250px ps-12"
                                            placeholder="Search Order" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Title</th>
                                            <th>Short Description</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $item)
                                            <tr>
                                                <td>
                                                    @if ($item->image)
                                                        <img src="{{ '/storage/' . $item->image }}" alt="News Image"
                                                            width="80" height="50" style="object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->title }}
                                                    @if ($item->is_breaking_news)
                                                        <span class="badge bg-danger">Breaking News</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->short_desc }}</td>
                                                <td>{{ $item->author }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="{{ route('news-master.edit', $item->id) }}"
                                                        class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="{{ route('news-master.destroy', $item->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2"
                                                            onclick="return confirm('Yakin ingin menghapus?');"><i
                                                                class="fas fa-trash-alt"></i< /button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Products-->
                    </div>
                </div>
                {{-- body-end --}}



                <!-- Modal Tambah Berita -->
                <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewsModalLabel">Add News</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="newsForm" enctype="multipart/form-data">

                                    @csrf
                                    <div class="mb-3">
                                        <label for="title" class="form-label">title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="short_desc" class="form-label">short_desc</label>
                                        <textarea class="form-control" id="short_desc" name="short_desc" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="author" class="form-label">author</label>
                                        <input type="text" class="form-control" id="author" name="author" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">content</label>
                                        <input type="text" class="form-control" id="content" name="content"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="draft">Draft</option>
                                            <option value="published">Published</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Picture</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    {{-- <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_breaking_news" name="is_breaking_news">
                        <label class="form-check-label" for="is_breaking_news">
                            Breaking News
                        </label>
                    </div> --}}
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal SaveDataCountriesCategoriesNews -->
                <div class="modal fade" id="saveDataModal" tabindex="-1" aria-labelledby="saveDataModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="saveDataModalLabel">Save Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <input type="hidden" id="newsId">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Select Country:</label>
                                        <select id="country" name="country" class="form-select">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category" class="form-label">Select Category:</label>
                                        <select id="category" name="category" class="form-select">
                                            <option value="">-- Select Category --</option>
                                        </select>
                                    </div>

                                    <button type="button" id="saveData" class="btn btn-primary">Save</button>
                                </form>

                                <hr>

                                <h3>Saved Data:</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Country</th>
                                                <th>Category</th>
                                                <th>News ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="savedDataTable">
                                            <!-- Data dari AJAX akan muncul di sini -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check the number of columns in thead
            const theadColumns = document.querySelectorAll("#kt_ecommerce_sales_table thead th").length;
            console.log("Column count in thead:", theadColumns);

            // Check the number of columns in each tbody row
            document.querySelectorAll("#kt_ecommerce_sales_table tbody tr").forEach((row, index) => {
                const tdCount = row.querySelectorAll("td").length;
                console.log(`Row ${index + 1} column count in tbody:`, tdCount);
                if (tdCount !== theadColumns) {
                    console.error(
                        `Mismatch found in Row ${index + 1}: Expected ${theadColumns}, found ${tdCount}`
                    );
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kt_ecommerce_sales_table').DataTable({
                "order": [
                    [0, "desc"]
                ] // Kolom pertama (ID) diurutkan secara DESC
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function loadCategories(countryId, selectedCategory = null) {
                $('#category').html('<option value="">-- Select Category --</option>');

                if (countryId) {
                    $.ajax({
                        url: '/api/getCategoriesCountry',
                        type: 'GET',
                        data: {
                            country_id: countryId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, category) {
                                let selected = (category.id == selectedCategory) ? 'selected' :
                                    '';
                                $('#category').append(
                                    `<option value="${category.id}" ${selected}>${category.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Error fetching categories');
                        }
                    });
                }
            }

            function loadSavedData(newsId) {
                $.ajax({
                    url: '/api/getSavedDataCountriesCategoriesNews/' + newsId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let rows = '';
                        $.each(data, function(key, item) {
                            rows += `<tr id="row-${item.id}">
                            <td>${item.country.country_name}</td>
                            <td>${item.category.name}</td>
                            <td>${item.news_id}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteData" data-id="${item.id}">Delete</button>
                            </td>
                        </tr>`;
                        });
                        $('#savedDataTable').html(rows);
                    },
                    error: function() {
                        alert('Error fetching saved data');
                    }
                });
            }

            $('#country').on('change', function() {
                let countryId = $(this).val();
                loadCategories(countryId);
            });

            // Save Data
            $('#saveData').on('click', function() {
                let countryId = $('#country').val();
                let categoryId = $('#category').val();
                let newsId = $('#newsId').val(); // Ambil dari input hidden modal

                if (!countryId || !categoryId) {
                    alert('Please select both Country and Category.');
                    return;
                }

                $.ajax({
                    url: '/api/SaveDataCountriesCategoriesNews',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        country_id: countryId,
                        category_id: categoryId,
                        news_id: newsId
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Data saved successfully!');
                        loadSavedData(newsId);
                    },
                    error: function() {
                        alert('Error saving data');
                    }
                });
            });

            $('#newsForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                // Pastikan is_breaking_news memiliki nilai default 0 jika tidak dicentang
                // if (!formData.has("is_breaking_news")) {
                //     formData.append("is_breaking_news", 0);
                // }

                $.ajax({
                    url: "/api/news",
                    type: "POST",
                    data: formData,
                    contentType: false, // Jangan set Content-Type secara manual
                    processData: false, // Jangan ubah FormData menjadi string query
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan token dikirim jika diperlukan
                    },
                    success: function(response) {
                        if (response.success) {
                            alert("Berita berhasil ditambahkan!");
                            $('#addNewsModal').modal('hide');
                            // location.reload(); // Reload halaman agar data terbaru muncul
                            // Simpan news ID untuk proses selanjutnya
                            let newsId = response.data.id;

                            // Tampilkan modal SaveDataCountriesCategoriesNews
                            $('#saveDataModal').modal('show');

                            // Set berita ID ke modal
                            $('#newsId').val(newsId);

                            // Load saved data
                            loadSavedData(newsId);
                        } else {
                            alert("Terjadi kesalahan: " + response.message);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = "Gagal menambahkan berita.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += "\n" + xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            });

            $('#saveDataModal').on('hidden.bs.modal', function() {
                location.reload(); // Reload halaman saat modal ditutup
            });

            $(document).ready(function() {
                $('.btn-close').on('click', function() {
                    location.reload();
                });
            });

            // DELETE FUNCTION
            $(document).on('click', '.deleteData', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/api/deleteDataCountriesCategoriesNews/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.message);
                            $('#row-' + id).remove();
                        },
                        error: function() {
                            alert('Error deleting data');
                        }
                    });
                }
            });

        });
    </script>
@endsection
