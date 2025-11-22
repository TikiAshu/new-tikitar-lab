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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Clients</h1>
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
                        <li class="breadcrumb-item text-dark">Clients</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">Clients</span>
                            </h3>
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
                                    Add Client
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
                                    <th>Client Type</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>City</th>
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
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Client Type</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select client type" name="client_type" required>
                                    <option></option>
                                    <option value="external" selected>External</option>
                                    <option value="internal">Internal</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="client_type-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Company Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Company name"
                                    name="company_name" />
                                <div class="fv-plugins-message-container invalid-feedback" id="company_name-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Contact Person</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Contact person name"
                                    name="contact_person" />
                                <div class="fv-plugins-message-container invalid-feedback" id="contact_person-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Email</label>
                                <input type="email" class="form-control form-control-solid" placeholder="Email address"
                                    name="email" />
                                <div class="fv-plugins-message-container invalid-feedback" id="email-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Mobile</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Mobile number"
                                    name="mobile" />
                                <div class="fv-plugins-message-container invalid-feedback" id="mobile-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Phone Number</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Phone number"
                                    name="phone_number" />
                                <div class="fv-plugins-message-container invalid-feedback" id="phone_number-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Address</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Address"
                                    name="address" />
                                <div class="fv-plugins-message-container invalid-feedback" id="address-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">City</label>
                                <input type="text" class="form-control form-control-solid" placeholder="City" name="city" />
                                <div class="fv-plugins-message-container invalid-feedback" id="city-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">State</label>
                                <input type="text" class="form-control form-control-solid" placeholder="State" name="state" />
                                <div class="fv-plugins-message-container invalid-feedback" id="state-error"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold mb-2">Country</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Country" name="country" />
                                <div class="fv-plugins-message-container invalid-feedback" id="country-error"></div>
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
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">Edit {{ $masterName }}</h2>
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
                        
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Client Type</label>
                            <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select client type" id="edit_client_type" name="client_type" required>
                                <option></option>
                                <option value="external">External</option>
                                <option value="internal">Internal</option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="client_type-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Company Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Company name"
                                id="edit_company_name" name="company_name" />
                            <div class="fv-plugins-message-container invalid-feedback" id="company_name-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Contact Person</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Contact person name"
                                id="edit_contact_person" name="contact_person" />
                            <div class="fv-plugins-message-container invalid-feedback" id="contact_person-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Email</label>
                            <input type="email" class="form-control form-control-solid" placeholder="Email address"
                                id="edit_email" name="email" />
                            <div class="fv-plugins-message-container invalid-feedback" id="email-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Mobile</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Mobile number"
                                id="edit_mobile" name="mobile" />
                            <div class="fv-plugins-message-container invalid-feedback" id="mobile-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Phone Number</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Phone number"
                                id="edit_phone_number" name="phone_number" />
                            <div class="fv-plugins-message-container invalid-feedback" id="phone_number-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Address</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Address"
                                id="edit_address" name="address" />
                            <div class="fv-plugins-message-container invalid-feedback" id="address-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">City</label>
                            <input type="text" class="form-control form-control-solid" placeholder="City"
                                id="edit_city" name="city" />
                            <div class="fv-plugins-message-container invalid-feedback" id="city-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">State</label>
                            <input type="text" class="form-control form-control-solid" placeholder="State"
                                id="edit_state" name="state" />
                            <div class="fv-plugins-message-container invalid-feedback" id="state-error"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Country</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Country"
                                id="edit_country" name="country" />
                            <div class="fv-plugins-message-container invalid-feedback" id="country-error"></div>
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
                    <h2 class="fw-bolder">View {{ $masterName }}</h2>
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
                            <label class="fs-6 fw-bold mb-2">Client Type</label>
                            <input type="text" class="form-control form-control-solid" id="view_client_type"
                                name="view_client_type" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Company Name</label>
                            <input type="text" class="form-control form-control-solid" id="view_company_name"
                                name="view_company_name" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Contact Person</label>
                            <input type="text" class="form-control form-control-solid" id="view_contact_person"
                                name="view_contact_person" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Email</label>
                            <input type="email" class="form-control form-control-solid" id="view_email"
                                name="view_email" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Mobile</label>
                            <input type="text" class="form-control form-control-solid" id="view_mobile"
                                name="view_mobile" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Phone Number</label>
                            <input type="text" class="form-control form-control-solid" id="view_phone_number"
                                name="view_phone_number" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Address</label>
                            <input type="text" class="form-control form-control-solid" id="view_address"
                                name="view_address" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">City</label>
                            <input type="text" class="form-control form-control-solid" id="view_city"
                                name="view_city" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">State</label>
                            <input type="text" class="form-control form-control-solid" id="view_state"
                                name="view_state" disabled />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">Country</label>
                            <input type="text" class="form-control form-control-solid" id="view_country"
                                name="view_country" disabled />
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
                ajax: "{{ route('clients.index') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'client_type_text',
                    name: 'client_type_text'
                }, {
                    data: 'company_name',
                    name: 'company_name'
                }, {
                    data: 'contact_person',
                    name: 'contact_person'
                }, {
                    data: 'email',
                    name: 'email'
                }, {
                    data: 'mobile',
                    name: 'mobile'
                }, {
                    data: 'city',
                    name: 'city'
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

            // Delete client
            $(document).on('click', '[data-kt-action="client_remove"]', function(e) {
                e.preventDefault();

                const button = $(this);
                const clientId = button.data('id');
                const clientName = button.data('name');

                Swal.fire({
                    text: "Are you sure you want to delete " + clientName + "?",
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
                            url: "/clients/" + clientId,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "You have deleted " + clientName + "!",
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
                                    text: "Error deleting " + clientName + ".",
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
                            text: clientName + " was not deleted.",
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
                url: "{{ route('clients.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Client has been successfully added!",
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
        function editClient(id) {
            $('#kt_customers_edit_form')[0].reset();
            $('.fv-plugins-message-container').html('').removeClass('d-block');
            $('.is-invalid').removeClass('is-invalid');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/clients/" + id + "/edit",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const client = response;

                    $('#edit_id').val(client.id);
                    $('#edit_client_type').val(client.client_type).trigger('change');
                    $('#edit_company_name').val(client.company_name);
                    $('#edit_contact_person').val(client.contact_person);
                    $('#edit_email').val(client.email);
                    $('#edit_mobile').val(client.mobile);
                    $('#edit_phone_number').val(client.phone_number);
                    $('#edit_address').val(client.address);
                    $('#edit_city').val(client.city);
                    $('#edit_state').val(client.state);
                    $('#edit_country').val(client.country);

                    $('#kt_customers_edit_modal').modal('show');

                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading client details.",
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
            var clientId = $('#edit_id').val();
            formData.append('_method', 'PUT');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/clients/" + clientId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Client has been successfully updated!",
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
        $(document).on('click', '.edit-client', function() {
            const id = $(this).data('id');
            editClient(id);
        });

        // Function to view client details
        function viewClient(id) {
            $.ajax({
                url: "/clients/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const client = response;

                    $('#view_id').val(client.id);
                    $('#view_client_type').val(client.client_type ? client.client_type.charAt(0).toUpperCase() + client.client_type.slice(1) : '');
                    $('#view_company_name').val(client.company_name);
                    $('#view_contact_person').val(client.contact_person);
                    $('#view_email').val(client.email);
                    $('#view_mobile').val(client.mobile);
                    $('#view_phone_number').val(client.phone_number);
                    $('#view_address').val(client.address);
                    $('#view_city').val(client.city);
                    $('#view_state').val(client.state);
                    $('#view_country').val(client.country);

                    $('#kt_customers_view_modal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading client details.",
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
        $(document).on('click', '.view-client', function() {
            const id = $(this).data('id');
            viewClient(id);
        });

        // Clear errors when user starts typing
        $(document).on('input', 'input, textarea, select', function() {
            var fieldName = $(this).attr('name');
            if (fieldName) {
                $(this).removeClass('is-invalid');
                $('#' + fieldName + '-error').html('').removeClass('d-block');
            }
        });
    </script>
@endsection

