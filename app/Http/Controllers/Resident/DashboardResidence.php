<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

class DashboardResidence extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('user.home');
    }


    public function destroy()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
