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
                                    <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Master</a></li>
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

                                    <table id="newsTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Title</th>
                                                <th>Short Desc</th>
                                                <th>Content</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="row-number">1</td>
                                                <td><textarea name="news[0][title]" class="form-control" rows="2" required></textarea></td>
                                                <td><textarea name="news[0][short_desc]" class="form-control" rows="2" required></textarea></td>
                                                <td><textarea name="news[0][content]" class="form-control" rows="2" required></textarea></td>
                                                <td><button type="button" class="removeRow btn btn-danger">Delete</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" id="addRow" class="mt-3 btn btn-success">➕ Add Row</button>
                                    <button type="submit" class="mt-3 btn btn-primary">💾 Save</button>
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
                    <button type="button" class="btn btn-primary" id="confirmSelection" disabled>Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Tambah baris dengan nomor otomatis
            $("#addRow").click(function() {
                rowCount++;
                let newRow = `<tr>
                    <td class="row-number">${rowCount}</td>
                    <td><textarea name="news[${rowCount - 1}][title]" class="form-control" rows="2" required></textarea></td>
                    <td><textarea name="news[${rowCount - 1}][short_desc]" class="form-control" rows="2" required></textarea></td>
                    <td><textarea name="news[${rowCount - 1}][content]" class="form-control" rows="2" required></textarea></td>
                    <td><button type="button" class="removeRow btn btn-danger">Delete</button></td>
                </tr>`;
                $("#newsTable tbody").append(newRow);
            });

            // Hapus baris dan perbarui nomor
            $(document).on("click", ".removeRow", function() {
                $(this).closest("tr").remove();
                updateRowNumbers();
            });

            function updateRowNumbers() {
                rowCount = 0;
                $("#newsTable tbody tr").each(function() {
                    rowCount++;
                    $(this).find(".row-number").text(rowCount);
                    $(this).find("textarea").each(function() {
                        let nameAttr = $(this).attr("name");
                        nameAttr = nameAttr.replace(/\[\d+\]/, `[${rowCount - 1}]`);
                        $(this).attr("name", nameAttr);
                    });
                });
            }

            // Dropdown Country & Category
            let countrySelect = $('#country');
            let categorySelect = $('#category');
            let confirmButton = $('#confirmSelection');

            function checkSelection() {
                if (countrySelect.val() && categorySelect.val()) {
                    confirmButton.prop("disabled", false);
                } else {
                    confirmButton.prop("disabled", true);
                }
            }

            countrySelect.change(function() {
                let countryId = $(this).val();
                categorySelect.html('<option value="">Loading...</option>');
                confirmButton.prop("disabled", true);
                if (countryId) {
                    $.get(`/api/get-categories/${countryId}`, function(data) {
                        categorySelect.html('<option value="">-- Select Category --</option>');
                        data.forEach(category => {
                            categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                        });
                    });
                }
            });

            categorySelect.change(checkSelection);
            countrySelect.change(checkSelection);

            // Konfirmasi pilihan di modal
            confirmButton.click(function() {
                $('#selected_country_id').val(countrySelect.val());
                $('#selected_category_id').val(categorySelect.val());
                $('#selectCountryCategoryModal').modal('hide');
                $('#newsForm').show();
            });

            // Submit Form
            $('#newsForm').submit(function(e) {
                e.preventDefault();
                $.post("{{ route('news.bulk-save') }}", $(this).serialize(), function(response) {
                    alert(response.message);
                    window.location.href = '/back/news';
                });
            });

            $('#selectCountryCategoryModal').modal('show');
        });
    </script>
@endsection
