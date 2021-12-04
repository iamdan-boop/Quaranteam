@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        @include('components.dropdown-profile')

        <div class="container-md d-flex justify-content-center announceTitle">
            <h3 class="mt-3"><b>Edit Announcements</b></h3>
        </div>

        <div class="container-fluid bookContent p-4 mb-5" style="background-color:#fff;">
            @if ($errors->any())
                <div class="rounded bg-danger text-white w-50 p-3 mb-2">
                    @foreach ($errors->all() as $error)
                        <div>• <span>{{ $error }}</span></div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('admin.announcements.update', ['announcement' => $announcement]) }}" method="POST">
                @method('PUT')
                @csrf
                <div>
                    <div class="modal-body">
                        <input type="file" name="photo" />
                        <div class="mb-3 ">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="announcement_title"
                                value="{{ $announcement->title }}" required>
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="announcement_description"
                                value="{{ $announcement->description }}" required>
                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Date</label>
                            <input type="text" name="date" id="datepicker" class="form-control"
                                value="{{ $announcement->date }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-whatever="@mdo">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </div>
            </form>
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

        const picker = new Pikaday({
            field: document.getElementById('datepicker'),
            format: 'MM/DD/YYYY',
        });
    </script>
@endsection
@endsection
