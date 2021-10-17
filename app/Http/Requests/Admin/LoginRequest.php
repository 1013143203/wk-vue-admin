<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [    
            'username' => 'required|exists:user,username|max:50',
            'password' => 'required|max:50',
        ];
    }
    public function messages()
    {
        return [
            'username.exists' => '用户不存在',
            'username.required' => '用户不能为空',
            'password.required' => '密码不能为空',
        ];
    }
    // 重写ajax请求验证错误响应格式（防止验证422报错）
    protected function failedValidation(Validator $validator)
    {
        // 此处自定义您想要返回的数据类型
        $data = [
            'code' => 203,
            'msg' => $validator->errors()->first(),
        ];
        throw new HttpResponseException(response()->json($data));
    }
}
