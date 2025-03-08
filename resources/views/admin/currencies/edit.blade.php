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
                    <form action="{{ route('currencies.update', ['currency' => $currency->id, 'user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Currency Name *</label>
                                <input class="form-control" name="name" type="text" id="name" value="{{ old('name', $currency->name) }}" placeholder="Enter Currency Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="icon" class="form-label">Icon (Optional)</label>
                                <input class="form-control" name="icon" type="text" id="icon" value="{{ old('icon', $currency->icon) }}" placeholder="Enter Currency Icon">
                                @error('icon')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="note" class="form-label">Note (Optional)</label>
                                <textarea class="form-control" name="note" id="note" placeholder="Enter Currency Note">{{ old('note', $currency->note) }}</textarea>
                                @error('note')
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
