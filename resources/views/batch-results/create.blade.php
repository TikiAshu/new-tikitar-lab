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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create Test Result - {{ $testType }}</h1>
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
                        <li class="breadcrumb-item text-dark">Create</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">Create {{ $testType }} Test Result</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Batch: {{ $batch->batch_number ?? 'N/A' }} |
                                    Product: {{ $batch->product->product_name ?? 'N/A' }} |
                                    Specification: {{ $batch->specification->specification ?? 'N/A' }}
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <form id="kt_create_result_form" novalidate="novalidate">
                            @csrf
                            <input type="hidden" name="test_type" value="{{ $testType }}">

                            <!-- Basic Information -->
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Start Date</label>
                                    <input type="date" class="form-control form-control-solid" name="start_date" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="start_date-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="required fs-6 fw-bold mb-2">Date Perform</label>
                                    <input type="date" class="form-control form-control-solid" name="date_perform" required />
                                    <div class="fv-plugins-message-container invalid-feedback" id="date_perform-error"></div>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <div class="col-md-12">
                                    <label class="fs-6 fw-bold mb-2">Chemist Comment</label>
                                    <textarea class="form-control form-control-solid" name="chemist_comment" rows="3" placeholder="Enter chemist comments (optional)"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="chemist_comment-error"></div>
                                </div>
                            </div>

                            <input type="hidden" name="report_status" value="draft">

                            <!-- Test Parameters -->
                            <div class="separator separator-dashed my-10"></div>
                            <h3 class="fw-bold mb-5">Test Parameters</h3>

                            @php
                                $resultIndex = 0;
                                // Use the flat collection passed from controller, or flatten grouped templates
                                if (isset($allTemplates) && $allTemplates->count() > 0) {
                                    $templatesToDisplay = $allTemplates;
                                } else {
                                    // Fallback: Flatten grouped templates
                                    $templatesToDisplay = collect();
                                    foreach($groupedTemplates as $templates) {
                                        $templatesToDisplay = $templatesToDisplay->merge($templates);
                                    }
                                }
                            @endphp

                            @if($templatesToDisplay->count() > 0)
                                @foreach($templatesToDisplay as $template)
                                    @php
                                        $testParameter = $template->testParameter;
                                        $isSubParameter = !is_null($template->test_sub_parameter_id) && $template->test_sub_parameter_id > 0;
                                        $subParameter = $template->testSubParameter;
                                        $requirement = $template->testParameterRequirement;
                                        $testMethod = $template->testMethod;
                                    @endphp

                                    @if($testParameter || $template->test_parameter_id)
                                        @if($isSubParameter)
                                            <!-- Sub-parameter -->
                                            <div class="sub-parameter">
                                                <h5 class="fw-bold mb-2">
                                                    {{ $subParameter ? $subParameter->parameter : ('Sub-Parameter ID: ' . $template->test_sub_parameter_id) }}
                                                    @if($template->is_required == 'Yes')
                                                        <span class="required-field">*</span>
                                                    @endif
                                                </h5>
                                        @else
                                            <!-- Main parameter -->
                                            <div class="parameter-group" data-parameter-id="{{ $template->test_parameter_id }}">
                                                <h4 class="fw-bold mb-3">
                                                    {{ $testParameter ? $testParameter->test_parameter : ('Parameter ID: ' . $template->test_parameter_id) }}
                                                    @if($template->is_required == 'Yes')
                                                        <span class="required-field">*</span>
                                                    @endif
                                                </h4>
                                        @endif

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

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="fs-6 fw-bold mb-2">
                                                    Result
                                                    @if($template->is_required == 'Yes')
                                                        <span class="required-field">*</span>
                                                    @endif
                                                </label>
                                                <input type="text"
                                                    class="form-control form-control-solid result-input"
                                                    name="result_details[{{ $resultIndex }}][result]"
                                                    placeholder="Enter result"
                                                    @if($template->is_required == 'Yes') required @endif />
                                                <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_id]" value="{{ $template->test_parameter_id }}">
                                                @if($isSubParameter)
                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_sub_parameter_id]" value="{{ $template->test_sub_parameter_id }}">
                                                @endif
                                                <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_requirement_id]" value="{{ $template->test_parameter_requirement_id }}">
                                                <input type="hidden" name="result_details[{{ $resultIndex }}][test_method_id]" value="{{ $template->test_method_id }}">
                                                <input type="hidden" name="result_details[{{ $resultIndex }}][is_required]" value="{{ $template->is_required }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fs-6 fw-bold mb-2">Comment</label>
                                                <input type="text"
                                                    class="form-control form-control-solid"
                                                    name="result_details[{{ $resultIndex }}][comment]"
                                                    placeholder="Enter comment (optional)" />
                                            </div>
                                        </div>
                                        @php $resultIndex++; @endphp

                                        @if($isSubParameter)
                                            </div> <!-- Close sub-parameter -->
                                        @else
                                            </div> <!-- Close parameter-group -->
                                        @endif
                                    @else
                                        <!-- Fallback: Show template even if testParameter relationship not loaded -->
                                        <div class="parameter-group" data-parameter-id="{{ $template->test_parameter_id }}">
                                            <h4 class="fw-bold mb-3">
                                                Parameter ID: {{ $template->test_parameter_id }}
                                                @if($template->is_required == 'Yes')
                                                    <span class="required-field">*</span>
                                                @endif
                                            </h4>

                                            @if($template->testParameterRequirement)
                                                @php $requirement = $template->testParameterRequirement; @endphp
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

                                            @if($template->testMethod)
                                                <div class="mb-3">
                                                    <span class="text-muted">Test Method:</span>
                                                    <strong>{{ $template->testMethod->title }}</strong>
                                                </div>
                                            @endif

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        Result
                                                        @if($template->is_required == 'Yes')
                                                            <span class="required-field">*</span>
                                                        @endif
                                                    </label>
                                                    <input type="text"
                                                        class="form-control form-control-solid result-input"
                                                        name="result_details[{{ $resultIndex }}][result]"
                                                        placeholder="Enter result"
                                                        @if($template->is_required == 'Yes') required @endif />
                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_id]" value="{{ $template->test_parameter_id }}">
                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_parameter_requirement_id]" value="{{ $template->test_parameter_requirement_id }}">
                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][test_method_id]" value="{{ $template->test_method_id }}">
                                                    <input type="hidden" name="result_details[{{ $resultIndex }}][is_required]" value="{{ $template->is_required }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fs-6 fw-bold mb-2">Comment</label>
                                                    <input type="text"
                                                        class="form-control form-control-solid"
                                                        name="result_details[{{ $resultIndex }}][comment]"
                                                        placeholder="Enter comment (optional)" />
                                                </div>
                                            </div>
                                            @php $resultIndex++; @endphp
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    <strong>No test templates found!</strong> Please configure test templates for this test specification first.
                                    <br><br>
                                    <a href="{{ route('test-templates.index', $testSpecification->id) }}" class="btn btn-sm btn-primary">Configure Test Templates</a>
                                </div>
                            @endif

                            <!-- Form Actions -->
                            <div class="separator separator-dashed my-10"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('batches.results.index', $batch->id) }}" class="btn btn-light me-3">Cancel</a>
                                <button type="submit" id="kt_create_result_submit" class="btn btn-primary">
                                    <span class="indicator-label">Save as Draft</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
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
            // Form submission
            $('#kt_create_result_form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                const submitButton = document.querySelector('#kt_create_result_submit');
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                $.ajax({
                    url: "{{ route('batches.results.store', $batch->id) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Test result version created successfully!",
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
        });
    </script>
@endsection

