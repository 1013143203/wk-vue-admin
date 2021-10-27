<?php

namespace App\Http\Requests\Admin;

class MemberUpdateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'mobile' => 'required|numeric',
            'id' => 'required|exists:member,id|numeric',
        ];
        if (request("level")) $rules['level'] = 'numeric|exists:member_level,id';
        return $rules;
    }
    public function messages()
    {
        return [
            'mobile.required' => '手机号不能为空',
            'mobile.numeric' => '手机号错误',
            'level.exists' => '等级不能存在',
            'level.numeric' => '等级错误错误',
            'id.required' => 'ID不能为空',
            'id.exists' => '数据不存在',
        ];
    }
}
