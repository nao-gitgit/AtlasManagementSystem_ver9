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
        return true;
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
            'over_name'  => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|max:30|regex:/^[ァ-ヶー]+$/u',
            'under_name_kana' => 'required|string|max:30|regex:/^[ァ-ヶー]+$/u',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            'sex' => 'required|in:1,2,3',
            'old_year' => 'required',
            'old_month' => 'required',
            'old_day' => 'required',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|min:8|max:30|confirmed',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages()
    {
        return [
            // 姓
            'over_name.required' => '姓は必ず入力してください。',
            'over_name.string' => '姓は文字列である必要があります。',
            'over_name.max' => '姓は10文字以内で入力してください。',
            // 名
            'under_name.required' => '名は必ず入力してください。',
            'under_name.string' => '名は文字列である必要があります。',
            'under_name.max' => '名は10文字以内で入力してください。',
            // 姓（カナ）
            'over_name_kana.required' => '姓（カナ）は必ず入力してください。',
            'over_name_kana.string' => '姓（カナ）は文字列である必要があります。',
            'over_name_kana.max' => '姓（カナ）は30文字以内で入力してください。',
            'over_name_kana.regex' => '姓（カナ）はカタカナで入力してください。',
            // 名（カナ）
            'under_name_kana.required' => '名（カナ）は必ず入力してください。',
            'under_name_kana.string' => '名（カナ）は文字列である必要があります。',
            'under_name_kana.max' => '名（カナ）は30文字以内で入力してください。',
            'under_name_kana.regex' => '名（カナ）はカタカナで入力してください。',
            // メールアドレス
            'mail_address.required' => 'メールアドレスは必ず入力してください。',
            'mail_address.email' => 'メールアドレスの形式で入力してください。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
            'mail_address.unique' => 'このメールアドレスはすでに登録されています。',
            // 性別
            'sex.required' => '性別は必ず選択してください。',
            // 生年月日
            'old_year.required' => '生年月日（年）は必ず入力してください。',
            'old_month.required' => '生年月日（月）は必ず入力してください。',
            'old_day.required' => '生年月日（日）は必ず入力してください。',
            // 役割
            'role.required' => '役割は必ず選択してください。',

            // パスワード
            'password.required' => 'パスワードは必ず入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以内で入力してください。',
            'password.confirmed' => '確認用パスワードが一致しません。',
        ];
    }

    // 日付のバリデーション設定
    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $year = $this->old_year;
            $month = $this->old_month;
            $day = $this->old_day;

            // 年月日揃っている場合のみ日付チェック
            if ($year && $month && $day){
                // 実在する日付かチェック
                if (!checkdate((int)$month, (int)$day, (int)$year)){
                    $validator->errors()->add('old_day', '正しい日付を入力してください。');
                }

                // 2000/1/1〜今日までのチェック
                $inputDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $minDate = '2000-01-01';
                $today = date('Y-m-d');

                if ($inputDate < $minDate || $inputDate > $today){
                    $validator->errors()->add('old_day', '2000年1月1日から今日までの日付を入力してください。');
                }
            }
        });
    }
}
