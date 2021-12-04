@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        <div>
            @include('components.dropdown-profile')
            <div class="container-md d-flex justify-content-center announceTitle">
                <h3 class="mt-3"><b>Appointments</b></h3>
            </div>

            <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
                <table class="table table-borderless table-responsive card-1 p-4">
                    <div class="col-sm-4 row">
                        <button type="button" class="btn btn-success add-new" data-toggle="modal"
                            data-target="#announcementModal"><i class="fa fa-plus"></i> Add New</button>
                    </div>

                    <thead>
                        <tr class="border-bottom">
                            <th> <span class="ml-6">Name</span> </th>
                            <th> <span class="ml-6">Date</span> </th>
                            <th> <span class="ml-2">Slots Allocated</span> </th>
                            <th> <span class="ml-2">Slots Booked</span> </th>
                            <th> <span class="ml-2">Slots Available</span> </th>
                            <th> <span class="ml-2">Dose</span> </th>
                            <th> <span class="ml-2">Address</span> </th>
                            <th> <span class="ml-4">Action</span> </th>
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
                                    <div class="p-2">
                                        <a href="{{ route('admin.manage-appointments.edit', ['manage_appointment' => $appointment]) }}"
                                            class="btn btn-info">Edit
                                            Details </a>
                                    </div>
                                    <div class="p-2">
                                        <form
                                            action="{{ route('admin.manage-appointments.destroy', ['manage_appointment' => $appointment]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Create Announcement Modal -->
            <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog"
                aria-labelledby="announcementModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="announcementModalLabel">Create Appointments</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="m-3">
                            @if ($errors->any())
                                <div class="rounded bg-danger text-white w-50 p-3 mb-2">
                                    @foreach ($errors->all() as $error)
                                        <div>• <span>{{ $error }}</span></div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.manage-appointments.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="modal-body">
                                    <div class="mb-3 ">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Contact No.:</label>
                                        <input type="text" name="contact_number" class="form-control" id="contact_number"
                                            required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Date</label>
                                        <input type="text" name="date" id="datepicker" class="form-control" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Slots Allocated</label>
                                        <input type="number" name="slots_allocated" class="form-control"
                                            id="slots_allocated" required>
                                    </div>

                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                        name="dose">
                                        <option selected="true" disabled>Select Dosage</option>
                                        <option value="First Dose">First Dosage</option>
                                        <option value="Second Dose">Second Dosage</option>
                                    </select>

                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                        name="active">
                                        <option selected="true" disabled>Enable/Disable</option>
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

    <script>
        const picker = new Pikaday({
            field: document.getElementById('datepicker'),
            format: 'MM/DD/YYYY',
        });
    </script>
@endsection
@endsection
