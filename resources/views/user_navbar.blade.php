<nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top" style="backdrop-filter: blur(10px);">
    <div class="container-fluid px-3">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <div class="d-flex align-items-center gap-2">

            <a href="#" class="btn btn-outline-light btn-sm">
                Profile
            </a>

            <a href="{{ route('user') }}" class="btn btn-outline-success btn-sm">
                Users
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

<div class="container-fluid px-0">
    <div class="row min-vh-100 g-0">

        <!-- LEFT SIDEBAR -->
        <div class="col-3 text-white p-4" style="background-color: black;">
            <div class="card bg-dark text-white border-success mb-4">
                <div class="card-body text-center">
                    <h6 class="text-success">WELCOME BACK!</h6>
                    <h2>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h2>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-success w-100">Start Exploring</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN AREA -->
        <div class="col-9 p-4">
            @yield('content')
        </div>

    </div>
</div>