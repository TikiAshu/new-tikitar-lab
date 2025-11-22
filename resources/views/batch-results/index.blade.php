@extends('layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Test Result Versions</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('batch.index') }}" class="text-muted text-hover-primary">Batches</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Test Results</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Test Result Versions</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Batch: {{ $batch->batch_number ?? 'N/A' }} | 
                                    Product: {{ $batch->product->product_name ?? 'N/A' }}
                                </span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end gap-2">
                                @if(!$hasNABL)
                                    <a href="{{ route('batches.results.create', ['batch' => $batch->id, 'test_type' => 'NABL']) }}" 
                                        class="btn btn-success">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        Create NABL Test
                                    </a>
                                @endif
                                @if(!$hasNONNABL)
                                    <a href="{{ route('batches.results.create', ['batch' => $batch->id, 'test_type' => 'NON-NABL']) }}" 
                                        class="btn btn-info">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        Create NON-NABL Test
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <table id="kt_result_versions_table" class="table table-row-bordered gy-5">
                            <thead>
                                <tr class="fw-bold fs-6 text-muted">
                                    <th>#</th>
                                    <th>Test Type</th>
                                    <th>Version</th>
                                    <th>Start Date</th>
                                    <th>Date Perform</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $("#kt_result_versions_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('batches.results.index', $batch->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'test_type_badge', name: 'test_type' },
                    { data: 'version_number', name: 'version' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'date_perform', name: 'date_perform' },
                    { data: 'status_badge', name: 'report_status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "Showing 0 to 0 of 0 records",
                    "emptyTable": "No data available in table"
                },
                "pageLength": 10,
                "order": [[0, 'asc']]
            });

            // Delete handler
            $(document).on('click', '.delete-result', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var batchId = $(this).data('batch');
                
                Swal.fire({
                    text: "Are you sure you want to delete this test result version?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/batches/" + batchId + "/results/" + id,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "Test result version deleted successfully!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: "Error deleting test result version.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });
            });

            // Submit for Review handler
            $(document).on('click', '.submit-review', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var batchId = $(this).data('batch');
                
                $.ajax({
                    url: "/batches/" + batchId + "/results/" + id + "/submit-review",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Test result version submitted for review!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then(function() {
                            table.ajax.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            text: xhr.responseJSON?.error || "Error submitting for review.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                    }
                });
            });

            // Approve handler
            $(document).on('click', '.approve-result', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var batchId = $(this).data('batch');
                
                Swal.fire({
                    text: "Are you sure you want to approve this test result version?",
                    icon: "question",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, approve!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-success",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/batches/" + batchId + "/results/" + id + "/approve",
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "Test result version approved!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: xhr.responseJSON?.error || "Error approving test result version.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });
            });

            // Reject handler
            $(document).on('click', '.reject-result', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var batchId = $(this).data('batch');
                
                Swal.fire({
                    text: "Are you sure you want to reject this test result version?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, reject!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/batches/" + batchId + "/results/" + id + "/reject",
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "Test result version rejected!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: xhr.responseJSON?.error || "Error rejecting test result version.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection

