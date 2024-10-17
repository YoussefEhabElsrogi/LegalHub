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
            'client_id' => 'required|exists:clients,id',
            'company_name' => 'required|unique:companies,company_name|string|max:255',
            'establishment_fees' => 'required|numeric|min:0',
            'fees' => 'required|numeric',
            'advance_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }
}
