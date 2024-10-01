<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            "files" => "required|array", // Check that files is present and is an array
            'files.*' => ' mimes:pdf|max:2048',
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
            'files.required' => 'من فضلك اختر الملف',
            'files.array' => 'يجب أن تكون الملفات مصفوفة',
            'files.*.mimes' => 'يجب أن تكون الملفات بصيغة PDF فقط.',
            'files.*.max' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
