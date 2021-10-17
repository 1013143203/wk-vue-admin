<?php

namespace App\Http\Requests\Admin;


class UserUpdateRequest extends Base
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:user,id|numeric',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => '数据不存在',
            'id.exists' => '数据不存在',
        ];
    }
}
