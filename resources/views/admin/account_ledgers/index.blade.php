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
                <h4 class="page-title">Account Ledgers</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('account_ledgers.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Account Ledger
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Account Ledgers Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="account_ledger_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Ledger Name</th>
                                <th>Account Group</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Opening Balance</th>
                                <th>Debit/Credit</th>
                                <th>Status</th>
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
            let table = $("#account_ledger_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('account_ledgers.index', ['user_id' => auth()->id()]) }}", // Fetch account ledgers data
                    type: "GET",
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "account_group_name", name: "account_group_name" }, // Display Account Group name
                    { data: "phone_number", name: "phone_number" },
                    { data: "email", name: "email" },
                    { data: "opening_balance", name: "opening_balance" },
                    { data: "debit_credit", name: "debit_credit" },
                    { data: "status", name: "status" },
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
