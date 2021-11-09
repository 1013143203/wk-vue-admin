<?php

namespace App\Http\Requests\Admin;


class FileRequest extends Base
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'identifier.required' => '上传失败',
        ];
    }
}
