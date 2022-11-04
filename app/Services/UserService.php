<?php

namespace App\Services;

use App\Mail\ResetPassword;
use App\Models\ResetPassword as ResetPasswordModel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
        return User::create($data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function sendResetToken(array $data): void
    {
        $user = User::where('email', $data['email'])->first();

        $token = Str::random(128);

        if(!isset($user->resetPassword->token)) {
            $user->resetPassword()->create([
                'token' => $token
            ]);

            Mail::to($user->email)->send(new ResetPassword($token));
        } else {
            $user->resetPassword()->update([
                'token' => $token,
                'updated_at' => now(),
                'created_at' => now()
            ]);

            Mail::to($user->email)->send(new ResetPassword($token));
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function storeUserPassword(array $data): void
    {
        // Note: No model events are fired when updating a set of models via the Eloquent query builder.
        // Should I use method bcrypt() again in this case? The model user has already included the bcrypt()
        $resetPassword = ResetPasswordModel::where('token', $data['token'])->first();
        $resetPassword->user()->update([
            'password' => bcrypt($data['password'])
        ]);

        $resetPassword->delete();
    }
}
