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
                <form action="{{ route('products.update', ['product' => $product->id, 'user_id' => auth()->id()]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="item_name" class="form-label">Item Name *</label>
                                <input class="form-control" name="item_name" type="text" id="item_name" value="{{ $product->item_name }}" required>
                                @error('item_name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="item_part" class="form-label">Item Part (Optional)</label>
                                <input class="form-control" name="item_part" type="text" id="item_part" value="{{ $product->item_part }}">
                                @error('item_part')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="unit_id" class="form-label">Unit *</label>
                                <select class="form-control" name="unit_id" id="unit_id" required>
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Category *</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="purchase_price" class="form-label">Purchase Price *</label>
                                <input class="form-control" name="purchase_price" type="number" id="purchase_price" value="{{ $product->purchase_price }}" required>
                                @error('purchase_price')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="sales_price" class="form-label">Sales Price *</label>
                                <input class="form-control" name="sales_price" type="number" id="sales_price" value="{{ $product->sales_price }}" required>
                                @error('sales_price')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="godown_id" class="form-label">Godown *</label>
                                <select class="form-control" name="godown_id" id="godown_id" required>
                                    <option value="">Select Godown</option>
                                    @foreach($godowns as $godown)
                                        <option value="{{ $godown->id }}" {{ $product->godown_id == $godown->id ? 'selected' : '' }}>{{ $godown->godown_name }}</option>
                                    @endforeach
                                </select>
                                @error('godown_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="previous_stock" class="form-label">Previous Stock *</label>
                                <input class="form-control" name="previous_stock" type="number" id="previous_stock" value="{{ $product->previous_stock }}" required>
                                @error('previous_stock')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="total_previous_stock" class="form-label">Total Previous Stock (Optional)</label>
                                <input class="form-control" name="total_previous_stock" type="number" id="total_previous_stock" value="{{ $product->total_previous_stock }}">
                                @error('total_previous_stock')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
