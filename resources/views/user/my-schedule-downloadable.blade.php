@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        @include('components.dropdown-profile')
        <div class="container-md d-flex justify-content-center announceTitle">
            <h3 class="mt-3"><b>My Schedule</b></h3>
        </div>

        <div class="container-fluid announceContent">
            <br>
            <h3 class="pb-3"> <b> Booking Details </b></h3>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold mb-2">Name:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5">{{ $appointment->firstname }}
                    {{ $appointment->lastname }}</div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold mb-2">Address:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5">
                    {{ $appointment->appointments[0]->address }}</div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold ">Contact Number:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5 mb-4">
                    {{ $appointment->appointments[0]->contact_number }}</div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold mb-2">Booking Reference Code:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5">
                    {{ $appointment->appointments[0]->pivot->reference_code }}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold mb-2">Dose:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5">
                    {{ $appointment->appointments[0]->dose }}</div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6 fs-5 fw-bold ">Date:</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 fs-5 mb-2">
                    {{ $appointment->appointments[0]->date }}</div>
            </div>

            <hr>

            <div class="text-center"><a
                    href="{{ route('resident.download.schedule', ['id' => $appointment->appointments[0]]) }}"
                    class="btn btn-success profile-button mb-4" type="button">
                    <i class="fas fa-upload"></i>Download file here</button></a>
            </div>
        </div>
    @endsection
