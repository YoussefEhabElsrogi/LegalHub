<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
                'unique:admins,phone',
            ],
            'password' => ['required', Rules\Password::defaults()],
            'phone' => [
                'required',
                'string',
                'max:11',
                'unique:admins,phone',
                'regex:/^(011|015|010|012)[0-9]{8}$/',
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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
            'name.required' => 'اسم المستخدم مطلوب.',
            'name.string' => 'اسم المستخدم يجب أن يكون نصًا.',
            'name.max' => 'اسم المستخدم يجب أن لا يتجاوز 255 حرفًا.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.string' => 'البريد الإلكتروني يجب أن يكون نصًا.',
            'email.lowercase' => 'البريد الإلكتروني يجب أن يكون بحروف صغيرة.',
            'email.email' => 'البريد الإلكتروني غير صالح.',
            'email.max' => 'البريد الإلكتروني يجب أن لا يتجاوز 255 حرفًا.',
            'email.unique' => 'هذا البريد الإلكتروني موجود بالفعل.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password' => 'كلمة المرور يجب أن تلبي المعايير المحددة.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
            'phone.regex' => 'رقم الهاتف يجب أن يبدأ بـ 011 أو 015 أو 010 أو 012.',
            'phone.max' => 'رقم الهاتف يجب أن لا يتجاوز 11 رقما.',
            'phone.unique' => 'هذا رقم الهاتف موجود بالفعل.',

            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, svg.',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2048 كيلوبايت.',
        ];
    }
}
