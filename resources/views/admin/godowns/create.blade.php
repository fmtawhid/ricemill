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
                    <form action="{{ route('godowns.store', ['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="godown_name" class="form-label">Godown Name *</label>
                                <input class="form-control" name="godown_name" type="text" id="godown_name" placeholder="Enter Godown Name" required>
                                @error('godown_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description (Optional)</label>
                                <input class="form-control" name="description" type="text" id="description" placeholder="Enter Description">
                                @error('description')
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
