<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $adminId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($adminId),
            ],
            'phone' => [
                'required',
                'string',
                'max:30',
                Rule::unique('admins')->ignore($adminId),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Customize the validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'البريد الإلكتروني مُستخدم بالفعل.',
            'phone.unique' => 'رقم الهاتف مُستخدم بالفعل.',
        ];
    }
}
