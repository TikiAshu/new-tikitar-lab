<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Report;
use App\Models\Batch;
use App\Models\ReportVersion;
use App\Models\Client;
use App\Models\Employee;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $batchId, $resultVersionId)
    {
        if ($request->ajax()) {
            $reports = Report::where('batch_id', $batchId)
                ->where('result_version_id', $resultVersionId)
                ->where('status', '1')
                ->with(['client', 'employee', 'assign'])
                ->orderBy('createdon', 'desc');

            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('report_code_display', function($row) {
                    return $row->report_code ?? 'N/A';
                })
                ->addColumn('client_name', function($row) {
                    return $row->client ? $row->client->company_name : 'N/A';
                })
                ->addColumn('quantity_display', function($row) {
                    return ($row->quantity ?? '0') . ' ' . ($row->unit ?? '');
                })
                ->addColumn('date_issue_formatted', function($row) {
                    return $row->date_issue ?? 'N/A';
                })
                ->addColumn('employee_name', function($row) {
                    return $row->employee ? $row->employee->first_name . ' ' . $row->employee->last_name : 'N/A';
                })
                ->addColumn('assign_name', function($row) {
                    $getAssign = ReportVersion::find($row->result_version_id)->employee_id;
                    $getAssign = Employee::find($getAssign);
                    return $getAssign ? $getAssign->first_name . ' ' . $getAssign->last_name : 'N/A';
                })
                ->addColumn('actions', function($row) use ($batchId, $resultVersionId) {
                    $actions = '';

                    // Generate PDF button
                    $actions .= '<a href="' . route('batches.results.reports.generate-pdf', ['batch' => $batchId, 'result' => $resultVersionId, 'report' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-test-specs" data-id="'.$row->id.'" title="Generate PDF" style="width: 100px;">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect y="6" width="16" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"/>
                            </svg>
                        </span>
                        &nbsp; <br /> <span style="color: #a1a5b7; padding-bottom: 5px;">Preview PDF</span>
                    </a>';

                    // View button
                    $actions .= '<a href="' . route('batches.results.reports.view', ['batch' => $batchId, 'result' => $resultVersionId, 'report' => $row->id]) . '"
                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View">
                        <span class="svg-icon svg-icon-3">
                            <svg style="color: rgb(177, 176, 170);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill="#b1b0aa"></path>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill="#b1b0aa"></path>
                            </svg>
                        </span>
                    </a>';

                    // Edit button
                    $actions .= '<a href="' . route('batches.results.reports.edit', ['batch' => $batchId, 'result' => $resultVersionId, 'report' => $row->id]) . '"
                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                            </svg>
                        </span>
                    </a>';

                    // Delete button
                    $actions .= '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete-report"
                        data-id="' . $row->id . '" data-batch="' . $batchId . '" data-result="' . $resultVersionId . '" title="Delete">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                            </svg>
                        </span>
                    </a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $batch = Batch::with(['product', 'specification'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch'])->findOrFail($resultVersionId);

        return view('reports.index', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $batchId, $resultVersionId)
    {
        $batch = Batch::with(['product', 'specification', 'productGrade'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch'])->findOrFail($resultVersionId);

        // Get available clients
        $clients = Client::where('status', '1')->get();

        // Get employees (for tech manager/assign)
        $employees = Employee::where('status', '1')->get();

        // Calculate available quantity
        $usedQuantity = Report::where('batch_id', $batchId)
            ->where('result_version_id', $resultVersionId)
            ->where('status', '1')
            ->sum('quantity');

        $availableQuantity = ($batch->quantity ?? 0) - $usedQuantity;

        // Get certificate title based on test type
        $certificateTitle = $reportVersion->test_type === 'NABL'
            ? 'Certificate of Quality (NABL)'
            : 'Certificate of Quality (NON-NABL)';

        return view('reports.create', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
            'clients' => $clients,
            'employees' => $employees,
            'availableQuantity' => $availableQuantity,
            'certificateTitle' => $certificateTitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $batchId, $resultVersionId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'certification' => 'nullable|string',
                'quantity' => 'required|numeric|min:0.01',
                'unit' => 'nullable|string|max:45',
                'date_issue' => 'required|date',
                'employee_id' => 'nullable|integer|exists:employee,id',
                'client_type' => 'required|in:internal,external',
                'assign_id' => 'required|integer|exists:employee,id',
                'client_id' => 'nullable|integer|exists:clients,id',
                'party_ref' => 'required|string',
                'project' => 'required|string',
                'show_logo' => 'required|in:Yes,No',
                'show_report_code' => 'required|in:Yes,No',
                'address' => 'required|string',
                'phone' => 'required|string|max:100',
                'fax' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'truck_no' => 'nullable|string|max:45',
                'invoice_no' => 'nullable|string|max:45',
                'nabl_report' => 'nullable|string|max:45',
                'ulr_number' => 'nullable|string|max:45',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Check available quantity
            $batch = Batch::findOrFail($batchId);
            $usedQuantity = Report::where('batch_id', $batchId)
                ->where('result_version_id', $resultVersionId)
                ->where('status', '1')
                ->sum('quantity');

            $availableQuantity = ($batch->quantity ?? 0) - $usedQuantity;

            if ($request->quantity > $availableQuantity) {
                return response()->json([
                    'error' => "Available quantity is only {$availableQuantity} {$batch->unit}. You cannot use more than available."
                ], 422);
            }

            // Generate report code if not provided
            $reportCode = $request->report_code;
            if (empty($reportCode)) {
                $reportCode = $this->generateReportCode($batchId, $resultVersionId);
            }

            $report = Report::create([
                'report_code' => $reportCode,
                'batch_id' => $batchId,
                'result_version_id' => $resultVersionId,
                'certification' => $request->certification,
                'quantity' => $request->quantity,
                'unit' => $request->unit ?? $batch->unit,
                'date_issue' => $request->date_issue,
                'employee_id' => $request->employee_id,
                'client_type' => $request->client_type,
                'assign_id' => $request->assign_id,
                'client_id' => $request->client_id,
                'party_ref' => $request->party_ref,
                'project' => $request->project,
                'show_logo' => $request->show_logo,
                'show_report_code' => $request->show_report_code,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email,
                'truck_no' => $request->truck_no,
                'invoice_no' => $request->invoice_no,
                'nabl_report' => $request->nabl_report,
                'ulr_number' => $request->ulr_number,
                'insert_ip' => $request->ip(),
                'submittedby' => Auth::id() ?? 1,
            ]);

            return response()->json([
                'success' => 'Report created successfully.',
                'redirect' => route('batches.results.reports.index', ['batch' => $batchId, 'result' => $resultVersionId])
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating report: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while creating the report.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($batchId, $resultVersionId, $id)
    {
        $batch = Batch::with(['product', 'specification'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch'])->findOrFail($resultVersionId);
        $report = Report::with(['client', 'employee', 'assign'])->findOrFail($id);

        return view('reports.view', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
            'report' => $report,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($batchId, $resultVersionId, $id)
    {
        $batch = Batch::with(['product', 'specification', 'productGrade'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch'])->findOrFail($resultVersionId);
        $report = Report::with(['client', 'employee', 'assign'])->findOrFail($id);

        // Get available clients
        $clients = Client::where('status', '1')->get();

        // Get employees
        $employees = Employee::where('status', '1')->get();

        // Calculate available quantity (including current report quantity)
        $usedQuantity = Report::where('batch_id', $batchId)
            ->where('result_version_id', $resultVersionId)
            ->where('status', '1')
            ->where('id', '!=', $id)
            ->sum('quantity');

        $availableQuantity = ($batch->quantity ?? 0) - $usedQuantity;

        return view('reports.edit', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
            'report' => $report,
            'clients' => $clients,
            'employees' => $employees,
            'availableQuantity' => $availableQuantity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $batchId, $resultVersionId, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'certification' => 'nullable|string',
                'quantity' => 'required|numeric|min:0.01',
                'unit' => 'nullable|string|max:45',
                'date_issue' => 'required|date',
                'employee_id' => 'nullable|integer|exists:employee,id',
                'client_type' => 'required|in:internal,external',
                'assign_id' => 'required|integer|exists:employee,id',
                'client_id' => 'nullable|integer|exists:clients,id',
                'party_ref' => 'required|string',
                'project' => 'required|string',
                'show_logo' => 'required|in:Yes,No',
                'show_report_code' => 'required|in:Yes,No',
                'address' => 'required|string',
                'phone' => 'required|string|max:100',
                'fax' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'truck_no' => 'nullable|string|max:45',
                'invoice_no' => 'nullable|string|max:45',
                'nabl_report' => 'nullable|string|max:45',
                'ulr_number' => 'nullable|string|max:45',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $report = Report::findOrFail($id);

            // Check available quantity (excluding current report)
            $batch = Batch::findOrFail($batchId);
            $usedQuantity = Report::where('batch_id', $batchId)
                ->where('result_version_id', $resultVersionId)
                ->where('status', '1')
                ->where('id', '!=', $id)
                ->sum('quantity');

            $availableQuantity = ($batch->quantity ?? 0) - $usedQuantity;

            if ($request->quantity > $availableQuantity) {
                return response()->json([
                    'error' => "Available quantity is only {$availableQuantity} {$batch->unit}. You cannot use more than available."
                ], 422);
            }

            $report->update([
                'certification' => $request->certification,
                'quantity' => $request->quantity,
                'unit' => $request->unit ?? $batch->unit,
                'date_issue' => $request->date_issue,
                'employee_id' => $request->employee_id,
                'client_type' => $request->client_type,
                'assign_id' => $request->assign_id,
                'client_id' => $request->client_id,
                'party_ref' => $request->party_ref,
                'project' => $request->project,
                'show_logo' => $request->show_logo,
                'show_report_code' => $request->show_report_code,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email,
                'truck_no' => $request->truck_no,
                'invoice_no' => $request->invoice_no,
                'nabl_report' => $request->nabl_report,
                'ulr_number' => $request->ulr_number,
                'insert_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => 'Report updated successfully.',
                'redirect' => route('batches.results.reports.index', ['batch' => $batchId, 'result' => $resultVersionId])
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating report: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while updating the report.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($batchId, $resultVersionId, $id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->status = '0';
            $report->save();

            return response()->json([
                'success' => 'Report deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting report: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while deleting the report.'
            ], 500);
        }
    }

    /**
     * Generate PDF report preview
     */
    public function generatePdf($batchId, $resultVersionId, $id)
    {
        $batch = Batch::with(['product', 'specification', 'factory', 'lab'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch', 'approver'])->findOrFail($resultVersionId);
        $report = Report::with(['client', 'employee', 'assign'])->findOrFail($id);

        // Get all result details with all relationships using query builder (similar to old PHP code)
        $listResultDetails = DB::table('result_details')
            ->select(
                'result_details.comment',
                'result_details.approve',
                'result_details.is_required',
                'result_details.result',
                'result_details.id',
                'test_parameters.test_parameter',
                'test_parameters.sub_parameter',
                'test_methods.title',
                'test_parameter_rquirement.value',
                'test_sub_parameters.parameter',
                'result_details.test_sub_parameter_id',
                'result_details.test_parameter_id',
                'test_parameter_rquirement.requirement_type',
                'test_parameter_rquirement.minimum',
                'test_parameter_rquirement.maximum',
                'test_parameter_rquirement.units',
                'result_details.test_sub_parameter_id',
                'result_details.test_parameter_requirement_id',
                'result_details.test_method_id'
            )
            ->leftJoin('test_parameters', 'test_parameters.id', '=', 'result_details.test_parameter_id')
            ->leftJoin('test_sub_parameters', 'test_sub_parameters.id', '=', 'result_details.test_sub_parameter_id')
            ->leftJoin('test_methods', 'test_methods.id', '=', 'result_details.test_method_id')
            ->leftJoin('test_parameter_rquirement', 'test_parameter_rquirement.id', '=', 'result_details.test_parameter_requirement_id')
            ->where('result_details.test_sub_parameter_id', 0)
            ->where('result_details.result_version_id', $resultVersionId)
            ->where('result_details.status', '1')
            ->orderBy('result_details.id', 'ASC')
            ->get();

        return view('reports.pdf', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
            'report' => $report,
            'listResultDetails' => $listResultDetails,
            'resultVersionId' => $resultVersionId,
        ]);
    }

    /**
     * Generate report code
     */
    private function generateReportCode($batchId, $resultVersionId)
    {
        $batch = Batch::findOrFail($batchId);
        $reportVersion = ReportVersion::findOrFail($resultVersionId);

        // Generate code: BATCH_NUMBER-TEST_TYPE-VERSION-REPORT_NUMBER
        $reportCount = Report::where('batch_id', $batchId)
            ->where('result_version_id', $resultVersionId)
            ->where('status', '1')
            ->count();

        $reportNumber = str_pad($reportCount + 1, 3, '0', STR_PAD_LEFT);
        $testTypeCode = $reportVersion->test_type === 'NABL' ? 'NABL' : 'NON';

        return ($batch->batch_number ?? 'BATCH') . '-' . $testTypeCode . '-V' . $reportVersion->version . '-' . $reportNumber;
    }
}

