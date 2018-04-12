<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
            case 'PUT':
            case 'PATCH':
        {
            return [
                'title' => 'required|max:50',
                'content' => 'required',
                'category_id' => 'required|numeric',
                'cover' => 'required'
            ];
        }
            case 'GET':
            case 'DELETE':
            default:
        {
            return [];
        }
        }
    }

    public function messages(){
        return [
            'title.required' => '未填写标题！',
            'title.max' => '标题最多50个字符！',
            'content.required' => '未填写内容',
            'cover.required' => '请选择封面'
        ];
    }
}
