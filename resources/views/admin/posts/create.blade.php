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
    <style>
        /* Ensure cropper's box resizing works */
.cropper-crop-box {
    cursor: pointer;  /* Ensure resizing cursor appears */
    border: 2px dashed rgba(0, 0, 0, 0.5); /* Optional dashed border */
}

/* Ensure cropper's resizing handles are visible */
.cropper-face, .cropper-line, .cropper-point {
    cursor: move;
}

/* Ensure that the image and crop box size constraints work */
.cropper-container {
    position: relative;
    overflow: hidden;
}

.cropper-crop-box {
    box-sizing: border-box;
    border: 2px dashed rgba(0, 0, 0, 0.5); /* Optional dashed border */
}

    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form to create a post -->
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title *</label>
                                <input class="form-control" name="title" value="{{ old('title') }}" type="text" id="title" placeholder="Enter Post Title" required>
                                @error('title')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug *</label>
                                <input class="form-control" name="slug" value="{{ old('slug') }}" type="text" id="slug" placeholder="Enter Post Slug" required>
                                @error('slug')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Category *</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="sub_category_id" class="form-label">Sub Category (optional)</label>
                                <select class="form-select" name="sub_category_id" id="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                </select>
                                @error('sub_category_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="news_type_id" class="form-label">News Types (optional)</label>
                                @foreach($newsTypes as $newsType)
                                    <div>
                                        <input type="radio" name="news_type_id" value="{{ $newsType->id }}" 
                                        @if(old('news_type_id') == $newsType->id) checked @endif>
                                        <label>{{ $newsType->name }}</label>
                                    </div>
                                @endforeach
                                @error('news_type_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                </select>
                                @error('status')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image *</label>
                                <input class="form-control" name="image" type="file" id="image" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div> -->
                            <!-- Add this part inside the form for image upload and cropping -->
                            <div class="mb-3 col-md-6">
        <label for="image" class="form-label">Image *</label>
        <input class="form-control" name="image1" type="file" id="image" accept="image/*">
    </div>

    <!-- Image preview -->
    <div class="img-container">
        <img id="image-preview" src="#" alt="Your Image" style="max-width:100%; display:none;">
    </div>

    <!-- Cropped Image Preview -->
    <div class="cropped-preview mt-3">
        <h5>Cropped Image</h5>
        <img id="cropped-image" src="#" alt="Cropped Image" style="max-width: 100%; display:none;">
    </div>

    <!-- Hidden Input to send the base64 data -->
    <input type="hidden" name="cropped_image" id="cropped-image-input">

    <!-- Button to get the cropped image -->
    <button id="get-cropped-image-btn" class="btn btn-primary mt-3">Get Cropped Image</button>

    <!-- Include Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <script>
        let cropper;

        // Image Upload Event
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const image = document.getElementById('image-preview');
                    image.src = event.target.result;
                    image.style.display = 'block'; // Show the image preview
                    document.getElementById('cropped-image').style.display = 'none'; // Hide cropped image initially
                };

                reader.readAsDataURL(file);
            }
        });

        // Initialize Cropper once image is loaded
        document.getElementById('image-preview').addEventListener('load', function() {
            const image = document.getElementById('image-preview');

            if (cropper) {
                cropper.destroy(); // Destroy any existing cropper instance
            }

            cropper = new Cropper(image, {
                aspectRatio: 780 / 438,  // Set the aspect ratio to 780x438
                viewMode: 1,  // Restrict the crop box to the image
                autoCropArea: 0.8,  // Automatically crop area
                responsive: true,  // Make cropper responsive
                cropBoxResizable: true,  // Allow resizing the crop box while maintaining aspect ratio
                cropBoxMovable: true,  // Allow moving the crop box
            });
        });

        // Get the cropped image and display it
        function getCroppedImage() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 780,  // Set the desired width
                    height: 438,  // Set the desired height
                });

                const croppedImage = document.getElementById('cropped-image');
                croppedImage.src = canvas.toDataURL();
                croppedImage.style.display = 'block'; // Show cropped image

                // Add the cropped image data URL to the hidden input to send with the form
                const imageInput = document.getElementById('cropped-image-input');
                imageInput.value = canvas.toDataURL('image/png'); // Save the base64 image
            }
        }

        // Listen for the click event on the "Get Cropped Image" button
        document.getElementById('get-cropped-image-btn').addEventListener('click', getCroppedImage);
    </script>



                            <div class="mb-3 col-md-6">
                                <label for="keywords" class="form-label">Keywords * </label>
                                <input class="form-control" name="keywords" value="{{ old('keywords') }}" type="text" id="keywords" placeholder="Enter Post Keywords">
                                @error('keywords')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="tags" class="form-label">Tags * </label>
                                <input class="form-control" name="tags" value="{{ old('tags') }}" type="text" id="tags" placeholder="Enter Post Tags">
                                @error('tags')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="short_summary" class="form-label">Short Summary * </label>
                                <textarea class="form-control" name="short_summary" id="short_summary" placeholder="Enter Short Summary">{{ old('short_summary') }}</textarea>
                                @error('short_summary')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description * </label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter Post Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="video_link" class="form-label">Video Link (optional)</label>
                                <input class="form-control" name="video_link" value="{{ old('video_link') }}" type="text" id="video_link" placeholder="Enter Video Link">
                                @error('video_link')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="author_name" class="form-label">Author Name (optional)</label>
                                <input class="form-control" name="author_name" value="{{ old('author_name') }}" type="text" id="author_name" placeholder="Enter Author Name">
                                @error('author_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Date * </label>
                                <input class="form-control" name="date" value="{{ old('date') }}" type="date" id="date" required>
                                @error('date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
