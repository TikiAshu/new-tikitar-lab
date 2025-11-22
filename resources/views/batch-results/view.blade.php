@extends('layouts.app')

@section('styles')
    <style>
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 0.475rem;
            font-weight: 600;
        }

        .status-draft { background: #fff3cd; color: #856404; }
        .status-review { background: #cfe2ff; color: #084298; }
        .status-approve { background: #d1e7dd; color: #0f5132; }
        .status-reject { background: #f8d7da; color: #842029; }
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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        View Test Result - {{ $reportVersion->test_type }}
                    </h1>
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
                        <li class="breadcrumb-item text-dark">View</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('batches.results.index', $batch->id) }}" class="btn btn-sm btn-light">Back</a>
                    <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}"
                        class="btn btn-sm btn-primary">Manage Reports</a>
                    @if($reportVersion->isApproved())
                        <a href="{{ route('batches.results.report', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}"
                            class="btn btn-sm btn-info">View Report</a>
                    @endif
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
                                <span class="card-label fw-bold fs-3 mb-1">
                                    {{ $reportVersion->test_type }} Test Result - Version {{ $reportVersion->version }}
                                </span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Batch: {{ $batch->batch_number ?? 'N/A' }} |
                                    Product: {{ $batch->product->product_name ?? 'N/A' }} |
                                    Specification: {{ $batch->specification->specification ?? 'N/A' }}
                                </span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <span class="status-badge status-{{ $reportVersion->report_status }}">
                                {{ ucfirst($reportVersion->report_status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <!-- Basic Information -->
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Start Date</label>
                                    <div class="fw-semibold">{{ $reportVersion->start_date ?? 'N/A' }}</div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Date Perform</label>
                                    <div class="fw-semibold">{{ $reportVersion->date_perform ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Test Type</label>
                                    <div class="fw-semibold">
                                        <span class="badge badge-{{ $reportVersion->test_type === 'NABL' ? 'success' : 'info' }}">
                                            {{ $reportVersion->test_type }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="fs-6 fw-bold text-muted mb-2">Status</label>
                                    <div class="fw-semibold">
                                        <span class="status-badge status-{{ $reportVersion->report_status }}">
                                            {{ ucfirst($reportVersion->report_status) }}
                                        </span>
                                    </div>
                                </div>
                                @if($reportVersion->approver)
                                    <div class="mb-5">
                                        <label class="fs-6 fw-bold text-muted mb-2">Approved By</label>
                                        <div class="fw-semibold">
                                            {{ $reportVersion->approver->first_name }} {{ $reportVersion->approver->last_name }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($reportVersion->chemist_comment)
                            <div class="separator separator-dashed my-10"></div>
                            <div class="mb-10">
                                <label class="fs-6 fw-bold text-muted mb-2">Chemist Comment</label>
                                <div class="p-5 bg-light-info rounded">
                                    {{ $reportVersion->chemist_comment }}
                                </div>
                            </div>
                        @endif

                        <!-- Test Results -->
                        <div class="separator separator-dashed my-10"></div>
                        <h3 class="fw-bold mb-5">Test Results</h3>

                        @php
                            // Debug info (remove in production)
                            $resultDetailsData = $reportVersion->resultDetailsData ?? collect();
                            $debugInfo = [
                                'total_result_details' => $resultDetailsData->count(),
                            ];
                        @endphp

                        @if(config('app.debug'))
                            <div class="alert alert-info mb-5">
                                <strong>Debug Info:</strong><br>
                                Total Result Details: {{ $debugInfo['total_result_details'] }}
                            </div>
                        @endif

                        @php
                            // Use the joined data from controller (similar to old PHP code)
                            $resultDetailsData = $reportVersion->resultDetailsData ?? collect();

                            // Helper function to format requirement (works with query builder results)
                            $formatRequirement = function($result) {
                                if (!$result || !isset($result->requirement_type) || !$result->requirement_type) {
                                    return '-';
                                }

                                $value = $result->requirement_value ?? '';
                                $units = $result->units ?? '';
                                $minimum = $result->minimum ?? 0;
                                $maximum = $result->maximum ?? 0;

                                if ($result->requirement_type == 'value') {
                                    return trim($value . ' ' . $units);
                                } elseif ($result->requirement_type == 'range') {
                                    return number_format($minimum, 3) . ' to ' . number_format($maximum, 3) . ' ' . $units;
                                } elseif ($result->requirement_type == 'plus-minus') {
                                    return trim($value . ' ± ' . number_format($minimum, 3) . ' ' . $units);
                                } elseif ($result->requirement_type == 'minimum') {
                                    return trim('≥ ' . $value . ' ' . $units);
                                } elseif ($result->requirement_type == 'maximum') {
                                    return trim('≤ ' . $value . ' ' . $units);
                                } else {
                                    return trim(($result->requirement_type ?? '') . ' ' . $value . ' ' . $units);
                                }
                            };

                            // Separate main parameters and sub-parameters (like old PHP code)
                            $mainResults = $resultDetailsData->where('test_sub_parameter_id', 0)->groupBy('test_parameter_id');
                            $subResults = $resultDetailsData->where('test_sub_parameter_id', '!=', 0)->groupBy('test_parameter_id');

                            // Build flat array for table display
                            $tableRows = [];

                            // Process main parameters first
                            foreach($mainResults as $testParameterId => $results) {
                                $mainResult = $results->first();

                                if ($mainResult) {
                                    $parameterName = $mainResult->test_parameter ?? 'Parameter ID: ' . $testParameterId;
                                    $requirementText = $formatRequirement($mainResult);
                                    $testMethodName = $mainResult->test_method_title ?? '-';

                                    $tableRows[] = [
                                        'parameter' => $parameterName,
                                        'requirement' => $requirementText,
                                        'result' => $mainResult->result ?? '-',
                                        'test_method' => $testMethodName,
                                        'comment' => $mainResult->comment ?? '-',
                                        'is_sub' => false,
                                        'parameter_id' => $testParameterId
                                    ];

                                    // Add sub-parameters for this main parameter
                                    if (isset($subResults[$testParameterId])) {
                                        foreach($subResults[$testParameterId] as $subResult) {
                                            $subParameterName = $subResult->sub_parameter_name ?? 'Sub-Parameter ID: ' . $subResult->test_sub_parameter_id;
                                            $requirementText = $formatRequirement($subResult);
                                            $testMethodName = $subResult->test_method_title ?? '-';

                                            $tableRows[] = [
                                                'parameter' => $subParameterName,
                                                'requirement' => $requirementText,
                                                'result' => $subResult->result ?? '-',
                                                'test_method' => $testMethodName,
                                                'comment' => $subResult->comment ?? '-',
                                                'is_sub' => true,
                                                'parameter_id' => $testParameterId
                                            ];
                                        }
                                    }
                                }
                            }

                            // If no main results but we have sub-results, show them
                            if (empty($tableRows) && $subResults->isNotEmpty()) {
                                foreach($subResults as $testParameterId => $results) {
                                    foreach($results as $subResult) {
                                        $subParameterName = $subResult->sub_parameter_name ?? 'Sub-Parameter ID: ' . $subResult->test_sub_parameter_id;
                                        $requirementText = $formatRequirement($subResult);
                                        $testMethodName = $subResult->test_method_title ?? '-';

                                        $tableRows[] = [
                                            'parameter' => $subParameterName,
                                            'requirement' => $requirementText,
                                            'result' => $subResult->result ?? '-',
                                            'test_method' => $testMethodName,
                                            'comment' => $subResult->comment ?? '-',
                                            'is_sub' => true,
                                            'parameter_id' => $testParameterId
                                        ];
                                    }
                                }
                            }
                        @endphp

                        @if(count($tableRows) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fw-bold">Parameters</th>
                                            <th class="fw-bold">Requirements</th>
                                            <th class="fw-bold">Result</th>
                                            <th class="fw-bold">Test Methods</th>
                                            <th class="fw-bold">Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tableRows as $row)
                                            <tr>
                                                <td class="{{ $row['is_sub'] ? 'ps-5 fst-italic' : 'fw-semibold' }}">
                                                    @if($row['is_sub'])
                                                        └─ {{ $row['parameter'] }}
                                                    @else
                                                        {{ $row['parameter'] }}
                                                    @endif
                                                </td>
                                                <td>{{ $row['requirement'] }}</td>
                                                <td>{{ $row['result'] }}</td>
                                                <td>{{ $row['test_method'] }}</td>
                                                <td>{{ $row['comment'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-10">
                                <p class="text-muted">No test results found.</p>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="separator separator-dashed my-10"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('batches.results.index', $batch->id) }}" class="btn btn-light">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

