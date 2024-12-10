<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 5%;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .login-card .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #4a76a8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #395d89;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="text-center mb-4 text-primary">Sign In</h3>
                        
                        <!-- Error message -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Username input -->
                            <div class="mb-3">
                                <label for="Username" class="form-label">Username</label>
                                <input type="text" id="Username" name="Username" class="form-control" placeholder="Enter your username" required />
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" id="Password" name="Password" class="form-control" placeholder="Enter your password" required />
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
