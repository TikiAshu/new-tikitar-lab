<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\Contracts\DataTables;

use App\Models\TestSpecification;
use App\Models\Product;
use App\Models\ProductGrade;
use App\Models\Specification;

class TestSpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId = null, $productGradeId = null)
    {
        if (request()->ajax()) {
            $query = TestSpecification::with(['specification', 'product', 'productGrade'])
                ->where('status', '1');
            
            if ($productId) {
                $query->where('product_id', $productId);
            }
            
            if ($productGradeId) {
                $query->where('product_grade_id', $productGradeId);
            } else if ($productId) {
                // If product_id but no grade_id, show specs with product_grade_id = 0 (direct product specs)
                $query->where('product_id', $productId)->where('product_grade_id', 0);
            }
            
            $testSpecs = $query;
            return datatables()->of($testSpecs)
                ->addIndexColumn()
                ->addColumn('specification_name', function($row) {
                    return $row->specification ? $row->specification->specification : 'N/A';
                })
                ->addColumn('grade_name', function($row) {
                    if ($row->productGrade) {
                        return $row->productGrade->grade;
                    }
                    return 'N/A';
                })
                ->addColumn('actions', function($row) {
                    $viewBtn = '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-test-spec" data-id="'. $row->id.'" title="View Test Specification">
                        <span class="svg-icon svg-icon-3">
                            <svg style="color: rgb(177, 176, 170);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill="#b1b0aa"></path> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill="#b1b0aa">
                                </path>
                            </svg>
                        </span>
                    </a>';

                    $editBtn = '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-test-spec" data-id="'.$row->id.'" title="Edit Test Specification">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                </svg>
                            </span>
                        </a>';

                    $testTemplateBtn = '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-test-templates" data-id="'.$row->id.'" title="View Test Templates" style="width: 100px;">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect y="6" width="16" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"/>
                            </svg>
                        </span>
                        &nbsp; <br /> <span style="color: #a1a5b7; padding-bottom: 5px;">Templates</span>
                    </a>';

                    $deleteBtn = '<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-kt-action="test_spec_remove" data-id="'.$row->id.'" data-name="Test Specification" title="Delete Test Specification">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                            </svg>
                        </span>
                    </a>';
                    return $testTemplateBtn . $viewBtn . $editBtn . $deleteBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        
        $product = null;
        $productGrade = null;
        
        if ($productId) {
            $product = Product::findOrFail($productId);
        }
        
        if ($productGradeId) {
            $productGrade = ProductGrade::findOrFail($productGradeId);
        }
        
        $specifications = Specification::where('status', '1')->get();
        
        return view('test-specifications.index', [
            'masterName' => 'Test Specifications',
            'page_title' => 'Test Specifications Management',
            'product' => $product,
            'productGrade' => $productGrade,
            'productId' => $productId,
            'productGradeId' => $productGradeId,
            'specifications' => $specifications,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used: handled via AJAX/modal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:products,id',
                'product_grade_id' => 'required|integer',
                'specification_id' => 'required|integer|exists:specification,id',
                'test_type' => 'nullable|in:NON-NABL,NABL',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Get the client's IP address
            $request->merge(['insert_ip' => $request->ip()]);
            $request->merge(['submittedby' => 1]); // Placeholder user ID

            TestSpecification::create($request->all());

            return response()->json(['success' => 'Test specification created successfully.']);
        } catch (\Exception $e) {
            Log::error('Error creating test specification: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json(['error' => 'An error occurred while creating the test specification.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testSpec = TestSpecification::with(['specification', 'product', 'productGrade'])->findOrFail($id);
        return response()->json($testSpec);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testSpec = TestSpecification::with(['specification', 'product', 'productGrade'])->findOrFail($id);
        return response()->json($testSpec);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $testSpec = TestSpecification::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:products,id',
                'product_grade_id' => 'required|integer',
                'specification_id' => 'required|integer|exists:specification,id',
                'test_type' => 'nullable|in:NON-NABL,NABL',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Get the client's IP address
            $request->merge(['insert_ip' => $request->ip()]);

            $testSpec->update($request->all());
            return response()->json(['success' => 'Test specification updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating test specification: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json(['error' => 'An error occurred while updating the test specification.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testSpec = TestSpecification::findOrFail($id);
        $testSpec->status = '0';
        $testSpec->save();
        return response()->json(['success' => 'Test specification deleted successfully.']);
    }
}
