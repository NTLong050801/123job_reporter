<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'email' => 'required',
            'skype' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'skype' => 'Skype',
        ];
    }


    public function messages()
    {
        return [
            'phone.required' => ':attribute không được để trống',
            'email.required' => ':attribute không được để trống',
            'skype.required' => ':attribute không được để trống',
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
