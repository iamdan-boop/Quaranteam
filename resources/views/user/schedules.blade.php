@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        <div>
            @include('components.dropdown-profile')
            <div class="container-md d-flex justify-content-center announceTitle">
                <h3 class="mt-3"><b>Bookings</b></h3>
            </div>

            <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
                <table class="table table-borderless table-responsive card-1 p-4">
                    <thead>
                        <tr class="border-bottom">
                            <th> <span class="ml-6">Name</span> </th>
                            <th> <span class="ml-6">Date</span> </th>
                            <th> <span class="ml-2">Slots Allocated</span> </th>
                            <th> <span class="ml-2">Slots Booked</span> </th>
                            <th> <span class="ml-2">Slots Available</span> </th>
                            <th> <span class="ml-2">Dose</span> </th>
                            <th> <span class="ml-2">Address</span> </th>
                            <th> <span class="ml-2">Action</span> </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr class="border-bottom">
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ $appointment->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ \Carbon\Carbon::parse($appointment->date)->format('m/d/Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2"> <span
                                            class="font-weight-bold">{{ $appointment->slots_allocated }}</span> </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <span>{{ $appointment->slots_booked }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <span>{{ $appointment->slots_allocated - $appointment->slots_booked }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <span>{{ $appointment->dose }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <span>{{ $appointment->address }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($appointment->active == 0)
                                        <button class="btn btn-success" style="background-color: #5bacaf;">Closed</button>
                                    @else
                                        <form
                                            action="{{ route('resident.book.schedule', ['appointments' => $appointment]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success"
                                                style="background-color: #5bacaf;">Book
                                                Now</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
