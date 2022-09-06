<?php
namespace Workable\ManagerSite\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ManagerSiteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'site_name' => 'required',
            'country' =>  'required|unique:sites,country,'.$this->id,
            'site_url' => 'required|unique:sites,country,'.$this->id,
            'status' => 'required',
            'continent' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'site_name.required'=> 'Không được để trống',
            'site_url.required'=> 'Không được để trống',
            'site_url.unique'=> 'Url đã tồn tại',
            'country.required'=> 'Không được để trống',
            'country.unique'=> 'Country đã tồn tại',
            'status.required'=> 'Không được để trống',
            'continent.required' => 'Không được để trống',

        ];
    }

    public function authorize()
    {
        return true;
    }

}
