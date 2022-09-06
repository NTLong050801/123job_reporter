<?php

namespace Workable\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnnouncementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this->instance()->all();
        $files   = $request['files'] ?? null;

        $rules = [
            'name'       => 'required',
            'company_id' => 'required',
            'type'       => 'required',
            'content'    => 'required',
        ];
        if ($files) {
            foreach($files as $key => $file) {
                $rules['files.'.$key] = 'mimes:doc,docx,pdf,xlsx';
            }
        }

        return $rules;
    }

    public function messages()
    {
        $request = $this->instance()->all();
        $files   = $request['files'] ?? null;

        $messages = [
            'name.required'       => 'Trường này là bắt buộc',
            'company_id.required' => 'Trường này là bắt buộc',
            'type.required'       => 'Trường này là bắt buộc',
            'content.required'    => 'Trường này là bắt buộc',
        ];

        if ($files) {
            foreach ($files as $key => $file) {
                $messages['files.' . $key . '.mimes'] = 'File tải lên phải có định dạng: :values';
            }
        }
        return $messages;
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

