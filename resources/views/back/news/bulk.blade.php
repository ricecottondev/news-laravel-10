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
                                <form id="newsForm" style="display:none;">
                                    <input type="hidden" id="selected_country_id" name="country_id">
                                    <input type="hidden" id="selected_category_id" name="category_id">

                                    <table id="newsTable">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Short Desc</th>
                                                <th>Content</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="news[0][title]" required></td>
                                                <td><input type="text" name="news[0][short_desc]" required></td>
                                                <td><input type="text" name="news[0][content]" required></td>
                                                <td><button type="button" class="removeRow btn">❌</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" id="addRow" class="btn btn-success">➕ Add Row</button>
                                    <button type="submit" class="btn btn-primary">💾 Save</button>
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
        $(document).ready(function() {
            let rowCount = 1;

            $("#addRow").click(function() {
                let newRow = `<tr>
                    <td><input type="text" name="news[${rowCount}][title]" required></td>
                    <td><input type="text" name="news[${rowCount}][short_desc]" required></td>
                    <td><input type="text" name="news[${rowCount}][content]" required></td>
                    <td><button type="button" class="removeRow btn">❌</button></td>
                </tr>`;
                $("#newsTable tbody").append(newRow);
                rowCount++;
            });

            $(document).on("click", ".removeRow", function() {
                $(this).closest("tr").remove();
            });

            let countrySelect = $('#country');
            let categorySelect = $('#category');

            countrySelect.change(function() {
                let countryId = $(this).val();
                categorySelect.html('<option value="">Loading...</option>');
                if (countryId) {
                    $.get(`/api/get-categories/${countryId}`, function(data) {
                        categorySelect.html('<option value="">-- Select Category --</option>');
                        data.forEach(category => {
                            categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                        });
                    });
                }
            });

            $('#confirmSelection').click(function() {
                $('#selected_country_id').val(countrySelect.val());
                $('#selected_category_id').val(categorySelect.val());
                $('#selectCountryCategoryModal').modal('hide');
                $('#newsForm').show();
            });

            $('#newsForm').submit(function(e) {
                e.preventDefault();
                $.post("{{ route('news.bulk-save') }}", $(this).serialize(), function(response) {
                    alert(response.message);
                    location.reload();
                });
            });

            $('#selectCountryCategoryModal').modal('show');
        });
    </script>
@endsection
