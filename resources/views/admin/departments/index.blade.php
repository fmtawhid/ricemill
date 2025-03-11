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
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Departments</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Department
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Create Department Form -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Add Department</h4>
                    <form id="createDepartmentForm" action="{{ route('departments.store',['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" id="name" placeholder="Enter Department Name" required>
                            @error('name')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Department</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Departments List (DataTable) -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table id="departments_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department Name</th>
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
            let table = $("#departments_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('departments.index', ['user_id' => auth()->id()]) }}", // Fetch departments data
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
