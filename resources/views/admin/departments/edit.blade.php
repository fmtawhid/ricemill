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
                    <h4 class="page-title">Edit Department</h4>
                    <!-- Make sure the form tag is properly closed after the fields are defined -->
                    <form action="{{ route('departments.update', ['department' => $department->id, 'user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" id="name" placeholder="Enter Department Name" value="{{ old('name', $department->name) }}" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
