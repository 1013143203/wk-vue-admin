<?php

namespace App\Http\Requests\Admin;

class UserCreateRequest extends Base
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [    
            'username' => 'required|unique:user,username|max:50',
            'password' => 'required|min:5|max:15',
        ];
    }
    public function messages()
    {
        return [
            'username.unique' => '用户已存在',
            'username.required' => '用户不能为空',
            'password.required' => '密码不能为空',
            'password.min' => '密码必须5到12位1',
            'password.max' => '密码必须5到12位2',
        ];
    }
}
