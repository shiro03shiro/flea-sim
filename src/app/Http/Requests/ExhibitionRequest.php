<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'image_path' => 'required|image|mimes:png,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string|max:255',
            'condition' => 'required',
            'category_id' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'image_path.required' => '商品画像を選択してください',
            'image_path.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'name.required' => '商品名を入力してください',
            'name.max' => '商品名は255文字以内で入力してください',
            'brand_name.max' => 'ブランド名は255文字以内で入力してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格は数値で入力してください',
            'price.min' => '販売価格は0円以上で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',
        ];
    }
}
