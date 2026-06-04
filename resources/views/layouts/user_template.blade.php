<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
  </head>
<body class="bg-light">

{{-- TOP NAVBAR --}}
<nav class="navbar bg-dark navbar-dark px-3 py-2 sticky-top">
    <div class="d-flex align-items-center gap-2">
        {{-- HAMBURGER --}}
        <button class="btn btn-dark border-0 p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="bi bi-list fs-4 text-white"></i>
        </button>
        <div class="d-flex align-items-center gap-2">
            <div class="bg-primary rounded p-1 d-flex align-items-center justify-content-center">
                <i class="bi bi-building text-white"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size:14px;">ERMS Pro</div>
                <div class="text-secondary" style="font-size:10px;">Employee Records</div>
            </div>
        </div>
    </div>
    <div class="ms-auto d-flex align-items-center gap-2">
        <span class="fw-medium text-white d-none d-md-block" style="font-size:14px;">
            {{ session('user') ? session('user')->fullname : 'Guest' }}
        </span>
        <a href="{{ route('profile') }}" class="text-decoration-none">
            @if(session('user') && session('user')->profile_picture)
                <img src="{{ asset(session('user')->profile_picture) }}"
                     class="rounded-circle"
                     style="width:34px;height:34px;object-fit:cover;">
            @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                     style="width:34px;height:34px;font-size:13px;">
                    {{ session('user') ? strtoupper(substr(session('user')->fullname, 0, 1)) : 'G' }}
                </div>
            @endif
        </a>
    </div>
</nav>

{{-- OFFCANVAS SIDEBAR --}}
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebar" style="width:240px;">
    <div class="offcanvas-header border-bottom border-secondary">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-primary rounded p-1 d-flex align-items-center justify-content-center">
                <i class="bi bi-building text-white"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size:14px;">ERMS Pro</div>
                <div class="text-secondary" style="font-size:10px;">Employee Records</div>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-2 d-flex flex-column">
        <ul class="nav nav-pills flex-column gap-1 flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : 'text-white-50' }}">
                    <i class="bi bi-grid-1x2 fs-6"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('employees') ? 'active' : 'text-white-50' }}">
                    <i class="bi bi-person-lines-fill fs-6"></i> Employees
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('departments') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('departments') ? 'active' : 'text-white-50' }}">
                    <i class="bi bi-building fs-6"></i> Departments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user') ? 'active' : 'text-white-50' }}">
                    <i class="bi bi-people fs-6"></i> Users
                </a>
            </li>
            <li><hr class="border-secondary my-1"></li>
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('profile') ? 'active' : 'text-white-50' }}">
                    <i class="bi bi-person-circle fs-6"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <button type="button"
                        class="nav-link text-white-50 d-flex align-items-center gap-2 w-100 border-0 bg-transparent"
                        data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-left fs-6"></i> Logout
                </button>
            </li>
        </ul>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="container-fluid">
    <div class="row">

        {{-- DESKTOP SIDEBAR --}}
        <div class="col-auto d-none d-lg-flex flex-column bg-dark text-white p-0" style="width:240px; min-height:calc(100vh - 54px); position:sticky; top:54px;">
            <ul class="nav nav-pills flex-column p-2 gap-1 flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : 'text-white-50' }}">
                        <i class="bi bi-grid-1x2 fs-6"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employees') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('employees') ? 'active' : 'text-white-50' }}">
                        <i class="bi bi-person-lines-fill fs-6"></i> Employees
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('departments') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('departments') ? 'active' : 'text-white-50' }}">
                        <i class="bi bi-building fs-6"></i> Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('user') ? 'active' : 'text-white-50' }}">
                        <i class="bi bi-people fs-6"></i> Users
                    </a>
                </li>
                <li><hr class="border-secondary my-1"></li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('profile') ? 'active' : 'text-white-50' }}">
                        <i class="bi bi-person-circle fs-6"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <button type="button"
                            class="nav-link text-white-50 d-flex align-items-center gap-2 w-100 border-0 bg-transparent"
                            data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="bi bi-box-arrow-left fs-6"></i> Logout
                    </button>
                </li>
            </ul>
        </div>

        {{-- PAGE CONTENT --}}
        <div class="col p-4">
            @yield('content')
        </div>

    </div>
</div>

{{-- LOGOUT MODAL --}}
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:56px;height:56px;">
                    <i class="bi bi-box-arrow-left text-danger fs-4"></i>
                </div>
                <h6 class="fw-bold mb-1">Log out?</h6>
                <p class="text-muted mb-4" style="font-size:13px;">Are you sure you want to log out of your account?</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm px-4">Yes, Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODALS --}}
@stack('modals')

{{-- TOASTS --}}
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
    @if(session('success'))
    <div class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast align-items-center text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="toast align-items-center text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.toast').forEach(function (toastEl) {
            new bootstrap.Toast(toastEl, { delay: 4000 }).show();
        });
    });
</script>

</body>
</html>