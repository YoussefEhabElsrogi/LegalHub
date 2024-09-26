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
            'password' => ['required', Rules\Password::defaults()],
            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:admins,phone',
            ],
            'role' => ['required', 'in:admin,superadmin'],
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
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
            'phone.max' => 'رقم الهاتف يجب أن لا يتجاوز 30 رقما.',
            'phone.unique' => 'هذا رقم الهاتف موجود بالفعل.',
            'role.required' => 'الدور مطلوب.',
            'role.in' => 'الدور يجب أن يكون إما admin أو superadmin.',
            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, svg.',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2048 كيلوبايت.',
        ];
    }
}
