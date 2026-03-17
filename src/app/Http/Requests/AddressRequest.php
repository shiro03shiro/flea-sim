<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal_code' => 'required|regex:/^[0-9]{3}-[0-9]{4}$/|size:8',
            'address' => 'required',
            'building' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号を8文字（半角数字・ハイフンあり）で入力してください',
            'postal_code.size' => '郵便番号を8文字（半角数字・ハイフンあり）で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
