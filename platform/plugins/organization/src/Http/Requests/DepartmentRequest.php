<?php

namespace Workable\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'company_id' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này là bắt buộc',
            'company_id.required' => 'Trường này là bắt buộc',
            'status.required' => 'Trường này là bắt buộc'
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
