<?php

namespace App\Http\Requests\Admin;

class RoleUpdateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['id'] ='required|exists:role,id|numeric';

        if (request('permission')) {
            $rules['permission'] ='required';
        }
        if (request('name')) {
            $rules['name'] ='required|max:50';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'permission.required' => '请选择权限',
            'id.required' => 'ID不能为空',
            'id.exists' => '数据不存在',
        ];
    }
}
