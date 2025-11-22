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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Products</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Products</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">Products</span>
                            </h3>
                            {{-- <div class="d-flex align-items-center position-relative my-1 ms-4">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor">
                                        </rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <input type="text" id="search" class="form-control form-control-solid w-250px ps-14"
                                    placeholder="Search products">
                            </div> --}}
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end">
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
                                    Add Product
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
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via Ajax -->
                            </tbody>
                            {{-- <tfoot>
                            <tr class="fw-bold fs-6 text-muted">
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot> --}}
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

    <!--begin::Modal - Customers - Add-->
    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" novalidate="novalidate" id="kt_modal_add_customer_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Add a {{ $masterName }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                            data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
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
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Product Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Product title"
                                    name="product_name" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                <div class="fv-plugins-message-container invalid-feedback" id="product_name-error"></div>
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Product Code</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Product code" name="product_code" />
                                <!--end::Input-->
                                <!--begin::Error-->
                                <div class="fv-plugins-message-container invalid-feedback" id="product_code-error"></div>
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid" rows="3" name="description"
                                    placeholder="Product description"></textarea>
                                <!--end::Input-->
                                <!--begin::Error-->
                                <div class="fv-plugins-message-container invalid-feedback" id="description-error"></div>
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Product Grade (0-1)</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select an option" name="grade" required>
                                    <option></option>
                                    <option value="0">No</option>
                                    <option value="1" selected>Yes</option>
                                </select>
                                <!--end::Input-->
                                <!--begin::Error-->
                                <div class="fv-plugins-message-container invalid-feedback" id="grade-error"></div>
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_customer_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Customers - Add-->

    <!--begin::Modal - edit-->
    <div class="modal fade" id="kt_customers_edit_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Edit {{ $masterName }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_customers_edit_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                        data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_customers_edit_form"
                        enctype="multipart/form-data">
                        <input type="hidden" id="edit_id" name="edit_id" />
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Product Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Product title"
                                id="edit_product_name" name="product_name" required />
                            <!--end::Input-->
                            <!--begin::Error-->
                            <div class="fv-plugins-message-container invalid-feedback" id="product_name-error"></div>
                            <!--end::Error-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Product Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Product code"
                                id="edit_product_code" name="product_code" />
                            <!--end::Input-->
                            <!--begin::Error-->
                            <div class="fv-plugins-message-container invalid-feedback" id="product_code-error"></div>
                            <!--end::Error-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" rows="3" id="edit_description" name="description"
                                placeholder="Product description"></textarea>
                            <!--end::Input-->
                            <!--begin::Error-->
                            <div class="fv-plugins-message-container invalid-feedback" id="description-error"></div>
                            <!--end::Error-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Product Grade (0-1)</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select an option" name="edit_product_grade"  id="edit_product_grade" required>
                                <option></option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <!--end::Input-->
                            <!--begin::Error-->
                            <div class="fv-plugins-message-container invalid-feedback" id="edit_product_grade-error"></div>
                            <!--end::Error-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_customers_edit_cancel"
                                class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_customers_edit_submit" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - edit-->

    <!--begin::Modal - View-->
    <div class="modal fade" id="kt_customers_view_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">View {{ $masterName }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_customers_view_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                        data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_customers_view_form">
                        <input type="hidden" id="view_id" name="view_id" />
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Product Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" id="view_product_name"
                                name="view_product_name" disabled />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Product Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" id="view_product_code"
                                name="view_product_code" disabled />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" id="view_description" name="view_description" disabled></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Product Grade</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select an option" name="view_product_grade"  id="view_product_grade" disabled>
                                <option></option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_customers_view_cancel"
                                class="btn btn-light me-3">Close</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - View-->

    <!-- end::Modals -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable with proper styling
            var table = $("#kt_datatable_example_1").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'product_code',
                    name: 'product_code'
                }, {
                    data: 'product_name',
                    name: 'product_name'
                }, {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }, ],
                // Styling options for DataTables
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
                // Apply Bootstrap styling to DataTables elements
                "drawCallback": function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    $('.dataTables_length select').addClass(
                        'form-select form-select-sm form-select-solid');
                    $('.dataTables_filter input').addClass('form-control form-control-solid');
                }
            });

            // Use the DataTable search box instead of custom search
            $('#search').on('keyup', function() {
                table.search($(this).val()).draw();
            });

            // Delete product
            $(document).on('click', '[data-kt-action="product_remove"]', function(e) {
                e.preventDefault();

                const button = $(this);
                const productId = button.data('id');
                const productName = button.data('name');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + productName + "?",
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
                            // url: '/admin/products/delete/' + productId,
                            url: "/products/" + productId,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "You have deleted " + productName +
                                        "!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function() {
                                    // Reload the datatable
                                    table.ajax.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: "Error deleting " + productName + ".",
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
                            text: productName + " was not deleted.",
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

            // Create FormData object to handle file uploads
            var formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                url: "{{ route('products.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        text: "Product has been successfully added!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        // Reset form and close modal
                        $('#kt_modal_add_customer_form')[0].reset();
                        $('#kt_modal_add_customer').modal('hide');

                        // Reload the datatable
                        $('#kt_datatable_example_1').DataTable().ajax.reload();
                    });
                },
                error: function(xhr) {
                    // Clear previous errors
                    $('.fv-plugins-message-container').html('').removeClass('d-block');

                    // Display validation errors
                    var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors :
                        null;
                    let firstError =
                        "Sorry, it looks like there are some errors detected. Please try again.";

                    if (errors) {
                        // Get the first error message
                        for (let key in errors) {
                            if (errors[key] && errors[key][0]) {
                                firstError = errors[key][0];
                                break;
                            }
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        firstError = xhr.responseJSON.message;
                    }

                    if (firstError.includes('must not be greater than 2048 kilobytes')) {
                        firstError = "Each image must be less than 10MB.";
                    }

                    // Show error message in Swal
                    Swal.fire({
                        // text: "Sorry, it looks like there are some errors detected. Please try again.",
                        text: firstError,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    // Now display validation errors as before
                    if (errors) {
                        $.each(errors, function(key, value) {
                            // Handle array field errors (e.g., file_names.0, files.1)
                            var fieldName = key;
                            var arrayIndex = null;

                            if (key.includes('.')) {
                                var parts = key.split('.');
                                fieldName = parts[0];
                                arrayIndex = parts[1];
                            }

                            var errorContainer = $('#' + key + '-error');
                            if (errorContainer.length) {
                                errorContainer.html(value[0]).addClass('d-block');
                                // Add error class to the input field
                                $('input[name="' + key + '"], textarea[name="' + key +
                                    '"], select[name="' + key + '"]').addClass('is-invalid');
                            } else {
                                // Try to find the field by name attribute
                                var field = $('input[name="' + key + '"], textarea[name="' +
                                    key + '"], select[name="' + key + '"]');
                                if (field.length) {
                                    // Create error container if it doesn't exist
                                    var container = $(
                                        '<div class="fv-plugins-message-container invalid-feedback d-block" id="' +
                                        key + '-error">' + value[0] + '</div>');
                                    field.after(container);
                                    field.addClass('is-invalid');
                                }
                            }
                        });
                    }
                }
            });
        });

        // Function to open edit modal with product data
        function editProduct(id) {
            // Reset form
            $('#kt_customers_edit_form')[0].reset();

            // Clear previous errors
            $('.fv-plugins-message-container').html('').removeClass('d-block');
            $('.is-invalid').removeClass('is-invalid');

            // Show loading
            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            // Fetch product data
            $.ajax({
                // url: "/products/edit/" + id,
                url: "/products/" + id + "/edit",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const product = response;
                    console.log(product);

                    // Populate form fields
                    $('#edit_id').val(product.id);
                    $('#edit_product_name').val(product.product_name);
                    $('#edit_product_code').val(product.product_code);
                    $('#edit_description').val(product.description);
                    $('#edit_product_grade').val(product.grade).trigger('change');

                    $('#remove_edit_images').data('product-id', product.id);

                    // Set color and opacity fields
                    if (product.color) {
                        $("input[name='color']", '#kt_customers_edit_form').val(product.color);
                    } else {
                        $("input[name='color']", '#kt_customers_edit_form').val('#ffffff');
                    }
                    if (product.opacity !== undefined && product.opacity !== null) {
                        $("input[name='opacity']", '#kt_customers_edit_form').val(product.opacity);
                    } else {
                        $("input[name='opacity']", '#kt_customers_edit_form').val(1);
                    }

                    // Show modal
                    $('#kt_customers_edit_modal').modal('show');

                    // Enable submit button
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                // Rest of the code remains the same...
            });
        }

        // Handle edit form submission
        $('#kt_customers_edit_form').on('submit', function(e) {
            e.preventDefault();

            // Get TinyMCE content and set to textarea fields
            if (tinymce.get('edit_description')) {
                $('#edit_description').val(tinymce.get('edit_description').getContent());
            }
            if (tinymce.get('edit_factor')) {
                $('#edit_factor').val(tinymce.get('edit_factor').getContent());
            }

            // Create FormData object to handle file uploads
            var formData = new FormData(this);

            // Handle multiple image files properly
            var imageInput = $('input[name="edit_image"]')[0];
            var imageFiles = imageInput ? imageInput.files : [];

            // Remove the original image field from FormData
            formData.delete('edit_image');

            // Append each file with the correct name
            for (var i = 0; i < imageFiles.length; i++) {
                formData.append('edit_image[]', imageFiles[i]);
            }

            // Get variants data from repeater using repeaterVal()
            var repeaterData = $('#kt_product_variants_edit_repeater').repeaterVal();
            var variants = repeaterData.variants || [];

            // Make sure we have valid variants data
            if (variants.length === 0) {
                // Add at least one empty variant if none exists
                variants.push({
                    variant_id: '',
                    ref_no: '',
                    available_in: ''
                });
            }

            formData.append('variants', JSON.stringify(variants));

            // Add delete files data if any
            if (window.deleteFiles && window.deleteFiles.length > 0) {
                window.deleteFiles.forEach(function(fileId) {
                    formData.append('delete_files[]', fileId);
                });
            }

            // Show loading
            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            // Send AJAX request
            $.ajax({
                url: "/admin/products/update",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        text: "Product has been successfully updated!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        // Close modal
                        $('#kt_customers_edit_modal').modal('hide');

                        // Reload the datatable
                        $('#kt_datatable_example_1').DataTable().ajax.reload();
                    });

                    // Enable submit button
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                error: function(xhr) {
                    // Clear previous errors
                    $('.fv-plugins-message-container').html('').removeClass('d-block');

                    // Display validation errors
                    var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors :
                        null;
                    let firstError =
                        "Sorry, it looks like there are some errors detected. Please try again.";

                    if (errors) {
                        // Get the first error message
                        for (let key in errors) {
                            if (errors[key] && errors[key][0]) {
                                firstError = errors[key][0];
                                break;
                            }
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        firstError = xhr.responseJSON.message;
                    }

                    if (firstError.includes('must not be greater than 2048 kilobytes')) {
                        firstError = "Each image must be less than 10MB.";
                    }

                    // Show error message in Swal
                    Swal.fire({
                        // text: "Sorry, it looks like there are some errors detected. Please try again.",
                        text: firstError,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    // Now display validation errors as before
                    if (errors) {
                        $.each(errors, function(key, value) {
                            // Handle array field errors (e.g., file_names.0, files.1)
                            var fieldName = key;
                            var arrayIndex = null;

                            if (key.includes('.')) {
                                var parts = key.split('.');
                                fieldName = parts[0];
                                arrayIndex = parts[1];
                            }

                            var errorContainer = $('#' + key + '-error');
                            if (errorContainer.length) {
                                errorContainer.html(value[0]).addClass('d-block');
                                // Add error class to the input field
                                $('input[name="' + key + '"], textarea[name="' + key +
                                    '"], select[name="' + key + '"]').addClass('is-invalid');
                            } else {
                                // Try to find the field by name attribute
                                var field = $('input[name="' + key + '"], textarea[name="' +
                                    key + '"], select[name="' + key + '"]');
                                if (field.length) {
                                    // Create error container if it doesn't exist
                                    var container = $(
                                        '<div class="fv-plugins-message-container invalid-feedback d-block" id="' +
                                        key + '-error">' + value[0] + '</div>');
                                    field.after(container);
                                    field.addClass('is-invalid');
                                }
                            }
                        });
                    }

                    // Enable submit button
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        });

        // Add click handler for edit buttons in the table
        $(document).on('click', '.edit-product', function() {
            const id = $(this).data('id');
            editProduct(id);
        });

        // Function to view product details
        function viewProduct(id) {
            // Fetch product data
            $.ajax({
                url: "/products/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const product = response;
                    console.log(product);

                    // Set product details
                    $('#view_id').val(product.id);
                    $('#view_product_name').val(product.product_name);
                    $('#view_product_code').val(product.product_code);
                    $('#view_product_grade').val(product.grade).trigger('change');
                    $('#view_description').val(product.description);

                    // Show modal
                    $('#kt_customers_view_modal').modal('show');
                },
                error: function(xhr) {
                    console.error('Error loading product:', xhr);

                    // Show error message
                    Swal.fire({
                        text: "Error loading product details.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    // Enable button
                    viewButton.removeAttribute('data-kt-indicator');
                    viewButton.disabled = false;
                }
            });
        }

        // Add click handler for view buttons in the table
        $(document).on('click', '.view-product', function() {
            const id = $(this).data('id');
            viewProduct(id);
        });

        // Clear errors when user starts typing
        $(document).on('input', 'input, textarea, select', function() {
            var fieldName = $(this).attr('name');
            if (fieldName) {
                $(this).removeClass('is-invalid');
                $('#' + fieldName + '-error').html('').removeClass('d-block');
            }
        });

        // Toggle featured status
        $(document).on('click', '.toggle-featured', function() {
            var button = $(this);
            var productId = button.data('id');

            $.ajax({
                url: '/admin/products/toggle-featured/' + productId,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // Update icon and title
                        if (response.is_featured) {
                            button.html('<i class="bi bi-star-fill fs-4 text-warning"></i>');
                            button.attr('title', 'Unfeature');
                        } else {
                            button.html('<i class="bi bi-star fs-4"></i>');
                            button.attr('title', 'Feature');
                        }
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        });

        // Toggle active status
        $(document).on('click', '.toggle-active', function() {
            var button = $(this);
            var productId = button.data('id');

            $.ajax({
                url: '/admin/products/toggle-active/' + productId,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // Reload table to update status column
                        $('#kt_datatable_example_1').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        });

        // Handle view grades button click
        $(document).on('click', '.view-grades', function() {
            const productId = $(this).data('id');
            window.location.href = '/product-grades/' + productId;
        });

        // Handle view test specs button click (for products without grades)
        $(document).on('click', '.view-test-specs', function() {
            const productId = $(this).data('id');
            window.location.href = '/test-specifications/' + productId;
        });


    </script>
@endsection
