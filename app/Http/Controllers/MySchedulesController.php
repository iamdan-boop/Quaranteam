<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class MySchedulesController extends Controller
{


    public function index()
    {
        $appointments = Appointment::whereHas('users', function ($q) {
            $q->whereIn('id', [auth()->user()->id]);
        })->get();
        return view('user.my-schedule', compact('appointments'));
    }
}
