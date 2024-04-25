<?php

namespace App\Http\Requests;

use App\Enums\LeaveType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LeaveCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(array_column(LeaveType::cases(), 'value'))],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'gte:start_date'],
            'leave_reason' => ['required', 'string'],
        ];
    }
}
