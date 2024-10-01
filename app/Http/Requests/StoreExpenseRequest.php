<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
            'client_id' => 'required|exists:clients,id',
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
            'expense_name.required' => 'اسم المصروف مطلوب.',
            'expense_name.string' => 'اسم المصروف يجب أن يكون نصًا.',
            'expense_name.max' => 'اسم المصروف يجب ألا يتجاوز 255 حرفًا.',
            'amount.required' => 'قيمة المصروف مطلوبة.',
            'amount.numeric' => 'قيمة المصروف يجب أن تكون رقمًا.',
            'amount.min' => 'قيمة المصروف يجب أن تكون أكبر من أو تساوي 0.',
            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',
            'notes.max' => 'الملاحظات يجب ألا تتجاوز 500 حرفًا.',
            'client_id.required' => 'معرف العميل مطلوب.',
            'client_id.exists' => 'معرف العميل غير موجود في قاعدة البيانات.',
        ];
    }
}
