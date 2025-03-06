<!-- resources/views/admin/units/create.blade.php -->
@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>Create Unit</h4>
            <form id="unit-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Unit Name</label>
                    <input type="text" id="name" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea id="note" class="form-control" name="note"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Unit</button>
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
                    url: "{{ route('units.store') }}",
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
