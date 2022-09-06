<?php

namespace Workable\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required' . ($this->route('id') ? '' : '|unique:admin_permission'),
            'http_uri' => 'required',
            'company_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Trường này là bắt buộc',
            'name.unique'       => 'Đã tồn tại bản ghi',
            'http_uri.required' => 'Trường này là bắt buộc',
            'company_id.required' => 'Trường này là bắt buộc',
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
