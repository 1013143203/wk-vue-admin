<?php

namespace App\Http\Requests\Admin\Member;

use App\Http\Requests\Admin\Base;

class LevelCreateRequest extends Base
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
            'level' => 'required|unique:member_level,level|numeric|min:1|max:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '菜单名称不能为空',
            'level.required' => '等级不能为空',
            'level.unique' => '等级已存在',
            'level.numeric' => '等级只能为数字',
        ];
    }
}
