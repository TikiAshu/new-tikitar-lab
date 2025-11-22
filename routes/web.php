<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\LabLocationController;
use App\Http\Controllers\FactoryLocationController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\TestParameterController;
use App\Http\Controllers\TestMethodController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ProductGradeController;
use App\Http\Controllers\TestSpecificationController;
use App\Http\Controllers\TestTemplateController;
use App\Http\Controllers\TestSubParameterController;
use App\Http\Controllers\TestParameterRequirementController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('labs', LabLocationController::class);
Route::resource('factories', FactoryLocationController::class);
Route::resource('specifications', SpecificationController::class);
Route::resource('test-parameters', TestParameterController::class);
Route::resource('test-methods', TestMethodController::class);
Route::resource('clients', ClientController::class);
Route::resource('batch', BatchController::class);

// Product Grades routes
Route::get('product-grades/{productId}', [ProductGradeController::class, 'index'])->name('product-grades.index');
Route::post('product-grades', [ProductGradeController::class, 'store'])->name('product-grades.store');
Route::get('product-grades/show/{id}', [ProductGradeController::class, 'show'])->name('product-grades.show');
Route::get('product-grades/edit/{id}', [ProductGradeController::class, 'edit'])->name('product-grades.edit');
Route::put('product-grades/{id}', [ProductGradeController::class, 'update'])->name('product-grades.update');
Route::delete('product-grades/{id}', [ProductGradeController::class, 'destroy'])->name('product-grades.destroy');

// Test Specifications routes
Route::get('test-specifications/{productId}', [TestSpecificationController::class, 'index'])->name('test-specifications.index');
Route::get('test-specifications/{productId}/grade/{productGradeId}', [TestSpecificationController::class, 'index'])->name('test-specifications.grade.index');
Route::post('test-specifications', [TestSpecificationController::class, 'store'])->name('test-specifications.store');
Route::get('test-specifications/show/{id}', [TestSpecificationController::class, 'show'])->name('test-specifications.show');
Route::get('test-specifications/edit/{id}', [TestSpecificationController::class, 'edit'])->name('test-specifications.edit');
Route::put('test-specifications/{id}', [TestSpecificationController::class, 'update'])->name('test-specifications.update');
Route::delete('test-specifications/{id}', [TestSpecificationController::class, 'destroy'])->name('test-specifications.destroy');

// Test Templates routes
Route::get('test-templates/{testSpecificationId}', [TestTemplateController::class, 'index'])->name('test-templates.index');
Route::post('test-templates', [TestTemplateController::class, 'store'])->name('test-templates.store');
Route::get('test-templates/show/{id}', [TestTemplateController::class, 'show'])->name('test-templates.show');
Route::get('test-templates/edit/{id}', [TestTemplateController::class, 'edit'])->name('test-templates.edit');
Route::put('test-templates/{id}', [TestTemplateController::class, 'update'])->name('test-templates.update');
Route::delete('test-templates/{id}', [TestTemplateController::class, 'destroy'])->name('test-templates.destroy');

// Test Sub-Parameters routes
Route::get('test-sub-parameters/{testParameterId}', [TestSubParameterController::class, 'index'])->name('test-sub-parameters.index');
Route::post('test-sub-parameters', [TestSubParameterController::class, 'store'])->name('test-sub-parameters.store');
Route::get('test-sub-parameters/show/{id}', [TestSubParameterController::class, 'show'])->name('test-sub-parameters.show');
Route::get('test-sub-parameters/edit/{id}', [TestSubParameterController::class, 'edit'])->name('test-sub-parameters.edit');
Route::put('test-sub-parameters/{id}', [TestSubParameterController::class, 'update'])->name('test-sub-parameters.update');
Route::delete('test-sub-parameters/{id}', [TestSubParameterController::class, 'destroy'])->name('test-sub-parameters.destroy');

// Test Parameter Requirements routes
Route::post('test-parameter-requirements', [TestParameterRequirementController::class, 'store'])->name('test-parameter-requirements.store');
Route::get('test-parameter-requirements/show/{id}', [TestParameterRequirementController::class, 'show'])->name('test-parameter-requirements.show');
Route::get('test-parameter-requirements/edit/{id}', [TestParameterRequirementController::class, 'edit'])->name('test-parameter-requirements.edit');
Route::put('test-parameter-requirements/{id}', [TestParameterRequirementController::class, 'update'])->name('test-parameter-requirements.update');
Route::delete('test-parameter-requirements/{id}', [TestParameterRequirementController::class, 'destroy'])->name('test-parameter-requirements.destroy');
Route::get('test-parameter-requirements/{testParameterId}/{testSubParameterId}', [TestParameterRequirementController::class, 'index'])->name('test-parameter-requirements.index');

// API route to get product grades by product ID
Route::get('api/product-grades/{productId}', function($productId) {
    $grades = \App\Models\ProductGrade::where('product_id', $productId)
        ->where('status', '1')
        ->get(['id', 'grade']);
    return response()->json(['data' => $grades]);
});

// Batch Result Versions routes (nested resource)
Route::prefix('batches/{batch}')->name('batches.results.')->group(function() {
    Route::get('/results', [\App\Http\Controllers\BatchResultVersionController::class, 'index'])->name('index');
    Route::get('/results/create', [\App\Http\Controllers\BatchResultVersionController::class, 'create'])->name('create');
    Route::post('/results', [\App\Http\Controllers\BatchResultVersionController::class, 'store'])->name('store');
    Route::get('/results/{result}/view', [\App\Http\Controllers\BatchResultVersionController::class, 'show'])->name('view');
    Route::get('/results/{result}/edit', [\App\Http\Controllers\BatchResultVersionController::class, 'edit'])->name('edit');
    Route::put('/results/{result}', [\App\Http\Controllers\BatchResultVersionController::class, 'update'])->name('update');
    Route::delete('/results/{result}', [\App\Http\Controllers\BatchResultVersionController::class, 'destroy'])->name('destroy');
    Route::post('/results/{result}/submit-review', [\App\Http\Controllers\BatchResultVersionController::class, 'submitReview'])->name('submit-review');
    Route::post('/results/{result}/approve', [\App\Http\Controllers\BatchResultVersionController::class, 'approve'])->name('approve');
    Route::post('/results/{result}/reject', [\App\Http\Controllers\BatchResultVersionController::class, 'reject'])->name('reject');
    Route::get('/results/{result}/report', [\App\Http\Controllers\BatchResultVersionController::class, 'generateReport'])->name('report');

    // Reports routes (nested under result versions)
    Route::prefix('results/{result}')->name('reports.')->group(function() {
        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('index');
        Route::get('/reports/create', [\App\Http\Controllers\ReportController::class, 'create'])->name('create');
        Route::post('/reports', [\App\Http\Controllers\ReportController::class, 'store'])->name('store');
        Route::get('/reports/{report}/edit', [\App\Http\Controllers\ReportController::class, 'edit'])->name('edit');
        Route::get('/reports/{report}/generate-pdf', [\App\Http\Controllers\ReportController::class, 'generatePdf'])->name('generate-pdf');
        Route::get('/reports/{report}', [\App\Http\Controllers\ReportController::class, 'show'])->name('view');
        Route::put('/reports/{report}', [\App\Http\Controllers\ReportController::class, 'update'])->name('update');
        Route::delete('/reports/{report}', [\App\Http\Controllers\ReportController::class, 'destroy'])->name('destroy');
    });
});
