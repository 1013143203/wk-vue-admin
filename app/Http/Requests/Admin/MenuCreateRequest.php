<?php

namespace App\Http\Requests\Admin;

class MenuCreateRequest extends Base
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
        ];
        if (request('pid')) {
            $rules['pid'] ='required|numeric|exists:menu,id';
        }
        if (in_array(request('type'),[1,2])){
            $rules['path'] ='required|unique:menu,path|max:50';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => '菜单名称不能为空',
            'pid.required' => '上级菜单不能为空',
            'pid.exists' => '上级菜单不能存在',
            'type.required' => '类型不能为空',
            'type.numeric' => '类型错误',
            'path.required' => '连接不能为空',
            'path.unique' => '连接已存在',
        ];
    }
}
