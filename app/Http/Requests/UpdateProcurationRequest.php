<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcurationRequest extends FormRequest
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
            'authorization_number' => 'required|string|max:255', 
            'notebook_number' => 'required|string|max:255', 
            'notes' => 'nullable|string', 
            'files.*' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'يرجى اختيار العميل.',
            'client_id.exists' => 'العميل المختار غير موجود.',
            'authorization_number.required' => 'يرجى إدخال رقم التوكيل.',
            'authorization_number.string' => 'رقم التوكيل يجب أن يكون نصاً.',
            'authorization_number.max' => 'رقم التوكيل لا يجب أن يتجاوز 255 حرفاً.',
            'notebook_number.required' => 'يرجى إدخال رقم التوكيل في الدفتر.',
            'notebook_number.string' => 'رقم التوكيل في الدفتر يجب أن يكون نصاً.',
            'notebook_number.max' => 'رقم التوكيل في الدفتر لا يجب أن يتجاوز 255 حرفاً.',
            'notes.string' => 'الملاحظات يجب أن تكون نصاً.',
            'files.*.file' => 'يجب أن تكون الملفات المرفقة ملفات.',
            'files.*.mimes' => 'يجب أن تكون الملفات من نوع PDF فقط.',
            'files.*.max' => 'حجم الملف لا يجب أن يتجاوز 2048 كيلوبايت.',
        ];
    }
}
