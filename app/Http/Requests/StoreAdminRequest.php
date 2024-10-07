<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:admins,email',
            ],
            'password' => [
                'required',
                'string',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:admins,phone',
            ],
            'role' => ['required', 'in:admin,superadmin'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
            'email.unique' => 'الأيميل موجود من قبل',
            'phone.unique' => 'رقم الهاتف موجود من قبل',
        ];
    }
}
