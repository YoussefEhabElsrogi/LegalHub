<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // يجب أن تكون true للسماح بالوصول
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id', // التحقق من أن العميل موجود
            'establishment_fees' => 'required|numeric|min:0',
            'fees' => 'required|numeric',
            'advance_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf|max:2048', // تعديل ليدعم ملفات PDF متعددة
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'اختيار الموكل مطلوب.',
            'client_id.exists' => 'الموكل المختار غير موجود.',
            'establishment_fees.required' => 'رسوم التأسيس مطلوبة.',
            'establishment_fees.numeric' => 'رسوم التأسيس يجب أن تكون رقم.',
            'establishment_fees.min' => 'رسوم التأسيس يجب أن تكون أكبر من أو تساوي 0.',
            'advance_amount.required' => 'المبلغ المدفوع مسبقاً مطلوب.',
            'advance_amount.numeric' => 'المبلغ المدفوع مسبقاً يجب أن يكون رقم.',
            'advance_amount.min' => 'المبلغ المدفوع مسبقاً يجب أن يكون أكبر من أو يساوي 0.',
            'fees.required' => 'الرسوم مطلوبة.',
            'fees.numeric' => 'الرسوم يجب أن تكون رقم.',
            'remaining_amount.required' => 'المبلغ المتبقي مطلوب.',
            'remaining_amount.numeric' => 'المبلغ المتبقي يجب أن يكون رقم.',
            'remaining_amount.min' => 'المبلغ المتبقي يجب أن يكون أكبر من أو يساوي 0.',
            'notes.string' => 'الملاحظات يجب أن تكون نصاً.',
            'files.*.file' => 'كل ملف مرفق يجب أن يكون ملفاً.',
            'files.*.mimes' => 'كل ملف يجب أن يكون بصيغة PDF.',
            'files.*.max' => 'حجم كل ملف يجب أن لا يتجاوز 2 ميجابايت.',
        ];
    }
}
