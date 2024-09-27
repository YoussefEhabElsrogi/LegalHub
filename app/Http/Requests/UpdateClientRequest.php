<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'national_id' => 'required|string|max:14|unique:clients,national_id,' . $this->route('client'),
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'هذا الحقل مطلوب.',
            'string' => 'يجب أن يكون هذا الحقل نصًا.',
            'max' => 'يجب ألا يتجاوز هذا الحقل :max حرفًا.',
            'unique' => 'هذا الرقم القومي موجود بالفعل.',
        ];
    }
}
