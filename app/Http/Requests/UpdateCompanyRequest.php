<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        $companyId = $this->route('company');
        return [
            'client_id' => 'required|exists:clients,id',
            'company_name' => 'required|string|max:255|unique:companies,company_name,' . $companyId,
            'establishment_fees' => 'required|numeric|min:0',
            'fees' => 'required|numeric|min:0',
            'advance_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'يجب اختيار اسم الموكل.',
            'client_id.exists' => 'الموكل المختار غير موجود.',
            'company_name.required' => 'يجب إدخال اسم الشركة.',
            'company_name.string' => 'اسم الشركة يجب أن يكون نصاً.',
            'company_name.max' => 'اسم الشركة يجب أن لا يتجاوز 255 حرف.',
            'company_name.unique' => 'اسم الشركة موجود بالفعل في قاعدة البيانات.',
            'establishment_fees.required' => 'يجب إدخال رسوم التأسيس.',
            'establishment_fees.numeric' => 'يجب أن تكون رسوم التأسيس عددًا.',
            'fees.required' => 'يجب إدخال الأتعاب.',
            'fees.numeric' => 'يجب أن تكون الأتعاب عددًا.',
            'advance_amount.required' => 'يجب إدخال قيمة المقدم.',
            'advance_amount.numeric' => 'يجب أن تكون قيمة المقدم عددًا.',
            'remaining_amount.required' => 'يجب إدخال قيمة المؤخر.',
            'remaining_amount.numeric' => 'يجب أن تكون قيمة المؤخر عددًا.',
        ];
    }
}
