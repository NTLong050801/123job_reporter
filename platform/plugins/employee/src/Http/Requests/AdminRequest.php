<?php

namespace Workable\Employee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $unique = $request->id ? '' : '|unique:admins';
        $rule = [
            'company_id' => 'required',
            'department_id' => 'required',
            'name' => 'required',
            'email' => 'required|email'.$unique,
            'date_of_birth' => 'required',
            'role' =>'required',
            'phone' =>'required'.$unique,
            'skype' =>'required'.$unique,
        ];
        if(array_key_exists('pwd', $request->toArray())) {
            $rule['pwd'] = 'required|min:6';
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'name.required'=> 'Không được để trống',
            'company_id.required'=> 'Không được để trống',
            'department_id.required'=> 'Không được để trống',
            'date_of_birth.required'=> 'Không được để trống',
            'email.required'=> 'Không được để trống',
            'role.required' =>'Vai trò không được để trống',
            'phone.required'=> 'Không được để trống',
            'skype.required'=> 'Không được để trống',
            'email.unique'=> 'Email đã tồn tại',
            'phone.unique'=> 'Phone đã tồn tại',
            'skype.unique'=> 'Skype đã tồn tại',
            'pwd.min'=>"Mật khẩu tối thiểu 6 kí tự",
            'pwd.required'=>'Mật khầu không được để trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
