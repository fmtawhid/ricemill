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
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Add Category</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Category List</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Category Creation Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form to add a new category -->
                    <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text"
                                    id="name" placeholder="Enter Category Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input class="form-control" name="slug" value="{{ old('slug') }}" type="text"
                                    id="slug" placeholder="Enter Category Slug" required>
                                @error('slug')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $("#categoryForm").on("submit", function(event) {
                event.preventDefault(); // Prevent form submission

                // Get form data
                var formData = new FormData(this);

                // AJAX request to store the category
                $.ajax({
                    url: $(this).attr("action"),
                    method: "POST",
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content type
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Show success message and reset the form
                            alert(response.message);

                            // Redirect to categories index
                            window.location.href = "{{ route('categories.index') }}";
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                $("#" + key).next(".text-danger").remove();
                                $("#" + key).after('<div class="text-danger my-2">' +
                                    value[0] + '</div>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
