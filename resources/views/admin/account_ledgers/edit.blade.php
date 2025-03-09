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
                    <form action="{{ route('account_ledgers.store', ['user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Account Ledger Name *</label>
                                <input class="form-control" name="name" type="text" id="name" placeholder="Enter Account Ledger Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="account_group_id" class="form-label">Account Group *</label>
                                <select class="form-control" name="account_group_id" id="account_group_id" required>
                                    <option value="">Select Account Group</option>
                                    @foreach ($accountGroups as $accountGroup)
                                        <option value="{{ $accountGroup->id }}">{{ $accountGroup->name }}</option>
                                    @endforeach
                                </select>
                                @error('account_group_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number *</label>
                                <input class="form-control" name="phone_number" type="text" id="phone_number" placeholder="Enter Phone Number" required>
                                @error('phone_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input class="form-control" name="email" type="email" id="email" placeholder="Enter Email" required>
                                @error('email')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="opening_balance" class="form-label">Opening Balance *</label>
                                <input class="form-control" name="opening_balance" type="number" id="opening_balance" step="0.01" placeholder="Enter Opening Balance" required>
                                @error('opening_balance')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="debit_credit" class="form-label">Debit/Credit *</label>
                                <select class="form-control" name="debit_credit" id="debit_credit" required>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                </select>
                                @error('debit_credit')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active">Active</option>
                                    <option value="deactivate">Deactivate</option>
                                </select>
                                @error('status')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Address *</label>
                                <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter Address" required></textarea>
                                @error('address')
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
