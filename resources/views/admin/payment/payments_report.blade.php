@extends('layouts.admin_master')

@section('styles')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Payment Report</h4>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Date Filters -->
    <div class="row mb-4">
        <div class="col-md-2">
            <label for="from_date" class="form-label">From Date</label>
            <input type="text" id="from_date" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-2">
            <label for="to_date" class="form-label">To Date</label>
            <input type="text" id="to_date" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-2">
            <label for="purpose_id" class="form-label">Purpose</label>
            <select class="form-control select2" id="purpose_id" name="purpose_id" style="width: 100%;" required>
                <option selected="selected" value="">Select Purpose</option>
                @foreach ($purposes as $p)
                    <option {{ $p->id == old('purpose_id') ? 'selected' : '' }} value="{{ $p->id }}">
                        {{ $p->purpose_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 align-self-end">
            <button id="filter" class="btn btn-success me-2">Filter</button>
            <button id="reset" class="btn btn-secondary me-2">Reset</button>
            <!-- Export Buttons -->
            <a href="#" id="export_excel" class="btn btn-success me-2">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="#" id="export_pdf" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("export_excel").classList.add("disabled");
            document.getElementById("export_pdf").classList.add("disabled");

            document.getElementById("filter").addEventListener("click", function() {
                document.getElementById("export_excel").classList.remove("disabled");
                document.getElementById("export_pdf").classList.remove("disabled");
            });

            document.getElementById("reset").addEventListener("click", function() {
                document.getElementById("export_excel").classList.add("disabled");
                document.getElementById("export_pdf").classList.add("disabled");
            });
        });
    </script>
    <!-- End Date Filters -->

    <!-- Create Expense Form -->
    <div class="row mt-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Payments DataTable -->
                    <table id="paymentsTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Receipt No</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Dakhila Number</th>
                                <th>Address</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                                <th>Amount in Words</th>
                                <th>Class</th>
                                <th>Bibhag</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables AJAX -->
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->



    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModalGal" tabindex="-1" aria-labelledby="attachmentsModalGalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="attachmentsGallery" class="row">
                        <!-- Attachments will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#to_date").flatpickr({
            dateFormat: "d-m-Y"
        })

        $("#from_date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>
    <script>
        $(document).ready(function() {
            // Define the route template with a placeholder for student ID
            var attachmentsRouteTemplate = "{{ route('payments.attachments', ':id') }}";

            // Initialize DataTable
            var table = $("#paymentsTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('payments.report') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.purpose_id = $('#purpose_id').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'reciept_no',
                        name: 'reciept_no'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'dhakila_number',
                        name: 'dhakila_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'purpose',
                        name: 'purpose'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'amount_in_words',
                        name: 'amount_in_words'
                    },
                    {
                        data: 'sreni',
                        name: 'sreni'
                    },
                    {
                        data: 'bibag',
                        name: 'bibag'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                initComplete: function(settings, json) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    // Handle Delete Button Clicks
                    $(document).on("click", ".delete", function(e) {
                        e.preventDefault();
                        let that = $(this);
                        $.confirm({
                            icon: "fas fa-exclamation-triangle",
                            closeIcon: true,
                            title: "Are you sure?",
                            content: "You cannot undo this action!",
                            type: "red",
                            typeAnimated: true,
                            buttons: {
                                confirm: function() {
                                    that.closest("form").submit();
                                },
                                cancel: function() {
                                    // Do nothing
                                },
                            },
                        });
                    });


                    // Handle View Attachments Button Click
                    $(document).on('click', '.view-attachments', function() {
                        let studentId = $(this).data('id');

                        // Generate the actual route by replacing the placeholder with the student ID
                        let attachmentsRoute = attachmentsRouteTemplate.replace(':id',
                            studentId);

                        // Clear previous attachments
                        $('#attachmentsGallery').empty();

                        // Fetch attachments via AJAX
                        $.ajax({
                            url: attachmentsRoute,
                            type: 'GET',
                            success: function(response) {
                                if (response.attachments.length > 0) {
                                    response.attachments.forEach(function(
                                        attachment) {
                                        if (['jpg', 'jpeg', 'png', 'gif',
                                                'svg'
                                            ].includes(attachment.file_type
                                                .toLowerCase())) {
                                            // Display image using Lightbox
                                            $('#attachmentsGallery').append(`
                                            <div class="col-md-3 mb-3">
                                                <a href="${attachment.url}" data-lightbox="attachments" data-title="${attachment.name}">
                                                    <img src="${attachment.url}" alt="${attachment.name}" class="img-fluid img-thumbnail">
                                                </a>
                                            </div>
                                        `);
                                        } else if (['pdf'].includes(
                                                attachment.file_type
                                                .toLowerCase())) {
                                            // Display PDF icon with link to view/download
                                            $('#attachmentsGallery').append(`
                                            <div class="col-md-3 mb-3 text-center">
                                                <a href="${attachment.url}" target="_blank" data-title="${attachment.name}">
                                                    <i class="fa fa-file-pdf-o fa-5x text-danger"></i>
                                                    <p>${attachment.name}</p>
                                                </a>
                                                  <a href="${attachment.url}" download class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                            </div>
                                        `);
                                        } else {
                                            // Handle other file types if necessary
                                        }
                                    });
                                } else {
                                    $('#attachmentsGallery').append(`
                                    <div class="col-12">
                                        <p class="text-center">No attachments found for this student.</p>
                                    </div>
                                `);
                                }

                                // Show the modal
                                $('#attachmentsModalGal').modal('show');
                            },
                            error: function(xhr) {
                                toastr.error('Failed to fetch attachments.');
                            }
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });



            // Filter button click
            $('#filter').click(function() {
                table.draw();
            });

            // Reset button click
            $('#reset').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                table.draw();
            });

            // // Export Excel
            // $('#export_excel').click(function(e) {
            //     e.preventDefault();
            //     let fromDate = $('#from_date').val();
            //     let toDate = $('#to_date').val();
            //     let url = "{{ route('payments.export.excel') }}" + "?from_date=" + fromDate + "&to_date=" +
            //         toDate;
            //     window.location.href = url;
            // });

            // // Export PDF
            // $('#export_pdf').click(function(e) {
            //     e.preventDefault();
            //     let fromDate = $('#from_date').val();
            //     let toDate = $('#to_date').val();
            //     let url = "{{ route('payments.export.pdf') }}" + "?from_date=" + fromDate + "&to_date=" +
            //         toDate;
            //     window.location.href = url;
            // });
            // Export Excel
            // Export Excel
            $('#export_excel').click(function(e) {
                e.preventDefault();

                // Get filter values
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let purposeId = $('#purpose_id').val(); // Use purpose_id here

                // Build the URL with query parameters
                let url = "{{ route('payments.export.excel') }}" +
                        "?from_date=" + fromDate +
                        "&to_date=" + toDate +
                        "&purpose_id=" + purposeId; // Pass purpose_id here

                window.location.href = url; // Redirect to the export route
            });

            // Export PDF
            $('#export_pdf').click(function(e) {
                e.preventDefault();

                // Get filter values
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                let purposeId = $('#purpose_id').val(); // Use purpose_id here

                // Build the URL with query parameters
                let url = "{{ route('payments.export.pdf') }}" +
                        "?from_date=" + fromDate +
                        "&to_date=" + toDate +
                        "&purpose_id=" + purposeId; // Pass purpose_id here

                window.location.href = url; // Redirect to the export route
            });
        });
    </script>
@endsection
