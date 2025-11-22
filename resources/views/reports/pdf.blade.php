<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Report - {{ $report->report_code ?? 'N/A' }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .action-buttons button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-print {
            background-color: #0d6efd;
            color: white;
        }

        .btn-print:hover {
            background-color: #0b5ed7;
        }

        .btn-download {
            background-color: #198754;
            color: white;
        }

        .btn-download:hover {
            background-color: #157347;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background-color: #5c636a;
        }

        #report {
            font-size: 11pt;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            background: white;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        #report .content td {
            border: 1px solid #111;
            padding: 5px 8px
        }

        #report .reports td {
            border-bottom: 1px solid #111;
            padding: 5px
        }

        #report .fbold {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }

        #report table {
            font-family: 'Roboto', sans-serif;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .action-buttons {
                display: none;
            }

            #report {
                box-shadow: none;
                padding: 0;
            }

            body {
                -webkit-print-color-adjust: exact;
                -o-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="action-buttons">
        <button class="btn-print" onclick="window.print()">Print</button>
        <button class="btn-download" onclick="downloadPDF()">Download</button>
        <a href="{{ route('batches.results.reports.index', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}" class="btn-back" style="text-decoration: none; display: inline-block; padding: 10px 20px; font-size: 14px; border-radius: 4px; font-weight: 600;">Back</a>
    </div>

    <div class="portlet-body">
        <div id="report" style="width:100%; max-width:700px; margin:auto; min-height:842px; text-align:center;">
            <header>
                <table cellspacing="0" style="width:100%; margin-top:30px;">
                    <tr>
                        <td style="width:21%; text-align:right">
                            @if($reportVersion->test_type == 'NABL')
                                <img style="width:135px" src="{{ asset('images/govlogo.jpg') }}" alt="Government Logo" onerror="this.style.display='none'" />
                            @endif
                        </td>
                        <td style="width:50%">&nbsp;</td>
                        <td style="width:29%">
                            <img style="width:135px" src="{{ asset('images/tikitarlogo.jpg') }}" alt="Tiki Tar Logo" onerror="this.style.display='none'" />
                        </td>
                    </tr>
                </table>
            </header>

            <h2 style="margin-bottom:20px; margin-top:15px; font-size:16pt; font-family: 'Roboto', sans-serif; font-weight:700;">TEST REPORT</h2>

            <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
                <tr>
                    <td style="width:74%;">
                        @if($reportVersion->test_type == 'NABL')
                            ULR : {{ $report->ulr_number ?? 'N/A' }}<br>
                        @endif
                        @if($report->show_report_code == 'Yes')
                            Test Report No. : {{ $report->report_code ?? 'N/A' }}<br>
                        @endif
                    </td>
                    <td style="width:26%;">DATE OF REPORT: {{ $report->date_issue ? date("d-m-Y", strtotime($report->date_issue)) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td>
                        @if($reportVersion->test_type == 'NON-NABL')
                            REPORT NO.: {{ $report->id }}
                        @endif
                    </td>
                    <td></td>
                </tr>
            </table>

            <table class="reports" cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:30px; border-collapse:collapse;">
                <tr>
                    <td class="fbold" colspan="4" style="width:25%;">
                        Issue to:<br>
                        {{ $report->client->company_name ?? 'N/A' }}
                        @if($report->address)
                            <br>{{ $report->address }}
                        @endif
                        @if($report->client && $report->client->city)
                            <br>{{ $report->client->city }}
                        @endif
                        @if($report->client && $report->client->country)
                            <br>{{ $report->client->country }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="fbold">Batch no.</td>
                    <td style="width: 26%;">: {{ $batch->batch_number ?? 'N/A' }}</td>
                    <td class="fbold"></td>
                    <td style="width: 26%;"></td>
                </tr>
                <tr>
                    <td class="fbold">Vehicle No.</td>
                    <td>: {{ $report->truck_no ? $report->truck_no : 'NA' }}</td>
                    <td class="fbold">Specification</td>
                    <td>: {{ $batch->specification->specification ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fbold">Product Name</td>
                    <td>: {{ $batch->product->product_name ?? 'N/A' }}</td>
                    <td class="fbold">Quantity</td>
                    <td>: {{ $report->quantity ?? 'N/A' }} {{ $batch->unit ?? '' }}</td>
                </tr>
                <tr>
                    <td class="fbold">Date of receipt</td>
                    <td>: {{ $batch->date_receipt ? date("d-m-Y", strtotime($batch->date_receipt)) : 'N/A' }}</td>
                    <td class="fbold">Condition of the sample on receipt</td>
                    <td>: {{ $batch->sample_condition ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fbold">Date of performance</td>
                    <td>: {{ $reportVersion->date_perform ? date("d-m-Y", strtotime($reportVersion->date_perform)) : 'N/A' }}</td>
                    <td class="fbold">Project</td>
                    <td>: {{ $report->project ? $report->project : 'NA' }}</td>
                </tr>
            </table>

            <hr style="border: none; border-top: 1px dashed #ffffff; margin-top:4px; margin-bottom:10px" />

            <table class="content" cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; border: 1px solid #aaa; border-collapse:collapse;">
                <tr style="background:#fecc00">
                    <td class="fbold" style="width:5%; height:5px; font-weight:bold;">Sr No</td>
                    <td class="fbold" style="width:35%; height:5px; vertical-align:middle; font-weight:bold;">Test Parameters</td>
                    <td class="fbold" style="width:20%; vertical-align:middle; font-weight:bold;">Requirement</td>
                    <td class="fbold" style="width:20%; vertical-align:middle; font-weight:bold;">Results</td>
                    <td class="fbold" style="width:20%; vertical-align:middle; font-weight:bold;">Test method</td>
                </tr>
                @php
                    $i = 1;
                @endphp
                @foreach($listResultDetails as $testTemplate)
                    <tr>
                        <td style="text-align:center">{{ $i }}</td>
                        <td>
                            @if($testTemplate->is_required == 'Yes')
                                <span style="color:red;"></span>
                            @endif
                            {{ $testTemplate->test_parameter ?? 'N/A' }}
                        </td>
                        <td>
                            @php
                                $requirementType = $testTemplate->requirement_type ?? '';
                                $value = $testTemplate->value ?? '';
                                $units = $testTemplate->units ?? '';
                                $minimum = $testTemplate->minimum ?? 0;
                                $maximum = $testTemplate->maximum ?? 0;
                            @endphp
                            @if($requirementType == 'value')
                                {{ $value }} {{ $units }}
                            @elseif($requirementType == 'range')
                                {{ number_format($minimum, 3) }} to {{ number_format($maximum, 3) }} {{ $units }}
                            @elseif($requirementType == 'plus-minus')
                                {{ $value }} ± {{ number_format($minimum, 3) }} {{ $units }}
                            @elseif($requirementType == 'minimum')
                                Min {{ $value }} {{ $units }}
                            @elseif($requirementType == 'maximum')
                                Max {{ $value }} {{ $units }}
                            @else
                                {{ $requirementType }} {{ $value }} {{ $units }}
                            @endif
                        </td>
                        <td>
                            @if($testTemplate->sub_parameter == '0')
                                {{ $testTemplate->result ?? 'N/A' }}
                            @endif
                        </td>
                        <td>{{ $testTemplate->title ?? 'N/A' }}</td>
                    </tr>
                    @php
                        // Get sub-parameters for this main parameter
                        $listSubResultDetails = \Illuminate\Support\Facades\DB::table('result_details')
                            ->select(
                                'result_details.comment',
                                'result_details.approve',
                                'result_details.is_required',
                                'result_details.result',
                                'result_details.id',
                                'test_parameters.test_parameter',
                                'test_methods.title',
                                'test_parameter_rquirement.value',
                                'test_sub_parameters.parameter',
                                'result_details.test_sub_parameter_id',
                                'test_parameter_rquirement.requirement_type',
                                'test_parameter_rquirement.minimum',
                                'test_parameter_rquirement.maximum',
                                'test_parameter_rquirement.units',
                                'result_details.test_parameter_requirement_id',
                                'result_details.test_method_id'
                            )
                            ->leftJoin('test_parameters', 'test_parameters.id', '=', 'result_details.test_parameter_id')
                            ->leftJoin('test_sub_parameters', 'test_sub_parameters.id', '=', 'result_details.test_sub_parameter_id')
                            ->leftJoin('test_methods', 'test_methods.id', '=', 'result_details.test_method_id')
                            ->leftJoin('test_parameter_rquirement', 'test_parameter_rquirement.id', '=', 'result_details.test_parameter_requirement_id')
                            ->where('result_details.result_version_id', $resultVersionId)
                            ->where('result_details.test_parameter_id', $testTemplate->test_parameter_id)
                            ->where('result_details.test_sub_parameter_id', '!=', 0)
                            ->where('result_details.status', '1')
                            ->orderBy('result_details.id', 'ASC')
                            ->get();
                    @endphp
                    @foreach($listSubResultDetails as $subTestTemplate)
                        <tr style="text-align:left">
                            <td></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $subTestTemplate->parameter ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $subRequirementType = $subTestTemplate->requirement_type ?? '';
                                    $subValue = $subTestTemplate->value ?? '';
                                    $subUnits = $subTestTemplate->units ?? '';
                                    $subMinimum = $subTestTemplate->minimum ?? 0;
                                    $subMaximum = $subTestTemplate->maximum ?? 0;
                                @endphp
                                @if($subRequirementType == 'value')
                                    {{ $subValue }} {{ $subUnits }}
                                @elseif($subRequirementType == 'range')
                                    {{ number_format($subMinimum, 3) }} to {{ number_format($subMaximum, 3) }} {{ $subUnits }}
                                @elseif($subRequirementType == 'plus-minus')
                                    {{ $subValue }} ± {{ number_format($subMinimum, 3) }} {{ $subUnits }}
                                @elseif($subRequirementType == 'minimum')
                                    Min {{ $subValue }} {{ $subUnits }}
                                @elseif($subRequirementType == 'maximum')
                                    Max {{ $subValue }} {{ $subUnits }}
                                @else
                                    {{ $subRequirementType }} {{ $subValue }} {{ $subUnits }}
                                @endif
                            </td>
                            <td>{{ $subTestTemplate->result ?? 'N/A' }}</td>
                            <td>{{ $subTestTemplate->title ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                    @php
                        $i++;
                    @endphp
                @endforeach
            </table>

            <table cellspacing="0" style="width: 100%; text-align: left; margin-top:10px; font-family: 'Roboto', sans-serif; font-weight:normal; font-size: 9pt;">
                <tr>
                    <td>
                        <p style="margin-bottom: 5px;">Statement of Conformity: Pass-Result confirms to specification.</p>
                        <p style="margin-bottom: 5px;">Opinion & Interpretation: NA</p>
                    </td>
                </tr>
            </table>

            <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
                <tr>
                    <td style="width:20%; text-align:left; padding:10px 0;">
                        Reviewed by :
                        <p style="height:10px">&nbsp;</p>
                    </td>
                    <td style="width:50%;text-align:center;"></td>
                    <td style="width:30%; text-align:center; padding:10px 0;">
                        <p style="height:10px">&nbsp;</p>
                        Name: {{ $report->employee ? $report->employee->first_name . ' ' . $report->employee->last_name : 'N/A' }}<br>
                        Designation: {{ $report->employee->designation ?? 'N/A' }}<br>
                        (Authorized Signatory)
                    </td>
                </tr>
            </table>

            <table cellspacing="0" style="background:#ececec; width: 100%; margin-top:15px; padding:15px">
                <tr>
                    <td>
                        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
                            <tr>
                                <td style="width:17%; text-align:right; font-family: 'Roboto', sans-serif; font-weight:700; padding-right:5px;">NOTE:</td>
                                <td style="width:83%">1. The results relate only to the items/samples tested.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>2. The report shall not be reproduced except in full without approval of the QA/QC Laboratory, Tiki Tar Industries (Baroda) Ltd. can provide assurance that parts of a report are not taken out of context.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>3. *The Information is supplied by the customer and can affect the validity of result.</td>
                            </tr>
                        </table>
                        @if($reportVersion->test_type == 'NABL')
                            <table style="background:#ececec; width: 100%; margin-top:15px; padding:15px">
                                <tr>
                                    <td style="width: 100%; text-align: center; font-size: 8pt;">F/7.8/01/Issue No.01/Issue Date: 01-06-2021/ Amend No.:00 / Amend Date:-- / Page 1 of 1 Controlled Document</td>
                                </tr>
                            </table>
                        @endif
                    </td>
                </tr>
            </table>

            <footer>
                <table cellspacing="0" style="width:100%; margin-top:15px; margin-left:10px">
                    <tr>
                        <td style="width:25%; text-align:left;font-size:8pt">
                            <img src="{{ asset('images/tikitarlogofooter1.jpg') }}" style="width:180px; margin-top:8px" alt="Tiki Tar Footer Logo" onerror="this.style.display='none'" />
                            <p style="margin-top:14px; margin-bottom:0; font-size:7pt; text-align:left; margin-left:16px">CIN No. U23109GJ2011PLC064721</p>
                        </td>
                        <td style="width:2%"></td>
                        <td style="width:73%; text-align:left; font-size:8pt">
                            <h4 style="font-family: roboto;"><b>TIKI TAR INDUSTRIES (BARODA) LIMITED</b></h4>
                            <p style="margin-top:10px; margin-bottom:10px;">
                                <span style="font-family: 'Roboto', sans-serif; font-weight:700;">Branch Office:</span><br />
                                {{ $report->address ?? 'N/A' }}<br />
                                @if($report->phone)
                                    Tel: {{ $report->phone }} |
                                @endif
                                @if($report->fax)
                                    Fax: {{ $report->fax }} |
                                @endif
                                @if($report->email)
                                    Email: {{ $report->email }} |
                                @endif
                                www.tikitar.com
                            </p>
                            <p style="margin-top:10px; margin-bottom:10px;">
                                <span style="font-family: 'Roboto', sans-serif; font-weight:700;">Corporate Office:</span><br />
                                8th Floor, Neptune Tower, Productivity Road, Vadodara - 390 007, Gujrat, India.<br />
                                Tel: +91 265 233 7992/7862/8142 | Fax: +91 265 233 4339 | Email: baroda@tikitar.com | www.tikitar.com
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:15px"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </footer>
        </div>
    </div>

    <script>
        function downloadPDF() {
            // For now, trigger print dialog which allows saving as PDF
            // In future, you can implement actual PDF generation using jsPDF or server-side PDF generation
            window.print();
        }
    </script>
</body>
</html>

