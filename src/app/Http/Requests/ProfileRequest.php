<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'avatar_path' => 'required|image|mimes:png,jpeg|max:2048',
            'name' => 'required|max:20',
            'postal_code' => 'required|max:8',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'avatar_path.required' => '画像を登録してください',
        'avatar_path.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        'name.required' => 'お名前を入力してください',
        'postal_code.required' => '郵便番号を入力してください',
        'postal_code.max' => '郵便番号を8文字（ハイフンあり）で入力してください',
        'address.required' => '住所を入力してください',
        ];
    }
}

