<?php
namespace Workable\Attribute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AttributeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $request_id = $request->id ?? '';
        return [
            'name' => 'required|unique:attributes,name,' . $request_id,
            'type' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required'=> 'Không được để trống',
            'type.required'=> 'Không được để trống',
        ];
    }

    public function authorize()
    {
        return true;
    }

}
