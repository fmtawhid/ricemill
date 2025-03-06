<!-- resources/views/admin/currencies/create.blade.php -->
@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>Create Currency</h4>
            <form id="currency-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Currency Name</label>
                    <input type="text" id="name" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea id="note" class="form-control" name="note"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Currency</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#currency-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('currencies.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('currencies.index') }}";
                    }
                });
            });
        });
    </script>
@endsection
