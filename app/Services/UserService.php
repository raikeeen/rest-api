<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
}
