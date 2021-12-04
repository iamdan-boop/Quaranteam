<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('user.schedules', compact('appointments'));
    }



    public function store($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment->users->contains(auth()->user()->id) ||
            $appointment->slots_allocated == $appointment->slots_booked) {
            return redirect()->back();
        }
        $appointment->users()->attach(auth()->user()->id, ['reference_code' => Str::orderedUuid()]);
        $appointment->increment('slots_booked', 1);
        return redirect()->back();
    }



    public function show($id)
    {
        $appointment = User::with(['appointments' => function ($query) use ($id) {
            $query->where('id', $id);
        }])->where('id', '=', auth()->user()->id)->first();
        return view('user.my-schedule-downloadable', compact('appointment'));
    }


    public function download($id)
    {
        $appointment = User::with(['appointments' => function ($query) use ($id) {
            $query->where('id', $id);
        }])->where('id', '=', auth()->user()->id)->first();
        $pdf = SnappyPdf::loadView('pdf.my-schedule', compact('appointment'));
        return $pdf->download('my-schedule.pdf');
    }
}
