<?php

namespace App\Http\Requests\Admin;

class MemberLevelUpdateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:member_level,id|numeric',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => '数据不存在',
            'id.exists' => '数据不存在',
            'id.numeric' => '数据不存在',
        ];
    }
}
