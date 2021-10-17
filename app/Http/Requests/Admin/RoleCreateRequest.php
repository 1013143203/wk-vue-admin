<?php

namespace App\Http\Requests\Admin;


class RoleCreateRequest extends Base
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:role,name|max:50',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '角色名称不能为空',
            'name.unique' => '角色已存在',
        ];
    }
}
