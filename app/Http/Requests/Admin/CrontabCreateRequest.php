<?php

namespace App\Http\Requests\Admin;

class CrontabCreateRequest extends Base
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
            'sType' => 'required|in:1,2',
            'tType' => 'required|numeric',
            'sBody' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '菜单名称不能为空',
            'sType.required' => '任务类型不能为空',
        ];
    }
}
