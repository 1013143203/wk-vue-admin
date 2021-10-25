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
        $rule = [
            'id' => 'required|exists:user,id|numeric',
        ];
        if (request('password')){
            $rule['password'] = 'required|min:5|max:15';
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'id.required' => '数据不存在',
            'id.exists' => '数据不存在',
        ];
    }
}
