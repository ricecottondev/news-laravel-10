@extends('back.layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                {{-- Header --}}
                <div class="app-toolbar py-3 py-lg-6">
                    <div class="container-xxl d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="fw-bold fs-3 text-dark">Import News</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"
                                            class="text-muted text-decoration-none">Master</a></li>
                                    <li class="breadcrumb-item text-muted">News</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="app-content flex-column-fluid">
                    <div class="container-xxl">
                        <div class="card">
                            <div class="card-body">
                                <h2>Import News from Excel</h2>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                {{-- Tombol untuk membuka modal --}}
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#selectCountryCategoryModal">
                                    Select Country & Category
                                </button>

                                <a href="{{ url('assets/template-excel/master_data_excel.xlsx') }}"
                                class="btn btn-info "></i>Template Excel</a>

                                <h2>How to Upload News Data via Excel</h2>
                                <ol>
                                    <li><strong>Select a Country:</strong>
                                        <br>Navigate to the news upload page in the admin panel. Click on the Button
                                        labeled <em>"Select Country & Category"</em> and choose the relevant country.
                                    </li>
                                    <li><strong>Select a Category:</strong>
                                        <br>After selecting the country, Choose the appropriate news category an than press button Confirm.
                                    </li>
                                    <li><strong>Upload Excel File:</strong>
                                        <br>Click on the <em>"Upload Excel"</em> button and select the Excel file (.xlsx or
                                        .csv) containing the news data. Ensure that your file includes the following
                                        columns:
                                        <ul>
                                            <li><strong>Title:</strong> News title</li>
                                            <li><strong>Content:</strong> News body</li>
                                            <li><strong>Author:</strong> Name of the writer</li>
                                            <li><strong>Publication Date:</strong> Date when the news was published</li>
                                            <li><strong>Status:</strong> <em>Publish</em> or <em>Draft</em></li>
                                        </ul>
                                    </li>
                                    <li><strong>Ensure News is Published on the Landing Page:</strong>
                                        <br>Only news articles with a <strong>"Published"</strong> status will appear on the
                                        landing page. If the status is <em>"Draft"</em>, it will not be visible to the
                                        public.
                                    </li>
                                    <li><strong>Complete News Images via Edit Page:</strong>
                                        <br>Once uploaded, go to the <em>news management</em> section, locate the news
                                        article, and click on <em>"Edit"</em>. Upload or update the news image in the
                                        designated <strong>image upload</strong> section, then save the changes.
                                    </li>
                                </ol>

                                {{-- Form Import Excel --}}
                                <form id="importForm" action="{{ route('news-master.import') }}" method="POST"
                                    enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="country_id" id="selected_country_id">
                                    <input type="hidden" name="category_id" id="selected_category_id">

                                    <div class="mb-3">
                                        <label class="form-label">Upload Excel File:</label>
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                    <a href="{{ route('news-master.index') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Pilih Country & Category --}}
    <div class="modal fade" id="selectCountryCategoryModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Country & Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <select id="country" class="form-control" required>
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select id="category" class="form-control" required>
                            <option value="">-- Select Category --</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSelection">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countrySelect = document.getElementById('country');
            let categorySelect = document.getElementById('category');
            let confirmButton = document.getElementById('confirmSelection');

            // Saat country berubah, ambil category dengan AJAX
            countrySelect.addEventListener('change', function() {
                let countryId = this.value;
                categorySelect.innerHTML = '<option value="">Loading...</option>'; // Tampilkan loading
                console.log(countryId);
                if (countryId) {
                    fetch(`/api/get-categories/${countryId}`)
                        .then(response => response.json())
                        .then(data => {
                            categorySelect.innerHTML =
                            '<option value="">-- Select Category --</option>'; // Reset pilihan
                            data.forEach(category => {
                                categorySelect.innerHTML +=
                                    `<option value="${category.id}">${category.name}</option>`;
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            categorySelect.innerHTML = '<option value="">Failed to load</option>';
                        });
                } else {
                    categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
                }
            });

            // Saat tombol confirm di modal ditekan
            confirmButton.addEventListener('click', function() {
                let selectedCountry = countrySelect.value;
                let selectedCategory = categorySelect.value;

                if (!selectedCountry || !selectedCategory) {
                    alert('Please select both Country and Category.');
                    return;
                }

                document.getElementById('selected_country_id').value = selectedCountry;
                document.getElementById('selected_category_id').value = selectedCategory;

                // Sembunyikan modal dan tampilkan form import
                let modal = bootstrap.Modal.getInstance(document.getElementById(
                    'selectCountryCategoryModal'));
                modal.hide();
                document.getElementById('importForm').style.display = 'block';
            });
        });
    </script>
@endsection

{{-- @section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log("ck 1");

        // Saat country berubah, ambil category dengan AJAX
        document.getElementById('country').addEventListener('change', function () {
            console.log("ck 2");
            let countryId = this.value;
            let categorySelect = document.getElementById('category');
            categorySelect.innerHTML = '<option value="">Loading...</option>';

            if (countryId) {
                fetch(`/get-categories/${countryId}`)
                    .then(response => response.json())
                    .then(data => {
                        categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
                        data.forEach(category => {
                            categorySelect.innerHTML += `<option value="${category.id}">${category.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
            }
        });

        // Saat tombol confirm di modal ditekan
        document.getElementById('confirmSelection').addEventListener('click', function () {
            let selectedCountry = document.getElementById('country').value;
            let selectedCategory = document.getElementById('category').value;

            if (!selectedCountry || !selectedCategory) {
                alert('Please select both Country and Category.');
                return;
            }

            document.getElementById('selected_country_id').value = selectedCountry;
            document.getElementById('selected_category_id').value = selectedCategory;

            // Sembunyikan modal dan tampilkan form import
            let modal = new bootstrap.Modal(document.getElementById('selectCountryCategoryModal'));
            modal.hide();
            document.getElementById('importForm').style.display = 'block';
        });
    });
</script>
@endsection --}}
