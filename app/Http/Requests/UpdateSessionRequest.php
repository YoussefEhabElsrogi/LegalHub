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
        // نحتاج إلى تعديلها للسماح للمستخدم بتنفيذ الطلب
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
        return [
            'client_id' => 'required|exists:clients,id',
            'session_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sessions')->ignore($sessionId),
            ],
            'session_type' => 'required|string|max:255',
            'opponent_name' => 'required|string|max:255',
            'session_date' => 'required|date',
            'session_status' => 'required|string|in:سارية,محفوظة',
            'notes' => 'nullable|string',
            'files.*' => 'nullable|mimes:pdf|max:2048',
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'الرجاء اختيار العميل.',
            'client_id.exists' => 'العميل المختار غير موجود.',
            'session_number.required' => 'الرجاء إدخال رقم الجلسة.',
            'session_number.unique' => 'رقم الجلسة مستخدم بالفعل.',
            'session_type.required' => 'الرجاء إدخال نوع الجلسة.',
            'opponent_name.required' => 'الرجاء إدخال اسم الخصم.',
            'opponent_name.string' => 'اسم الخصم يجب أن يكون نصاً.',
            'opponent_name.max' => 'اسم الخصم يجب أن لا يزيد عن 255 حرفاً.',
            'session_date.required' => 'الرجاء إدخال تاريخ الجلسة.',
            'session_status.required' => 'الرجاء اختيار حالة الجلسة.',
            'files.*.mimes' => 'الملفات يجب أن تكون بصيغة PDF.',
            'files.*.max' => 'حجم الملف يجب أن لا يتجاوز 2MB.',
        ];
    }
}
