<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تغيير إلى true للسماح لجميع المستخدمين بإجراء الطلب
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'app_name' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'app_name.required' => 'اسم التطبيق مطلوب.',
            'app_name.string' => 'اسم التطبيق يجب أن يكون نصًا.',
            'app_name.max' => 'اسم التطبيق يجب أن لا يتجاوز 255 حرفًا.',
            'facebook.url' => 'رابط فيسبوك يجب أن يكون رابط صالح.',
            'instagram.url' => 'رابط إنستجرام يجب أن يكون رابط صالح.',
            'twitter.url' => 'رابط تويتر يجب أن يكون رابط صالح.',
        ];
    }
}
    