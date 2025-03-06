@extends('layouts.admin_master')

@section('content')
    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">News Types</h4>
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item">
                        <a href="{{ route('news_types.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add News
                        </a>
                    </li> -->
                </ol>
            </div>
        </div>
    </div>

    <!-- Categories Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="category_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data is fetched by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this News Post?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $("#category_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('news_types.index') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "slug",
                        name: "slug"
                    },
                    {
                        data: "created_at",
                        name: "created_at"
                    },
                    
                ]
            });

            // Handle Delete Button Click
            let categorySlug;
            $(document).on("click", ".deleteCategory", function() {
                categorySlug = $(this).data("slug"); // Get the category slug
                $("#deleteModal").modal("show"); // Show the confirmation modal
            });

            // Confirm Delete
            $("#confirmDelete").click(function() {
                $.ajax({
                    url: "/categories/" + categorySlug, // Use the category slug in the URL
                    type: "DELETE", // DELETE request method
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content") // Ensure CSRF token is included
                    },
                    success: function(response) {
                        $("#deleteModal").modal("hide"); // Hide the modal
                        table.ajax.reload(); // Reload the table data
                    },
                    error: function(error) {
                        console.error("Error deleting category", error); // Handle errors
                    }
                });
            });
        });
    </script>
@endsection
