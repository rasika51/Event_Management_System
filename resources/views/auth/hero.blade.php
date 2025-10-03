@extends('layouts.app')

@section('content')
<div class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <!-- Hero Content - 3/4 width -->
            <div class="col-lg-8 col-md-7 text-white">
                <div class="hero-content">
                    <h1 class="display-3 fw-bold mb-4">
                        <i class="bi bi-calendar-event me-3"></i>
                        Event Management System
                    </h1>
                    <p class="lead mb-4 fs-4">
                        Organize, manage, and track your events with ease. 
                        Create memorable experiences and streamline your event planning process.
                    </p>
                    
                    <div class="row mt-5">
                        <div class="col-md-4 mb-4">
                            <div class="feature-box text-center">
                                <i class="bi bi-calendar-plus display-4 mb-3"></i>
                                <h5>Create Events</h5>
                                <p>Easily create and customize your events with detailed information.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-box text-center">
                                <i class="bi bi-people display-4 mb-3"></i>
                                <h5>Manage Participants</h5>
                                <p>Track attendees and manage participant limits effectively.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-box text-center">
                                <i class="bi bi-graph-up display-4 mb-3"></i>
                                <h5>Analytics</h5>
                                <p>Get insights and analytics about your events and participants.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Auth Forms - 1/4 width -->
            <div class="col-lg-4 col-md-5">
                <div class="auth-container">
                    <!-- Login/Register Toggle -->
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white border-0 pt-4">
                            <ul class="nav nav-pills nav-justified" id="authTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="login-tab" data-bs-toggle="pill" 
                                            data-bs-target="#login" type="button" role="tab">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="register-tab" data-bs-toggle="pill" 
                                            data-bs-target="#register" type="button" role="tab">
                                        <i class="bi bi-person-plus me-2"></i>Register
                                    </button>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="tab-content" id="authTabsContent">
                                <!-- Login Form -->
                                <div class="tab-pane fade show active" id="login" role="tabpanel">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="login_email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="login_email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="login_password" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="login_password" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Register Form -->
                                <div class="tab-pane fade" id="register" role="tabpanel">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="register_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="register_name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="register_email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="register_email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="register_role" class="form-label">Role</label>
                                            <select class="form-select @error('role') is-invalid @enderror" 
                                                    id="register_role" name="role" required>
                                                <option value="">Select Role</option>
                                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="register_password" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="register_password" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="register_password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" 
                                                   id="register_password_confirmation" name="password_confirmation" required>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="bi bi-person-plus me-2"></i>Register
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    // Show register tab if there are registration errors
    @if(old('name') || old('role') || $errors->has('name') || $errors->has('role'))
        document.addEventListener('DOMContentLoaded', function() {
            const registerTab = new bootstrap.Tab(document.getElementById('register-tab'));
            registerTab.show();
        });
    @endif
</script>
@endif
@endsection
