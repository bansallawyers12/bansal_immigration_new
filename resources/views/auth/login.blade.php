<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .login-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }
        
        .login-left {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        
        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }
        
        .checkbox-wrapper input {
            margin-right: 0.5rem;
            transform: scale(1.1);
        }
        
        .forgot-password {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: #3b82f6;
        }
        
        .back-link {
            margin-top: 2rem;
            text-align: center;
        }
        
        .back-link a {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }
        
        .back-link a:hover {
            color: #3b82f6;
        }
        
        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            border: 1px solid #fecaca;
        }
        
        .success-message {
            background: #f0fdf4;
            color: #16a34a;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            border: 1px solid #bbf7d0;
        }
        
        @media (max-width: 768px) {
            .login-card {
                grid-template-columns: 1fr;
                max-width: 400px;
            }
            
            .login-left {
                padding: 2rem;
            }
            
            .login-right {
                padding: 2rem;
            }
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side - Branding -->
            <div class="login-left">
                <div class="floating-shapes">
                    <div class="shape"></div>
                    <div class="shape"></div>
                    <div class="shape"></div>
                </div>
                
                <div class="login-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                
                <h2 class="text-3xl font-bold mb-4">Welcome Back!</h2>
                <p class="text-blue-100 text-lg mb-6">
                    Sign in to access your admin dashboard and manage your immigration services.
                </p>
                
                <div class="flex items-center justify-center space-x-4 text-blue-200">
                    <div class="flex items-center">
                        <i class="fas fa-lock mr-2"></i>
                        <span class="text-sm">Secure</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-bolt mr-2"></i>
                        <span class="text-sm">Fast</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-mobile-alt mr-2"></i>
                        <span class="text-sm">Responsive</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Admin Login</h1>
                    <p class="text-gray-600">Enter your credentials to access the admin panel</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="success-message">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>
                            Email Address
                        </label>
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="Enter your email address" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>
                            Password
                        </label>
                        <input id="password" 
                               class="form-input" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="Enter your password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="checkbox-wrapper">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                               name="remember">
                        <label for="remember_me" class="text-sm text-gray-600">
                            Remember me for 30 days
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In to Dashboard
                    </button>

                    <!-- Forgot Password -->
                    <div class="text-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                <i class="fas fa-question-circle mr-1"></i>
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Back to Website -->
                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Website
                    </a>
                </div>
                
                <!-- Demo Credentials -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Demo Credentials:</h4>
                    <div class="text-xs text-gray-600 space-y-1">
                        <div><strong>Email:</strong> admin@bansalimmigration.com</div>
                        <div><strong>Password:</strong> admin123</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove loading screen when page loads -->
    <script>
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>