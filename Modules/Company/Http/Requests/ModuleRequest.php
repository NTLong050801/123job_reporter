<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required|unique:admin_permissions',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Không được để trống',
            'title.unique'=>'Tên đã tồn tại'
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
