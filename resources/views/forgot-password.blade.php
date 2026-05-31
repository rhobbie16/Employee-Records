<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - ERMS Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="card border-0 shadow p-4" style="width:100%;max-width:420px;">
    <div class="text-center mb-4">
        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
            <i class="bi bi-building text-primary fs-3"></i>
        </div>
        <h4 class="fw-bold">Reset your password</h4>
        <p class="text-muted" style="font-size:14px;">Enter your email and we'll send reset instructions</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" placeholder="you@company.com">
    </div>

    <button class="btn btn-primary w-100 mb-3">Send reset link</button>

    <div class="text-center">
        <a href="{{ route('signin') }}" class="text-decoration-none text-muted" style="font-size:14px;">
            <i class="bi bi-arrow-left me-1"></i> Back to login
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
