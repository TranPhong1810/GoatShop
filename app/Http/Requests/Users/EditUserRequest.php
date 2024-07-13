<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required|',
            'email' => 'required|email|unique:users,email,'.$this->id.'',
            'user_catalogue_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.string' => 'Tên phải là một chuỗi ký tự',
            'name.max' => 'Tên không được vượt quá 255 ký tự',

            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email không được vượt quá 255 ký tự',

            'user_catalogue_id.required' => 'Bạn chưa chọn nhóm thành viên',
            'user_catalogue_id.integer' => 'Nhóm thành viên phải là một số nguyên',
        ];
    }
}
