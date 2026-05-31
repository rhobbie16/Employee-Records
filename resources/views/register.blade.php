@extends('layouts.main')

@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 p-3">

  <div class="card bg-white text-black border-0 shadow-lg p-4 rounded-4 w-100" 
       style="max-width:480px;">

    <!-- Logo -->
    <div class="text-center mb-2">
      <img src="images/emp.png" alt="logo" height="50">
    </div>

    <h3 class="text-center fw-bold mb-2">Create an account</h3>
    <h6 class="text-center fw-light mb-4">
      Join the Employee Records Management System
    </h6>

    <form action="/register" class="was-validated" method="POST">
      @csrf

      <!-- FULL NAME -->
      <div class="mb-3">
          <label for="name" class="form-label mb-1">Full Name</label>
          <input type="text" class="form-control border-black"
                name="fullname" id="name"
                placeholder="Enter your full name (e.g. Rhobbie Faraon)" required>
      </div>

      <!-- EMAIL + CONTACT -->
      <div class="row g-2 mb-3">

        <div class="col-md-6">
          <label for="email" class="form-label mb-1">Email</label>
          <input type="email" class="form-control border-black"
                 name="email" id="email"
                 placeholder="name@example.com" required>
        </div>

        <div class="col-md-6">
          <label for="contact" class="form-label mb-1">Contact</label>
          <input type="text" class="form-control border-black"
                 name="contact" id="contact"
                 placeholder="09XXXXXXXXX" required>
        </div>

      </div>

      <!-- PASSWORD -->
      <div class="mb-3">
        <label for="password" class="form-label mb-1">Password</label>
        <input type="password" class="form-control border-black"
               name="password" id="password"
               placeholder="Enter your password" required minlength="7">
      </div>

      <!-- CONFIRM PASSWORD -->
      <div class="mb-4">
        <label for="confirmpassword" class="form-label mb-1">Confirm Password</label>
        <input type="password" class="form-control border-black"
               name="confirmpassword" id="confirmpassword"
               placeholder="Re-enter your password" required minlength="7">
      </div>

      <!-- BUTTON -->
      <div class="d-grid">
        <button class="btn btn-primary rounded-pill fw-bold">
          Submit
        </button>
      </div>

    </form>

    <hr class="my-3">

    <!-- LOGIN LINK -->
    <p class="text-center mb-0 fw-light">
      Already have an account?
      <a href="{{ route('signin') }}" class="text-primary fw-bold text-decoration-none">
        Login
      </a>
    </p>

  </div>
</div>

@endsection