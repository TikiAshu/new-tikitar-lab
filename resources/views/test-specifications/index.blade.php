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

        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>
@endsection

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        Test Specifications
                        @if($product)
                            - {{ $product->product_name }}
                        @endif
                        @if($productGrade)
                            - Grade: {{ $productGrade->grade }}
                        @endif
                    </h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            @if($productGrade)
                                <a href="{{ route('product-grades.index', $productId) }}" class="text-muted text-hover-primary">Product Grades</a>
                            @else
                                <a href="{{ route('products.index') }}" class="text-muted text-hover-primary">Products</a>
                            @endif
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Test Specifications</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Test Specifications</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end gap-2">
                                @if($productGrade)
                                    <a href="{{ route('product-grades.index', $productId) }}" class="btn btn-light">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M9.60002 11L20.4 11C20.7314 11 21 11.2686 21 11.6C21 11.9314 20.7314 12.2 20.4 12.2L9.60002 12.2L9.60002 11Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M9.60002 11.6L3.60002 5.6C3.26863 5.26863 2.73137 5.26863 2.4 5.6C2.06863 5.93137 2.06863 6.46863 2.4 6.8L7.2 11.6L2.4 16.4C2.06863 16.7314 2.06863 17.2686 2.4 17.6C2.73137 17.9314 3.26863 17.9314 3.60002 17.6L9.60002 11.6Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        Back to Grades
                                    </a>
                                @else
                                    <a href="{{ route('products.index') }}" class="btn btn-light">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M9.60002 11L20.4 11C20.7314 11 21 11.2686 21 11.6C21 11.9314 20.7314 12.2 20.4 12.2L9.60002 12.2L9.60002 11Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M9.60002 11.6L3.60002 5.6C3.26863 5.26863 2.73137 5.26863 2.4 5.6C2.06863 5.93137 2.06863 6.46863 2.4 6.8L7.2 11.6L2.4 16.4C2.06863 16.7314 2.06863 17.2686 2.4 17.6C2.73137 17.9314 3.26863 17.9314 3.60002 17.6L9.60002 11.6Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        Back to Products
                                    </a>
                                @endif
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_customer">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor">
                                            </rect>
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor">
                                            </rect>
                                        </svg>
                                    </span>
                                    Add Test Specification
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
                            <thead>
                                <tr class="fw-bold fs-6 text-muted">
                                    <th>#</th>
                                    <th>Specification</th>
                                    @if($productGrade)
                                        <th>Grade</th>
                                    @endif
                                    <th>Test Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via Ajax -->
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <!-- begin::Modals -->

    <!--begin::Modal - Add-->
    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" novalidate="novalidate" id="kt_modal_add_customer_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Add a Test Specification</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                            data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                            data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                            <input type="hidden" name="product_id" value="{{ $productId }}" />
                            <input type="hidden" name="product_grade_id" value="{{ $productGradeId ?? 0 }}" />
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Specification</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select specification" name="specification_id" required>
                                    <option></option>
                                    @foreach($specifications as $spec)
                                        <option value="{{ $spec->id }}">{{ $spec->specification }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="specification_id-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Test Type</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select test type" name="test_type">
                                    <option></option>
                                    <option value="NON-NABL">NON-NABL</option>
                                    <option value="NABL">NABL</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="test_type-error"></div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_add_customer_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Add-->

    <!--begin::Modal - Edit-->
    <div class="modal fade" id="kt_customers_edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">Edit Test Specification</h2>
                    <div id="kt_customers_edit_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                        data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" novalidate="novalidate" id="kt_customers_edit_form">
                        <input type="hidden" id="edit_id" name="edit_id" />
                        <input type="hidden" id="edit_product_id" name="product_id" value="{{ $productId }}" />
                        <input type="hidden" id="edit_product_grade_id" name="product_grade_id" value="{{ $productGradeId ?? 0 }}" />
                        
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Specification</label>
                            <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select specification" id="edit_specification_id" name="specification_id" required>
                                <option></option>
                                @foreach($specifications as $spec)
                                    <option value="{{ $spec->id }}">{{ $spec->specification }}</option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="specification_id-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Test Type</label>
                            <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select test type" id="edit_test_type" name="test_type">
                                <option></option>
                                <option value="NON-NABL">NON-NABL</option>
                                <option value="NABL">NABL</option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="test_type-error"></div>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_customers_edit_cancel"
                                class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_customers_edit_submit" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Edit-->

    <!--begin::Modal - View-->
    <div class="modal fade" id="kt_customers_view_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">View Test Specification</h2>
                    <div id="kt_customers_view_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                        data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" novalidate="novalidate" id="kt_customers_view_form">
                        <input type="hidden" id="view_id" name="view_id" />
                        
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Specification</label>
                            <input type="text" class="form-control form-control-solid" id="view_specification"
                                name="view_specification" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Test Type</label>
                            <input type="text" class="form-control form-control-solid" id="view_test_type"
                                name="view_test_type" disabled />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_customers_view_cancel"
                                class="btn btn-light me-3">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - View-->

    <!-- end::Modals -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#kt_datatable_example_1").DataTable({
                processing: true,
                serverSide: true,
                ajax: @if($productGradeId) 
                    "{{ route('test-specifications.grade.index', [$productId, $productGradeId]) }}"
                @else
                    "{{ route('test-specifications.index', $productId) }}"
                @endif,
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'specification_name',
                    name: 'specification_name'
                }, 
                @if($productGrade)
                {
                    data: 'grade_name',
                    name: 'grade_name'
                },
                @endif
                {
                    data: 'test_type',
                    name: 'test_type'
                }, {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }, ],
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "Showing 0 to 0 of 0 records",
                    "emptyTable": "No data available in table",
                    "paginate": {
                        "first": '<i class="first"></i>',
                        "last": '<i class="last"></i>',
                        "next": '<i class="next"></i>',
                        "previous": '<i class="previous"></i>'
                    },
                },
                "pageLength": 10,
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                "order": [
                    [0, 'asc']
                ],
                "drawCallback": function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    $('.dataTables_length select').addClass(
                        'form-select form-select-sm form-select-solid');
                    $('.dataTables_filter input').addClass('form-control form-control-solid');
                }
            });

            // Delete test spec
            $(document).on('click', '[data-kt-action="test_spec_remove"]', function(e) {
                e.preventDefault();

                const button = $(this);
                const testSpecId = button.data('id');
                const testSpecName = button.data('name');

                Swal.fire({
                    text: "Are you sure you want to delete " + testSpecName + "?",
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
                            url: "/test-specifications/" + testSpecId,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "You have deleted " + testSpecName + "!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: "Error deleting " + testSpecName + ".",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: testSpecName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        });

        // Handle form submission
        $('#kt_modal_add_customer_form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('test-specifications.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Test specification has been successfully added!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        $('#kt_modal_add_customer_form')[0].reset();
                        $('#kt_modal_add_customer').modal('hide');
                        $('#kt_datatable_example_1').DataTable().ajax.reload();
                    });
                },
                error: function(xhr) {
                    $('.fv-plugins-message-container').html('').removeClass('d-block');
                    $('.is-invalid').removeClass('is-invalid');

                    var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                    let firstError = "Sorry, it looks like there are some errors detected. Please try again.";

                    if (errors) {
                        for (let key in errors) {
                            if (errors[key] && errors[key][0]) {
                                firstError = errors[key][0];
                                break;
                            }
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        firstError = xhr.responseJSON.message;
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
                            } else {
                                var field = $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]');
                                if (field.length) {
                                    var container = $('<div class="fv-plugins-message-container invalid-feedback d-block" id="' + key + '-error">' + value[0] + '</div>');
                                    field.after(container);
                                    field.addClass('is-invalid');
                                }
                            }
                        });
                    }
                }
            });
        });

        // Function to open edit modal
        function editTestSpec(id) {
            $('#kt_customers_edit_form')[0].reset();
            $('.fv-plugins-message-container').html('').removeClass('d-block');
            $('.is-invalid').removeClass('is-invalid');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/test-specifications/edit/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const testSpec = response;

                    $('#edit_id').val(testSpec.id);
                    $('#edit_specification_id').val(testSpec.specification_id).trigger('change');
                    $('#edit_test_type').val(testSpec.test_type).trigger('change');

                    $('#kt_customers_edit_modal').modal('show');

                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading test specification details.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        }

        // Handle edit form submission
        $('#kt_customers_edit_form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var testSpecId = $('#edit_id').val();
            formData.append('_method', 'PUT');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/test-specifications/" + testSpecId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Test specification has been successfully updated!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        $('#kt_customers_edit_modal').modal('hide');
                        $('#kt_datatable_example_1').DataTable().ajax.reload();
                    });

                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                error: function(xhr) {
                    $('.fv-plugins-message-container').html('').removeClass('d-block');
                    $('.is-invalid').removeClass('is-invalid');

                    var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                    let firstError = "Sorry, it looks like there are some errors detected. Please try again.";

                    if (errors) {
                        for (let key in errors) {
                            if (errors[key] && errors[key][0]) {
                                firstError = errors[key][0];
                                break;
                            }
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        firstError = xhr.responseJSON.message;
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
                            } else {
                                var field = $('input[name="' + key + '"], textarea[name="' + key + '"], select[name="' + key + '"]');
                                if (field.length) {
                                    var container = $('<div class="fv-plugins-message-container invalid-feedback d-block" id="' + key + '-error">' + value[0] + '</div>');
                                    field.after(container);
                                    field.addClass('is-invalid');
                                }
                            }
                        });
                    }

                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        });

        // Add click handler for edit buttons
        $(document).on('click', '.edit-test-spec', function() {
            const id = $(this).data('id');
            editTestSpec(id);
        });

        // Function to view test spec details
        function viewTestSpec(id) {
            $.ajax({
                url: "/test-specifications/show/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const testSpec = response;

                    $('#view_id').val(testSpec.id);
                    $('#view_specification').val(testSpec.specification ? testSpec.specification.specification : 'N/A');
                    $('#view_test_type').val(testSpec.test_type || 'N/A');

                    $('#kt_customers_view_modal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading test specification details.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        }

        // Add click handler for view buttons
        $(document).on('click', '.view-test-spec', function() {
            const id = $(this).data('id');
            viewTestSpec(id);
        });

        // Clear errors when user starts typing
        $(document).on('input', 'input, textarea, select', function() {
            var fieldName = $(this).attr('name');
            if (fieldName) {
                $(this).removeClass('is-invalid');
                $('#' + fieldName + '-error').html('').removeClass('d-block');
            }
        });

        // Handle view test templates button click
        $(document).on('click', '.view-test-templates', function() {
            const testSpecificationId = $(this).data('id');
            window.location.href = '/test-templates/' + testSpecificationId;
        });
    </script>
@endsection

