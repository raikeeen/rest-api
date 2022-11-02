<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!Hash::check($this->password, User::where('email', $this->email)->first()['password'])) {
                $validator->errors()->add('password', 'The password is incorrect.');
            }
        });
    }
}
