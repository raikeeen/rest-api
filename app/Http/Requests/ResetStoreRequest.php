<?php

namespace App\Http\Requests;

use App\Models\ResetPassword;
use Illuminate\Foundation\Http\FormRequest;

class ResetStoreRequest extends FormRequest
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
            'token' => 'required|exists:reset_password,token',
            'password' => 'required|confirmed|min:8'
        ];
    }

    /**
     * @param $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $token = ResetPassword::where('token', $this->token)->first();
            if(isset($token) && $token->tokenExpired()) {
                $validator->errors()->add('token', 'This token is expired.');
            }
        });
    }
}
