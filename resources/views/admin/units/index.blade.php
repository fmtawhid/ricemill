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
                <h4 class="page-title">Units</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('units.create', ['user_id' => auth()->id()]) }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Unit
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Units Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="unit_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Note</th>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this unit?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $("#unit_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('units.index', ['user_id' => auth()->id()]) }}", // Fetch units data
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "note", name: "note" },
                    { data: "created_at", name: "created_at" },
                    { data: "actions", name: "actions", orderable: false, searchable: false }
                ]
            });

            let unitId;
            $(document).on("click", ".deleteUnit", function() {
                unitId = $(this).data("id");
                $("#deleteModal").modal("show");
                $("#deleteForm").attr("action", "/units/" + unitId);
            });

            $("#deleteForm").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        $("#deleteModal").modal("hide");
                        table.ajax.reload();
                    },
                    error: function(error) {
                        console.error("Error deleting unit", error);
                    }
                });
            });
        });
    </script>
@endsection
