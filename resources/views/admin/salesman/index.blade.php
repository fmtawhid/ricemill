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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Salary</th>
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
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row) {
                            // Check if image exists, else show a placeholder image
                            return data ? '<img src="{{ asset('img') }}/' + data +
                                '" alt="Profile Image" style="width: 50px; height: 50px; object-fit: cover;">' :
                                '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGhFuhp-J1n_y1pfRjcFoRe_PFPgqXXt4OwafWjwoBuTfIbaRQX0Tt5F4&s" alt="Default Image" style="width: 50px; height: 50px; object-fit: cover;">';
                        }
                    },
                    { data: 'name', name: 'name' },  // Name column
                    { data: 'number', name: 'number' },  // Phone Number column
                    { data: 'email', name: 'email' },  // Email column
                    { data: 'address', name: 'address' },  // Address column
                    // { data: 'image', name: 'image' },  // Image column (optional)
                    
                    { data: 'salary', name: 'salary' },  // Salary column
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }  // Actions column (edit/delete)
                ],
                order: [[0, 'asc']]  // Use the index column (DT_RowIndex) to sort, this will automatically be handled by DataTables
            });
        });


    </script>
@endsection
