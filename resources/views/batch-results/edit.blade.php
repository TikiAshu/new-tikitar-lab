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

        .parameter-group {
            border: 1px solid #e4e6ef;
            border-radius: 0.475rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background: #f9f9f9;
        }

        .sub-parameter {
            margin-left: 2rem;
            margin-top: 1rem;
            padding: 1rem;
            background: #fff;
            border-left: 3px solid #009ef7;
        }

        .required-field {
            color: #dc3545;
        }

        .requirement-display {
            font-weight: 600;
            color: #009ef7;
            margin-left: 0.5rem;
        }

        .readonly-field {
            background-color: #f5f8fa;
            cursor: not-allowed;
        }
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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Test Result - {{ $reportVersion->test_type }}</h1>
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
                        <li class="breadcrumb-item text-dark">Edit</li>
                    </ul>
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
                                <span class="card-label fw-bold fs-3 mb-1">Edit {{ $reportVersion->test_type }} Test Result</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Batch: {{ $batch->batch_number ?? 'N/A' }} |
                                    Product: {{ $batch->product->product_name ?? 'N/A' }} |
                                    Specification: {{ $batch->specification->specification ?? 'N/A' }}
                                </span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <span class="badge badge-{{ $reportVersion->report_status === 'draft' ? 'warning' : ($reportVersion->report_status === 'review' ? 'primary' : ($reportVersion->report_status === 'approve' ? 'success' : 'danger')) }}">
                                {{ ucfirst($reportVersion->report_status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        @if(!$reportVersion->canEdit())
                            <div class="alert alert-warning">
                                <strong>This test result version cannot be edited.</strong> Only draft versions can be edited.
                            </div>
                        @endif

                        <form id="kt_edit_result_form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="test_type" value="{{ $reportVersion->test_type }}">

                            <!-- Basic Information -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Start Date</label>
                                    <input type="date" 
                                        class="form-control form-control-solid {{ !$reportVersion->canEdit() ? 'readonly-field' : '' }}" 
                                        name="start_date" 
                                        value="{{ $reportVersion->start_date }}"
                                        {{ !$reportVersion->canEdit() ? 'readonly' : '' }}
                                        required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="start_date-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Date Perform</label>
                                    <input type="date" 
                                        class="form-control form-control-solid {{ !$reportVersion->canEdit() ? 'readonly-field' : '' }}" 
                                        name="date_perform" 
                                        value="{{ $reportVersion->date_perform }}"
                                        {{ !$reportVersion->canEdit() ? 'readonly' : '' }}
                                        required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="date_perform-error"></div>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <div class="col-md-12">
                                    <label class="fs-6 fw-bold mb-2">Chemist Comment</label>
                                    <textarea 
                                        class="form-control form-control-solid {{ !$reportVersion->canEdit() ? 'readonly-field' : '' }}" 
                                        name="chemist_comment" 
                                        rows="3" 
                                        placeholder="Enter chemist comments (optional)"
                                        {{ !$reportVersion->canEdit() ? 'readonly' : '' }}>{{ $reportVersion->chemist_comment }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="chemist_comment-error"></div>
                                </div>
                            </div>

                            <input type="hidden" name="report_status" value="{{ $reportVersion->report_status }}">

                            <!-- Test Parameters -->
                            <div class="separator separator-dashed my-10"></div>
                            <h3 class="fw-bold mb-5">Test Parameters</h3>

                            @php
                                $resultIndex = 0;
                                $isReadonly = !$reportVersion->canEdit();
                            @endphp

                            @if($groupedTemplates->count() > 0)
                                @foreach($groupedTemplates as $testParameterId => $templates)
                                    @php
                                        $testParameter = $templates->first()->testParameter;
                                        $mainTemplate = $templates->whereNull('test_sub_parameter_id')->first();
                                        $subTemplates = $templates->whereNotNull('test_sub_parameter_id');
                                        
                                        // Get existing result for main parameter
                                        $mainResult = $existingResults->get($testParameterId . '_0') ?? null;
                                    @endphp

                                    @if($testParameter)
                                        <!-- Main parameter -->
                                        <div class="parameter-group" data-parameter-id="{{ $testParameterId }}">
                                            <h4 class="fw-bold mb-3">
                                                {{ $testParameter->test_parameter }}
                                                @if($mainTemplate && $mainTemplate->is_required == 'Yes')
                                                    <span class="required-field">*</span>
                                                @endif
                                            </h4>

                                            @if($mainTemplate)
                                                @php
                                                    $requirement = $mainTemplate->testParameterRequirement;
                                                    $testMethod = $mainTemplate->testMethod;
                                                @endphp

                                                @if($requirement)
                                                    <div class="mb-3">
                                                        <span class="text-muted">Requirement:</span>
                                                        <span class="requirement-display">
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
                                                            @else
                                                                {{ $requirement->requirement_type }} {{ $requirement->value }} {{ $requirement->units ?? '' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif

                                                @if($testMethod)
                                                    <div class="mb-3">
                                                        <span class="text-muted">Test Method:</span>
                                                        <strong>{{ $testMethod->title }}</strong>
                                                    </div>
                                                @endif

                                                @if($subTemplates->count() == 0)
                                                    <!-- Main parameter without sub-parameters -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="fs-6 fw-bold mb-2">
                                                                Result
                                                                @if($mainTemplate->is_required == 'Yes')
                                                                    <span class="required-field">*</span>
                                                                @endif
                                                            </label>
                                                            <input type="text"
                                                                class="form-control form-control-solid result-input {{ $isReadonly ? 'readonly-field' : '' }}"
                                                                name="result_details[{{ $resultIndex }}][result]"
                                                                value="{{ $mainResult ? $mainResult->result : '' }}"
                                                                placeholder="Enter result"
                                                                {{ $isReadonly ? 'readonly' : '' }}
                                                                @if($mainTemplate->is_required == 'Yes') required @endif />
                                                            @if($mainResult)
                                                                <input type="hidden" name="result_details[{{ $resultIndex }}][id]" value="{{ $mainResult->id }}">
                                                            @endif
                                                            <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_id]" value="{{ $testParameterId }}">
                                                            <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_requirement_id]" value="{{ $mainTemplate->test_parameter_requirement_id }}">
                                                            <input type="hidden" name="result_details[{{ $resultIndex }}][test_method_id]" value="{{ $mainTemplate->test_method_id }}">
                                                            <input type="hidden" name="result_details[{{ $resultIndex }}][is_required]" value="{{ $mainTemplate->is_required }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="fs-6 fw-bold mb-2">Comment</label>
                                                            <input type="text"
                                                                class="form-control form-control-solid {{ $isReadonly ? 'readonly-field' : '' }}"
                                                                name="result_details[{{ $resultIndex }}][comment]"
                                                                value="{{ $mainResult ? $mainResult->comment : '' }}"
                                                                placeholder="Enter comment (optional)"
                                                                {{ $isReadonly ? 'readonly' : '' }} />
                                                        </div>
                                                    </div>
                                                    @php $resultIndex++; @endphp
                                                @endif
                                            @endif

                                            <!-- Sub-parameters -->
                                            @if($subTemplates->count() > 0)
                                                @foreach($subTemplates as $subTemplate)
                                                    @php
                                                        $subParameter = $subTemplate->testSubParameter;
                                                        $subResult = $existingResults->get($testParameterId . '_' . $subTemplate->test_sub_parameter_id) ?? null;
                                                    @endphp
                                                    @if($subParameter)
                                                        <div class="sub-parameter">
                                                            <h5 class="fw-bold mb-2">
                                                                {{ $subParameter->parameter }}
                                                                @if($subTemplate->is_required == 'Yes')
                                                                    <span class="required-field">*</span>
                                                                @endif
                                                            </h5>

                                                            @if($subTemplate->testParameterRequirement)
                                                                @php $subRequirement = $subTemplate->testParameterRequirement; @endphp
                                                                <div class="mb-2">
                                                                    <span class="text-muted small">Requirement:</span>
                                                                    <span class="requirement-display small">
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
                                                                    </span>
                                                                </div>
                                                            @endif

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="fs-6 fw-bold mb-2">
                                                                        Result
                                                                        @if($subTemplate->is_required == 'Yes')
                                                                            <span class="required-field">*</span>
                                                                        @endif
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid result-input {{ $isReadonly ? 'readonly-field' : '' }}"
                                                                        name="result_details[{{ $resultIndex }}][result]"
                                                                        value="{{ $subResult ? $subResult->result : '' }}"
                                                                        placeholder="Enter result"
                                                                        {{ $isReadonly ? 'readonly' : '' }}
                                                                        @if($subTemplate->is_required == 'Yes') required @endif />
                                                                    @if($subResult)
                                                                        <input type="hidden" name="result_details[{{ $resultIndex }}][id]" value="{{ $subResult->id }}">
                                                                    @endif
                                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_id]" value="{{ $testParameterId }}">
                                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_sub_parameter_id]" value="{{ $subTemplate->test_sub_parameter_id }}">
                                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_requirement_id]" value="{{ $subTemplate->test_parameter_requirement_id }}">
                                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_method_id]" value="{{ $subTemplate->test_method_id }}">
                                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][is_required]" value="{{ $subTemplate->is_required }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="fs-6 fw-bold mb-2">Comment</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid {{ $isReadonly ? 'readonly-field' : '' }}"
                                                                        name="result_details[{{ $resultIndex }}][comment]"
                                                                        value="{{ $subResult ? $subResult->comment : '' }}"
                                                                        placeholder="Enter comment (optional)"
                                                                        {{ $isReadonly ? 'readonly' : '' }} />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php $resultIndex++; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    <strong>No test templates found!</strong> Please configure test templates for this test specification first.
                                </div>
                            @endif

                            <!-- Form Actions -->
                            <div class="separator separator-dashed my-10"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('batches.results.index', $batch->id) }}" class="btn btn-light me-3">Cancel</a>
                                @if($reportVersion->canEdit())
                                    <button type="submit" id="kt_edit_result_submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            @if($reportVersion->canEdit())
            // Form submission
            $('#kt_edit_result_form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                const submitButton = document.querySelector('#kt_edit_result_submit');
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                $.ajax({
                    url: "{{ route('batches.results.update', ['batch' => $batch->id, 'result' => $reportVersion->id]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Test result version updated successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            window.location.href = response.redirect || "{{ route('batches.results.index', $batch->id) }}";
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
                                }
                            });
                        }

                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    }
                });
            });

            // Clear errors when user starts typing
            $(document).on('input', 'input, textarea, select', function() {
                var fieldName = $(this).attr('name');
                if (fieldName) {
                    $(this).removeClass('is-invalid');
                    var fieldKey = fieldName.split('[').pop().split(']')[0];
                    $('#' + fieldKey + '-error').html('').removeClass('d-block');
                }
            });
            @endif
        });
    </script>
@endsection

