<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'password' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages(): array
    {
        return [
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email chưa đúng định dạng',
        ];
    }
}
