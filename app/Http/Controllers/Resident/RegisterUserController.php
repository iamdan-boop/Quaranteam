<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Hash;

class RegisterUserController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }


    public function store(RegisterUserRequest $request)
    {
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
        ]);
        return redirect()->route('resident.residence.dashboard');
    }
}
