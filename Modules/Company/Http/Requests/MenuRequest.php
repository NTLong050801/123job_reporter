<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'menu_name'     => 'required|max:50',
            'menu_slug'     => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'menu_name.required' => 'Trường này là bắt buộc',
            'menu_slug.required' => 'Trường này là bắt buộc',
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
