@extends('layouts.user_template')

@section('content')

<h4 class="fw-bold mb-1">My Profile</h4>
<p class="text-muted mb-4" style="font-size:14px;">Manage your personal information and settings.</p>

<div class="row g-4">

    {{-- LEFT CARD --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">

            {{-- CLICKABLE PROFILE PICTURE --}}
            <label for="profilePicTrigger" style="cursor:pointer;" title="Click to change photo">
                @if(session('user')->profile_picture)
                    <img src="{{ asset(session('user')->profile_picture) }}"
                         class="rounded-circle mx-auto mb-1 d-block"
                         style="width:80px;height:80px;object-fit:cover;">
                @else
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto mb-1 fw-bold fs-1"
                         style="width:80px;height:80px;">
                        {{ strtoupper(substr(session('user')->fullname, 0, 1)) }}
                    </div>
                @endif
                <small class="text-muted d-block mb-3" style="font-size:11px;">
                    <i class="bi bi-camera me-1"></i>Click to change
                </small>
            </label>

            <h5 class="fw-bold mb-1">{{ session('user')->fullname }}</h5>
            <p class="text-muted mb-3" style="font-size:13px;">{{ session('user')->role ?? 'Administrator' }}</p>
            <div class="text-start border-top pt-3">
                <p class="mb-2" style="font-size:13px;">
                    <i class="bi bi-envelope me-2 text-muted"></i>{{ session('user')->email }}
                </p>
                <p class="mb-2" style="font-size:13px;">
                    <i class="bi bi-telephone me-2 text-muted"></i>{{ session('user')->contact ?? '—' }}
                </p>
                <p class="mb-2" style="font-size:13px;">
                    <i class="bi bi-geo-alt me-2 text-muted"></i>{{ session('user')->address ?? '—' }}
                </p>
            </div>
            <p class="text-muted mt-2 mb-0" style="font-size:12px;">
                Joined {{ session('user')->created_at->format('M d, Y') }}
            </p>
        </div>
    </div>

    {{-- RIGHT CARD --}}
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-1">Edit Profile</h6>
            <p class="text-muted mb-4" style="font-size:13px;">Update your personal details below.</p>

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                                   value="{{ old('fullname', session('user')->fullname) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', session('user')->email) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select gender</option>
                            <option value="Male" {{ old('gender', session('user')->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', session('user')->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="contact" class="form-control"
                                   value="{{ old('contact', session('user')->contact) }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', session('user')->address) }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Profile Picture</label>
                        {{-- Hidden input synced with the clickable avatar label --}}
                        <input type="file" name="profile_picture" id="profilePicTrigger"
                               class="form-control @error('profile_picture') is-invalid @enderror"
                               accept="image/*">
                        <div class="form-text">JPG, JPEG, PNG — max 2MB</div>
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection