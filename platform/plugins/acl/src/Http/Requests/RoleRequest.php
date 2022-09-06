<?php

namespace Workable\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50'.($this->route('id') ? '' : '|unique:admin_roles'),
            'title' => 'required|max:50|min:4',
            'company_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Trường này bắt buộc nhập',
            'title.required'      => 'Trường này bắt buộc nhập',
            'company_id.required' => 'Trường này bắt buộc nhập',
            'name.unique'         => 'Tên này đã được sử dụng',
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
