<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Batch;
use App\Models\ReportVersion;
use App\Models\ResultDetail;
use App\Models\TestSpecification;
use App\Models\TestTemplate;
use App\Http\Requests\StoreResultVersionRequest;
use App\Http\Requests\UpdateResultVersionRequest;
use Yajra\DataTables\Facades\DataTables;

class BatchResultVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $batchId)
    {
        if ($request->ajax()) {
            $batch = Batch::findOrFail($batchId);
            $reportVersions = ReportVersion::where('batch_id', $batchId)
                ->where('status', '1')
                ->with(['batch', 'approver'])
                ->orderBy('createdon', 'desc');

            // Role-based filtering: Hide drafts for non-Chemist roles
            $user = Auth::user();
            $userRole = $this->getUserRole($user);

            if (!in_array($userRole, ['Chemist', 'Super Admin'])) {
                $reportVersions->where('report_status', '!=', 'draft');
            }

            return DataTables::of($reportVersions)
                ->addIndexColumn()
                ->addColumn('test_type_badge', function($row) {
                    $badge = $row->test_type === 'NABL'
                        ? '<span class="badge badge-success">NABL</span>'
                        : '<span class="badge badge-info">NON-NABL</span>';
                    return $badge;
                })
                ->addColumn('status_badge', function($row) {
                    $statusColors = [
                        'draft' => 'warning',
                        'review' => 'primary',
                        'approve' => 'success',
                        'reject' => 'danger'
                    ];
                    $color = $statusColors[$row->report_status] ?? 'secondary';
                    return '<span class="badge badge-' . $color . '">' . ucfirst($row->report_status) . '</span>';
                })
                ->addColumn('version_number', function($row) {
                    return 'v' . $row->version;
                })
                ->addColumn('actions', function($row) use ($batchId) {
                    $actions = '';

                    $viewReportBtn = '<a href="' . route('batches.results.reports.index', ['batch' => $batchId, 'result' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-test-specs" data-id="'.$row->id.'" title="View Reports" style="width: 120px;">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect y="6" width="16" height="3" rx="1.5" fill="black"/>
                                    <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"/>
                                    <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"/>
                                </svg>
                            </span>
                            &nbsp; <br /> <span style="color: #a1a5b7; padding-bottom: 5px;">View Reports</span>
                        </a>';
                    $actions .= $viewReportBtn;

                    // View button
                    $actions .= '<a href="' . route('batches.results.view', ['batch' => $batchId, 'result' => $row->id]) . '"
                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View">
                        <span class="svg-icon svg-icon-3">
                            <svg style="color: rgb(177, 176, 170);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill="#b1b0aa"></path>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill="#b1b0aa"></path>
                            </svg>
                        </span>
                    </a>';

                    // Edit button (only for draft)
                    if ($row->isDraft() && $this->canEdit($row)) {
                        $actions .= '<a href="' . route('batches.results.edit', ['batch' => $batchId, 'result' => $row->id]) . '"
                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                </svg>
                            </span>
                        </a>';
                    }

                    // Delete button (only for draft)
                    if ($row->isDraft() && $this->canDelete($row)) {
                        $actions .= '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete-result"
                            data-id="' . $row->id . '" data-batch="' . $batchId . '" title="Delete">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                </svg>
                            </span>
                        </a>';
                    }

                    // Submit for Review button (only for draft)
                    if ($row->isDraft() && $this->canSubmitReview($row)) {
                        $actions .= '<a href="#" class="btn btn-sm btn-primary submit-review"
                            data-id="' . $row->id . '" data-batch="' . $batchId . '" title="Submit for Review">
                            Review
                        </a>';
                    }

                    // Approve/Reject buttons (only for review status)
                    if ($row->isReview()) {
                        if ($this->canApprove($row)) {
                            $actions .= '<a href="#" class="btn btn-sm btn-success approve-result me-1"
                                data-id="' . $row->id . '" data-batch="' . $batchId . '" title="Approve">
                                Approve
                            </a>';
                        }
                        if ($this->canReject($row)) {
                            $actions .= '<a href="#" class="btn btn-sm btn-danger reject-result"
                                data-id="' . $row->id . '" data-batch="' . $batchId . '" title="Reject">
                                Reject
                            </a>';
                        }
                    }

                    // Generate Report button (only for approved)
                    if ($row->isApproved() && $this->canGenerateReport($row)) {
                        $actions .= '<a href="' . route('batches.results.report', ['batch' => $batchId, 'result' => $row->id]) . '"
                            class="btn btn-sm btn-info" title="Generate Report">
                            Report
                        </a>';
                    }

                    return $actions;
                })
                ->rawColumns(['test_type_badge', 'status_badge', 'actions'])
                ->make(true);
        }

        $batch = Batch::with(['product', 'specification'])->findOrFail($batchId);

        // Check existing versions
        $hasNABL = ReportVersion::where('batch_id', $batchId)
            ->where('test_type', 'NABL')
            ->where('status', '1')
            ->exists();

        $hasNONNABL = ReportVersion::where('batch_id', $batchId)
            ->where('test_type', 'NON-NABL')
            ->where('status', '1')
            ->exists();

        return view('batch-results.index', [
            'batch' => $batch,
            'hasNABL' => $hasNABL,
            'hasNONNABL' => $hasNONNABL,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $batchId)
    {
        $batch = Batch::with(['product', 'specification', 'productGrade'])->findOrFail($batchId);

        // Get test type from query parameter
        $testType = $request->get('test_type', 'NABL');

        if (!in_array($testType, ['NABL', 'NON-NABL'])) {
            return redirect()->back()->with('error', 'Invalid test type.');
        }

        // Check if version already exists
        $existingVersion = ReportVersion::where('batch_id', $batchId)
            ->where('test_type', $testType)
            ->where('status', '1')
            ->first();

        if ($existingVersion) {
            return redirect()->route('batches.results.index', $batchId)
                ->with('error', ucfirst($testType) . ' test version already exists for this batch.');
        }

        // Get test specification based on batch
        $testSpecification = TestSpecification::where('product_id', $batch->product_id)
            ->where('product_grade_id', $batch->product_grade_id)
            ->where('specification_id', $batch->specification_id)
            ->where('test_type', $testType)
            ->where('status', '1')
            ->first();

        if (!$testSpecification) {
            return redirect()->route('batches.results.index', $batchId)
                ->with('error', 'Test specification not found for this product, grade, and test type combination.');
        }

        // Get test templates with all relationships
        $testTemplates = TestTemplate::where('test_specification_id', $testSpecification->id)
            ->where('status', '1')
            ->with([
                'testParameter',
                'testSubParameter',
                'testParameterRequirement',
                'testMethod'
            ])
            ->orderBy('test_parameter_id')
            ->orderBy('test_sub_parameter_id')
            ->get();

        // Group templates by main parameter (for organization, but we'll flatten in view)
        $groupedTemplates = $testTemplates->groupBy('test_parameter_id');

        // Debug: Log template count
        Log::info('Batch Result Create - Templates found: ' . $testTemplates->count() . ' for test spec: ' . $testSpecification->id);

        return view('batch-results.create', [
            'batch' => $batch,
            'testType' => $testType,
            'testSpecification' => $testSpecification,
            'groupedTemplates' => $groupedTemplates,
            'allTemplates' => $testTemplates, // Also pass flat collection for easier access
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultVersionRequest $request, $batchId)
    {
        try {
            DB::beginTransaction();

            $batch = Batch::findOrFail($batchId);

            // Create report version
            $reportVersion = ReportVersion::create([
                'batch_id' => $batchId,
                'test_type' => $request->test_type,
                'start_date' => $request->start_date,
                'date_perform' => $request->date_perform,
                'report_status' => $request->report_status ?? 'draft',
                'chemist_comment' => $request->chemist_comment,
                'insert_ip' => $request->ip(),
                'submittedby' => Auth::id() ?? 1,
            ]);

            // Create result details
            foreach ($request->result_details as $detail) {
                ResultDetail::create([
                    'result_version_id' => $reportVersion->id,
                    'test_parameter_id' => $detail['test_parameter_id'],
                    'test_sub_parameter_id' => $detail['test_sub_parameter_id'] ?? null,
                    'test_parameter_requirement_id' => $detail['test_parameter_requirement_id'] ?? null,
                    'test_method_id' => $detail['test_method_id'] ?? null,
                    'result' => $detail['result'] ?? null,
                    'comment' => $detail['comment'] ?? null,
                    'is_required' => $detail['is_required'] ?? 'No',
                    'insert_ip' => $request->ip(),
                    'submittedby' => Auth::id() ?? 1,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => 'Test result version created successfully.',
                'redirect' => route('batches.results.index', $batchId)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating result version: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while creating the test result version.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($batchId, $id)
    {
        $batch = Batch::with(['product', 'specification'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with(['batch', 'approver'])->findOrFail($id);

        // Get all result details with all relationships using query builder (similar to old PHP code)
        $resultDetails = DB::table('result_details')
            ->leftJoin('test_parameters', 'test_parameters.id', '=', 'result_details.test_parameter_id')
            ->leftJoin('test_sub_parameters', 'test_sub_parameters.id', '=', 'result_details.test_sub_parameter_id')
            ->leftJoin('test_methods', 'test_methods.id', '=', 'result_details.test_method_id')
            ->leftJoin('test_parameter_rquirement', 'test_parameter_rquirement.id', '=', 'result_details.test_parameter_requirement_id')
            ->where('result_details.result_version_id', $id)
            ->where('result_details.status', '1')
            ->select(
                'result_details.id',
                'result_details.result',
                'result_details.comment',
                'result_details.approve',
                'result_details.is_required',
                'result_details.test_parameter_id',
                'result_details.test_sub_parameter_id',
                'result_details.test_parameter_requirement_id',
                'result_details.test_method_id',
                'test_parameters.test_parameter',
                'test_parameters.sub_parameter',
                'test_sub_parameters.parameter as sub_parameter_name',
                'test_methods.title as test_method_title',
                'test_parameter_rquirement.value as requirement_value',
                'test_parameter_rquirement.requirement_type',
                'test_parameter_rquirement.minimum',
                'test_parameter_rquirement.maximum',
                'test_parameter_rquirement.units'
            )
            ->orderBy('result_details.id', 'ASC')
            ->get();

        // Convert to collection and group by parameter
        $reportVersion->resultDetailsData = $resultDetails;

        return view('batch-results.view', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($batchId, $id)
    {
        $batch = Batch::with(['product', 'specification', 'productGrade'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with([
            'resultDetails.testParameter',
            'resultDetails.testSubParameter',
            'resultDetails.testParameterRequirement',
            'resultDetails.testMethod'
        ])->findOrFail($id);

        // Check if editable
        if (!$reportVersion->canEdit()) {
            return redirect()->route('batches.results.index', $batchId)
                ->with('error', 'This test result version cannot be edited.');
        }

        // Get test specification
        $testSpecification = TestSpecification::where('product_id', $batch->product_id)
            ->where('product_grade_id', $batch->product_grade_id)
            ->where('specification_id', $batch->specification_id)
            ->where('test_type', $reportVersion->test_type)
            ->where('status', '1')
            ->first();

        if (!$testSpecification) {
            return redirect()->route('batches.results.index', $batchId)
                ->with('error', 'Test specification not found.');
        }

        // Get test templates
        $testTemplates = TestTemplate::where('test_specification_id', $testSpecification->id)
            ->where('status', '1')
            ->with([
                'testParameter',
                'testSubParameter',
                'testParameterRequirement',
                'testMethod'
            ])
            ->get();

        // Group templates by main parameter
        $groupedTemplates = $testTemplates->groupBy('test_parameter_id');

        // Map existing results by parameter ID
        $existingResults = $reportVersion->resultDetails->keyBy(function($item) {
            return $item->test_parameter_id . '_' . ($item->test_sub_parameter_id ?? '0');
        });

        return view('batch-results.edit', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
            'testSpecification' => $testSpecification,
            'groupedTemplates' => $groupedTemplates,
            'existingResults' => $existingResults,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultVersionRequest $request, $batchId, $id)
    {
        try {
            DB::beginTransaction();

            $reportVersion = ReportVersion::findOrFail($id);

            // Check if editable
            if (!$reportVersion->canEdit()) {
                return response()->json([
                    'error' => 'This test result version cannot be edited.'
                ], 403);
            }

            // Update report version
            $reportVersion->update([
                'test_type' => $request->test_type,
                'start_date' => $request->start_date,
                'date_perform' => $request->date_perform,
                'report_status' => $request->report_status ?? 'draft',
                'chemist_comment' => $request->chemist_comment,
                'insert_ip' => $request->ip(),
            ]);

            // Update or create result details
            $existingDetailIds = [];

            foreach ($request->result_details as $detail) {
                if (isset($detail['id']) && $detail['id']) {
                    // Update existing
                    $resultDetail = ResultDetail::find($detail['id']);
                    if ($resultDetail && $resultDetail->result_version_id == $reportVersion->id) {
                        $resultDetail->update([
                            'test_parameter_id' => $detail['test_parameter_id'],
                            'test_sub_parameter_id' => $detail['test_sub_parameter_id'] ?? null,
                            'test_parameter_requirement_id' => $detail['test_parameter_requirement_id'] ?? null,
                            'test_method_id' => $detail['test_method_id'] ?? null,
                            'result' => $detail['result'] ?? null,
                            'comment' => $detail['comment'] ?? null,
                            'is_required' => $detail['is_required'] ?? 'No',
                            'insert_ip' => $request->ip(),
                        ]);
                        $existingDetailIds[] = $resultDetail->id;
                    }
                } else {
                    // Create new
                    $resultDetail = ResultDetail::create([
                        'result_version_id' => $reportVersion->id,
                        'test_parameter_id' => $detail['test_parameter_id'],
                        'test_sub_parameter_id' => $detail['test_sub_parameter_id'] ?? null,
                        'test_parameter_requirement_id' => $detail['test_parameter_requirement_id'] ?? null,
                        'test_method_id' => $detail['test_method_id'] ?? null,
                        'result' => $detail['result'] ?? null,
                        'comment' => $detail['comment'] ?? null,
                        'is_required' => $detail['is_required'] ?? 'No',
                        'insert_ip' => $request->ip(),
                        'submittedby' => Auth::id() ?? 1,
                    ]);
                    $existingDetailIds[] = $resultDetail->id;
                }
            }

            // Delete removed details
            ResultDetail::where('result_version_id', $reportVersion->id)
                ->whereNotIn('id', $existingDetailIds)
                ->update(['status' => '0']);

            DB::commit();

            return response()->json([
                'success' => 'Test result version updated successfully.',
                'redirect' => route('batches.results.index', $batchId)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating result version: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while updating the test result version.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($batchId, $id)
    {
        try {
            $reportVersion = ReportVersion::findOrFail($id);

            // Check if deletable
            if (!$reportVersion->canDelete()) {
                return response()->json([
                    'error' => 'This test result version cannot be deleted.'
                ], 403);
            }

            // Soft delete
            $reportVersion->status = '0';
            $reportVersion->save();

            // Soft delete related result details
            ResultDetail::where('result_version_id', $id)->update(['status' => '0']);

            return response()->json([
                'success' => 'Test result version deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting result version: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while deleting the test result version.'
            ], 500);
        }
    }

    /**
     * Submit for review
     */
    public function submitReview(Request $request, $batchId, $id)
    {
        try {
            $reportVersion = ReportVersion::findOrFail($id);

            if (!$reportVersion->canEdit()) {
                return response()->json([
                    'error' => 'This test result version cannot be submitted for review.'
                ], 403);
            }

            $reportVersion->update([
                'report_status' => 'review',
                'insert_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => 'Test result version submitted for review successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error submitting for review: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while submitting for review.'
            ], 500);
        }
    }

    /**
     * Approve result version
     */
    public function approve(Request $request, $batchId, $id)
    {
        try {
            $reportVersion = ReportVersion::findOrFail($id);

            if (!$reportVersion->isReview()) {
                return response()->json([
                    'error' => 'Only test results in review status can be approved.'
                ], 403);
            }

            $reportVersion->update([
                'report_status' => 'approve',
                'approved_by' => Auth::id() ?? 1,
                'insert_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => 'Test result version approved successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error approving result version: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while approving the test result version.'
            ], 500);
        }
    }

    /**
     * Reject result version
     */
    public function reject(Request $request, $batchId, $id)
    {
        try {
            $reportVersion = ReportVersion::findOrFail($id);

            if (!$reportVersion->isReview()) {
                return response()->json([
                    'error' => 'Only test results in review status can be rejected.'
                ], 403);
            }

            $reportVersion->update([
                'report_status' => 'reject',
                'approved_by' => Auth::id() ?? 1,
                'insert_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => 'Test result version rejected successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error rejecting result version: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while rejecting the test result version.'
            ], 500);
        }
    }

    /**
     * Generate report
     */
    public function generateReport($batchId, $id)
    {
        $batch = Batch::with(['product', 'specification', 'factory', 'lab'])->findOrFail($batchId);
        $reportVersion = ReportVersion::with([
            'batch',
            'resultDetails.testParameter',
            'resultDetails.testSubParameter',
            'resultDetails.testParameterRequirement',
            'resultDetails.testMethod',
            'approver'
        ])->findOrFail($id);

        if (!$reportVersion->isApproved()) {
            return redirect()->route('batches.results.index', $batchId)
                ->with('error', 'Only approved test results can generate reports.');
        }

        // For now, return view. Later can implement PDF generation
        return view('batch-results.report', [
            'batch' => $batch,
            'reportVersion' => $reportVersion,
        ]);
    }

    /**
     * Helper methods for authorization checks
     */
    protected function getUserRole($user)
    {
        if ($user instanceof \App\Models\Employee) {
            return $user->role ?? null;
        }
        return $user->role ?? null;
    }

    protected function canEdit($reportVersion)
    {
        return Gate::allows('update', $reportVersion);
    }

    protected function canDelete($reportVersion)
    {
        return Gate::allows('delete', $reportVersion);
    }

    protected function canSubmitReview($reportVersion)
    {
        return Gate::allows('submitReview', $reportVersion);
    }

    protected function canApprove($reportVersion)
    {
        return Gate::allows('approve', $reportVersion);
    }

    protected function canReject($reportVersion)
    {
        return Gate::allows('reject', $reportVersion);
    }

    protected function canGenerateReport($reportVersion)
    {
        return Gate::allows('generateReport', $reportVersion);
    }
}
