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
                    <form action="{{ route('salesman.update', ['salesman' => $salesMan->id, 'user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Salesman Name *</label>
                                <input class="form-control" name="name" type="text" id="name" value="{{ $salesMan->name }}" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="number" class="form-label">Phone Number *</label>
                                <input class="form-control" name="number" type="text" id="number" value="{{ $salesMan->number }}" required>
                                @error('number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email (Optional)</label>
                                <input class="form-control" name="email" type="email" id="email" value="{{ $salesMan->email }}">
                                @error('email')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address (Optional)</label>
                                <input class="form-control" name="address" type="text" id="address" value="{{ $salesMan->address }}">
                                @error('address')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">Salary (Optional)</label>
                                <input class="form-control" name="salary" type="number" id="salary" value="{{ $salesMan->salary }}">
                                @error('salary')
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
