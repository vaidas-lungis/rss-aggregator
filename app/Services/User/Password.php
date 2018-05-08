<?php

namespace App\Services\User;


use App\User;
use Illuminate\Support\Facades\Hash;

class Password
{
    public function change(User $user, $oldPassword, $newPassword)
    {
        if (!Hash::check($oldPassword, $user->password)){
            throw new \InvalidArgumentException('Password does not match');
        }
        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }
}