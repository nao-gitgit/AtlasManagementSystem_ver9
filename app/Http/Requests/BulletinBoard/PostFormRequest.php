<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            // 投稿タイトル
            'post_title' => 'required|string|max:100',
            // 投稿内容
            'post_body' => 'required|string|max:2000',
            // サブカテゴリー
            'sub_category_id' => 'required|exists:sub_categories,id',
        ];
    }

    public function messages(){
        return [
            // 投稿タイトル
            'post_title.required' => 'タイトルは必ず入力してください。',
            'post_title.string' => 'タイトルは文字列である必要があります。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            // 投稿内容
            'post_body.required' => '投稿内容は必ず入力してください。',
            'post_body.string' => '投稿内容は文字列である必要があります。',
            'post_body.max' => '最大文字数は2000文字です。',
            // サブカテゴリー
            'sub_category_id.required' => 'サブカテゴリーを選択してください。',
            'sub_category_id.exists' => '選択されたサブカテゴリーは存在しません。',
        ];
    }
}
