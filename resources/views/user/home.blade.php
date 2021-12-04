@extends('components.head-resident')


@section('resident-child')
    <div id="page-content-wrapper">
        @include('components.dropdown-profile')
        <div class="container-fluid px-4">
        </div>
        @if (!auth()->user()->is_admin)
            @include('components.footer')
        @endif
    </div>
@endsection
