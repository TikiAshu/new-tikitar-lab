<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Report - {{ $reportVersion->test_type }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }

        .report-container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20mm;
            background: #fff;
        }

        .report-header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .report-header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-header h2 {
            font-size: 18px;
            font-weight: normal;
            color: #666;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .info-section {
            flex: 1;
        }

        .info-section h3 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #000;
        }

        .info-item {
            margin-bottom: 5px;
            font-size: 11px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .results-table th,
        .results-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .results-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 11px;
        }

        .results-table td {
            font-size: 11px;
        }

        .parameter-group {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .parameter-title {
            font-weight: bold;
            font-size: 13px;
            background: #e8e8e8;
            padding: 8px;
            border-left: 4px solid #009ef7;
            margin-bottom: 5px;
        }

        .sub-parameter {
            margin-left: 20px;
            margin-top: 5px;
            padding: 5px;
            border-left: 2px solid #009ef7;
        }

        .requirement {
            font-size: 10px;
            color: #666;
            font-style: italic;
            margin-left: 10px;
        }

        .comment-section {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #009ef7;
        }

        .comment-section h3 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #000;
            display: flex;
            justify-content: space-between;
        }

        .signature-section {
            width: 200px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .badge-info {
            background: #cfe2ff;
            color: #084298;
        }

        @media print {
            body {
                background: #fff;
            }

            .report-container {
                padding: 10mm;
            }

            .no-print {
                display: none;
            }
        }

        .print-actions {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #f5f5f5;
        }

        .print-actions button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background: #009ef7;
            color: #fff;
        }

        .print-actions button:hover {
            background: #0085d1;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Print Actions -->
        <div class="print-actions no-print">
            <button onclick="window.print()">Print Report</button>
            <button onclick="window.close()">Close</button>
        </div>

        <!-- Report Header -->
        <div class="report-header">
            <h1>TEST REPORT</h1>
            <h2>{{ $reportVersion->test_type }} - Version {{ $reportVersion->version }}</h2>
        </div>

        <!-- Report Information -->
        <div class="report-info">
            <div class="info-section">
                <h3>Batch Information</h3>
                <div class="info-item">
                    <span class="info-label">Batch Number:</span>
                    <span>{{ $batch->batch_number ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Product:</span>
                    <span>{{ $batch->product->product_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Specification:</span>
                    <span>{{ $batch->specification->specification ?? 'N/A' }}</span>
                </div>
                @if($batch->productGrade)
                <div class="info-item">
                    <span class="info-label">Grade:</span>
                    <span>{{ $batch->productGrade->grade ?? 'N/A' }}</span>
                </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Quantity:</span>
                    <span>{{ $batch->quantity ?? 'N/A' }} {{ $batch->unit ?? '' }}</span>
                </div>
            </div>
            <div class="info-section">
                <h3>Test Information</h3>
                <div class="info-item">
                    <span class="info-label">Test Type:</span>
                    <span class="badge badge-{{ $reportVersion->test_type === 'NABL' ? 'success' : 'info' }}">
                        {{ $reportVersion->test_type }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Start Date:</span>
                    <span>{{ $reportVersion->start_date ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date Perform:</span>
                    <span>{{ $reportVersion->date_perform ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span>{{ ucfirst($reportVersion->report_status) }}</span>
                </div>
                @if($reportVersion->approver)
                <div class="info-item">
                    <span class="info-label">Approved By:</span>
                    <span>{{ $reportVersion->approver->first_name }} {{ $reportVersion->approver->last_name }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Test Results -->
        <h3 style="font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Test Results</h3>

        @php
            $activeResults = $reportVersion->resultDetails->where('status', '1');
            $groupedResults = $activeResults->groupBy('test_parameter_id');
        @endphp

        @if($groupedResults->count() > 0)
            @foreach($groupedResults as $testParameterId => $results)
                @php
                    $mainResult = $results->whereNull('test_sub_parameter_id')->first();
                    $subResults = $results->whereNotNull('test_sub_parameter_id');
                    
                    // Get test parameter
                    if ($mainResult && $mainResult->testParameter) {
                        $testParameter = $mainResult->testParameter;
                    } else {
                        $firstResult = $results->first();
                        $testParameter = $firstResult && $firstResult->testParameter ? $firstResult->testParameter : null;
                    }
                @endphp

                @if($testParameter)
                    <div class="parameter-group">
                        <div class="parameter-title">
                            {{ $testParameter->test_parameter ?? 'N/A' }}
                            @if($mainResult && $mainResult->testParameterRequirement)
                                @php $requirement = $mainResult->testParameterRequirement; @endphp
                                <span class="requirement">
                                    (
                                    @if($requirement->requirement_type == 'value')
                                        {{ $requirement->value }} {{ $requirement->units ?? '' }}
                                    @elseif($requirement->requirement_type == 'range')
                                        {{ number_format($requirement->minimum, 3) }} to {{ number_format($requirement->maximum, 3) }} {{ $requirement->units ?? '' }}
                                    @elseif($requirement->requirement_type == 'plus-minus')
                                        {{ $requirement->value }} ± {{ number_format($requirement->minimum, 3) }} {{ $requirement->units ?? '' }}
                                    @elseif($requirement->requirement_type == 'minimum')
                                        ≥ {{ $requirement->value }} {{ $requirement->units ?? '' }}
                                    @elseif($requirement->requirement_type == 'maximum')
                                        ≤ {{ $requirement->value }} {{ $requirement->units ?? '' }}
                                    @endif
                                    )
                                </span>
                            @endif
                        </div>

                        @if($mainResult && $mainResult->testMethod)
                            <div style="font-size: 10px; color: #666; margin-left: 10px; margin-bottom: 5px;">
                                <strong>Test Method:</strong> {{ $mainResult->testMethod->title }}
                            </div>
                        @endif

                        @if($mainResult)
                            <table class="results-table">
                                <tr>
                                    <th style="width: 60%;">Result</th>
                                    <th style="width: 40%;">Comment</th>
                                </tr>
                                <tr>
                                    <td>{{ $mainResult->result ?? 'N/A' }}</td>
                                    <td>{{ $mainResult->comment ?? '-' }}</td>
                                </tr>
                            </table>
                        @endif

                        <!-- Sub-parameters -->
                        @if($subResults->count() > 0)
                            @foreach($subResults as $subResult)
                                @php $subParameter = $subResult->testSubParameter; @endphp
                                @if($subParameter)
                                    <div class="sub-parameter">
                                        <div style="font-weight: bold; font-size: 12px; margin-bottom: 5px;">
                                            {{ $subParameter->parameter ?? 'N/A' }}
                                            @if($subResult->testParameterRequirement)
                                                @php $subRequirement = $subResult->testParameterRequirement; @endphp
                                                <span class="requirement">
                                                    (
                                                    @if($subRequirement->requirement_type == 'value')
                                                        {{ $subRequirement->value }} {{ $subRequirement->units ?? '' }}
                                                    @elseif($subRequirement->requirement_type == 'range')
                                                        {{ number_format($subRequirement->minimum, 3) }} to {{ number_format($subRequirement->maximum, 3) }} {{ $subRequirement->units ?? '' }}
                                                    @elseif($subRequirement->requirement_type == 'plus-minus')
                                                        {{ $subRequirement->value }} ± {{ number_format($subRequirement->minimum, 3) }} {{ $subRequirement->units ?? '' }}
                                                    @elseif($subRequirement->requirement_type == 'minimum')
                                                        ≥ {{ $subRequirement->value }} {{ $subRequirement->units ?? '' }}
                                                    @elseif($subRequirement->requirement_type == 'maximum')
                                                        ≤ {{ $subRequirement->value }} {{ $subRequirement->units ?? '' }}
                                                    @endif
                                                    )
                                                </span>
                                            @endif
                                        </div>
                                        <table class="results-table" style="margin-top: 5px;">
                                            <tr>
                                                <th style="width: 60%;">Result</th>
                                                <th style="width: 40%;">Comment</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $subResult->result ?? 'N/A' }}</td>
                                                <td>{{ $subResult->comment ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endif
            @endforeach
        @else
            <p style="text-align: center; color: #666; padding: 20px;">No test results found.</p>
        @endif

        <!-- Chemist Comment -->
        @if($reportVersion->chemist_comment)
            <div class="comment-section">
                <h3>Chemist Comment</h3>
                <p>{{ $reportVersion->chemist_comment }}</p>
            </div>
        @endif

        <!-- Footer with Signatures -->
        <div class="footer">
            <div class="signature-section">
                <div class="signature-line">
                    <strong>Chemist</strong>
                </div>
            </div>
            <div class="signature-section">
                <div class="signature-line">
                    <strong>Approved By</strong>
                    @if($reportVersion->approver)
                        <br><small>{{ $reportVersion->approver->first_name }} {{ $reportVersion->approver->last_name }}</small>
                    @endif
                </div>
            </div>
        </div>

        <!-- Report Footer -->
        <div style="text-align: center; margin-top: 30px; font-size: 10px; color: #666;">
            <p>Generated on: {{ now()->format('Y-m-d H:i:s') }}</p>
            <p>Report Version: {{ $reportVersion->version }}</p>
        </div>
    </div>

    <script>
        // Auto-print on load (optional - can be removed)
        // window.onload = function() {
        //     window.print();
        // };
    </script>
</body>
</html>

