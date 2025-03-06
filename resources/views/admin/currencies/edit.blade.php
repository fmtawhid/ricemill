<!-- resources/views/admin/currencies/edit.blade.php -->
@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>Edit Currency</h4>
            <form id="currency-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Currency Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $currency->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea id="note" class="form-control" name="note">{{ $currency->note }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Currency</button>
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
                    url: "{{ route('currencies.update', $currency->id) }}",
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
