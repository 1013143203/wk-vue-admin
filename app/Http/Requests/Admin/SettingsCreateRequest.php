<?php

namespace App\Http\Requests\Admin;

class SettingsCreateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:settings,name|max:50',
            'value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => '配置已存在',
            'name.required' => '配置名称不能为空',
            'value.required' => '配置内容不能为空',
        ];
    }
}
