<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $user = User::where(['email' => $request->username])->orWhere('username', '=', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['message' => 'Invalid Username or Password']);
        }
        if (auth()->attempt(['email' => $user->email, 'password' => $request->password])) {
            if ($user->is_admin) {
                return redirect()->route('admin.admin.dashboard');
            }
            return redirect()->route('resident.residence.dashboard');
        }
    }
}
