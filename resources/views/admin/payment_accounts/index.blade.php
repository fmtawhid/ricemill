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
        <!-- Create Payment Account Form -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Add Payment Account</h4>
                    <form action="{{ route('payment_accounts.store', ['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Account Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" id="name" placeholder="Enter Account Name" required>
                            @error('name')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_number" class="form-label">Account Number <span class="text-danger">*</span></label>
                            <input class="form-control" name="account_number" type="text" id="account_number" placeholder="Enter Account Number" required>
                            @error('account_number')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" name="phone_number" type="text" id="phone_number" placeholder="Enter Phone Number" required>
                            @error('phone_number')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Optional)</label>
                            <input class="form-control" name="email" type="email" id="email" placeholder="Enter Email">
                            @error('email')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="balance" class="form-label">Balance <span class="text-danger">*</span></label>
                            <input class="form-control" name="balance" type="number" step="0.01" id="balance" placeholder="Enter Balance" required>
                            @error('balance')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                            @error('note')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Account</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment Accounts List -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table id="payment_accounts_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Phone Number</th>
                                <th>Balance</th>
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
            let table = $("#payment_accounts_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('payment_accounts.index', ['user_id' => auth()->id()]) }}", // Fetch payment accounts data
                    type: "GET",
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "account_number", name: "account_number" },
                    { data: "phone_number", name: "phone_number" },
                    { data: "balance", name: "balance" },
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
