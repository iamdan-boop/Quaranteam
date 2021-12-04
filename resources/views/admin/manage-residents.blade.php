@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        <div>
            @include('components.dropdown-profile')
            <div class="container-md d-flex justify-content-center announceTitle">
                <h3 class="mt-3"><b>Residents</b></h3>
            </div>
            <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
                <table class="table table-borderless table-responsive card-1 p-4">
                    <thead>
                        <tr class="border-bottom">
                            <th> <span class="col-sm-6 col-md-5 col-lg-6 fs-5">Firstname</span> </th>
                            <th> <span class="col-sm-6 col-md-5 col-lg-6 fs-5">Lastname</span> </th>
                            <th> <span class="col-sm-6 col-md-5 col-lg-6 fs-5">Email</span> </th>
                            <th> <span class="col-sm-6 col-md-5 col-lg-6 fs-5">Action</span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residents as $resident)
                            <tr class="border-bottom">
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ $resident->firstname }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ $resident->lastname }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ $resident->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <a href="{{ route('admin.manage-residents.edit', ['manage_resident' => $resident]) }}"
                                            class="btn btn-info mr-4"><i class="fas fa-eye"></i>View</a>
                                        <form class="pt-2"
                                            action="{{ route('admin.manage-residents.destroy', ['manage_resident' => $resident]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger "><i
                                                    class="fas fa-trash-alt"></i>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
