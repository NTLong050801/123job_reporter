<?php

namespace Modules\Company\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class AdminServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'service_group_id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'code' => 'required',
            'unit' => 'required',
            'meta_price' => 'required',
        ];
    }

    public function messages()
    {
        return [
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
