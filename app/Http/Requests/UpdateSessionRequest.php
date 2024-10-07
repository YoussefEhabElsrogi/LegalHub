<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSessionRequest extends FormRequest
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
        $sessionId = $this->route('session');
        $sessionDate = $this->input('session_date');

        return [
            'client_id' => 'required|exists:clients,id',
            'session_type' => 'required|string|max:255',
            'session_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sessions')->ignore($sessionId),
            ],
            'opponent_name' => 'required|string|max:255',
            'session_date' => 'required|date|after_or_equal:today',
            'reminder_dates' => 'nullable|array',
            'reminder_dates.*' => [
                'nullable',
                'before:' . $sessionDate,
            ],
            'session_status' => 'required|in:سارية,محفوظة',
            'notes' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'session_number.unique' => 'رقم الدعوي مستخدم بالفعل.',
            'session_date.date' => 'تاريخ الدعوي يجب أن يكون تاريخ صحيح.',
            'session_date.after_or_equal' => 'تاريخ الدعوي يجب أن يكون تاريخ اليوم أو بعده.',
            'reminder_dates.array' => 'تذكيرات يجب أن تكون مصفوفة.',
            'reminder_dates.*.date' => 'يجب أن تكون تواريخ التذكير صحيحة.',
            'reminder_dates.*.before' => 'تاريخ التذكير يجب أن يكون قبل تاريخ الدعوي.',
            'session_status.in' => 'الحالة يجب أن تكون سارية أو محفوظة.',
        ];
    }
}
