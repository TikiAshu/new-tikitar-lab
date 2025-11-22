<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResultVersionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization handled by Policy
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $batchId = $this->route('batch');
        $resultVersionId = $this->route('result');
        
        $rules = [
            'test_type' => [
                'required',
                'in:NABL,NON-NABL',
                Rule::unique('report_version', 'test_type')
                    ->where('batch_id', $batchId)
                    ->where('status', '1')
                    ->ignore($resultVersionId)
            ],
            'start_date' => 'required|date',
            'date_perform' => 'required|date',
            'report_status' => 'required|in:draft,review,approve,reject',
            'chemist_comment' => 'nullable|string|max:1000',
            'result_details' => 'required|array|min:1',
            'result_details.*.id' => 'nullable|integer|exists:result_details,id',
            'result_details.*.test_parameter_id' => 'required|integer|exists:test_parameters,id',
            'result_details.*.test_sub_parameter_id' => 'nullable|integer|exists:test_sub_parameters,id',
            'result_details.*.test_parameter_requirement_id' => 'nullable|integer|exists:test_parameter_rquirement,id',
            'result_details.*.test_method_id' => 'nullable|integer|exists:test_methods,id',
            'result_details.*.result' => 'nullable|string|max:255',
            'result_details.*.comment' => 'nullable|string|max:1000',
            'result_details.*.is_required' => 'nullable|in:Yes,No',
        ];

        // Add dynamic required validation for result fields
        if ($this->has('result_details')) {
            foreach ($this->input('result_details', []) as $index => $detail) {
                if (isset($detail['is_required']) && $detail['is_required'] === 'Yes') {
                    $rules["result_details.{$index}.result"] = 'required|string|max:255';
                }
            }
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        $messages = [
            'test_type.unique' => 'A :test_type test version already exists for this batch.',
            'result_details.required' => 'At least one test parameter result is required.',
            'result_details.min' => 'At least one test parameter result is required.',
            'result_details.*.test_parameter_id.required' => 'Test parameter is required.',
            'result_details.*.test_parameter_id.exists' => 'Selected test parameter does not exist.',
        ];

        // Add dynamic messages for required result fields
        if ($this->has('result_details')) {
            foreach ($this->input('result_details', []) as $index => $detail) {
                if (isset($detail['is_required']) && $detail['is_required'] === 'Yes') {
                    $messages["result_details.{$index}.result.required"] = 'Result is required for this parameter.';
                }
            }
        }

        return $messages;
    }
}
