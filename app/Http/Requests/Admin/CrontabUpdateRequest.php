<?php

namespace App\Http\Requests\Admin;

class CrontabUpdateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'id' => 'required|exists:crontab,id|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'id.required' => 'ID不能为空',
            'id.exists' => '数据不存在',
        ];
    }
}
