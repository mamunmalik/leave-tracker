<?php

namespace App\Http\Requests;

use App\Enums\LeaveType;
use App\Models\LeaveRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
            'leave_type' => ['required', Rule::in(array_column(LeaveType::cases(), 'name'))],
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date',
                function ($attribute, $value, $fail) {
                    $message = $this->checkLeaveDate();
                    if (!empty($message)) {
                        $fail($message);
                    }
                }
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) {
                    $message = $this->checkLeaveDate();
                    if (!empty($message)) {
                        $fail($message);
                    }
                }
            ],
            'leave_reason' => ['required', 'string'],
        ];
    }

    private function checkLeaveDate(): string
    {

        // $leaveRequest = LeaveRequest::where('user_id', Auth::id())
        //     ->where('start_date', '>=', $this->start_date)
        //     ->where('end_date', '<=', $this->end_date)
        //     //->where('status', '!=', LeaveStatus::REJECTED->name)
        //     ->get();    
        // dd($leaveRequest);
        // if ($leaveRequest) {
        //     return 'A Leave Request is already applied "' . $this->start_date . '" to "' . $this->end_date;
        // }
        return '';
    }
}
