<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'session_type' => 'required|string',  // هذا السطر للتحقق من إدخال session_type
            'session_number' => 'required|string',
            'opponent_name' => 'required|string',
            'session_date' => 'required|date',
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
            'client_id.required' => 'يجب اختيار العميل.',
            'client_id.exists' => 'العميل المختار غير موجود.',
            'session_type.required' => 'نوع الجلسة مطلوب.',
            'session_type.string' => 'نوع الجلسة يجب أن يكون نص.',
            'session_type.max' => 'نوع الجلسة يجب ألا يتجاوز 255 حرف.',
            'session_number.required' => 'رقم الجلسة مطلوب.',
            'session_number.string' => 'رقم الجلسة يجب أن يكون نص.',
            'session_number.max' => 'رقم الجلسة يجب ألا يتجاوز 255 حرف.',
            'session_number.unique' => 'رقم الجلسة موجود بالفعل.',
            'opponent_name.required' => 'اسم الخصم مطلوب.',
            'opponent_name.string' => 'اسم الخصم يجب أن يكون نص.',
            'opponent_name.max' => 'اسم الخصم يجب ألا يتجاوز 255 حرف.',
            'session_date.required' => 'تاريخ الجلسة مطلوب.',
            'session_date.date' => 'تاريخ الجلسة يجب أن يكون تاريخ صحيح.',
            'session_status.required' => 'حالة الجلسة مطلوبة.',
            'session_status.in' => 'الحالة يجب أن تكون سارية أو محفوظة.',
            'files.*.mimes' => 'يجب أن تكون الملفات من نوع PDF فقط.',
            'files.*.max' => 'حجم الملف لا يجب أن يتجاوز 2 ميجابايت.',
        ];
    }
}
