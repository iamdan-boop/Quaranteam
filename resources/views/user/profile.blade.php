@extends('components.head-resident')

@section('resident-child')

    <div id="page-content-wrapper">
        <div class="container-md d-flex justify-content-center mt-5 formTitle">
            <h2 class="mt-3 mp"><b>
                    My Profile</b>
            </h2>
        </div>
        <div class="container-fluid regContent p-4 mb-5 mainprofile">
            <div class="container rounded bg-white mb-5">
                <div class="row">
                    <div class="col-md-5 border-right profile justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center  py-5">
                            @if (auth()->user()->getFirstMediaUrl('avatars'))
                                <img class="rounded-circle" width="150px"
                                    src="{{ auth()->user()->getFirstMediaUrl('avatars') }}">
                            @else
                                <img class="rounded-circle" width="150px"
                                    src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                            @endif
                            <span class="font-weight-bold">{{ $user->firstname }}</span>
                            <span class="text-black-50">{{ $user->email }}</span><span> </span>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary profile-button" type="button" data-toggle="modal"
                                data-target="#imageUpload">
                                <i class="fas fa-upload"></i>Upload new photo</button>
                        </div>
                    </div>
                    <div class="col-md-7 border-right profile-settings">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right"><b>Profile Settings</b></h4>
                            </div>
                            @if ($errors->any())
                                <div class="rounded bg-danger text-white w-50 p-3 mb-2">

                                    @foreach ($errors->all() as $error)
                                        <div>• <span>{{ $error }}</span></div>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('profile.update') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-floating mb-3">
                                    <input name="firstname" type="text" class="form-control" id="floatingFN"
                                        placeholder="First Name" value="{{ $user->firstname }}">
                                    <label for="floatingPassword">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="lastname" class="form-control" id="floatingLN"
                                        placeholder="Last Name" value="{{ $user->lastname }}">
                                    <label for="floatingPassword">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="address" class="form-control" id="floatingAddress"
                                        placeholder="Address" value="{{ $user->address }}">
                                    <label for="floatingPassword">Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="contact_number" class="form-control" id="floatingAddress"
                                        placeholder="ContactNo" value="{{ $user->contact_number }}">
                                    <label for="floatingContactNo">Contact Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingAddress"
                                        placeholder="EmailAdd" value="{{ $user->email }}">
                                    <label for="floatingEmailAdd">Email Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingPassword"
                                        placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button"
                                        type="submit">Save
                                        Profile</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Upload Modal --}}
    <div class="modal fade" id="imageUpload" tabindex="-1" role="dialog" aria-labelledby="imageUploadLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('profile.photo') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageUploadLabel">Upload Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="photo" class="filepond">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js">
    </script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginImageValidateSize);
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('upload') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endsection
@endsection
