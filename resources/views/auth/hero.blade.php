<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:;">

    <title>{{ config('app.name', 'Event Management System') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .hero-section {
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80') center center;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 2rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 4px 4px 8px rgba(0,0,0,0.9);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.9);
            line-height: 1.6;
            opacity: 1;
        }

        .cta-button {
            background: linear-gradient(45deg, #1e3a8a, #1e40af);
            border: none;
            padding: 18px 50px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.7);
            color: white;
        }

        .auth-modal {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-pills .nav-link {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 12px 20px;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(45deg, #10b981, #059669);
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }


        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem 1.5rem 1rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }

            .cta-button {
                padding: 15px 40px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="bi bi-calendar-event me-3"></i>
                Event Management System
            </h1>
            <p class="hero-subtitle">
                Streamline your event planning with our powerful, user-friendly platform. 
                Create, manage, and track events effortlessly with advanced analytics and participant management.
            </p>
            
            <!-- CTA Button -->
            <div class="text-center">
                <a href="#" class="cta-button" data-bs-toggle="modal" data-bs-target="#authModal">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Get Started Now
                </a>
            </div>
        </div>
    </div>

    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content auth-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="authModalLabel">Access Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <!-- Login/Register Toggle -->
                    <ul class="nav nav-pills nav-justified mb-3" id="authTabs" role="tablist">
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
                    
                    <div class="tab-content" id="authTabsContent">
                        <!-- Login Form -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="login_email" class="form-label">Email Address</label>
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
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
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
                                    <label for="register_email" class="form-label">Email Address</label>
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
                                    <i class="bi bi-person-plus me-2"></i>Create Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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
</body>
</html>
