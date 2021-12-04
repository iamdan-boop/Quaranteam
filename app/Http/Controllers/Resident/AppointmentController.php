<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;

class AppointmentController extends Controller
{


    public function store(AppointmentRequest $request)
    {
        $appoinment = Appointment::create($request->validated());
        return $appoinment;
    }

    public function destroy($id)
    {
        $appoinment = Appointment::destroy($id);
        return $appoinment;
    }
}
