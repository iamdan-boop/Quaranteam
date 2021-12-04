@extends('layouts.app')

@section('section')
    <div>
        @push('styles')
            <link rel="stylesheet" href="{{ asset('css/resident-style.css') }}">
        @endpush
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper" style="background-color: #f0f7f7;">
                <center><img src="{{ asset('img/logo.png') }}" class="img-fluid mt-4" alt="Lourdes Young" width="100">
                </center>
                <div class="sidebar-heading text-center primary-text fs-5 fw-bold text-uppercase border-bottom">Lourdes Young
                </div>

                <div class="list-group list-group-flush my-3">
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.admin.dashboard') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-home me-2"></i>Home</a>
                        <a href="{{ route('admin.manage-residents.index') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-users me-2"></i></i>Residents</a>
                    @else
                        <a href="{{ route('resident.residence.dashboard') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-home me-2"></i>Home</a>
                    @endif

                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.announcements.index') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-users me-2"></i></i>Announcements</a>
                    @else
                        <a href="{{ route('resident.announcements') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-users me-2"></i></i>Announcements</a>
                    @endif

                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.manage-appointments.index') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-syringe me-2"></i>Bookings</a>
                    @else
                        <a href="{{ route('resident.schedules') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-syringe me-2"></i>Bookings</a>
                        <a href="{{ route('my-schedules') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-syringe me-2"></i>My Schedules</a>
                    @endif
                    {{-- @if (!auth()->user()->is_admin)
                        <a href="{{ route('resident.schedules') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-syringe me-2"></i>My Schedules</a>
                    @endif --}}
                    <a {{-- href="AboutUs.php" --}}
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-address-card me-2"></i>About Us</a>
                    <form action="{{ route('residence.logout') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                class="fas fa-power-off me-2"></i>Logout</button>
                    </form>
                </div>
            </div>
            @yield('resident-child')
        </div>

        <script>
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            };
        </script>
    </div>
@endsection
