<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'min:5', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'unique:users', 'max:100'],
            'password' => ['required', 'string', 'min:6']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống . ',
            'min' => ':attribute ít nhất có :min ký tự . ',
            'max' => ':attribute ít nhất có :max ký tự . ',
            'string' => ':attribute không đúng định dạng.',
            'email' => ':attribute không đúng định dạng.',
            'unique' => ':attribute đã tồn tại trên hệ thống . '
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'User name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }


}
