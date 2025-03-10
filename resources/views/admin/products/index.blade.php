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
                <h4 class="page-title">Product List</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Product
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Product Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="product_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Item Part</th>
                                <th>Category</th>
                                <th>Purchase Price</th>
                                <th>Sales Price</th>
                                <th>Godown</th>
                                <th>Previous Stock</th>
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
            $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index', ['user_id' => auth()->id()]) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },  // Index column for row numbering
                    { data: 'item_name', name: 'item_name' },  // Item Name
                    { data: 'item_part', name: 'item_part' },  // Item Part
                    { data: 'category.name', name: 'category.name' },  // Category
                    { data: 'purchase_price', name: 'purchase_price' },  // Purchase Price
                    { data: 'sales_price', name: 'sales_price' },  // Sales Price
                    { data: 'godown.godown_name', name: 'godown.godown_name' },  // Godown Name
                    { data: 'previous_stock', name: 'previous_stock' },  // Previous Stock
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }  // Actions column (edit/delete)
                ],
                order: [[0, 'asc']]  // Order by the first column (DT_RowIndex)
            });
        });

    </script>
@endsection
