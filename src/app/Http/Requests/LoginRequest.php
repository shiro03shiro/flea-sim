<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        \Log::info('LoginRequest rules called');
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
        'email.required' => 'メールアドレスを入力してください',
        'password.required' => 'パスワードを入力してください',
        ];
    }

    public function failedAuthorization()
    {
        throw ValidationException::withMessages([
            'email' => 'ログイン情報が登録されていません。',
        ]);
    }

    public function authenticate(): ?User
    {
        $user = User::where('email', $this->email)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            $this->failedAuthorization();
        }

        return $user;
    }
}
