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
                <h4 class="page-title">Posts</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('posts.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Post
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Posts Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="post_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Keywords</th>
                                <th>Tags</th>
                                <th>Short Summary</th>
                                <th>Description</th>
                                <th>Video Link</th>
                                <th>Image</th>
                                
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables -->
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
                    <p>Are you sure you want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
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
            // Initialize DataTables
            let table = $("#post_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('posts.index', ['user_id' => auth()->id()]) }}", // The URL for fetching the posts
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "title", name: "title" },
                    { data: "slug", name: "slug" },
                    { data: "category_name", name: "category_name" },
                    { data: "status", name: "status" },
                    { data: "keywords", name: "keywords" },
                    { data: "tags", name: "tags" },
                    { data: "short_summary", name: "short_summary" },
                    { data: "description", name: "description" },
                    { data: "video_link", name: "video_link" },
                    { data: "image", name: "image" },
                    { data: "created_at", name: "created_at" },
                    { data: "actions", name: "actions", orderable: false, searchable: false }
                ]
            });

            // Handle Delete Button Click
            let postSlug;
            $(document).on("click", ".deletePost", function() {
                postSlug = $(this).data("slug"); // Get the post slug
                $("#deleteModal").modal("show"); // Show the confirmation modal
                // Set the action for the delete form dynamically
                $("#deleteForm").attr("action", "/posts/" + postSlug);
            });

            // Handle Delete Form Submission
            $("#deleteForm").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        $("#deleteModal").modal("hide"); // Hide the modal
                        table.ajax.reload(); // Reload the table data
                    },
                    error: function(error) {
                        console.error("Error deleting post", error); // Handle errors
                    }
                });
            });
        });
    </script>
@endsection
