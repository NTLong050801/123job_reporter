<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'module_id' => 'required',
            'uri' => 'required',
            'icon'  => 'max:50'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Trường này là bắt buộc',
            'module_id.required' => 'Trường này là bắt buộc',
            'uri.required' => 'Trường này là bắt buộc',
            'title.max'      => 'Tối đa 50 ký tự',
            'icon.max'       => 'Tối đa 50 ký tự',
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
