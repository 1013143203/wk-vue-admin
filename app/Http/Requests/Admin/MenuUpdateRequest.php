<?php

namespace App\Http\Requests\Admin;

class MenuUpdateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:50',
            'type' => 'required|numeric|in:1,2,3',
            'id' => 'required|exists:menu,id|numeric',
        ];
        if (request('pid')) {
            $rules['pid'] ='required|numeric|exists:menu,id';
        }
        if (in_array(request('type'),[1,2])){
            $rules['path'] ='required|max:50';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => '菜单名称不能为空',
            'pid.required' => '上级菜单不能为空',
            'pid.exists' => '上级菜单不能存在',
            'permission.required' => '权限标识不能为空',
            'type.required' => '类型不能为空',
            'type.numeric' => '类型错误',
            'type.in' => '类型错误',
            'id.required' => 'ID不能为空',
            'id.exists' => '数据不存在',
        ];
    }
}
