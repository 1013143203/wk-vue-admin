<?php

namespace App\Http\Requests\Admin;

class SettingsUpdateRequest extends Base
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
            'value' => 'required',
            'id' => 'required|exists:settings,id|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => '配置已存在',
            'name.required' => '配置名称不能为空',
            'value.required' => '配置内容不能为空',
            'id.required' => 'ID不能为空',
            'id.exists' => '数据不存在',
        ];
    }
}
