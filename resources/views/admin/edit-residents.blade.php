@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        @include('components.dropdown-profile')

        <div class="container-md d-flex justify-content-center announceTitle">
            <h3 class="mt-3"><b>Edit Residents</b></h3>
        </div>
        <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
            @if ($errors->any())
                <div class="rounded bg-danger text-white w-50 p-3 mb-2">

                    @foreach ($errors->all() as $error)
                        <div>• <span>{{ $error }}</span></div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('admin.manage-residents.update', ['manage_resident' => $resident]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="exampleInputFN" class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" aria-label="First name"
                            value="{{ $resident->firstname }}" required="required">
                    </div>

                    <div class="col mb-3">
                        <label for="exampleInputLN" class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" aria-label="Last name"
                            value="{{ $resident->lastname }}" required="required">
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="exampleInputUsername1" class="form-label">Username</label>
                    <input type="username" name="username" class="form-control" id="exampleInputUsername1"
                        value="{{ $resident->username }}" required="required">
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $resident->email }}"
                        id="exampleInputEmail1" required="required">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>

                <center><button type="submit" class="btn btn-primary"
                        style="background-color:
                                                                                                                                                                                                    #284e50;">Save
                        Changes</button>
                </center>
            </form>
        </div>
    </div>
@endsection
