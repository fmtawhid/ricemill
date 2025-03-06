{{-- @extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Teacher</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.list') }}" class="btn btn-primary">Teachers List</a>
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
                <!-- Form to update the teacher item -->
                <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- This is required for PUT requests -->

                    <div class="row">
                        <!-- Teacher Name -->
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" value="{{ old('name', $teacher->name) }}"
                                type="text" id="name" placeholder="Enter Teacher Name" required>
                            @error('name')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Teacher Designation -->
                        <div class="mb-3 col-md-6">
                            <label for="designation" class="form-label">Designation <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" name="designation"
                                value="{{ old('designation', $teacher->designation) }}" type="text" id="designation"
                                placeholder="Enter Teacher Designation" required>
                            @error('designation')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Teacher Image -->
                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image (Optional)</label>
                            <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                            @if ($teacher->image)
                            <div class="mt-3">
                                <label>Current Image:</label>
                                <img src="{{ asset('img/teachers/' . $teacher->image) }}" alt="Teacher Image"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Update Teacher</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection --}}

@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Edit Teacher</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('teacher.list') }}" class="btn btn-primary">Teachers List</a>
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
                <!-- Form to update the teacher item -->
                <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- This is required for PUT requests -->

                    <div class="row">
                        <!-- Teacher Name -->
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" value="{{ old('name', $teacher->name) }}" type="text" id="name" placeholder="Enter Teacher Name" required>
                            @error('name')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Teacher Designation -->
                        <div class="mb-3 col-md-6">
                            <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" value="{{ old('designation', $teacher->designation) }}" type="text" id="designation" placeholder="Enter Teacher Designation" required>
                            @error('designation')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Teacher Image -->
                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image (Optional)</label>
                            <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                            @if ($teacher->image)
                            <div class="mt-3">
                                <label>Current Image:</label>
                                <img src="{{ asset('img/teachers/' . $teacher->image) }}" alt="Teacher Image" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- New Fields -->
                    <div class="row">
                        <!-- Phone Number -->
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input class="form-control" name="phone_number" value="{{ old('phone_number', $teacher->phone_number) }}" type="text" id="phone_number" placeholder="Enter Teacher Phone Number">
                            @error('phone_number')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" name="email" value="{{ old('email', $teacher->email) }}" type="email" id="email" placeholder="Enter Teacher Email">
                            @error('email')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Enter Teacher Address">{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Facebook Link -->
                        <div class="mb-3 col-md-6">
                            <label for="facebook_link" class="form-label">Facebook Link</label>
                            <input class="form-control" name="facebook_link" value="{{ old('facebook_link', $teacher->facebook_link) }}" type="url" id="facebook_link" placeholder="Enter Teacher Facebook Link">
                            @error('facebook_link')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Date of Joining -->
                        <div class="mb-3 col-md-6">
                            <label for="date_of_joining" class="form-label">Date of Joining</label>
                            <input class="form-control" name="date_of_joining" value="{{ old('date_of_joining', $teacher->date_of_joining) }}" type="date" id="date_of_joining">
                            @error('date_of_joining')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="mb-3 col-md-6">
                            <label for="salary" class="form-label">Salary</label>
                            <input class="form-control" name="salary" value="{{ old('salary', $teacher->salary) }}" type="number" id="salary" placeholder="Enter Teacher Salary">
                            @error('salary')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Qualification -->
                        <div class="mb-3 col-md-6">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input class="form-control" name="qualification" value="{{ old('qualification', $teacher->qualification) }}" type="text" id="qualification" placeholder="Enter Teacher Qualification">
                            @error('qualification')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Years of Experience -->
                        <div class="mb-3 col-md-6">
                            <label for="years_of_experience" class="form-label">Years of Experience</label>
                            <input class="form-control" name="years_of_experience" value="{{ old('years_of_experience', $teacher->years_of_experience) }}" type="number" id="years_of_experience" placeholder="Enter Teacher's Years of Experience">
                            @error('years_of_experience')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="mb-3 col-md-6">
                            <label for="department" class="form-label">Department</label>
                            <input class="form-control" name="department" value="{{ old('department', $teacher->department) }}" type="text" id="department" placeholder="Enter Teacher's Department">
                            @error('department')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Update Teacher</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection

