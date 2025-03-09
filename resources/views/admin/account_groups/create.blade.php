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
                    <form action="{{ route('account_groups.store', ['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Account Group Name *</label>
                                <input class="form-control" name="name" type="text" id="name" placeholder="Enter Account Group Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="nature_id" class="form-label">Nature *</label>
                                <select class="form-control" name="nature_id" id="nature_id" required>
                                    <option value="">Select Nature</option>
                                    @foreach ($natures as $nature)
                                        <option value="{{ $nature->id }}">{{ $nature->name }}</option>
                                    @endforeach
                                </select>
                                @error('nature_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="group_under_id" class="form-label">Group Under *</label>
                                <select class="form-control" name="group_under_id" id="group_under_id" required>
                                    <option value="">Select Group Under</option>
                                    @foreach ($groupUnders as $groupUnder)
                                        <option value="{{ $groupUnder->id }}">{{ $groupUnder->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_under_id')
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
