<!-- resources/views/admin/units/edit.blade.php -->
@extends('layouts.admin_master')

@section('content')
    <div class="row"> 
        <div class="col-12">
            <h4>Edit Unit</h4>
            <form id="unit-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Unit Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $unit->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea id="note" class="form-control" name="note">{{ $unit->note }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Unit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#unit-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('units.update', $unit->id) }}",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('units.index') }}";
                    }
                });
            });
        });
    </script>
@endsection
