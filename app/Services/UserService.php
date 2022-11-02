<?php

namespace App\Services;

use App\Models\User;

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
