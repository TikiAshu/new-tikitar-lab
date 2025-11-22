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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Test Reports</h1>
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
                        <li class="breadcrumb-item text-dark">Test Reports</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">Test Reports</span>
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
                                    Add Test Report
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
                                    <th>Batch</th>
                                    <th>Product</th>
                                    <th>Specification</th>
                                    <th>Total Quantity</th>
                                    <th>Available Quantity (QA)</th>
                                    <th>Available Quantity (QC)</th>
                                    {{-- <th>Date Receipt</th> --}}
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
        <div class="modal-dialog modal-dialog-centered mw-1000px">
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

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Product</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a product" name="product_id">
                                        <option></option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="product_id-error"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Specification</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a specification" name="specification_id">
                                        <option></option>
                                        @foreach($specifications as $specification)
                                            <option value="{{ $specification->id }}">{{ $specification->specification }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="specification_id-error"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Factory</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a factory" name="factory_id">
                                        <option></option>
                                        @foreach($factories as $factory)
                                            <option value="{{ $factory->id }}">{{ $factory->factory_location }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="factory_id-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Lab</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a lab" name="lab_id">
                                        <option></option>
                                        @foreach($labs as $lab)
                                            <option value="{{ $lab->id }}">{{ $lab->lab_location }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="lab_id-error"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Date Receipt</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Date receipt"
                                        name="date_receipt" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="date_receipt-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Quantity</label>
                                    <input type="number" step="any" class="form-control form-control-solid" placeholder="Quantity"
                                        name="quantity" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="quantity-error"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Unit</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Unit"
                                        name="unit" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="unit-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Sample Stage</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a sample stage" name="sample_condition">
                                        <option></option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Final">Final</option>
                                    </select>
                                    {{-- <input type="text" class="form-control form-control-solid" placeholder="Sample condition"
                                        name="sample_condition" /> --}}
                                    <div class="fv-plugins-message-container invalid-feedback" id="sample_condition-error"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Sample Type</label>
                                    {{-- <input type="text" class="form-control form-control-solid" placeholder="Sample"
                                        name="sample" required /> --}}
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a sample type" name="sample">
                                        <option></option>
                                        <option value="FG">Finished Good(FG)</option>
                                        <option value="RM">Raw Material(RM)</option>
                                        <option value="TS">Test Sample(TS)</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="sample-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Tested By</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a chemist" name="chemist_id">
                                        <option></option>
                                        @foreach($chemistEmployees as $chemist)
                                            <option value="{{ $chemist->id }}">{{ $chemist->first_name }} {{ $chemist->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Approved By</label>
                                    <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a approved by" name="approved_id">
                                        <option></option>
                                        @foreach($nonChemistEmployees as $nonChemist)
                                            <option value="{{ $nonChemist->id }}">{{ $nonChemist->first_name }} {{ $nonChemist->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback" id="approved_id-error"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            {{-- <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Batch Number</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Batch number"
                                        name="batch_number" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="batch_number-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Date Performance</label>
                                    <input type="date" class="form-control form-control-solid" name="date_perfomance" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="date_perfomance-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Test Type</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Test type"
                                        name="test_type" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="test_type-error"></div>
                                </div>
                            </div>
                            <!--end::Row--> --}}

                            {{-- <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold mb-2">Batch Status</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Batch status"
                                        name="batch_status" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="batch_status-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Product Grade ID</label>
                                    <input type="number" class="form-control form-control-solid" placeholder="Product grade ID"
                                        name="product_grade_id" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="product_grade_id-error"></div>
                                </div>
                            </div>
                            <!--end::Row--> --}}

                            {{-- <!--begin::Row-->
                            <div class="row mb-7">
                                <div class="col-md-4">
                                    <label class="required fs-6 fw-bold mb-2">Employee ID</label>
                                    <input type="number" class="form-control form-control-solid" placeholder="Employee ID"
                                        name="employee_id" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="employee_id-error"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="required fs-6 fw-bold mb-2">Approved ID</label>
                                    <input type="number" class="form-control form-control-solid" placeholder="Approved ID"
                                        name="approved_id" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="approved_id-error"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="required fs-6 fw-bold mb-2">Reports ID</label>
                                    <input type="number" class="form-control form-control-solid" placeholder="Reports ID"
                                        name="reports_id" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="reports_id-error"></div>
                                </div>
                            </div>
                            <!--end::Row--> --}}

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
        <div class="modal-dialog modal-dialog-centered mw-1000px">
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

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Product</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a product" id="edit_product_id" name="product_id">
                                    <option></option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="product_id-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Product Grade ID</label>
                                <input type="number" class="form-control form-control-solid" placeholder="Product grade ID"
                                    id="edit_product_grade_id" name="product_grade_id" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="product_grade_id-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Specification</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a specification" id="edit_specification_id" name="specification_id">
                                    <option></option>
                                    @foreach($specifications as $specification)
                                        <option value="{{ $specification->id }}">{{ $specification->specification }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="specification_id-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Test Type</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Test type"
                                    id="edit_test_type" name="test_type" />
                                <div class="fv-plugins-message-container invalid-feedback" id="test_type-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Factory</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a factory" id="edit_factory_id" name="factory_id">
                                    <option></option>
                                    @foreach($factories as $factory)
                                        <option value="{{ $factory->id }}">{{ $factory->factory_location }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="factory_id-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Lab</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a lab" id="edit_lab_id" name="lab_id">
                                    <option></option>
                                    @foreach($labs as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->lab_location }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="lab_id-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Batch Number</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Batch number"
                                    id="edit_batch_number" name="batch_number" />
                                <div class="fv-plugins-message-container invalid-feedback" id="batch_number-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Date Receipt</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Date receipt"
                                    id="edit_date_receipt" name="date_receipt" />
                                <div class="fv-plugins-message-container invalid-feedback" id="date_receipt-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Date Performance</label>
                                <input type="date" class="form-control form-control-solid" id="edit_date_perfomance" name="date_perfomance" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="date_perfomance-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Quantity</label>
                                <input type="number" step="any" class="form-control form-control-solid" placeholder="Quantity"
                                    id="edit_quantity" name="quantity" />
                                <div class="fv-plugins-message-container invalid-feedback" id="quantity-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Unit</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Unit"
                                    id="edit_unit" name="unit" />
                                <div class="fv-plugins-message-container invalid-feedback" id="unit-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Sample Stage</label>
                                {{-- <input type="text" class="form-control form-control-solid" placeholder="Sample condition"
                                    id="edit_sample_condition" name="sample_condition" /> --}}
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a sample stage" id="edit_sample_condition" name="sample_condition">
                                    <option></option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Final">Final</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="sample_condition-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Sample</label>
                                <select class="form-select form-control-solid" data-control="select2" data-placeholder="Select a sample type" id="edit_sample" name="sample">
                                    <option></option>
                                    <option value="FG">Finished Good(FG)</option>
                                    <option value="RM">Raw Material(RM)</option>
                                    <option value="TS">Test Sample(TS)</option>
                                </select>
                                {{-- <input type="text" class="form-control form-control-solid" placeholder="Sample"
                                    id="edit_sample" name="sample" required /> --}}
                                <div class="fv-plugins-message-container invalid-feedback" id="sample-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Batch Status</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Batch status"
                                    id="edit_batch_status" name="batch_status" />
                                <div class="fv-plugins-message-container invalid-feedback" id="batch_status-error"></div>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-4">
                                <label class="required fs-6 fw-bold mb-2">Employee ID</label>
                                <input type="number" class="form-control form-control-solid" placeholder="Employee ID"
                                    id="edit_employee_id" name="employee_id" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="employee_id-error"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="required fs-6 fw-bold mb-2">Approved ID</label>
                                <input type="number" class="form-control form-control-solid" placeholder="Approved ID"
                                    id="edit_approved_id" name="approved_id" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="approved_id-error"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="required fs-6 fw-bold mb-2">Reports ID</label>
                                <input type="number" class="form-control form-control-solid" placeholder="Reports ID"
                                    id="edit_reports_id" name="reports_id" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="reports_id-error"></div>
                            </div>
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
        <div class="modal-dialog modal-dialog-centered mw-1000px">
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

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Product</label>
                                <input type="text" class="form-control form-control-solid" id="view_product"
                                    name="view_product" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Product Grade ID</label>
                                <input type="text" class="form-control form-control-solid" id="view_product_grade_id"
                                    name="view_product_grade_id" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Specification</label>
                                <input type="text" class="form-control form-control-solid" id="view_specification"
                                    name="view_specification" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Test Type</label>
                                <input type="text" class="form-control form-control-solid" id="view_test_type"
                                    name="view_test_type" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Factory</label>
                                <input type="text" class="form-control form-control-solid" id="view_factory"
                                    name="view_factory" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Lab</label>
                                <input type="text" class="form-control form-control-solid" id="view_lab"
                                    name="view_lab" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Batch Number</label>
                                <input type="text" class="form-control form-control-solid" id="view_batch_number"
                                    name="view_batch_number" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Date Receipt</label>
                                <input type="text" class="form-control form-control-solid" id="view_date_receipt"
                                    name="view_date_receipt" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Date Performance</label>
                                <input type="text" class="form-control form-control-solid" id="view_date_perfomance"
                                    name="view_date_perfomance" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Quantity</label>
                                <input type="text" class="form-control form-control-solid" id="view_quantity"
                                    name="view_quantity" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Unit</label>
                                <input type="text" class="form-control form-control-solid" id="view_unit"
                                    name="view_unit" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Sample Condition</label>
                                <input type="text" class="form-control form-control-solid" id="view_sample_condition"
                                    name="view_sample_condition" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Sample</label>
                                <input type="text" class="form-control form-control-solid" id="view_sample"
                                    name="view_sample" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Batch Status</label>
                                <input type="text" class="form-control form-control-solid" id="view_batch_status"
                                    name="view_batch_status" disabled />
                            </div>
                        </div>

                        <div class="row mb-7">
                            <div class="col-md-4">
                                <label class="fs-6 fw-bold mb-2">Employee ID</label>
                                <input type="text" class="form-control form-control-solid" id="view_employee_id"
                                    name="view_employee_id" disabled />
                            </div>
                            <div class="col-md-4">
                                <label class="fs-6 fw-bold mb-2">Approved ID</label>
                                <input type="text" class="form-control form-control-solid" id="view_approved_id"
                                    name="view_approved_id" disabled />
                            </div>
                            <div class="col-md-4">
                                <label class="fs-6 fw-bold mb-2">Reports ID</label>
                                <input type="text" class="form-control form-control-solid" id="view_reports_id"
                                    name="view_reports_id" disabled />
                            </div>
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
                ajax: "{{ route('batch.index') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'batch_number',
                    name: 'batch_number'
                }, {
                    data: 'product_name',
                    name: 'product_name'
                }, {
                    data: 'specification_name',
                    name: 'specification_name'
                }, {
                    data: 'total_quantity',
                    name: 'total_quantity'
                }, {
                    data: 'available_quantity',
                    name: 'available_quantity'
                }, {
                    data: 'available_quantity_qc',
                    name: 'available_quantity_qc'
                // }, {
                //     data: 'date_receipt',
                //     name: 'date_receipt'
                // }, {
                //     data: 'test_type',
                //     name: 'test_type'
                // }, {
                //     data: 'sample',
                //     name: 'sample'
                // }, {
                //     data: 'date_perfomance',
                //     name: 'date_perfomance'
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

            // Delete batch
            $(document).on('click', '[data-kt-action="batch_remove"]', function(e) {
                e.preventDefault();

                const button = $(this);
                const batchId = button.data('id');
                const batchName = button.data('name');

                Swal.fire({
                    text: "Are you sure you want to delete " + batchName + "?",
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
                            url: "/batch/" + batchId,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: "You have deleted " + batchName + "!",
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
                                    text: "Error deleting " + batchName + ".",
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
                            text: batchName + " was not deleted.",
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
                url: "{{ route('batch.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Batch has been successfully added!",
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
        function editBatch(id) {
            $('#kt_customers_edit_form')[0].reset();
            $('.fv-plugins-message-container').html('').removeClass('d-block');
            $('.is-invalid').removeClass('is-invalid');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/batch/" + id + "/edit",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const batch = response;

                    $('#edit_id').val(batch.id);
                    $('#edit_product_id').val(batch.product_id).trigger('change');
                    $('#edit_product_grade_id').val(batch.product_grade_id);
                    $('#edit_specification_id').val(batch.specification_id).trigger('change');
                    $('#edit_test_type').val(batch.test_type);
                    $('#edit_factory_id').val(batch.factory_id).trigger('change');
                    $('#edit_lab_id').val(batch.lab_id).trigger('change');
                    $('#edit_batch_number').val(batch.batch_number);
                    $('#edit_date_receipt').val(batch.date_receipt);
                    $('#edit_date_perfomance').val(batch.date_perfomance);
                    $('#edit_quantity').val(batch.quantity);
                    $('#edit_unit').val(batch.unit);
                    $('#edit_sample_condition').val(batch.sample_condition).trigger('change');
                    $('#edit_sample').val(batch.sample).trigger('change');
                    $('#edit_batch_status').val(batch.batch_status);
                    $('#edit_employee_id').val(batch.employee_id);
                    $('#edit_approved_id').val(batch.approved_id);
                    $('#edit_reports_id').val(batch.reports_id);

                    $('#kt_customers_edit_modal').modal('show');

                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading batch details.",
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
            var batchId = $('#edit_id').val();
            formData.append('_method', 'PUT');

            const submitButton = document.querySelector('#kt_customers_edit_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            $.ajax({
                url: "/batch/" + batchId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        text: "Batch has been successfully updated!",
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
        $(document).on('click', '.edit-batch', function() {
            const id = $(this).data('id');
            editBatch(id);
        });

        // Function to view batch details
        function viewBatch(id) {
            $.ajax({
                url: "/batch/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    const batch = response;

                    $('#view_id').val(batch.id);
                    $('#view_product').val(batch.product ? batch.product.product_name : 'N/A');
                    $('#view_product_grade_id').val(batch.product_grade_id);
                    $('#view_specification').val(batch.specification ? batch.specification.specification : 'N/A');
                    $('#view_test_type').val(batch.test_type);
                    $('#view_factory').val(batch.factory ? batch.factory.factory_location : 'N/A');
                    $('#view_lab').val(batch.lab ? batch.lab.lab_location : 'N/A');
                    $('#view_batch_number').val(batch.batch_number);
                    $('#view_date_receipt').val(batch.date_receipt);
                    $('#view_date_perfomance').val(batch.date_perfomance);
                    $('#view_quantity').val(batch.quantity);
                    $('#view_unit').val(batch.unit);
                    $('#view_sample_condition').val(batch.sample_condition);
                    $('#view_sample').val(batch.sample);
                    $('#view_batch_status').val(batch.batch_status);
                    $('#view_employee_id').val(batch.employee_id);
                    $('#view_approved_id').val(batch.approved_id);
                    $('#view_reports_id').val(batch.reports_id);

                    $('#kt_customers_view_modal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire({
                        text: "Error loading batch details.",
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
        $(document).on('click', '.view-batch', function() {
            const id = $(this).data('id');
            viewBatch(id);
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

