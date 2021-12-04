@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        @include('components.dropdown-profile')

        <div class="container-md d-flex justify-content-center announceTitle">
            <h3 class="mt-3"><b>Edit Appointment</b></h3>
        </div>
        <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
            @if ($errors->any())
                <div class="rounded bg-danger text-white w-50 p-3 mb-2">

                    @foreach ($errors->all() as $error)
                        <div>• <span>{{ $error }}</span></div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('admin.manage-appointments.update', ['manage_appointment' => $appointment]) }}"
                method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="exampleInputFN" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" aria-label="First name"
                            value="{{ $appointment->name }}" required="required">
                    </div>

                    <div class="col mb-3">
                        <label for="exampleInputLN" class="form-label">
                            Address
                        </label>
                        <input type="text" name="address" class="form-control" aria-label="Last name"
                            value="{{ $appointment->address }}" required="required">
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="exampleInputUsername1" class="form-label">Contact Number</label>
                    <input type="username" name="contact_number" class="form-control" id="exampleInputUsername1"
                        value="{{ $appointment->contact_number }}" required="required">
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Date</label>
                    <input name="date" class="form-control" value="{{ $appointment->date }}" id="exampleInputEmail1"
                        required="required">
                </div>

                <div class="mb-3 ">
                    <label class="form-label">Slots Allocated</label>
                    <input type="number" name="slots_allocated" class="form-control" id="slots_allocated" required>
                </div>

                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="dose">
                    <option selected="true" disabled>Select Dosage</option>
                    <option value="First Dose">First Dosage</option>
                    <option value="Second Dose">Second Dosage</option>
                </select>


                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="active">
                    <option selected="true" disabled>Enable/Disable</option>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
                <center><button type="submit" class="btn btn-primary"
                        style="background-color:
                                                                                                                                                                                                                                                                                                #284e50;">Save
                        Changes</button>
                </center>
            </form>
        </div>
    </div>
@endsection
