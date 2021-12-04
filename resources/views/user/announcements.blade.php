@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        <div>
            @include('components.dropdown-profile')

            <div class="container-md d-flex justify-content-center announceTitle">
                <h3 class="mt-3"><b>Announcements</b></h3>
            </div>

            <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
                <table class="table table-borderless table-responsive card-1 p-4">
                    @if (auth()->user()->is_admin)
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-success add-new" data-toggle="modal"
                                data-target="#announcementModal"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    @endif

                    <thead>
                        <tr class="border-bottom">
                            <th> <span class="ml-6">Time</span> </th>
                            <th> <span class="ml-2">Advertisement</span> </th>
                            <th> <span class="ml-2">Title</span> </th>
                            <th> <span class="ml-2">Description</span> </th>
                            <th> <span class="ml-4">Action</span> </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr class="border-bottom">
                                <td>
                                    <div class="p-2"> <span
                                            class="d-block font-weight-bold">{{ \Carbon\Carbon::parse($announcement->date)->diffForHumans() }}</span>
                                        {{ $announcement->date }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 d-flex flex-row align-items-center mb-2">
                                        <a href="{{ $announcement->getFirstMediaUrl('images') }}">
                                            <img src="{{ $announcement->getFirstMediaUrl('images') }}" width="200"></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2"> <span
                                            class="font-weight-bold">{{ $announcement->title }}</span> </div>
                                </td>
                                <td>
                                    <div class="p-2">
                                        <span>{{ $announcement->description }}</span>
                                    </div>
                                </td>
                                @if (auth()->user()->is_admin)
                                    <td>
                                        <div class="p-2">
                                            <a href="{{ route('admin.announcements.edit', ['announcement' => $announcement]) }}"
                                                class="btn btn-info">Edit
                                                Details </a>
                                        </div>
                                        <div class="p-2">
                                            <form
                                                action="{{ route('admin.announcements.destroy', ['announcement' => $announcement]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
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
                            <h5 class="modal-title" id="announcementModalLabel">Create Announcement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @if ($errors->any())
                            <div class="rounded bg-danger text-white w-50 p-3 mb-2">

                                @foreach ($errors->all() as $error)
                                    <div>• <span>{{ $error }}</span></div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('admin.announcements.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="modal-body">
                                    <input type="file" name="photo" />
                                    <div class="mb-3 ">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" id="announcement_title"
                                            required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            id="announcement_description" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label class="form-label">Date</label>
                                        <input type="text" name="date" id="datepicker" class="form-control" required>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

        const picker = new Pikaday({
            field: document.getElementById('datepicker'),
            format: 'MM/DD/YYYY',
        });
    </script>
@endsection
@endsection
