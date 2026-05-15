<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentFormRequest extends FormRequest
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
            // コメントのバリデーション設定
            'comment' => 'required|string|max:250',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages()
    {
        return [
            'comment.required' => 'コメントは必ず入力してください。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'タイトルは250文字以内で入力してください。',
        ];
    }
}
