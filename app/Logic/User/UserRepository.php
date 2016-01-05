<?php

namespace App\Logic\User;

use Hash;
use App\Models\Role;
use App\Models\User;

class UserRepository
{

    public function register($data)
    {

        $user = new User;
        $user->email            = $data['email'];
        $user->first_name       = ucfirst($data['first_name']);
        $user->last_name        = ucfirst($data['last_name']);
        $user->password         = Hash::make($data['password']);
        $user->save();

        //Assign Role
        $role = Role::whereName('user')->first();
        $user->assignRole($role);

    }
}
