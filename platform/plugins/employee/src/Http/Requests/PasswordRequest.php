<?php

namespace Workable\Employee\Http\Requests;

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
            //
            'oldPwd' => "required",
            'newPwd' => "required|min:6",
            'rePwd' => "required",
        ];
    }

    public function messages()
    {
        return [
            'oldPwd.required' => 'Không được để trống',
            'newPwd.required' => 'Không được để trống',
            'newPwd.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'rePwd.required' => 'Không được để trống',
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
