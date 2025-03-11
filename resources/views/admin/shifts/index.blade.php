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
        <!-- Create Shift Form -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Add Shift</h4>
                    <form action="{{ route('shifts.store', ['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Shift Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" id="name" placeholder="Enter Shift Name" required>
                            @error('name')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Shift</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Shifts List (DataTable) -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table id="shifts_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Shift Name</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $("#shifts_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('shifts.index', ['user_id' => auth()->id()]) }}", // Fetch shifts data
                    type: "GET",
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "created_at", name: "created_at" },
                    {
                        data: "actions", 
                        name: "actions", 
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endsection
