<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            'confirm_password' => 'Nhập lại mật khẩu mới',
        ];
    }


    public function messages()
    {
        return [
            'old_password.required' => ':attribute không được để trống',
            'new_password.required' => ':attribute không được để trống',
            'new_password.min' => ':attribute phải tối thiểu :min ký tự',
            'confirm_password.required' => ':attribute không được để trống',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
