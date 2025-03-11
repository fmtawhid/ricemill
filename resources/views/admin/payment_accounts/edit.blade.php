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
                    <h4 class="page-title">Edit Payment Account</h4>
                    <form action="{{ route('payment_accounts.update', ['payment_account' => $account->id, 'user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Account Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" id="name" placeholder="Enter Account Name" value="{{ old('name', $account->name) }}" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="account_number" class="form-label">Account Number <span class="text-danger">*</span></label>
                                <input class="form-control" name="account_number" type="text" id="account_number" placeholder="Enter Account Number" value="{{ old('account_number', $account->account_number) }}" required>
                                @error('account_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input class="form-control" name="phone_number" type="text" id="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number', $account->phone_number) }}" required>
                                @error('phone_number')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email (Optional)</label>
                                <input class="form-control" name="email" type="email" id="email" placeholder="Enter Email" value="{{ old('email', $account->email) }}">
                                @error('email')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="balance" class="form-label">Balance <span class="text-danger">*</span></label>
                            <input class="form-control" name="balance" type="number" step="0.01" id="balance" placeholder="Enter Balance" value="{{ old('balance', $account->balance) }}" required>
                            @error('balance')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" name="note" id="note" rows="3">{{ old('note', $account->note) }}</textarea>
                            @error('note')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Payment Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
