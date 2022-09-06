<?php

namespace Modules\Monitor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMonitorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required',
            'site_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'Url không được để trống' ,
            'site_id.required' => 'Url không được để trống'
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

