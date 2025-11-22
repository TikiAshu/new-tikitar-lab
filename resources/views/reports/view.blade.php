@extends('layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">View Report</h1>
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
                        <li class="breadcrumb-item text-dark">View</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}" class="btn btn-sm btn-light">Back</a>
                    <a href="{{ route('batches.results.reports.edit', ['batch' => $batch->id, 'result' => $reportVersion->id, 'report' => $report->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('batches.results.reports.generate-pdf', ['batch' => $batch->id, 'result' => $reportVersion->id, 'report' => $report->id]) }}" class="btn btn-sm btn-danger">Generate PDF</a>
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
                                <span class="card-label fw-bold fs-3 mb-1">Report Details</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Report Code: {{ $report->report_code ?? 'N/A' }} |
                                    Batch: {{ $batch->batch_number ?? 'N/A' }}
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <!-- Basic Information -->
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Certificate Title</label>
                                    <div class="fw-semibold">{{ $report->certification ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Quantity</label>
                                    <div class="fw-semibold">{{ $report->quantity ?? 'N/A' }} {{ $report->unit ?? '' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Date Issue</label>
                                    <div class="fw-semibold">{{ $report->date_issue ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Client Type</label>
                                    <div class="fw-semibold">{{ ucfirst($report->client_type ?? 'N/A') }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Client</label>
                                    <div class="fw-semibold">{{ $report->client ? $report->client->company_name : 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Project</label>
                                    <div class="fw-semibold">{{ $report->project ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Truck No.</label>
                                    <div class="fw-semibold">{{ $report->truck_no ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Invoice No.</label>
                                    <div class="fw-semibold">{{ $report->invoice_no ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Tech. Manager</label>
                                    <div class="fw-semibold">
                                        {{ $report->assign ? $report->assign->first_name . ' ' . $report->assign->last_name : 'N/A' }}
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Show Report Code</label>
                                    <div class="fw-semibold">
                                        <span class="badge badge-{{ $report->show_report_code === 'Yes' ? 'success' : 'secondary' }}">
                                            {{ $report->show_report_code ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <!-- Contact Information -->
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <h4 class="fw-bold mb-5">Contact Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Party Ref</label>
                                        <div class="fw-semibold">{{ $report->party_ref ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Address</label>
                                        <div class="fw-semibold">{{ $report->address ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Phone</label>
                                        <div class="fw-semibold">{{ $report->phone ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Fax</label>
                                        <div class="fw-semibold">{{ $report->fax ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Email</label>
                                        <div class="fw-semibold">{{ $report->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <!-- Additional Information -->
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Show Logo</label>
                                    <div class="fw-semibold">
                                        <span class="badge badge-{{ $report->show_logo === 'Yes' ? 'success' : 'secondary' }}">
                                            {{ $report->show_logo ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Employee</label>
                                    <div class="fw-semibold">
                                        {{ $report->employee ? $report->employee->first_name . ' ' . $report->employee->last_name : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">NABL Report</label>
                                    <div class="fw-semibold">{{ $report->nabl_report ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">ULR Number</label>
                                    <div class="fw-semibold">{{ $report->ulr_number ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="separator separator-dashed my-10"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}" class="btn btn-light">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

