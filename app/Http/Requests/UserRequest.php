<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25',
            'age' => 'required',
            'gender' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'occupation_id' => 'required',
            'avatar' => 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200'
        ];
    }

    public function messages(){
        return [
          'name.required' => '用户名不能为空！',
          'name.between' => '用户名必须介于3到25个字符之间！',
          'age.required' => '未选择年龄！',
          'gender.required' => '未选择性别！',
          'province_id.required' => '未选择城市！',
          'city_id.required' => '未选择城市！',
          'occupation_id.required' => '未选择职业！',
          'avatar.required' => '未设置头像！',
          'avatar.mimes' => '头像格式不支持，仅支持jpeg,bmp,png,gif格式！',
          'avatar.dimensions' => '头像不够清晰，宽和高至少需要200px！'
        ];
    }
}
