<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // ユーザー新規登録画面のバリデーション設定
            'over_name'       => ['required', 'string', 'max:10'],
            'under_name'      => ['required', 'string', 'max:10'],
            'over_name_kana'  => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー]+$/u'],
            'under_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー]+$/u'],
            'mail_address'    => ['required', 'email', 'max:100', 'unique:users,mail_address'],
            'sex'             => ['required', 'in:1,2,3'],
            'old_year'        => ['required'],
            'old_month'       => ['required'],
            'old_day'         => ['required'],
            'role'            => ['required', 'in:1,2,3,4'],
            'password'        => ['required', 'min:8', 'max:30', 'confirmed'],
        ];
    }
}
