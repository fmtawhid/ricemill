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
                <h4 class="page-title">Account Groups</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('account_groups.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Account Group
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Account Groups Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="account_group_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Group Name</th>
                                <th>Nature</th>
                                <th>Group Under</th>
                                <th>Description</th>
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
            let table = $("#account_group_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('account_groups.index', ['user_id' => auth()->id()]) }}", // Fetch account groups data
                    type: "GET",
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "nature_name", name: "nature_name" },  // Display Nature name
                    { data: "group_under_name", name: "group_under_name" },  // Display Group Under name
                    { data: "description", name: "description" },
                    { data: "created_at", name: "created_at" },
                    {
                        data: "actions", 
                        name: "actions", 
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
