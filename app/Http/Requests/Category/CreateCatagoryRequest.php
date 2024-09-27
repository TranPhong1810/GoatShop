<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCatagoryRequest extends FormRequest
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
            'name' => 'required|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.string' => 'Tên phải là một chuỗi ký tự',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
        ];
    }
}
