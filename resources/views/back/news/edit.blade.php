@extends('back.layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                {{-- Header --}}
                <div class="app-toolbar py-3 py-lg-6">
                    <div class="container-xxl d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="fw-bold fs-3 text-dark">Edit News</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"
                                            class="text-muted text-decoration-none">Master</a></li>
                                    <li class="breadcrumb-item text-muted">News</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                                            <i class="ki-duotone ki-plus"></i> Edit News
                                                        </button> -->
                    </div>
                </div>

                {{-- Content --}}
                <div class="app-content flex-column-fluid">
                    <div class="container-xxl">
                        <div class="card mb-3">
                            <a href="{{ route('news-master.index') }}"
                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default"><i
                                    class="fas fa-backward"></i>Back</a>
                        </div>
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('news-master.update', $news->id) }}" enctype="multipart/form-data"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $news->title }}" required>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select" name="category_id" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $news->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="short_desc" class="form-label">Short Desc</label>
                                        <input type="text" class="form-control" id="short_desc" name="short_desc"
                                            value="{{ $news->short_desc }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="is_breaking_news" id="is_breaking_news"
                                            class="form-check-input" value="1"
                                            {{ old('is_breaking_news', $news->is_breaking_news ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_breaking_news">Set as Breaking News</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author"
                                            value="{{ $news->author }}" required>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ $news->slug }}" required>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>
                                                Published</option>
                                            <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft
                                            </option>
                                        </select>
                                    </div>




                                    <div class="mb-3">
                                        <label for="image" class="form-label"><strong>Picture</strong> </label>
                                    </div>
                                    @if ($news->image)
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Old Image</label>
                                        </div>

                                        <div>
                                            <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image"
                                                class="img-thumbnail mt-2" width="345px">
                                        </div>
                                    @endif

                                    <div class="mb-3 mt-3">
                                        <div>
                                            <label for="image" class="form-label">New Image</label>
                                            <p>Paste your image here (Ctrl+V)</p>
                                        </div>
                                        {{-- <input type="file" class="form-control" id="image" name="image"> --}}
                                        <div id="paste-area" class="img-thumbnail p-3 mt-2" contenteditable="true"
                                            style="height: 350px; width: 350px; overflow: auto;">

                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <img id="preview" src="" class="mt-3" style="max-width: 100%;">
                                    </div>

                                    <div class="mb-3">
                                        <input type="hidden" id="image-path" name="image">

                                    </div>




                                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                                </form>



                                <form>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Select Country:</label>
                                        <select id="country" name="country" class="form-select"
                                            data-default="{{ $defaultCountry }}">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $country->id == $defaultCountry ? 'selected' : '' }}>
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category" class="form-label">Select Category:</label>
                                        <select id="category" name="category" class="form-select"
                                            data-default="{{ $defaultCategory }}">
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
        document.getElementById('paste-area').addEventListener('paste', function(event) {
            const items = (event.clipboardData || window.clipboardData).items;
            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                if (item.kind === 'file' && item.type.indexOf('image') !== -1) {
                    const file = item.getAsFile();
                    // alert('ck1');
                    uploadImageFile(file);
                } else if (item.kind === 'string' && item.type === 'text/html') {
                    // alert('ck2');
                    item.getAsString(function(html) {
                        const imgTag = html.match(/<img src="([^"]+)"/);
                        if (imgTag && imgTag[1].startsWith('data:image')) {
                            uploadBase64Image(imgTag[1]);
                        }
                    });
                }
            }
        });


        function uploadImageFile(file) {
            // alert('not base64');
            const formData = new FormData();
            formData.append('image', file);
            formData.append('news_id', {{ $news->id }});

            fetch('/upload-image', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('preview').src = data.url;
                    document.getElementById('image-path').value = data.path;
                    alert('Image uploaded successfully!');
                })
                .catch(error => console.error('Upload failed:', error));
        }

        function uploadBase64Image(dataUrl) {
            // alert('base64'.dataUrl);
            fetch('/upload-image-base64', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        image: dataUrl,
                        news_id: {{ $news->id }}
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('preview').src = data.url;
                    document.getElementById('image-path').value = data.path;
                    alert('Base64 image uploaded successfully!');
                })
                .catch(error => console.error('Upload failed:', error));
        }


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

            function loadSavedData() {

                $.ajax({
                    url: '/api/getSavedDataCountriesCategoriesNews/{{ $news->id }}',
                    type: 'GET',
                    // data: { news_id:  },
                    dataType: 'json',
                    success: function(data) {
                        let rows = '';
                        $.each(data, function(key, item) {
                            rows += `<tr>
                                <td>${item.country.country_name}</td>
                                <td>${item.category.name}</td>
                                <td>${item.news_id}</td>
                                <td>
                                    <button class="deleteData" data-id="${item.id}">Delete</button>
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

            // Ambil default country & category
            let defaultCountry = $('#country').data('default');
            let defaultCategory = $('#category').data('default');

            if (defaultCountry) {
                loadCategories(defaultCountry, defaultCategory);
                loadSavedData();
            }

            $('#country').on('change', function() {
                let countryId = $(this).val();
                loadCategories(countryId);
            });

            $('#saveData').on('click', function() {
                let countryId = $('#country').val();
                let categoryId = $('#category').val();
                let newsId = 1; // Default News ID

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
                        news_id: {{ $news->id }}
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Data saved successfully!');
                        loadSavedData(); // Reload table setelah menyimpan
                    },
                    error: function() {
                        alert('Error saving data');
                    }
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
                            $('#row-' + id).remove(); // Hapus baris dari tabel tanpa reload
                            loadSavedData();
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
