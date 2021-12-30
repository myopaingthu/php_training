<?php

namespace App\Dao\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;
use App\Contracts\Dao\Auth\AuthDaoInterface;

/**
 * Data Access Object for Authentication
 */
class AuthDao implements AuthDaoInterface
{
    /**
     * To Save User with values from request
     * @param Request $request request including inputs
     * @return Object created user object
     */
    public function saveUser(UserRegisterRequest $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}