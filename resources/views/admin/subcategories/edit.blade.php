@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Category</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Category List</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Form to update the category -->
                <form action="{{ route('categories.update', $category->slug) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This is required for PUT requests -->

                    <div class="row">
                        <!-- Category Name -->
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" value="{{ old('name', $category->name) }}" type="text" id="name" placeholder="Enter Category Name" required>
                            @error('name')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Slug -->
                        <div class="mb-3 col-md-6">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" type="text" id="slug" placeholder="Enter Category Slug" required>
                            @error('slug')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection
