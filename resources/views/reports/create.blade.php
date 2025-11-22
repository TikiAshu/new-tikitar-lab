@extends('layouts.app')

@section('styles')
    <style>
        .fv-plugins-message-container {
            display: none;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .fv-plugins-message-container.d-block {
            display: block !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>
@endsection

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create Report</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('batches.results.index', $batch->id) }}" class="text-muted text-hover-primary">Test Results</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}" class="text-muted text-hover-primary">Reports</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">Reports - {{ $batch->product->product_name ?? 'N/A' }} - {{ $batch->quantity ?? 'N/A' }} {{ $batch->unit ?? '' }} - Batch: {{ $batch->batch_number ?? 'N/A' }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <form id="kt_create_report_form" novalidate="novalidate">
                            @csrf

                            <h3 class="fw-bold mb-5">TEST RESULTS</h3>

                            <!-- Certificate Title -->
                            <div class="row mb-7">
                                <div class="col-md-12">
                                    <label class="fs-6 fw-bold mb-2">Certificate Title</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="certification"
                                        value="{{ $certificateTitle }}"
                                        readonly />
                                    <div class="fv-plugins-message-container invalid-feedback" id="certification-error"></div>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Quantity *</label>
                                    <input type="number"
                                        step="0.01"
                                        class="form-control form-control-solid"
                                        name="quantity"
                                        placeholder="Enter quantity"
                                        required />
                                    <div class="text-muted mt-1">Available Quantity: {{ number_format($availableQuantity, 2) }} {{ $batch->unit ?? '' }}</div>
                                    <div class="fv-plugins-message-container invalid-feedback" id="quantity-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Unit</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="unit"
                                        value="{{ $batch->unit ?? '' }}"
                                        placeholder="Unit" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="unit-error"></div>
                                </div>
                            </div>

                            <!-- Client Type & Client -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Client Type *</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select Client Type" name="client_type" required>
                                        <option></option>
                                        <option value="internal">Internal</option>
                                        <option value="external">External</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="client_type-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Client</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select Client" name="client_id" id="client_id">
                                            <option></option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('clients.index') }}" target="_blank" class="btn btn-sm btn-light-primary">Add New +</a>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback" id="client_id-error"></div>
                                </div>
                            </div>

                            <!-- Project & Truck No -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Project *</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="project"
                                        placeholder="Enter project"
                                        required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="project-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Truck No.</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="truck_no"
                                        placeholder="Enter truck number" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="truck_no-error"></div>
                                </div>
                            </div>

                            <!-- Invoice No & Date Issue -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Invoice No.</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="invoice_no"
                                        placeholder="Enter invoice number" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="invoice_no-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Show Report Code *</label>
                                    <div class="d-flex gap-4">
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="show_report_code" value="Yes" checked />
                                            <span class="form-check-label">Yes</span>
                                        </label>
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="show_report_code" value="No" />
                                            <span class="form-check-label">No</span>
                                        </label>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback" id="show_report_code-error"></div>
                                </div>
                            </div>

                            <!-- Show Report Code -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Tech. Manager *</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select Tech. Manager" name="assign_id" required>
                                        <option></option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="assign_id-error"></div>
                                </div>
                            </div>

                            <!-- Party Ref -->
                            <div class="row mb-7">
                                <div class="col-md-12">
                                    <label class="required fs-6 fw-bold mb-2">Party Ref *</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="party_ref"
                                        placeholder="Enter party reference"
                                        required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="party_ref-error"></div>
                                </div>
                            </div>

                            <!-- Show  -->
                            {{-- <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Employee</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select Employee" name="employee_id">
                                        <option></option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="employee_id-error"></div>
                                </div>
                            </div> --}}
{{--
                            <!-- Optional Fields -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">NABL Report</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="nabl_report"
                                        placeholder="Enter NABL report" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="nabl_report-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">ULR Number</label>
                                    <input type="text"
                                        class="form-control form-control-solid"
                                        name="ulr_number"
                                        placeholder="Enter ULR number" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ulr_number-error"></div>
                                </div>
                            </div> --}}

                            <!-- Form Actions -->
                            <div class="separator separator-dashed my-10"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}" class="btn btn-light me-3">Cancel</a>
                                <button type="submit" id="kt_create_report_submit" class="btn btn-primary">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Form submission
            $('#kt_create_report_form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                const submitButton = document.querySelector('#kt_create_report_submit');
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                $.ajax({
                    url: "{{ route('batches.results.reports.store', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Report created successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            window.location.href = response.redirect || "{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}";
                        });
                    },
                    error: function(xhr) {
                        $('.fv-plugins-message-container').html('').removeClass('d-block');
                        $('.is-invalid').removeClass('is-invalid');

                        var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                        let firstError = xhr.responseJSON?.error || "Sorry, it looks like there are some errors detected. Please try again.";

                        if (errors) {
                            for (let key in errors) {
                                if (errors[key] && errors[key][0]) {
                                    firstError = errors[key][0];
                                    break;
                                }
                            }
                        }

                        Swal.fire({
                            text: firstError,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        if (errors) {
                            $.each(errors, function(key, value) {
                                var errorContainer = $('#' + key + '-error');
                                if (errorContainer.length) {
                                    errorContainer.html(value[0]).addClass('d-block');
                                    $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]').addClass('is-invalid');
                                }
                            });
                        }

                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    }
                });
            });

            // Clear errors when user starts typing
            $(document).on('input', 'input, textarea, select', function() {
                var fieldName = $(this).attr('name');
                if (fieldName) {
                    $(this).removeClass('is-invalid');
                    $('#' + fieldName + '-error').html('').removeClass('d-block');
                }
            });

            // Auto-fill client details when client is selected
            $('#client_id').on('change', function() {
                var clientId = $(this).val();
                if (clientId) {
                    $.ajax({
                        url: "{{ route('clients.index') }}/" + clientId,
                        type: "GET",
                        success: function(response) {
                            if (response) {
                                // Auto-fill address, phone, email if empty
                                if (!$('textarea[name="address"]').val() && response.address) {
                                    $('textarea[name="address"]').val(response.address);
                                }
                                if (!$('input[name="phone"]').val() && response.phone_number) {
                                    $('input[name="phone"]').val(response.phone_number);
                                }
                                if (!$('input[name="email"]').val() && response.email) {
                                    $('input[name="email"]').val(response.email);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

