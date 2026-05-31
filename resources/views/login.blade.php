@extends('layouts.main')

@section('content')

<form action="/login" class="was-validated" method="POST">
    @csrf
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card bg-white text-black border-0 shadow-lg p-4 rounded-4" style="width:100%; max-width:400px;">

            <!-- Logo -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/emp.png') }}" alt="logo" height="50">
            </div>

            <!-- Title -->
            <h3 class="text-center fw-bold mb-1">Sign in to ERMS</h3>
            <h6 class="text-center fw-light mb-4">Employee Records Management System</h6>

            <!-- EMAIL -->
            <div class="mb-4">
                <label for="email" class="form-label mb-1">Email Address</label>
                <input type="email" class="form-control border-black" name="email" id="email" placeholder="name@example.com" required>
                <div class="invalid-feedback">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label for="password" class="form-label mb-1">Password</label>
                <input type="password" class="form-control border-black" name="password" id="password" placeholder="Enter your password" required>
                <div class="invalid-feedback">
                </div>
            </div>

            <!-- FORGOT PASSWORD -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('forgot-password') }}" class="text-decoration-none">
                    Forgot Password?
                </a>
            </div>

            <!-- LOGIN BUTTON -->
            <div class="d-grid mb-0">
                <button class="btn btn-primary rounded-pill fw-bold" type="submit">
                    Log In
                </button>
            </div>

            <!-- DIVIDER -->
            <hr class="border-black my-3">

            <!-- SIGN UP LINK -->
            <p class="text-center mb-0 fw-light">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                    Sign up
                </a>
            </p>

        </div>
    </div>
</form>

@endsection