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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form to update a post -->
                    <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" id="postForm">
                        @csrf
                        @method('PUT') <!-- Method spoofing for PUT request -->

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" name="title" value="{{ old('title', $post->title) }}" type="text" id="title" placeholder="Enter Post Title" required>
                                @error('title')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input class="form-control" name="slug" value="{{ old('slug', $post->slug) }}" type="text" id="slug" placeholder="Enter Post Slug" required>
                                @error('slug')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="" required>
                                    <option value="pending" {{ old('status', $post->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status', $post->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                </select>
                                @error('status')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="sub_category_id" class="form-label">Sub Category</label>
                                <select class="form-select" name="sub_category_id" id="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ $subCategory->id == $post->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="news_type_id" class="form-label">News Types</label>
                                @foreach($newsTypes as $newsType)
                                    <div>
                                        <input type="radio" name="news_type_id" value="{{ $newsType->id }}" 
                                        @if(old('news_type_id', $post->news_type_id) == $newsType->id) checked @endif>
                                        <label>{{ $newsType->name }}</label>
                                    </div>
                                @endforeach
                                @error('news_type_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- The rest of the fields remain similar to the 'create' blade -->

                            

                            <div class="mb-3 col-md-6">
                                <label for="keywords" class="form-label">Keywords</label>
                                <input class="form-control" name="keywords" value="{{ old('keywords', $post->keywords) }}" type="text" id="keywords" placeholder="Enter Post Keywords">
                                @error('keywords')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="tags" class="form-label">Tags</label>
                                <input class="form-control" name="tags" value="{{ old('tags', $post->tags) }}" type="text" id="tags" placeholder="Enter Post Tags">
                                @error('tags')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="video_link" class="form-label">Video Link</label>
                                <input class="form-control" name="video_link" value="{{ old('video_link', $post->video_link) }}" type="text" id="video_link" placeholder="Enter Video Link">
                                @error('video_link')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            
                            <div class="mb-3 col-md-6">
                                <label for="author_name" class="form-label">Author Name (optional)</label>
                                <input class="form-control" name="author_name" value="{{ old('author_name') }}" type="text" id="author_name" placeholder="Enter Author Name ">
                                @error('author_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input class="form-control" name="date" value="{{ old('date', $post->date) }}" type="date" id="date" required>
                                @error('date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" name="image" type="file" id="image" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                                <!-- Display the current image -->
                                @if($post->image)
                                    <img src="{{ asset('img/posts/' . $post->image) }}" alt="{{ $post->title }}" width="150">
                                @endif
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="short_summary" class="form-label">Short Summary</label>
                                <textarea class="form-control" name="short_summary" id="short_summary" placeholder="Enter Short Summary">{{ old('short_summary', $post->short_summary) }}</textarea>
                                @error('short_summary')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter Post Description">{{ old('description', $post->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value; // Get selected category ID
            const subCategorySelect = document.getElementById('sub_category_id'); // Sub-category dropdown

            // Clear previous sub-category options
            subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';

            // If a category is selected, fetch the sub-categories
            if (categoryId) {
                fetch(`{{ url('/get-sub-categories/${categoryId}') }}`)  // Sending categoryId to the server
                    .then(response => response.json())
                    .then(data => {
                        // If subcategories are returned, populate the subcategory dropdown
                        if (data.subCategories.length > 0) {
                            data.subCategories.forEach(subCategory => {
                                const option = document.createElement('option');
                                option.value = subCategory.id;
                                option.textContent = subCategory.name;
                                subCategorySelect.appendChild(option);
                            });
                        } else {
                            subCategorySelect.innerHTML = '<option value="">No Sub Categories Available</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching sub-categories:', error);
                    });
            }
        });


    </script>
<!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection