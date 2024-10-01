<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcurationRequest extends FormRequest
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
     * Get the validation messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'يجب اختيار عميل.',
            'authorization_number.required' => 'رقم التوكيل مطلوب.',
            'notebook_number.required' => 'رقم السجل مطلوب.',
            'files.*.file' => 'كل ملف مرفق يجب أن يكون ملفاً.',
            'files.*.mimes' => 'يجب أن تكون الملفات بصيغة PDF فقط.',
            'files.*.max' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
