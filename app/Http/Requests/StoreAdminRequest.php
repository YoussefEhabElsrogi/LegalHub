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
                'lowercase',
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
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.max' => __('validation.max.string'),
            'email.required' => __('validation.required'),
            'email.string' => __('validation.string'),
            'email.lowercase' => __('validation.lowercase'),
            'email.email' => __('validation.email'),
            'email.max' => __('validation.max.string'),
            'email.unique' => __('validation.unique'),
            'password.required' => __('validation.required'),
            'password.min' => __('validation.password.min'),
            'password.mixed' => __('validation.password.mixed'),
            'password.numbers' => __('validation.password.numbers'),
            'password.symbols' => __('validation.password.symbols'),
            'password.uncompromised' => __('validation.password.uncompromised'),
            'phone.required' => __('validation.required'),
            'phone.string' => __('validation.string'),
            'phone.max' => __('validation.max.string'),
            'phone.unique' => __('validation.unique'),
            'role.required' => __('validation.required'),
            'role.in' => __('validation.in'),
            'image.image' => __('validation.image'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max.file'),
        ];
    }
}
