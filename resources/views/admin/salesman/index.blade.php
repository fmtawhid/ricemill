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
                <h4 class="page-title">SalesMan List</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('salesman.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add SalesMan
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- SalesMan Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="salesman_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Image</th>
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
        $(function() {
            $('#salesman_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('salesman.index', ['user_id' => auth()->id()]) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },  // Add Index column for numbering rows
                    { data: 'name', name: 'name' },  // Name column
                    { data: 'number', name: 'number' },  // Phone Number column
                    { data: 'address', name: 'address' },  // Address column
                    { data: 'image', name: 'image' },  // Image column (optional)
                    { data: 'email', name: 'email' },  // Email column
                    { data: 'salary', name: 'salary' },  // Salary column
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }  // Actions column (edit/delete)
                ],
                order: [[0, 'asc']]  // Use the index column (DT_RowIndex) to sort, this will automatically be handled by DataTables
            });
        });


    </script>
@endsection
