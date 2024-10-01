<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'new_password_confirmation' => 'required|string|min:8',
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
            'current_password.required' => 'يرجى إدخال كلمة المرور الحالية.',
            'new_password.required' => 'يرجى إدخال كلمة المرور الجديدة.',
            'new_password.min' => 'يجب أن تحتوي كلمة المرور الجديدة على 8 أحرف على الأقل.',
            'new_password.confirmed' => 'كلمة المرور الجديدة وتأكيد كلمة المرور غير متطابقتين.',
            'new_password_confirmation.required' => 'يرجى تأكيد كلمة المرور الجديدة.',
            'new_password_confirmation.min' => 'يجب أن تحتوي تأكيد كلمة المرور على 8 أحرف على الأقل.',
        ];
    }
}
